@extends('new_home')
@section('content')
    <div class="col-sm-8">
        <form class="search" action="/jobs/search">
            <input type="text" name="term" class="form-control" maxlength="64" placeholder='Search for things like "Jenkins", "AWS" or "Chef"' />
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
                <ul>
                    <li class="circle">Curated list of jobs</li>
                    <li class="circle">Lorem ipsum dolor sit amet.</li>
                    <li class="circle">Consectetur adipisicing elit.</li>
                    <li class="circle">Necessitatibus ipsum quasi sapiente.</li>
                </ul>
            </div>
        </div>
    </div>
@endsection