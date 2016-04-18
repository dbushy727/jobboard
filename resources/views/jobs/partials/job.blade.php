<div class="panel panel-default job-posting">
    <div class="panel-body">
        <div class="col-sm-12">
            <div class="job-posting-section tight">
                @if($job->logo)
                <img src="{{ env('S3_BASEPATH') . $job->logo}}" class="job-posting-logo pull-right">
                @endif
                <h1>{{$job->title}}</h1>
                <p>{{ $job->created_at->format('M d Y') }}</p>
            </div>
        </div>

        <div class="col-sm-10">
            <div class="company_info job-posting-section">
                <div for="company">{{ $job->company_name}}</div>
                <div for="location">{{ $job->location}}</div>
                <div for="url"><a href="{{$job->url}}">{{$job->url}}</a></div>
            </div>
        </div>

        <div class="col-sm-2 share-links">
            <h4><u>Share Links</u></h4>
            <p><a href="mailto:?subject={{$job->title}}&body=Hey, I thought you would want to check out this job posting. {{ url('jobs', $job->id)}}"><i class="fa fa-envelope"></i> Email This Job</a></p>
            <p><a href="#"><i class="fa fa-twitter"></i> Tweet This Job</a></p>
            <p><a href="#"><i class="fa fa-linkedin"></i> Post on LinkedIn</a></p>
        </div>
        <div class="col-sm-12">
            <div class="job_info job-posting-section">
                <label>Description</label>
                <hr>
                <p>{!! $job->description !!}</p>
            </div>

            <div class="apply_info job-posting-section">
                <label>How to apply</label>
                <div>
                    {{$job->application_method}}
                </div>
            </div>
        </div>
    </div>
</div>