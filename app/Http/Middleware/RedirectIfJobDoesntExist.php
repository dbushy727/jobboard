<?php

namespace App\Http\Middleware;

use App\Models\Job;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfJobDoesntExist
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
        if (Job::find($request->id)) {
            return redirect('/');
        }

        return $next($request);
    }
}
