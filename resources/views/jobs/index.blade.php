@extends('new_home')
@section('content')
    <div class="col-sm-8">
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
                <button class="btn btn-lg btn-block btn-primary" data-toggle="modal" data-target="#postJobModal">Post A Job</button>
                <div class="small text-center">$200 for 30 days</div>
                <hr>
                <ul class="job-amenities">
                    <li class="circle">Curated list of jobs</li>
                    <li class="circle">Quick review process</li>
                    <li class="circle">Reach out to followers on Twitter</li>
                    <li class="circle">Narrow your target to the right people.</li>
                </ul>
                <hr>
                <p>Welcome to <b>{{ env('APP_NAME') }}</b>. Here you will find a manicured list of the hottest {{ env('JOB_TYPE') }} jobs the market has to offer. Each application is reviewed to make sure only top-notch jobs make it to the board.</p>
            </div>
        </div>
    </div>
@endsection