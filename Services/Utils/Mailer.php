<?php
require __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer
{
    private $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);
    }

    public function sendEmailWithPDF($to, $subject, $body, $pdfPath)
    {
        try {
            $env = parse_ini_file('/etc/secrets/.env');

            $this->mail->isSMTP();
            $this->mail->Host       = 'smtp.gmail.com';
            $this->mail->SMTPAuth   = true;
            $this->mail->Username   = $env['MAILER_USERNAME'];
            $this->mail->Password   = $env['MAILER_PASSWORD'];
            $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $this->mail->Port       = 587;

            //Recipients
            $this->mail->setFrom('your_email@gmail.com', 'Your Name');
            $this->mail->addAddress($to);

            // Attach the PDF file
            $this->mail->addAttachment($pdfPath);

            // Content
            $this->mail->isHTML(true);
            $this->mail->Subject = $subject;
            $this->mail->Body    = $body;

            // Send the email
            $this->mail->send();
            return 'SUCCESS';
        } catch (Exception $e) {
            return "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
        }
    }
}
