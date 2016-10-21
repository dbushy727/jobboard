<?php

namespace App\Mail;

use Illuminate\Mail\Mailer;

class MailMan
{
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendMessageToAdmin($subject, $data, $view)
    {
        return $this->mailer->send($view, $data, function ($mail) use ($subject) {
            $mail->from(env('ADMIN_EMAIL'), 'DevOps Jobs');
            $mail->to(env('ADMIN_EMAIL'));
            $mail->subject($subject);
        });
    }

    public function sendContactEmail($data, $subject = 'Contact Form')
    {
        return $this->sendMessageToAdmin($subject, $data, 'emails.contact');
    }
}
