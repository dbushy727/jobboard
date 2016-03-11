@extends('layout')

@section('content')
<h2>Jobs</h2>
<div class="jobs">
    <div class="col-sm-12">
    @if(!$jobs->count())
        <div class="text-center">There are currently no jobs posted within the last 30 days.</div>
    @else
        <div class="list-group job-list">
        @foreach($jobs as $job)
            <a href="/jobs/{{$job->id}}" class="list-group-item {{ $job->is_featured ? 'featured' : ''}}" >
                <div class="pull-right">
                    <div class="job-list-item location">{{ $job->location }}</div>
                    <div class="job-list-item date">{{ $job->created_at->format('M d Y') }}</div>
                </div>
                <div>
                    @if($job->logo)
                        <img class="job-posting-logo" src="{{ $job->logo }}" alt="">
                    @else
                        <img class="job-posting-logo" src="https://placebear.com/100/100" alt="">
                    @endif
                    <div class="job-list-info">
                        <div class="job-list-title">{{$job->title}}</div>
                        <div class="job-list-company">{{ $job->company_name}}</div>
                    </div>
                </div>
            </a>
        @endforeach
        </div>
    @endif
    </div>
</div>
@endsection