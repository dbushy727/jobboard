<?php

namespace App\Providers;

use App\Models\Job;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('jobs.partials.mini-list', function ($view) {
            $view->with('jobs', Job::active()
                ->current()
                ->orderBy('is_featured', 'desc')
                ->orderBy('published_at', 'desc')
                ->where('id', '!=', $view->job->id)
                ->take(5)
                ->get());
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
