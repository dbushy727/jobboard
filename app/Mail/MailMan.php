<?php

namespace App\Mail;

use App\Models\Job;
use Illuminate\Mail\Mailer;

class MailMan
{
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }


    public function sendContactEmail($data, $subject = 'Contact Form')
    {
        return $this->sendMessageToAdmin($subject, $data, 'emails.contact');
    }


    public function sendJobApprovalEmail(Job $job)
    {
        $subject = 'Your job post was accepted!';

        return $this->sendEmail($job->payment->email, $subject, $job->toArray(), 'emails.approval');
    }

    protected function sendMessageToAdmin($subject, $data, $view)
    {
        return $this->sendEmail(env('ADMIN_EMAIL'), $subject, $data, $view);
    }

    protected function sendEmail($to, $subject, $data, $view)
    {
        return $this->mailer->send($view, $data, function ($mail) use ($to, $subject) {
            $mail->from(env('ADMIN_EMAIL'), env('APP_NAME'));
            $mail->to($to);
            $mail->subject($subject);
        });
    }
}
