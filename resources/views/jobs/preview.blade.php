@extends('jobs.show')

@section('activate')

    <div class="activation-buttons">
        <a href="/jobs/{{$job->id}}/edit/{{$job->edit_token}}"><button class="btn btn-red header-button"><i class="fa fa-arrow-left"></i> Back To Edit</button></a>
        @if($job->is_paid || $job->isReplacement())
            <a href="/thank-you" class="btn btn-success header-button pull-right">Looks Good <i class="fa fa-arrow-right"></i></a>
        @else
            <button class="btn btn-success pull-right header-button" id="checkoutButton">Looks Good <i class="fa fa-arrow-right"></i></button>
            <form action="/jobs/{{$job->id}}/payment" method="POST" id="payment">
                {!! csrf_field() !!}
                <input type="hidden" id="key" value="{{ getenv('STRIPE_PUBLIC_KEY')}}">
                <input type="hidden" name="token" id="token">
                <input type="hidden" name="email" id="email">
            </form>
        @endif
    </div>


@endsection