@extends('jobs.show')

@section('activate')

<div class="activation-buttons">
    <button class="btn btn-info">Edit</button>
    <button class="btn btn-success pull-right" id="checkoutButton">Looks Good</button>
    <form action="/jobs/{{$job->id}}/activate" method="POST" id="payment">
        <input type="hidden" id="key" value="{{ getenv('STRIPE_PUBLIC_KEY')}}">
        <input type="hidden" name="token" id="token">
    </form>
</div>

<script src="/js/payment.js"></script>
@endsection