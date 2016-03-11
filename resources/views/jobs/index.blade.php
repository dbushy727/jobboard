@extends('layout')

@section('content')
<h2>Jobs</h2>
<div class="jobs">
    <div class="col-sm-12">
        <div class="col-sm-3"><b>Location</b></div>
        <div class="col-sm-3"><b>Company</b></div>
        <div class="col-sm-3"><b>Title</b></div>
        <div class="col-sm-3"><b>Date</b></div>
    </div>

    <div class="col-sm-12">
        @foreach($jobs as $job)
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="col-sm-3">{{ $job->location }}</div>
                <div class="col-sm-3">{{ $job->company_name }}</div>
                <div class="col-sm-3">{{ $job->title}}</div>
                <div class="col-sm-3">{{ $job->created_at->tz('America/New_York')->format('m/d/y h:i A') }}</div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection