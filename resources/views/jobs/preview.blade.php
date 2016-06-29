@extends('jobs.show')

@section('activate')
    <div class="activation-buttons text-center">
        @if($job->is_paid || $job->isReplacement())
            <a href="/thank-you" class="btn btn-success header-button pull-right">Proceed to Payment</a>
        @else
            <button class="btn btn-success btn-block header-button" id="checkoutButton">Proceed to Payment</button>
            or <a href="/jobs/{{$job->id}}/edit/{{$job->edit_token}}">Back to Edit</a>
            <form action="/jobs/{{$job->id}}/payment" method="POST" id="payment">
                {!! csrf_field() !!}
                <input type="hidden" id="key" value="{{ getenv('STRIPE_PUBLIC_KEY')}}">
                <input type="hidden" name="token" id="token">
                <input type="hidden" name="email" id="email">
            </form>
        @endif
    </div>


@endsection