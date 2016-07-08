@extends('new_home')
@section('content')
    <div class="col-sm-8">
        <p>Welcome to <a href="{{ url('/') }}"><b>{{ env('APP_NAME') }}</b></a>. We serve the {{ env('JOB_TYPE') }} community by offering the best place to find and list {{ env('JOB_TYPE') }} career opportunities. Follow us on Twitter <a href="{{ env('TWITTER_URL') }}">{{ env('TWITTER_HANDLE') }}</a></p>
        <form class="search" action="/jobs/search">
            <input type="text" name="term" class="form-control" maxlength="64" placeholder="Search for jobs"/>
            <button type="submit" class="btn btn-red search-button">Search</button>
        </form>
        @if(isset($term))
            <div>Search: {{ $term }} <a href="/"><i class="fa fa-times"></i></a></div>
        @endif
    </div>
    {{-- Two Column Layout --}}
    <div class="col-sm-8">
        <div class="jobs">
            <div class="col-sm-12 no-pad">
                @include('jobs.partials.list')
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="panel panel-default">
            <div class="panel-body">
                <button class="btn btn-lg btn-block btn-primary" data-toggle="modal" data-target="#postJobModal">Post A Job FIXME</button>
                <div class="small text-center">$200 for 30 days</div>
                    <center>Easily reach out to the {{ env('JOB_TYPE') }} community,
                    <br/>
                    and find the most qualified people</center>
                </div>
        </div>
    </div>
@endsection