<?php

namespace App\Http\Middleware;

use App\Models\Job;
use Closure;
use Illuminate\Support\Facades\Auth;

class VerifySession
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
        $job = Job::find($request->id);

        if (\Session::getId() !== $job->session_id) {
            return redirect()->route('jobs');
        }

        return $next($request);
    }
}
