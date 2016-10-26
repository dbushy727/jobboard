@extends('emails.layout')

@section('content')
    <div>
    	Name: {{$name}}
    </div>
    <div>
    	Email: {{$email}}
    </div>
    <div>
    	Message: {{$body}}
    </div>
@stop
