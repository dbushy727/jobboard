<div class="panel panel-default">
    <div class="panel-body text-center">
        <button class="btn btn-lg btn-block btn-primary" data-toggle="modal" data-target="#postJobModal">Post A Job</button>
        <div class="small">$200 for 30 days</div>
        <hr>
        <div>
            Easily reach out to the {{ env('JOB_TYPE') }} community,
            <br/>
            and find the most qualified people
        </div>
        <br>
        <div>
            <a class="twitter-follow-button"
                href={{ env('TWITTER_URL') }}
                data-size="large"
                data-show-count="false"> Follow {{ env('TWITTER_HANDLE') }}
            </a>
        </div>
        <div>
            <i class="fa fa-briefcase light-blue"></i> <i class="fa fa-heart red"></i> <i class="fa fa-users green"></i>
        </div>
    </div>
</div>