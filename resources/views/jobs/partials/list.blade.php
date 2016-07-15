@if(!$jobs->count())
    <div class="text-center">There are currently no jobs that match your criteria posted within the last 30 days.</div>
@else
    <div class="list-group job-list tight">
    @foreach($jobs as $job)
        <a href="/jobs/{{$job->slug}}" class="list-group-item {{ $job->is_featured ? 'featured' : ''}}" >
            <div class="pull-right job-list-date">
                <div class="job-list-item location">{{ $job->location }}</div>
                <!-- <div class="job-list-item date">{{ $job->created_at->format('M d Y') }}</div> -->
                <div class="job-list-item date">{{ $job->created_at->diffForHumans() }}</div>
            </div>
            <div>
                @if($job->logo)
                    <img src="{{ env('S3_BASEPATH') . $job->logo}}" class="job-posting-logo">
                @else
                    <img class="job-posting-logo" src="/img/building.png" alt="">
                @endif
                <div class="job-list-info">
                    <div class="job-list-title">{{$job->title}}</div>
                    <div class="job-list-company">{{ $job->company_name}}</div>
                    @if($job->created_at->diffInDays() < 2)
                        <div class="label label-info small">New</div>
                        @if($job->isReplacement())
                            <div class="label label-warning small">Revision</div>
                        @endif
                    @endif
                    @if($job->is_remote)
                        <div class="label label-success small">Remote</div>
                    @endif
                </div>
            </div>
        </a>
    @endforeach
    </div>
@endif