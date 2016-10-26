<?php

namespace App\Events\Job;

use App\Events\Event;
use App\Models\Job;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class JobWasApproved extends Event
{
    use SerializesModels;

    public $job;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Job $job)
    {
        $this->job = $job;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
