<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::active()
            ->current()
            ->orderBy('is_featured', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('jobs.index', compact('jobs'));
    }

    public function show($id)
    {
        $job = Job::find($id);

        if (!$job) {
            return redirect('/');
        }

        if (!$job->is_active) {
            return redirect('/');
        }

        return view('jobs.show', compact('job'));
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function store(Request $request)
    {
        $params = $request->only([
            'title',
            'logo',
            'company_name',
            'location',
            'url',
            'description',
            'application_method',
            'email',
            'is_featured',
        ]);

        $params = array_filter($params);

        Job::create($params);

        return redirect('preview');
    }

    public function preview($id)
    {
        $job = Job::find($id);

        if (!$job) {
            return redirect('/');
        }

        if ($job->is_active) {
            return redirect('/');
        }

        return view('jobs.preview', compact('job'));
    }

    public function activate($id, Request $request, Stripe $stripe)
    {
        $params = $request->all();

        if ($stripe->charge($params)) {
            Job::find($id)->activate();
        }

        return redirect('/');
    }
}
