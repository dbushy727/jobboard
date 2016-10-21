@extends('new_home')

@section('content')
<div class="col-sm-8">
    <div class="panel panel-default">
        <div class="panel-body">
            <h1>About</h1>
            <hr>
            <div>
                This website was created by a {{ env('JOB_TYPE') }} professional <i>for</i> {{ env('JOB_TYPE') }} professionals, as well as to make it easier for organizations to reach {{ env('JOB_TYPE') }} people. Each post goes through a review process prior to being listed here.
            </div>
            <div>
                Want to get in touch? Contact us <a href="/contact">here</a>.
            </div>
        </div>
    </div>
</div>
<div class="col-sm-4">
    @include('post-job')
</div>

@endsection