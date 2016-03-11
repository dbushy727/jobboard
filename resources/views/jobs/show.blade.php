@extends('layout')

@section('content')
<div class="job">
    <div class="panel panel-default">
        <div class="panel-body">
            <h4>{{$job->title}}</h4>

            <div class="company_info">
                <div for="logo">{{ $job->logo}}</div>
                <div for="location">{{ $job->location}}</div>
                <div for="company">{{ $job->company_name}}</div>
                <div for="url"><a href="{{$job->url}}">{{$job->url}}</a></div>
            </div>

            <div class="job_info">
                <p>{{ $job->description }}</p>
            </div>

            <div class="apply_info">
                {{$job->application_method}}
            </div>
        </div>
    </div>

</div>

@endsection