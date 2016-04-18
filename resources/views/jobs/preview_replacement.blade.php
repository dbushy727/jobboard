@extends('layout')

@section('content')
    @include('jobs.partials.replacement')
    <div class="activation-buttons">
        <a href="/jobs/{{$job->id}}/edit/{{$job->edit_token}}"><button class="btn btn-info">Edit</button></a>
        <a href="/thank-you" class="btn btn-success pull-right">Looks Good</a>
    </div>

@endsection