<?php

namespace App\Http\Controllers;

use App\Models\EmailLog;
use App\Models\Employee;
use App\Models\Holiday;
use App\Models\RequestToApiLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use OpenAI;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class EmailController extends Controller
{
    const EMOJI_HEARTS = [
        '&#128140;',
        '&#128147;',
        '&#128149;',
        '&#128150;',
        '&#128151;',
        '&#128152;',
        '&#128153;',
        '&#128154;',
        '&#128155;',
        '&#128156;',
        '&#128157;',
        '&#128158;',
        '&#10084;',
    ];
    private $holiday;
    private $employee;
    private string $letterSubject;
    private bool $emailLogged;
    private bool $requestLogged;
    private string $congratulationMessage;

    public function index()
    {
        $employees = Employee::query()->with('department')->get();
        $holidays = Holiday::all();

        return view('email.index', compact('employees', 'holidays'));
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

        $this->employee = Employee::query()->findOrFail($request->employee_id);
        $this->holiday = Holiday::query()->findOrFail($request->holiday_id);
        $requestData = [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'user',
                    'content' => 'Напиши вариант поздравления на русском языке. Праздник: ' . $this->holiday->name . '. Именинника зовут: ' . $this->employee->first_name . '. Учти, что поздравление должно быть от лица компании Neovox в адрес своего сотрудника, а также учти дополнительные сведения: "' . $request->description . '". Не забудь добавить пару эмодзи во всё поздравление.'
                ],
            ],
        ];

        $client = OpenAI::client(env('API_KEY'));
        $responseData = $client->chat()->create($requestData);
        $this->congratulationMessage = $responseData['choices'][0]['message']['content'];
//        return view('email.body', compact('congratulationMessage', 'employee', ));

        $this->requestLogged = $this->saveRequestToLog($requestData, $responseData);

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
            $mail->addAddress($this->employee->email);
            $mail->isHTML(true); // Set email content format to HTML

            $this->letterSubject = 'С днём рождения, ' . $this->employee->first_name . '!';
            $mail->Subject = $this->letterSubject;

            $mail->Body = view('email.body', [
                'congratulationMessage' => $this->congratulationMessage,
                'employee' => $this->employee
            ])->render();

            $mail->AltBody = '';

            if (!$mail->send()) {
                $this->emailLogged = $this->saveEmailLog(false);

                return json_encode([
                    'status' => 'error',
                    'result' => $mail->ErrorInfo,
                    'requestLogged' => $this->requestLogged,
                    'emailLogged' => $this->emailLogged,
                ]);
            } else {
                $this->emailLogged = $this->saveEmailLog(true);

                return json_encode([
                    'status' => 'success',
                    'congratulationMessage' => $this->congratulationMessage,
                    'email' => $this->employee->email,
                    'requestLogged' => $this->requestLogged,
                    'emailLogged' => $this->emailLogged,
                ]);
            }

        } catch (Exception $e) {
            return json_encode([
                'status' => 'error',
                'result' => $mail->ErrorInfo,
                'requestLogged' => $this->requestLogged,
                'emailLogged' => $this->emailLogged,
            ]);
        }
    }

    private function saveRequestToLog($request, $response): bool
    {
        return RequestToApiLog::query()->create([
            'created_at' => Carbon::createFromTimestamp($response['created']),
            'request_data' => json_encode($request),
            'response_data' => json_encode($response),
            'prompt_tokens' => $response['usage']['prompt_tokens'],
            'completion_tokens' => $response['usage']['completion_tokens'],
            'total_tokens' => $response['usage']['total_tokens'],
        ])->save();
    }

    private function saveEmailLog($isSuccess): bool
    {
        return EmailLog::query()->create([
            'holiday_id' => $this->holiday->id,
            'addressee_letter_email' => $this->employee->email,
            'addressee_copy_email' => null,
            'letter_subject' => $this->letterSubject,
            'letter_body' => $this->congratulationMessage,
            'created_at' => Carbon::now(),
            'is_send_success' => $isSuccess,
        ])->save();
    }
}
