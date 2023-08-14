<?php

namespace App\Console\Commands;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MailerController;
use App\Http\Controllers\RequestToApiLogController;
use App\Models\Employee;
use App\Models\Holiday;
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
    protected $description = 'Проверка на наличие именинников сегодня и отправка им поздравлений на почту';

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
            echo 'All recipients received congratulations';
            return true;
        } else {
            echo 'There are no recipients today';
            return true;
        }
    }
    private function sendBirthdayEmail(): bool|string
    {
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
        RequestToApiLogController::saveRequestToLog($requestData, $responseData);

        $congratulationMessage = $responseData['choices'][0]['message']['content'];

        $mail = new PHPMailer(true);     // Passing `true` enables exceptions

        try {
            $mailer = new MailerController($this->birthdayEmployee, $congratulationMessage);
            $mailIsSend = $mailer->sendEmail($mail);

            $emailController = new EmailController();

            if ($mailIsSend) {
                $emailController->saveEmailLog(true, $holiday, $this->birthdayEmployee, $mail->Subject, $mail->Body);

                echo json_encode([
                    'status' => 'success',
                    'congratulationMessage' => $congratulationMessage,
                    'email' => $this->birthdayEmployee->email,
                ]);
                return true;
            } else {
                $emailController->saveEmailLog(false, $holiday, $this->birthdayEmployee, $mail->Subject, $mail->Body);

                echo json_encode([
                    'status' => 'error',
                    'result' => $mail->ErrorInfo,
                ]);
                return false;
            }
        } catch (\PHPMailer\PHPMailer\Exception $e) {
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
        if ($this->sendBirthdayEmail()) {
            return 'Congratulations have been sent to: ' . $this->birthdayEmployee->email . ' to: ' . $this->birthdayEmployee->last_name . ' ' . $this->birthdayEmployee->first_name . ' ' . $this->birthdayEmployee->patronymic;
        }
        return 'When trying to send an email to: ' . $this->birthdayEmployee->email . ' to: ' . $this->birthdayEmployee->last_name . ' ' . $this->birthdayEmployee->first_name . ' ' . $this->birthdayEmployee->patronymic . ' an error has occurred';
    }
}
