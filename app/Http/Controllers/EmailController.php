<?php

namespace App\Http\Controllers;

use App\Models\EmailLog;
use App\Models\Employee;
use App\Models\Holiday;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
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
        $this->letterSubject = 'С днём рождения, ' . $this->employee->first_name . '!';

        $requestData = [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'user',
                    'content' => 'Напиши вариант поздравления на русском языке. Праздник: ' . $this->holiday->name . '. Именинника зовут: ' . $this->employee->first_name . '. Учти, что поздравление должно быть от лица компании Neovox в адрес своего сотрудника, а также учти дополнительные сведения: "' . $request->description . '". Не забудь добавить пару эмодзи во всё поздравление.'
                ],
            ],
        ];

        $responseData = ApiController::sendRequest($requestData);
        $this->congratulationMessage = $responseData['choices'][0]['message']['content'];
        $this->requestLogged = RequestToApiLogController::saveRequestToLog($requestData, $responseData);

        $mail = new PHPMailer(true);     // Passing `true` enables exceptions

        try {
            $mailer = new MailerController($this->employee, $this->congratulationMessage);
            $mailIsSend = $mailer->sendEmail($mail);

            if ($mailIsSend) {
                $this->emailLogged = $this->saveEmailLog(true);
                return json_encode([
                    'status' => 'success',
                    'congratulationMessage' => $this->congratulationMessage,
                    'email' => $this->employee->email,
                    'requestLogged' => $this->requestLogged,
                    'emailLogged' => $this->emailLogged,
                ]);
            } else {
                $this->emailLogged = $this->saveEmailLog(false);

                return json_encode([
                    'status' => 'error',
                    'result' => $mail->ErrorInfo,
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

    public function saveEmailLog(bool $isSuccess, Holiday $holiday = null, Employee $employee = null, string $letterSubject = null, string $congratulationMessage = null,): bool
    {
        return EmailLog::query()->create([
            'holiday_id' => $holiday->id ?? $this->holiday->id,
            'addressee_letter_email' => $employee->email ?? $this->employee->email,
            'addressee_copy_email' => null,
            'letter_subject' => $letterSubject ?? $this->letterSubject,
            'letter_body' => $congratulationMessage ?? $this->congratulationMessage,
            'created_at' => Carbon::now(),
            'is_send_success' => $isSuccess,
        ])->save();
    }
}
