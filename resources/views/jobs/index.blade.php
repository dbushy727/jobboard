@extends('new_home')
@section('content')
    <div class="col-sm-8">
        <p>
            Welcome to <a href="{{ url('/') }}"><b>{{ env('APP_NAME') }}</b></a>. We serve the {{ env('JOB_TYPE') }} community by offering the best place to find and list {{ env('JOB_TYPE') }} career opportunities.
        </p>
        <form class="search" action="/jobs/search">
            <div class="input-group">
                <input type="text" name="term" class="form-control" maxlength="64" placeholder="Search for jobs">
                <span class="input-group-btn"><button class="btn btn-red search-button" type="submit">Search</button></span>
            </div>
        </form>
        @if(isset($term))
            <div>Search: {{ $term }} <a href="/"><i class="fa fa-times"></i></a></div>
        @endif

        <div class="jobs">
            <div class="col-sm-12 no-pad">
                @include('jobs.partials.list')
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        @include('post-job')
    </div>
@endsection