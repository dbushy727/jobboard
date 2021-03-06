<?php

namespace App\Http\Middleware;

use App\Models\Job;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfInactive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $job = Job::slug($request->slug)->first();

        if (!$job->is_active) {
            return \Auth::check() ? redirect()->route('approve_job', [$job->slug]) : redirect()->route('jobs');
        }

        return $next($request);
    }
}
