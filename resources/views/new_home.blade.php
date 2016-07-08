<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') }}</title>
    <!-- Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Lato:300' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/app.css">

    <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="//cdn.ckeditor.com/4.5.7/basic/ckeditor.js"></script>
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
                <a class="navbar-brand" href="/"><img alt="{{ env('APP_NAME') }} Logo" src="{{ env('APP_LOGO') }}" height=50px></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- <li><a href="#contact">Contact</a></li> -->
                    <div class="navbar-form">
                        <li><button class="btn btn-primary" data-toggle="modal" data-target="#postJobModal">Post A Job</button></li>
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
                        For <strong>$<u>200</u></strong>, your job posting will remain on the site for <strong><u>30 days</u></strong>.
                        To ensure that we maintain the best {{ env('JOB_TYPE')}} jobs in the market, your application will be reviewed by our experienced team.
                        If your application is accepted, it will appear on the top of the job board.
                        If your application gets rejected, your payment will be refunded.
                    </div>
                    <div class="modal-footer">
                        <a href="/jobs/create" class="btn btn-success btn-lg btn-block">Continue</a>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- /container -->

    <!-- Footer -->
    <footer class="footer">
        <div class="container-fluid">
            <a href="http://voyent.io" class="navbar-text pull-right">Powered by Voyent</a>
            <span class="pull-left navbar-text">&copy; {{ date('Y') }} | <a href="/jobs/feed">RSS Feed</a></span>
        </div>
    </footer>


    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="/js/all.js"></script>
</body>
</html>