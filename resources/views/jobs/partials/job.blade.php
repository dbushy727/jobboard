<div class="col-sm-3 col-sm-push-9">
        <div class="panel panel-default text-center">
            <div class="panel-body">
                <div class="col-sm-12">
                    @if($job->logo)
                    <img src="{{ env('S3_BASEPATH') . $job->logo}}" class="job-posting-logo">
                    @endif
                </div>

                <div class="company_info job-posting-section col-sm-12">
                    <div for="company">{{ $job->company_name}}</div>
                    <div for="location">{{ $job->location}}</div>
                    @if(strpos($job->url, '://') !== false)
                        <div for="url" class="job-link"><a href="{{$job->url}}">{{ explode('://', $job->url)[1] }}</a></div>
                    @else
                        <div for="url" class="job-link"><a href="http://{{$job->url}}">{{ $job->url }}</a></div>
                    @endif
                </div>
            </div>
        </div>
        <div class="panel panel-default text-center">
            <div class="panel-body">
                <div class="col-sm-12 share-links">
                    <h4>Share Job</h4>
                    <hr>
                    <p><a href="mailto:?subject={{$job->title}}&body=Hey, I thought you would want to check out this job posting. {{ url('jobs', $job->id)}}"><i class="fa fa-envelope"></i> Email This Job</a></p>
                    <p><a target="_BLANK" href="http://twitter.com/share?text=Check Out This Job: {{ $job->title }}&url={{ url('jobs', $job->id) }}&hashtags=jobboard, devops, {{ $job->company }}"><i class="fa fa-twitter"></i> Tweet This Job</a></p>
                    <p><a target="_BLANK" href="https://www.linkedin.com/shareArticle?mini=true&source=Jobboard&title={{ $job->title }}&url={{ url('jobs', $job->id) }}"><i class="fa fa-linkedin"></i> Post on LinkedIn</a></p>
                </div>
            </div>
            <div class="panel-footer">
                <p><a href="mailto:report@jobboard.dev?subject=Job #{{ $job->id }} Is Being Reported"> <i class="fa fa-warning"></i> Report This Job</a></p>
            </div>
        </div>
</div>
<div class="col-sm-9 col-sm-pull-3">
    <div class="panel panel-default job-posting">
        <div class="panel-body">
            <div class="job-posting-section tight col-sm-12">
                <h1>{{$job->title}}</h1>
                <p>{{ $job->created_at->format('M d Y') }}</p>
            </div>
            <div class="job_info job-posting-section col-sm-12 col-xs-12">
                <hr>
                <p>{!! $job->description !!}</p>
                <br>
                <div class="apply_info job-posting-section col-sm-12 col-xs-12">
                    <label>How to apply</label>
                    <div>{{$job->application_method}}</div>
                </div>
            </div>
        </div>
    </div>
</div>