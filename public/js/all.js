var key = $('#key').val(),
    handler = StripeCheckout.configure({
        key: key,
        image: 'https://cdn2.iconfinder.com/data/icons/hicons/600/relatorio.png',
        locale: 'auto',
        token: function(token) {
            $('#token').val(token.id);
            $('#email').val(token.email);
            $('#payment').submit();
        }
});

function setupCheckout() {
    var id = window.location.pathname.split('/')[2];

    var callback = function (job) {
        if (job.status == 'error') {
            $('#errorMessage').text(job.message);
            return false;
        }
    }

    return getJob(id, callback);
}

function getJob(id, callback)
{
    return $.ajax({
        url: '/jobs-ajax/' + id,
        method: 'get',
        success: function (job) {
            return callback(job);
        }
    });
}

function createCheckoutListener() {
    $('#paymentButton').on('click', function(e) {
        e.preventDefault();
        $('#checkoutModal').hide();

        setupCheckout().then(function (data) {
            var amount = data.message.price - data.message.discount;

            // Open Checkout with further options
            handler.open({
                name: 'Payment Information',
                amount: amount,
            });
        });
    });
};

function applyCoupon() {
    $('.coupon-apply-button').on('click', function (e) {
        e.preventDefault();

        var coupon_code = $('input.coupon-code').val();
        var job_id = $('input.job').val();
        var token = $('.coupon-input-group input').first().val();

        $.ajax({
            url: '/jobs-ajax/' + job_id + '/apply-coupon?ajax=true',
            method: 'POST',
            data: {
                code: coupon_code,
                _token: token
            },
            success: function (data) {
                if (data.message !== 'Coupon Applied') {
                    $('#coupon_message').addClass('text-danger');
                    $('#coupon_message').removeClass('text-success');
                } else {
                    $('#coupon_message').removeClass('text-danger');
                    $('#coupon_message').addClass('text-success');

                    if (data.job.is_paid) {
                        window.location.href = '/thank-you';
                    }

                    var discount = (data.job.discount / 100).toFixed(2);
                    var price = (data.job.price / 100).toFixed(2);
                    var total = (price - discount).toFixed(2);
                    var html = '<td class="borderless">Discount</td><td class="borderless">- $' + discount +'</td>'
                    $('#discount_row').empty().append(html);
                    $('#total').text(total);
                }

                $('#coupon_message').text(data.message);
            }
        })
    });
}

// Close Checkout on page navigation
$(window).on('popstate', function() {
    handler.close();
});

$(function() {
    createCheckoutListener();
    applyCoupon();
});
var renderFileUploaded = function () {
    $('#logo').on('change', function (e) {
        var logo = this;
        var data = $(logo).val().split('\\');
        var name = data[data.length - 1];
        $('.uploadedFile').text(name);
    });
};

$(function() {
    renderFileUploaded();
});
//# sourceMappingURL=all.js.map
