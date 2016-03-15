var key = $('#key').val(),
    handler = StripeCheckout.configure({
        key: key,
        image: 'https://cdn2.iconfinder.com/data/icons/hicons/600/relatorio.png',
        locale: 'auto',
        token: function(token) {
            $('#token').val(token.id);
            $('#payment').submit();
        }
});

$('#checkoutButton').on('click', function(e) {
    // Open Checkout with further options
    handler.open({
        name: 'Payment Information',
        amount: 20000,
    });

    e.preventDefault();
});

// Close Checkout on page navigation
$(window).on('popstate', function() {
    handler.close();
});

//# sourceMappingURL=all.js.map
