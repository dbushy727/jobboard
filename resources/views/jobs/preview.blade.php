@extends('jobs.show')

@section('activate')

<div class="activation-buttons">
    <a href="/jobs/{{$job->id}}/edit/{{$job->edit_token}}"><button class="btn btn-info">Edit</button></a>
    @if($job->is_paid || $job->isReplacement())
        <a href="/thank-you" class="btn btn-success pull-right">Looks Good</a>
    @else
        <button class="btn btn-success pull-right" id="checkoutButton">Looks Good</button>
        <form action="/jobs/{{$job->id}}/payment" method="POST" id="payment">
            {!! csrf_field() !!}
            <input type="hidden" id="key" value="{{ getenv('STRIPE_PUBLIC_KEY')}}">
            <input type="hidden" name="token" id="token">
            <input type="hidden" name="email" id="email">
        </form>
    @endif
</div>

@endsection