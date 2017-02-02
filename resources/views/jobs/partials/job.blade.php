<div class="col-sm-3 col-sm-push-9">
    {{-- Share --}}
    <div class="panel panel-default text-center regular-share-bar">
        <div class="panel-body">
            <div class="col-sm-12 share-links">
                <h4>Share Job</h4>
                <hr>
                <p><a href="mailto:?subject={{$job->title}}&body=Hey, I thought you would want to check out this job posting. {{ url('posts', $job->slug)}}"><i class="fa fa-envelope"></i> Email This Job</a></p>
                <p><a target="_BLANK" href="http://twitter.com/share?text=Check Out This Job: {{ $job->title }}&url={{ url('posts', $job->slug) }}&hashtags=jobboard, devops, {{ $job->company }}"><i class="fa fa-twitter"></i> Tweet This Job</a></p>
                <p><a target="_BLANK" href="https://www.linkedin.com/shareArticle?mini=true&source=Jobboard&title={{ $job->title }}&url={{ url('posts', $job->slug) }}"><i class="fa fa-linkedin"></i> Post on LinkedIn</a></p>
            </div>
        </div>
        <div class="panel-footer">


            <p><a href="mailto:{{ env('REPORT_EMAIL') }}?subject=Job #{{ $job->id }} is being reported&body=Job #{{ $job->id }} is being reported because ..."> <i class="fa fa-warning"></i> Report This Job</a></p>
        </div>
    </div>

    {{-- Recommendations --}}
    <div class="regular-recommend-bar">
        @include('jobs.partials.mini-list')
    </div>
</div>
<div class="col-sm-9 col-sm-pull-3">
    <div class="panel panel-default job-posting">
        <div class="panel-body">
            <div class="job-posting-section tight col-sm-12">
                <h1>{{$job->title}}</h1>
                <p class="secondary-text">POSTED <span>{{ $job->date->format('M d Y') }}</span></p>
                @if ($job->logo)
                    <div class="company-logo webfeedsFeaturedVisual">
                        <img src="{{ env('S3_BASEPATH') . $job->logo}}" class="job-posting-logo" alt="{{$job->company_name}} Logo">
                    </div>
                @endif
                <div class="company-info">
                    <div for="company"><span class="company-icon"><i class="fa fa-users"></i></span> <span>{{ $job->company_name}}</span></div>
                    <div for="location">
                        <span class="company-icon">
                            <i class="fa fa-map-marker"></i>
                        </span>
                        <span>{{ $job->location}}</span>
                    </div>
                    @if($job->url)
                        @if(strpos($job->url, '://') !== false)
                            <div for="url" class="job-link"><span class="company-icon"><i class="fa fa-external-link-square"></i></span> <span><a href="{{$job->url}}">{{ explode('://', $job->url)[1] }}</a></span></div>
                        @else
                            <div for="url" class="job-link"><span class="company-icon"><i class="fa fa-external-link-square"></i></span> <span><a href="https://{{$job->url}}">{{ $job->url }}</a></span></div>
                        @endif
                    @endif
                </div>
                @if($job->is_remote)
                    <div><span class="company-icon"><i class="fa fa-globe"></i></span> <span>Remote</span></div>
                @endif

            </div>
            <div class="job_info job-posting-section col-sm-12 col-xs-12">
                <hr>
                <p>{!! $job->description !!}</p>
                <br>
                <div class="apply_info job-posting-section col-sm-12 col-xs-12">
                    <label>How to apply</label>
                    <div>{!! linkify($job->application_method) !!}</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-sm-3 mobile-share-bar">
    <div class="panel panel-default text-center">
        <div class="panel-body">
            <div class="col-sm-12 share-links">
                <h4>Share Job</h4>
                <hr>
                <p><a href="mailto:?subject={{$job->title}}&body=Hey, I thought you would want to check out this job posting. {{ url('posts', $job->slug)}}"><i class="fa fa-envelope"></i> Email This Job</a></p>
                <p><a target="_BLANK" href="http://twitter.com/share?text=Check Out This Job: {{ $job->title }}&url={{ url('posts', $job->slug) }}&hashtags=jobboard, devops, {{ $job->company }}"><i class="fa fa-twitter"></i> Tweet This Job</a></p>
                <p><a target="_BLANK" href="https://www.linkedin.com/shareArticle?mini=true&source=Jobboard&title={{ $job->title }}&url={{ url('posts', $job->slug) }}"><i class="fa fa-linkedin"></i> Post on LinkedIn</a></p>
            </div>
        </div>
        <div class="panel-footer">
            <p><a href="mailto:report@\{{ env('MAIL_DOMAIN') }}?subject=Job #{{ $job->id }} Is Being Reported"> <i class="fa fa-warning"></i> Report This Job</a></p>
        </div>
    </div>
</div>
<div class="col-sm-3 mobile-recommend-bar">
    @include('jobs.partials.mini-list')
</div>

<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "JobPosting",
  "datePosted": "{{ $job->date->toDateString() }}",
  "description": "{!! preg_replace('#<[^>]+>#', ' ',($job->description)) !!}",
  "industry": "DevOps",
  "jobLocation": {
    "@type": "Place",
    "address": {
      "@type": "PostalAddress",
      "addressLocality": "{{ $job->location }}"
    }
  },
  "occupationalCategory": "15-1133.00 Software Developers, Systems Software",
  "title": "{{ $job->title }}"
}
</script>
