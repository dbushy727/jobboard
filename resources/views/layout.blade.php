<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jobboard</title>
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/theme.css">
    <link rel="stylesheet" href="/css/jobs.css">
</head>
<body>
    <div class="container">
        <div class="header clearfix">
            <nav>
                <ul class="nav nav-pills pull-right">
                    <li role="presentation" class="active"><a href="/jobs/create">Post a Job</a></li>
                </ul>
            </nav>
            <h2 class="text-muted"><a href="/">Jobboard</a></h2>
        </div>

        <div class="clearfix">
            This is my welcome content. This is where the copy goes that explains what this site does along with anything else we wanna tell the world. Go ahead, write something down and I'll make sure to share it. PS - We could put pictures in this as well. No need to hold back.

            <hr>
        </div>
        <div class="clearfix">
            @yield('content')
        </div>

        <footer class="footer text-center">
            <p>&copy; 2016 Jobboard, Inc.</p>
        </footer>

    </div> <!-- /container -->

    <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>
</html>