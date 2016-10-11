<?php

namespace App\Http\Controllers;

use App\Models\Job;

class WidgetController extends Controller
{
    public function index()
    {
        // Find the current active jobs and sort them by feature status and newest
        $jobs = Job::active()
            ->current()
            ->orderBy('is_featured', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('widget', compact('jobs'));
    }
}
