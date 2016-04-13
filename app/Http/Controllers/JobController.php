<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateJobRequest;
use App\Http\Requests\PaymentRequest;
use App\Models\Job;
use App\Models\Payment;
use App\Models\Refund;
use App\Payment\Stripe;
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

        if (!$job->is_active && !\Auth::check()) {
            return redirect()->route('jobs');
        }

        return view('jobs.show', compact('job'));
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function store(CreateJobRequest $request)
    {
        $params = $request->only([
            'title',
            'location',
            'description',
            'application_method',
            'email',
            'company_name',
            'url',
            'is_featured',
            'is_remote',
        ]);

        $params = array_filter($params);

        if ($file = $request->file('logo')) {
            $params['logo'] = $this->uploadImage($file);
        }

        $job = Job::create($params);

        return redirect()->route('preview_job', [$job->id]);
    }

    public function preview($id)
    {
        $job = Job::find($id);

        return view('jobs.preview', compact('job'));
    }

    public function activate($id, Request $request)
    {
        $job = Job::find($id);

        $job->activate();

        return redirect()->route('show_job', [$id]);
    }

    public function pending()
    {
        $jobs = Job::pending()
            ->current()
            ->orderBy('is_featured', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('jobs.pending', compact('jobs'));
    }

    public function payment($id, Stripe $stripe, PaymentRequest $request)
    {
        $job = Job::find($id);

        $charge = $this->makePayment($job, $stripe, $request);
        $this->savePayment($job, $charge);
        $job->pay();

        return redirect()->route('thank_you');
    }

    public function edit($id)
    {
        $job = Job::find($id);

        return view('jobs.edit', compact('job'));
    }

    public function update($id, Request $request)
    {
        $job = Job::find($id);

        $params = $request->only([
            'title',
            'company_name',
            'location',
            'url',
            'description',
            'application_method',
            'email',
            'is_featured',
            'is_remote',
        ]);

        $params = array_filter($params);

        if ($file = $request->file('logo')) {
            $params['logo'] = $this->uploadImage($file);
        }

        $job->update($params);

        return redirect()->route('preview_job', [$job->id]);
    }

    public function info($id, Request $request)
    {
        $job = Job::find($id);

        if (!$job) {
            return ['status' => 'error', 'message' => 'Job not found'];
        }

        return ['status' => 'success', 'message' => $job];
    }

    public function reject($id, Stripe $stripe, Request $request)
    {
        $job = Job::find($id);

        $stripe_refund = $stripe->refund($job->payment);

        if (array_get($stripe_refund, 'status') !== 'success') {
            throw new \Exception("Refund Failed");
        }

        $job->reject();

        $refund = Refund::create([
            'payment_id' => $job->payment->id,
            'transaction_id' => $stripe_refund['message']->id,
            'amount' => $stripe_refund['message']->amount,
            'reason' => 'Rejected Job Application',
        ]);

        return redirect()->route('pending_jobs');
    }

    protected function makePayment(Job $job, Stripe $stripe, PaymentRequest $request)
    {
        if ($job->is_paid) {
            throw new \Exception("Job #{$id} has already been paid for");
        }

        $charge = $stripe->charge([
            'token'         => $request->get('token'),
            'metadata'      => ['job_id' => $job->id],
            'receipt_email' => $request->get('email', null),
            'amount'        => $job->price,
        ]);

        if (array_get($charge, 'status') !== 'success') {
            throw new \Exception("Payment Failed");
        }

        return $charge;
    }

    protected function savePayment(Job $job, $charge)
    {
        $params = [
            'job_id'         => $job->id,
            'transaction_id' => array_get($charge, 'message.id'),
            'amount'         => array_get($charge, 'message.amount'),
            'description'    => array_get($charge, 'message.description'),
            'email'          => array_get($charge, 'message.receipt_email'),
            'type'           => array_get($charge, 'message.source.object'),
            'last4'          => array_get($charge, 'message.source.last4'),
            'exp_month'      => array_get($charge, 'message.source.exp_month'),
            'exp_year'       => array_get($charge, 'message.source.exp_year'),
            'name'           => array_get($charge, 'message.source.name'),
        ];

        return Payment::create($params);
    }
}
