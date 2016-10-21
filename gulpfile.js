var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass(['theme.scss', 'nav.scss', 'jobs.scss', 'modal.scss', 'search.scss', 'contact.scss']);
    mix.scripts(['payment.js', 'edit-job.js']);
});

