<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="apple-mobile-web-app-title" content="{{ env('APP_NAME') }}">
    <meta name="application-name" content="{{ env('APP_NAME') }}">
    <meta name="msapplication-config" content="/img/favicons/browserconfig.xml">
    <meta name="theme-color" content="#ecf0f1">
    <meta name="description" content="A curated list of opportunities for {{ env('JOB_TYPE') }} job seekers, and the best place for hiring managers to target {{ env('JOB_TYPE') }} candidates.">

    <title>{{ env('APP_NAME') }}: A curated list of {{ env('JOB_TYPE') }} opportunities</title>

    <!-- Icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="/img/favicons/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/img/favicons/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="/img/favicons/manifest.json">
    <link rel="mask-icon" href="/img/favicons/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="/img/favicons/favicon.ico">

    <!-- Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Lato:300' rel='stylesheet' type='text/css'>

    <!-- CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/app.css">

    <!-- JS -->
    <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="//cdn.ckeditor.com/4.5.7/basic/ckeditor.js"></script>
    <script src="https://platform.twitter.com/widgets.js"></script>
    <script src="https://checkout.stripe.com/checkout.js"></script>

</head>
<body>
    <!-- Nav -->
    <nav class="nav navbar navbar-static-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <!-- <span class="icon-bar"></span> -->
                </button>
                <a class="navbar-brand" href="/">
                    <img alt="{{ env('APP_NAME') }} Logo" src="/{{ env('APP_LOGO') }}" height=50px>
                    <div class="lead small text-center">A curated list of {{ env('JOB_TYPE') }} job opportunities</div>
                </a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <div class="navbar-form nav-link">
                        <li><a href="/">Home</a></li>
                    </div>
                    <div class="navbar-form nav-link">
                        <li><a href="/about">About</a></li>
                    </div>
                    <div class="navbar-form nav-link">
                        <li><button class="btn btn-primary btn-lg main-post-job-button" data-toggle="modal" data-target="#postJobModal">Post A Job</button></li>
                    </div>
                </ul>
            </div><!--/.navbar-collapse -->
        </div>
    </nav>

    <!-- Container -->
    <div class="container-fluid">
        @yield('content')

        <!-- Post Job Modal -->
        <div class="modal fade" id="postJobModal" tabindex="-1" role="dialog" aria-labelledby="postJobModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content sans-serif">
                    <div class="modal-header text-center">
                        <h3>
                            <span>Thanks for choosing to post with {{ env('APP_NAME')}}</span>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </h3>
                    </div>
                    <div class="modal-body modal-text">
                        <div class="text-center">For <strong>$<u>200</u></strong>, your job posting will be listed here for <strong><u>30 days</u></strong>.</div>
                        <p>{{ env('APP_NAME')}} is only for jobs that complement a {{ env('JOB_TYPE')}} skillset.
                        Your application will be reviewed by our experienced team to ensure that we only list the best {{ env('JOB_TYPE')}} jobs on the market.
                        After your application is accepted it will appear at the top of the job board.
                        Your payment will be refunded in the event that your application is rejected.</p>
                    </div>
                    <div class="modal-footer">
                        <div>
                            <a href="/jobs/create" class="btn btn-success btn-lg btn-block">Got it! Let's find the right person for the job!</a>
                        </div>
                        <br/>
                        <div class="text-center">
                            <a href="#" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">On second thought, this isn't really a {{ env('JOB_TYPE')}} opportunity</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- /container -->

    <!-- Footer -->
    <footer class="footer">
        <div class="container-fluid">
            <p class="navbar-text pull-right">
                <a class="contact-link" href="mailto:{{ env('ADMIN_EMAIL') }}"><i class="fa large fa-envelope"></i></a>
                <a class="contact-link" href="{{ env('TWITTER_URL') }}"><i class="fa large fa-twitter"></i></a>
            </p>
            <span class="pull-left navbar-text">&copy; {{ date('Y') }} | <a href="/jobs/feed">RSS Feed</a></span>
        </div>
    </footer>

    {{-- Late Load JS --}}
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="/js/all.js"></script>
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
      ga('create', 'UA-80504881-1', 'auto');
      ga('send', 'pageview');
    </script>
</body>
</html>