<?php

namespace App\Http\Middleware;

use Illuminate\View\Factory as View;
use Closure;

class TitleDescriptionMiddleware
{
    public function __construct(View $view)
    {
        $this->view = $view;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $description = sprintf('A curated list of opportunities for %s job seekers, and the best place for hiring managers to target %s candidates.', env('JOB_TYPE'), env('JOB_TYPE'));
        $title       = sprintf('%s: A curated list of %s opportunities', env('APP_NAME'), env('JOB_TYPE'));
        $url         = $request->fullUrl();

        $this->view->share('title', $title);
        $this->view->share('description', $description);
        $this->view->share('url', $url);

        return $next($request);
    }
}
