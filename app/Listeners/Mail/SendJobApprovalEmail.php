<?php

namespace App\Listeners\Mail;

use App\Events\Job\JobWasApproved;
use App\Mail\MailMan;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendJobApprovalEmail implements ShouldQueue
{
    protected $mailer;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(MailMan $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Handle the event.
     *
     * @param  JobWasApproved  $event
     * @return void
     */
    public function handle(JobWasApproved $event)
    {
        $this->mailer->sendJobApprovalEmail($event->job);
    }
}
