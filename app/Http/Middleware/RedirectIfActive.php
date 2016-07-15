<?php

namespace App\Http\Middleware;

use App\Models\Job;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfActive
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

        if ($job->is_active) {
            return redirect()->route('show_job', [$job->slug]);
        }

        return $next($request);
    }
}
