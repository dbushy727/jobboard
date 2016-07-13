@extends('new_home')
@section('content')
    <div class="col-sm-8">
        <p>
            Welcome to <a href="{{ url('/') }}"><b>{{ env('APP_NAME') }}</b></a>. We serve the {{ env('JOB_TYPE') }} community by offering the best place to find and list {{ env('JOB_TYPE') }} career opportunities.
        </p>
    </div>
    <div class="col-sm-4 pull-right">
        @include('post-job')
    </div>
    <div class="col-sm-8 clearfix">
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
@endsection