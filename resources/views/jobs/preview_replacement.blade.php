@extends('new_home')

@section('content')
    <div class="activation-buttons">
        <a href="/posts/{{$job->slug}}/edit/{{$job->edit_token}}"><button class="btn btn-red header-button"><i class="fa fa-arrow-left"></i> Back To Edit</button></a>
        <a href="/thank-you" class="btn btn-success header-button pull-right">Looks Good <i class="fa fa-arrow-right"></i></a>
    </div>
    @include('jobs.partials.replacement')

@endsection