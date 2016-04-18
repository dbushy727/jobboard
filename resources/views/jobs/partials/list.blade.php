@if(!$jobs->count())
    <div class="text-center">There are currently no jobs posted within the last 30 days.</div>
@else
    <div class="list-group job-list tight">
    @foreach($jobs as $job)
        <a href="/jobs/{{$job->id}}" class="list-group-item {{ $job->is_featured ? 'featured' : ''}}" >
            <div class="pull-right job-list-date">
                @if($job->isReplacement())
                    <div class="job-list-item"><b>Revision</b></div>
                @endif

                <div class="job-list-item location">{{ $job->location }}</div>
                <!-- <div class="job-list-item date">{{ $job->created_at->format('M d Y') }}</div> -->
                <div class="job-list-item date">{{ $job->created_at->diffForHumans() }}</div>
            </div>
            <div>
                @if($job->logo)
                    <img src="{{ env('S3_BASEPATH') . $job->logo}}" class="job-posting-logo">
                @else
                    <img class="job-posting-logo" src="https://cdn2.iconfinder.com/data/icons/management/256/Resume-512.png" alt="">
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