@extends('layout')
@section('content')
    @include('welcome')
    <div class="jobs">
        <div class="col-sm-12">
            <h2>Jobs</h2>
            @include('jobs.jobs')
        </div>
    </div>
@endsection