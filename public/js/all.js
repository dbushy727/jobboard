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

    $.ajax({
        url: '/jobs-ajax/' + id,
        method: 'get',
        success: function (job) {
            if (job.status == 'error') {
                $('#errorMessage').text(job.message);
                return false;
            }

            var amount = job.message.price;

            createCheckoutListener(amount);
        }
    });
}


function createCheckoutListener(amount) {
    $('#checkoutButton').on('click', function(e) {
        e.preventDefault();
        // Open Checkout with further options
        handler.open({
            name: 'Payment Information',
            amount: amount,
        });
    });
};


// Close Checkout on page navigation
$(window).on('popstate', function() {
    handler.close();
});

$(function() {
    setupCheckout();
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
