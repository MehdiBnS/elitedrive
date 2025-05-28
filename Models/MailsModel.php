<?php

namespace elitedrive\Models;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailsModel
{
    private $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);

        // $this->mail->isSMTP();
        $this->mail->CharSet = 'UTF-8';
        $this->mail->Encoding = 'base64';
        //   $this->mail->Host       = 'sandbox.smtp.mailtrap.io';
        //  $this->mail->SMTPAuth   = true;
        //  $this->mail->Username   = '6cbe9cc11fd5c1';
        //  $this->mail->Password   = 'b70fba23f3fc98';
        //  $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        // $this->mail->Port       = 465;

        $this->mail->setFrom('no-reply@elitedrive.fr', 'EliteDrive');
        $this->mail->isHTML(true);
    }

    public function sendMail($to, $subject, $body, $fromEmail = null, $fromName = null)
    {
        try {
            $this->mail->clearAllRecipients();
            if ($fromEmail && $fromName) {
                $this->mail->setFrom($fromEmail, $fromName);
            } else {
                $this->mail->setFrom('no-reply@elitedrive.com', 'EliteDrive');
            }

            $this->mail->addAddress($to);
            $this->mail->Subject = $subject;
            $this->mail->Body    = $body;

            return $this->mail->send();
        } catch (Exception $e) {
            error_log("Erreur Mailer : " . $this->mail->ErrorInfo);
            return false;
        }
    }
}
