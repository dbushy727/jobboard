@extends('emails.layout')

@section('content')
Name: {{$name}}
Email: {{$email}}

Message: {{$body}}
@stop
