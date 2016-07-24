<?php

namespace App\External;

use App\Models\Job;
use Thujohn\Twitter\Twitter;

class Tweet
{
    protected $twitter;

    protected $statuses = [
        [
            'message' => 'New opportunity posted for a %s %s @ %s %s',
            'replace' => ['title', 'remote', 'company_name', 'link']
        ],
        [
            'message' => '%s is looking for a new %s %s %s',
            'replace' => ['company_name', 'title', 'remote', 'link']
        ],
        [
            'message' => '%s is now hiring for a %s %s %s',
            'replace' => ['company_name', 'title', 'remote', 'link']
        ],
        [
            'message' => 'Interested in being a %s %s for %s ? %s',
            'replace' => ['title', 'remote', 'company_name', 'link']
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
            'title'        => $job->title,
            'remote'       => $job->is_remote ? '(Remote)' : null,
            'company_name' => $job->company_name,
            'link'         => url('jobs', $job->id),
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
