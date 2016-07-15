<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
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
    public function show($slug, Request $request)
    {
        $job = Job::slug($slug)->first();

        if (!$job) {
            return ['status' => 'error', 'message' => 'Job not found'];
        }

        return ['status' => 'success', 'message' => $job];
    }

    public function applyCoupon($id, Request $request)
    {
        $job = Job::find($id);

        if (!$job) {
            return ['status' => 'error', 'message' => 'Job not found'];
        }

        $coupon = Coupon::where('code', $request->get('code'))->first();

        if (!$coupon) {
            return ['status' => 'success', 'message' => 'Coupon Not Found'];
        }

        if ($coupon->isMaxedOut()) {
            return ['status' => 'success', 'message' => 'Coupon Expired'];
        }

        $job->discount = $coupon->amount;
        $coupon->useIt();

        if ($job->price - $job->discount == 0) {
            $job->pay();
        }

        $job->save();

        return ['status' => 'success', 'message' => 'Coupon Applied', 'job' => $job];
    }
}
