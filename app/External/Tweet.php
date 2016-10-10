<?php

namespace App\External;

use App\Models\Job;
use Thujohn\Twitter\Twitter;

class Tweet
{
    protected $twitter;

    protected $statuses = [
        [
            'message' => 'New opportunity posted for a %s @ %s %s %s',
            'replace' => ['title', 'company_name', 'hashtags', 'link']
        ],
        [
            'message' => '%s is looking for a new %s %s %s',
            'replace' => ['company_name', 'title', 'hashtags', 'link']
        ],
        [
            'message' => '%s is now hiring for a %s %s %s',
            'replace' => ['company_name', 'title', 'hashtags', 'link']
        ],
        [
            'message' => 'Interested in being a %s for %s? %s %s',
            'replace' => ['title', 'company_name', 'hashtags', 'link']
        ],
    ];

    public function __construct(Twitter $twitter)
    {
        $this->twitter = $twitter;
    }

    public function tweetJob(Job $job)
    {
        $status = $this->randomStatus();

        $data = [
            'title'        => $job->is_remote ? $job->title . ' (Remote)' : $job->title,
            'company_name' => $job->company_name,
            'hashtags'     => "#" . strtolower(env('JOB_TYPE')) . " #" . strtolower(env('JOB_TYPE')) . "jobs #" . str_replace(' ', '', strtolower($job->company_name)),
            'link'         => url('posts', $job->slug),
        ];

        $this->tweet($status, $data);
    }

    protected function randomStatus()
    {
        return $this->statuses[array_rand($this->statuses)];
    }

    protected function tweet($status, $data)
    {
        $replace = array_map(function ($replacement) use ($data) {
            return $data[$replacement];
        }, $status['replace']);

        $this->twitter->postTweet([
            'status' => sprintf($status['message'], ...$replace),
            'format' => 'json'
        ]);
    }
}
