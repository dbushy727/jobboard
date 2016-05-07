@extends('layout')
@section('content')
    <div class="container">
        @include('welcome')
        <div class="jobs">
            <div class="col-sm-12 no-pad">

                    <form action="/jobs/search" class="form-inline search-form" method="GET">
                        <div class="input-group search-group">
                            <input type="text" class="form-control" placeholder="Search for jobs here ..." name="term">
                            <div class="input-group-btn">
                                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                            </div>
                        </div>
                    </form>

                    @if(isset($term))
                        Search: {{$term}}
                    @endif
                <div class="col-sm-12 no-pad">
                    <h2>Jobs <a href="/jobs/feed" class="pull-right"><i class="fa fa-rss" aria-hidden="true"></i></a></h2>
                    @include('jobs.partials.list')
                </div>
            </div>
        </div>
    </div>
@endsection