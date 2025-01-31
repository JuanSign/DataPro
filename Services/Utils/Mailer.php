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
            $this->mail->isSMTP();
            $this->mail->Host       = 'smtp.gmail.com';
            $this->mail->SMTPAuth   = true;
            $this->mail->Username   = getenv('MAILER_USERNAME');
            $this->mail->Password   = getenv('MAILER_PASSWORD');
            $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $this->mail->Port       = 587;

            //Recipients
            $this->mail->setFrom(getenv('MAILER_USERNAME'), 'Juan S. A. Siagian');
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
