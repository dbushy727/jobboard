@extends('layout')

@section('content')
    @include('jobs.partials.replacement')
    <div class="activation-buttons">
        <form action="/jobs/{{$job->id}}/activate" method="POST" class="form">
            {!! csrf_field() !!}
            <button type="submit" class="btn btn-success btn-lg pull-right">Activate</button>
        </form>

        <form action="/jobs/{{$job->id}}/reject" method="POST" class="form">
            {!! csrf_field() !!}
            <button type="submit" class="btn btn-danger btn-lg pull-left">Reject</button>
        </form>
    </div>
    <br>

@endsection
