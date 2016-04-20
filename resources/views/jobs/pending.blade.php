@extends('layout')
@section('content')
    <div class="container">
        <div class="jobs">
            <div class="col-sm-12">
                <h2>Pending Jobs</h2>
                @include('jobs.partials.list')
            </div>
        </div>
    </div>
@endsection