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
    <div class="container">
        <div>
            <a href="/" class="header-text baseline">{{ env('APP_NAME') }}</a>
            <span class="pull-right text-center">
                <button id="post-job-button" class="btn btn-primary header-button" data-toggle="modal" data-target="#postJobModal">Post a Job</button>
                <label class="">$200 for 30 days</label>
            </span>
        </div>

        <!-- Modal -->
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
                        To ensure that we maintain the best DevOps jobs in the market, your application will be reviewed by our experienced team.
                        If your application is accepted, it will appear on the top of the job board.
                        If your application gets rejected, your payment will be refunded.
                    </div>
                    <div class="modal-footer">
                        <a href="/jobs/create" class="btn btn-success btn-lg btn-block">Continue</a>
                    </div>
                </div>
            </div>
        </div>
        @if(Auth::check())
        <div>
            <div class="text-center">God Mode</div>
            <a href="/jobs/pending">Jobs Pending</a>
            <a href="/auth/logout" class="pull-right">Logout</a>
        </div>
        @endif

    </div>
    <div class="container-fluid">
        <div class="clearfix">
            @yield('content')
        </div>
        <br>
        <br>
        <br>
        <footer class="footer text-center">
            <p>&copy; {{ date('Y') }} {{ env('COMPANY_NAME') }}</p>
            @if(!Auth::check())
            <p><a href="/auth/login">Admin</a></p>
            @endif

        </footer>

    </div> <!-- /container -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="/js/all.js"></script>
</body>
</html>