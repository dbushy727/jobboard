<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Widget</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/app.css">
</head>
<body style="background-color: #fff;">
    <div class="container-fluid">
        <h1><a href="{{env('APP_URL')}}">{{env('APP_NAME')}}</a></h1>
        @include('jobs.partials.list')
        <p class="text-right">Powered by {{env("APP_NAME")}}</p>
    </div>
</body>
</html>