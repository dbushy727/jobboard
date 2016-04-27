<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateJobRequest;
use App\Http\Requests\PaymentRequest;
use App\Models\Job;
use App\Models\Payment;
use App\Models\Refund;
use App\Payment\Stripe;
use Illuminate\Http\Request;
use Roumen\Feed\Feed;

class JobController extends Controller
{
    public function index()
    {
        // Find the current active jobs and sort them by feature status and newest
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

        $jobs = Job::active()
            ->current()
            ->orderBy('is_featured', 'desc')
            ->orderBy('created_at', 'desc')
            ->where('id', '!=', $id)
            ->take(5)
            ->get();

        return view('jobs.show', compact('job', 'jobs'));
    }

    public function approval($id)
    {
        $job = Job::find($id);

        if ($job->isReplacement()) {
            return view('jobs.approval_replacement', compact('job'));
        }

        return view('jobs.approval', compact('job'));
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
            'replacement_id',
        ]);

        $params = array_filter($params);

        if ($file = $request->file('logo')) {
            $params['logo'] = $this->uploadImage($file);
        }

        if ($replacement_id = array_get($params, 'replacement_id')) {
            return $this->storeReplacement($params);
        }

        $job = Job::create($params);
        return redirect()->route('preview_job', [$job->id]);
    }

    protected function storeReplacement($params)
    {
        $job = Job::firstOrCreate(array_only($params, ['replacement_id']));

        if (!$job->logo) {
            $job->logo = $job->original->logo;
        }

        $job->update($params);

        return redirect()->route('preview_job', [$job->id]);
    }

    public function preview($id)
    {
        $job = Job::find($id);

        if ($job->isReplacement()) {
            return view('jobs.preview_replacement', compact('job'));
        }

        return view('jobs.preview', compact('job'));
    }

    public function activate($id, Request $request)
    {
        $job = Job::find($id);

        if ($job->isReplacement()) {
            $job->original->replace();
            $job = $job->original;
        }

        $job->activate();

        $status = $job->title . ' ' . url('jobs', $id);
        \Twitter::postTweet(['status' => $status, 'format' => 'json']);

        return redirect()->route('show_job', [$id]);
    }

    public function pending()
    {
        // Grab currents jobs that haven't been activated yet
        $pending = Job::pending()
            ->current()
            ->orderBy('is_featured', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        $replacements = Job::replacements()
            ->current()
            ->orderBy('is_featured', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        $jobs = $pending->merge($replacements);

        return view('jobs.pending', compact('jobs'));
    }

    public function payment($id, Stripe $stripe, PaymentRequest $request)
    {
        $job = Job::find($id);

        // Process the charge and then save the charge info for later.
        // Once all payment bidness went through, set job to paid.
        $charge = $this->makePayment($job, $stripe, $request);
        $this->savePayment($job, $charge);
        $job->pay();

        return redirect()->route('thank_you');
    }

    public function edit($id, $token)
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

    /**
     * Show the job api style
     *
     * @param  int  $id
     * @param  Request $request
     * @return array
     */
    public function info($id, Request $request)
    {
        $job = Job::find($id);

        if (!$job) {
            return ['status' => 'error', 'message' => 'Job not found'];
        }

        return ['status' => 'success', 'message' => $job];
    }

    /**
     * Reject the job and refund the money
     *
     * @param  int  $id
     * @param  Stripe  $stripe
     * @param  Request $request
     * @return redirect
     */
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

    /**
     * Charge payment via payment processor
     * @param  Job            $job
     * @param  Stripe         $stripe
     * @param  PaymentRequest $request
     * @return array
     */
    protected function makePayment(Job $job, Stripe $stripe, PaymentRequest $request)
    {
        if ($job->is_paid) {
            throw new \Exception("Job #{$id} has already been paid for");
        }

        $charge = $stripe->charge([
            'token'         => $request->get('token'),
            'metadata'      => [
                'job_id' => $job->id,
                'edit_link' => url('jobs', $job->id, $job->edit_token),
            ],
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

    public function feed(Feed $feed)
    {
        $jobs = Job::active()
            ->current()
            ->orderBy('is_featured', 'desc')
            ->orderBy('created_at', 'desc')
            ->take(20)
            ->get();

        $feed->title       = env('RSS_TITLE');
        $feed->description = env('RSS_DESCRIPTION');
        $feed->link        = url('jobs', 'feed');
        $feed->pubdate     = $jobs->first()->created_at;
        $feed->lang        = 'en';

        $feed->setDateFormat('datetime');
        $feed->setShortening(true);
        $feed->setTextLimit(100);
        $feed->setView('vendor.feed.atom');

        foreach ($jobs as $job) {
            $feed->add($job->title, $job->company, url('jobs', $job->id), $job->created_at, $job->description);
        }

        return $feed->render('atom');
    }

    public function search(Request $request)
    {
        $term = $request->get('term');

        if (empty($term)) {
            return $this->index();
        }

        $jobs = Job::search($term)
            ->orderBy('is_featured', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('jobs.index', compact('jobs', 'term'));
    }
}
