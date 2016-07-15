@extends('jobs.show')

@section('activate')
    <div class="activation-buttons text-center">
        @if($job->is_paid || $job->isReplacement())
            <a href="/thank-you" class="btn btn-success header-button pull-right">Proceed to Checkout</a>
        @else
            <button class="btn btn-success btn-block header-button" id="checkoutButton" data-toggle="modal" data-target="#checkoutModal">Proceed to Checkout</button>
            or <a href="/jobs/{{$job->slug}}/edit/{{$job->edit_token}}">Back to Edit</a>
            <form action="/jobs/{{$job->slug}}/payment" method="POST" id="payment">
                {!! csrf_field() !!}
                <input type="hidden" id="key" value="{{ getenv('STRIPE_PUBLIC_KEY')}}">
                <input type="hidden" name="token" id="token">
                <input type="hidden" name="email" id="email">
            </form>
        @endif
    </div>

    <div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="checkoutModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content sans-serif">
                <div class="modal-header text-center">
                    <h3>
                        <span>Checkout</span>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </h3>
                </div>
                <div class="modal-body modal-text">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td class="borderless">Application Fee</td>
                                <td class="borderless">$200.00</td>
                            </tr>
                            @if($job->is_featured)
                            <tr>
                                <td class="borderless">Feature</td>
                                <td class="borderless">$50.00</td>
                            </tr>
                            @endif
                            <tr id="discount_row">
                                @if($job->discount)
                                <td class="borderless">Discount</td>
                                <td class="borderless">- ${{$job->getDiscountInMoney()}}</td>
                                @endif
                            </tr>
                            <tr>
                                <td><strong>Total</strong></td>
                                <td id="total">${{ $job->getTotalInMoney() }} </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <div class="col-sm-6 text-left">
                        <div><i class="fa fa-tag"></i> Have a coupon? Enter it here.</div>
                    </div>
                    <div class="col-sm-6">
                        <div class="input-group coupon-input-group">
                            {!! csrf_field() !!}
                            <input type="hidden" class="job" value="{{$job->id}}">
                            <input type="text" class="form-control coupon-code" placeholder="Coupon Code">
                            <span class="input-group-btn"><button class="btn btn-primary coupon-apply-button">Apply</button></span>
                        </div>
                        <p id="coupon_message" class="text-center"></p>
                    </div>
                    <div class="col-sm-12">
                        <br><br>
                        <button id="paymentButton" class="btn btn-success btn-block">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection