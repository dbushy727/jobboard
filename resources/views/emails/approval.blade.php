@extends('emails.layout')

@section('content')
<div>
    Congratulations! Your job post <a href="{{env('APP_URL')}}/posts/{{$slug}}">{{ $title }}</a> has been activated.
</div>
@stop
