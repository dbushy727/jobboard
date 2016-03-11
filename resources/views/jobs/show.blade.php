@extends('layout')

@section('content')
<div class="panel panel-default job-posting">
    <div class="panel-body">
        <div class="job-posting-section">
            <h1>{{$job->title}}</h1>
            <p>{{ $job->created_at->format('M d Y') }}</p>
        </div>

        <div class="company_info job-posting-section">
            <img src="{{ $job->logo}}" class="job-posting-logo pull-right">
            <div for="company">{{ $job->company_name}}</div>
            <div for="location">{{ $job->location}}</div>
            <div for="url"><a href="{{$job->url}}">{{$job->url}}</a></div>
        </div>

        <div class="job_info job-posting-section">
            <label>Description</label>
            <p class="well">{{ $job->description }}</p>
        </div>

        <div class="apply_info job-posting-section">
            <label>How to apply</label>
            <div class="well">
                {{$job->application_method}}
            </div>
        </div>
    </div>
</div>


@endsection