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

$('#checkoutButton').on('click', function(e) {
    var id = window.location.pathname.split('/')[2];
    $.ajax({
        url: '/jobs/' + id + '/info',
        method: 'get',
        success: function (job) {
            if (job.status == 'error') {
                $('#errorMessage').text(job.message);
                return false;
            }

            var amount = job.message.price;

            // Open Checkout with further options
            handler.open({
                name: 'Payment Information',
                amount: amount,
            });
        }
    });
    e.preventDefault();
});

// Close Checkout on page navigation
$(window).on('popstate', function() {
    handler.close();
});
