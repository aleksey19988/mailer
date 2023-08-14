<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class MailerController extends Controller
{
    private Employee $employee;
    private string $message;

    public function __construct($employee, string $message)
    {
        $this->employee = $employee;
        $this->message = $message;
    }

    /**
     * @throws Exception
     */
    public function sendEmail(PHPMailer $mail): bool
    {
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
        $mail->addAddress($this->employee->email);
        $mail->isHTML(true); // Set email content format to HTML

        $mail->Subject = 'С днём рождения, ' . $this->employee->first_name . '!';

        $mail->Body = view('email.body', [
            'congratulationMessage' => $this->message,
            'employee' => $this->employee
        ])->render();

        $mail->AltBody = '';

        return $mail->send();
    }
}
