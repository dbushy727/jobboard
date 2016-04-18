@extends('layout')
@section('content')
    @include('welcome')
    <div class="jobs">
        <div class="col-sm-12">
            <h2>Jobs <a href="/jobs/feed" class="pull-right"><i class="fa fa-rss" aria-hidden="true"></i></a></h2>
            @include('jobs.partials.list')
        </div>
    </div>
@endsection