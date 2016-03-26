<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Payment\Stripe;
use Illuminate\Http\Request;
use App\Http\Requests\PaymentRequest;

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
            'company_name',
            'location',
            'url',
            'description',
            'application_method',
            'email',
            'is_featured',
        ]);

        $params = array_filter($params);

        $params['logo'] = $this->uploadImage($request->file('logo'));

        $job = Job::create($params);

        return redirect("/jobs/{$job->id}/preview");
    }

    public function preview($id)
    {
        $job = Job::find($id);

        if (!$job) {
            return redirect('/404');
        }

        if ($job->is_active) {
            return redirect('/jobs/show/' . $job->id);
        }

        return view('jobs.preview', compact('job'));
    }

    public function activate($id, Request $request)
    {
        $job = Job::find($id);

        $job->activate();

        return redirect('/');
    }

    public function pending()
    {
        $jobs = Job::pending()
            ->current()
            ->orderBy('is_featured', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('jobs.index', compact('jobs'));
    }

    public function payment($id, Stripe $stripe, PaymentRequest $request)
    {
        $job = Job::find($id);

        if (!$job) {
            throw new \Exception("Cannot find Job #{$id}");
        }

        if ($job->is_paid) {
            throw new \Exception("Job #{$id} has already been paid for");
        }

        $charge = $stripe->charge([
            'token' => $request->get('token'),
            'metadata' => ['job_id' => $id],
            'receipt_email' => $request->get('email', null),
        ]);

        if (array_get($charge, 'status') === 'success') {
            $job->pay();
        }

        return $charge;
    }
}
