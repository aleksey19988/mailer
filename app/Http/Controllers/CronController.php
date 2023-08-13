<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Holiday;
use Exception;
use PHPMailer\PHPMailer\PHPMailer;

class CronController extends Controller
{
    private Employee $birthdayEmployee;

    public function checkBirthday()
    {
        $birthdayEmployees = EmployeeController::getBirthdayEmployees();
        $todayDate = \Carbon\Carbon::today()->format('d.m.Y');

        if ($birthdayEmployees) {
            foreach($birthdayEmployees as $employee) {
                $logByEmail = \App\Models\EmailLog::query()
                    ->where([['addressee_letter_email', '=', $employee->email]])
                    ->first();
                if ($logByEmail) {
                    $logCreatedAt = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $logByEmail->created_at)->format('d.m.Y');
                    $emailSentToday = ($logCreatedAt == $todayDate);
                    if (!$emailSentToday) {
                        return $this->extracted($employee);
                    }
                } else {
                    return $this->extracted($employee);
                }
            }
            return json_encode([
                'status' => 'success',
                'message' => 'Все сегоняшние именинники получили свои поздравления',
            ]);
        } else {
            return json_encode([
                'status' => 'success',
                'message' => 'Именинников сегодня нет',
            ]);
        }
    }

    private function sendBirthdayEmail($employee): bool|string
    {
        $emailController = new EmailController();
        $holiday = Holiday::query()->where('name', '=', 'день рождения')->first();

        $requestData = [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'user',
                    'content' => 'Напиши вариант поздравления на русском языке. Праздник: ' . $holiday->name . '. Именинника зовут: ' . $this->birthdayEmployee->first_name . '. Учти, что поздравление должно быть от лица компании Neovox в адрес своего сотрудника". Не забудь добавить пару эмодзи во всё поздравление.'
                ],
            ],
        ];

        $responseData = ApiController::sendRequest($requestData);
        $emailController->saveRequestToLog($requestData, $responseData);

        $congratulationMessage = $responseData['choices'][0]['message']['content'];

        $mail = new PHPMailer(true);     // Passing `true` enables exceptions

        try {
            // Email server settings
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'mail.hosting.reg.ru';
            $mail->SMTPAuth = true;
            $mail->Username = env('MAIL_USERNAME');
            $mail->Password = env('MAIL_PASSWORD');
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->CharSet = PhpMailer::CHARSET_UTF8;

            $mail->setFrom(env('MAIL_USERNAME'), 'Neovox AI');
            $mail->addAddress($this->birthdayEmployee->email);
            $mail->isHTML(true); // Set email content format to HTML

            $mail->Subject = 'С днём рождения, ' . $this->birthdayEmployee->first_name . '!';

            $mail->Body = view('email.body', [
                'congratulationMessage' => $congratulationMessage,
                'employee' => $this->birthdayEmployee
            ])->render();

            $mail->AltBody = '';

            if (!$mail->send()) {
                $emailController->saveEmailLog(false, $holiday, $this->birthdayEmployee, $mail->Subject, $mail->Body);

                return json_encode([
                    'status' => 'error',
                    'result' => $mail->ErrorInfo,
                ]);
            } else {
                $emailController->saveEmailLog(true, $holiday, $this->birthdayEmployee, $mail->Subject, $mail->Body);

                return json_encode([
                    'status' => 'success',
                    'congratulationMessage' => $congratulationMessage,
                    'email' => $this->birthdayEmployee->email,
                ]);
            }

        } catch (Exception $e) {
            return json_encode([
                'status' => 'error',
                'result' => $mail->ErrorInfo,
                'exception' => $e->getMessage(),
            ]);
        }
    }

    /**
     * @param mixed $employee
     * @return false|string
     */
    public function extracted(mixed $employee): string|false
    {
        $this->birthdayEmployee = $employee;
        $mailSendStatus = $this->sendBirthdayEmail($employee);

        return json_encode([
            'status' => 'success',
            'message' => 'Поздравление отправлено по адресу: ' . $this->birthdayEmployee->email . ' на имя: ' . $this->birthdayEmployee->last_name . ' ' . $this->birthdayEmployee->first_name . ' ' . $this->birthdayEmployee->patronymic,
            'mail-send-status' => $mailSendStatus,
        ]);
    }
}
