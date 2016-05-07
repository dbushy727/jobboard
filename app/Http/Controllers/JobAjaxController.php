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

class JobAjaxController extends Controller
{
    /**
     * Show the job api style
     *
     * @param  int  $id
     * @param  Request $request
     * @return array
     */
    public function show($id, Request $request)
    {
        $job = Job::find($id);

        if (!$job) {
            return ['status' => 'error', 'message' => 'Job not found'];
        }

        return ['status' => 'success', 'message' => $job];
    }
}
