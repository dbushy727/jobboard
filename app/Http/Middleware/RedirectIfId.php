<?php

namespace App\Http\Middleware;

use App\Models\Job;
use Closure;

class RedirectIfId
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!is_numeric($request->slug)) {
            return $next($request);
        }

        $job  = Job::find($request->slug)->first();

        return redirect()->route('show_job', [$job->slug]);
    }
}
