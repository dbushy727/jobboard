@if(!$jobs->count())
    <div class="text-center">There are currently no jobs that match your criteria posted within the last 30 days.</div>
@else
    <div class="list-group job-list tight">
    @foreach($jobs as $job)
        <a
            href="/posts/{{$job->slug}}"
            class="list-group-item {{ $job->is_featured ? 'featured' : ''}}"
            itemscope
            itemtype="http://schema.org/JobPosting">
            <div class="pull-right job-list-date">
                <div class="job-list-item location"
                    itemprop="jobLocation"
                    itemscope
                    itemtype="http://schema.org/Place">

                    <span
                        itemprop="address"
                        itemscope
                        itemtype="http://schema.org/PostalAddress">
                        <span itemprop="addressLocality">{{ $job->location }}</span>
                    </span>
                </div>
                <div
                    class="job-list-item date"
                    style="display: none;">
                    <span itemprop="datePosted">{{ $job->date->toDateString() }}</span>
                </div>
                <div class="job-list-item date">{{ $job->date->diffForHumans() }}</div>
            </div>
            <div>
                @if($job->logo)
                    <img src="{{ env('S3_BASEPATH') . $job->logo}}" class="job-posting-logo" alt="{{$job->company_name}} Logo">
                @else
                    <img class="job-posting-logo" src="/img/building.png" alt="Default Logo">
                @endif
                <div class="job-list-info">
                    <div class="job-list-title" itemprop="title">{{$job->title}}</div>
                    <div
                        class="job-list-company"
                        itemprop="hiringOrganization"
                        itemscope
                        itemtype="http://schema.org/Organization">
                        <span itemprop="name">{{$job->company_name}}</span>
                    </div>
                    @if($job->date->diffInDays() < 2)
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