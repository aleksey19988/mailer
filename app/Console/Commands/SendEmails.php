<?php

namespace App\Console\Commands;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\EmployeeController;
use App\Models\Employee;
use App\Models\Holiday;
use Exception;
use Illuminate\Console\Command;
use PHPMailer\PHPMailer\PHPMailer;

class SendEmails extends Command
{
    private Employee $birthdayEmployee;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $birthdayEmployees = EmployeeController::getBirthdayEmployees();
        $todayDate = \Carbon\Carbon::today()->format('d.m.Y');

        if ($birthdayEmployees) {
            foreach ($birthdayEmployees as $employee) {
                $logByEmail = \App\Models\EmailLog::query()
                    ->where([['addressee_letter_email', '=', $employee->email]])
                    ->first();
                if ($logByEmail) {
                    $logCreatedAt = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $logByEmail->created_at)->format('d.m.Y');
                    $emailSentToday = ($logCreatedAt == $todayDate);
                    if (!$emailSentToday) {
                        echo $this->extracted($employee);
                    }
                } else {
                    echo $this->extracted($employee);
                }
            }
            echo 'Все сегодняшние именинники получили свои поздравления';
            return true;
        } else {
            echo 'Именинников сегодня нет';
            return true;
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

                echo json_encode([
                    'status' => 'error',
                    'result' => $mail->ErrorInfo,
                ]);
                return false;
            } else {
                $emailController->saveEmailLog(true, $holiday, $this->birthdayEmployee, $mail->Subject, $mail->Body);

                echo json_encode([
                    'status' => 'success',
                    'congratulationMessage' => $congratulationMessage,
                    'email' => $this->birthdayEmployee->email,
                ]);
                return true;
            }

        } catch (Exception $e) {
            echo json_encode([
                'status' => 'error',
                'result' => $mail->ErrorInfo,
                'exception' => $e->getMessage(),
            ]);
            return false;
        }
    }

    /**
     * @param mixed $employee
     * @return string
     */
    public function extracted(mixed $employee): string
    {
        $this->birthdayEmployee = $employee;

        if ($this->sendBirthdayEmail($this->birthdayEmployee)) {
            return 'Поздравление отправлено по адресу: ' . $this->birthdayEmployee->email . ' на имя: ' . $this->birthdayEmployee->last_name . ' ' . $this->birthdayEmployee->first_name . ' ' . $this->birthdayEmployee->patronymic;
        }
        return 'При попытке отправить email по адресу: ' . $this->birthdayEmployee->email . ' на имя: ' . $this->birthdayEmployee->last_name . ' ' . $this->birthdayEmployee->first_name . ' ' . $this->birthdayEmployee->patronymic . ' произошла ошибка';
    }
}
