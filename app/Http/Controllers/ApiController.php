<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Holiday;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use OpenAI;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class ApiController extends Controller
{
    public function index()
    {
        $employees = Employee::query()->with('department')->get();
        $holidays = Holiday::all();

        return view('api.index', compact('employees', 'holidays'));
    }

    public function store(Request $request)
    {
        $messages = [
            'required' => 'Забыли заполнить кое что (:attribute)',
        ];
        $validator = Validator::make($request->all(), [
            'employee_id' => ['required'],
            'holiday_id' => ['required'],
            'description' => Rule::requiredIf(function () use ($request) {
                $birthdayHoliday = Holiday::query()->where('name', '=', 'день рождения')->get()->all()[0];
                return (int)$request->holiday_id !== $birthdayHoliday->id;
            }),
        ], $messages);

        if ($validator->fails()) {
            return redirect(route('api.index'))
                ->withErrors($validator)
                ->withInput();
        }

        $employee = Employee::query()->findOrFail($request->employee_id);
        $holiday = Holiday::query()->findOrFail($request->holiday_id);

        $client = OpenAI::client(env('API_KEY'));
        $response = $client->chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'user',
                    'content' => 'Напиши вариант поздравления на русском языке. Праздник: ' . $holiday->name . '. Именинника зовут: ' . $employee->first_name . '. Учти, что поздравление должно быть от лица компании Neovox, а также учти дополнительные сведения: ' . $request->description . '. Не забудь добавить пару эмодзи во всё поздравление'
                ],
            ],
        ]);
        $congratulationMessage = $response['choices'][0]['message']['content'];

        $mail = new PHPMailer(true);     // Passing `true` enables exceptions

        try {

            // Email server settings
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = env('MAIL_USERNAME');
            $mail->Password = env('MAIL_PASSWORD');
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->CharSet = PhpMailer::CHARSET_UTF8;

            $mail->setFrom('sender@example.com', 'Neovox AI');
            $mail->addAddress($employee->email);
            $mail->isHTML(true); // Set email content format to HTML

            $mail->Subject = 'С днём рождения, ' . $employee->first_name . '!';
            $mail->Body = view('api.mail.body', compact('congratulationMessage', 'employee'))->render();

            $mail->AltBody = '';

            if (!$mail->send()) {
                return json_encode([
                    'status' => 'error',
                    'result' => $mail->ErrorInfo,
                ]);
            } else {
                return json_encode([
                    'status' => 'success',
                    'congratulationMessage' => $congratulationMessage,
                    'email' => $employee->email,
                ]);
            }

        } catch (Exception $e) {
            return back()->with('error', 'Message could not be sent.');
        }


    }
}
