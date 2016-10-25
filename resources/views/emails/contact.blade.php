@extends('emails.layout')

@section('content')
<html>
<head></head>
  <body>
    <div>
    	Name: {{$name}}
    </div>
    <div>
    	Email: {{$email}}
    </div>
    <div>
    	Message: {{$body}}
    </div>
  </body>
</html>
@stop
