var key = $('#key').val(),
    handler = StripeCheckout.configure({
        key: key,
        image: 'https://cdn2.iconfinder.com/data/icons/hicons/600/relatorio.png',
        locale: 'auto',
        token: function(token) {
            console.log(token);
            $('#token').val(token.id);
            $('#email').val(token.email);
            $('#payment').submit();
        }
});

$('#checkoutButton').on('click', function(e) {
    // Open Checkout with further options
    var amount = 20000;

    handler.open({
        name: 'Payment Information',
        amount: amount,
    });

    e.preventDefault();
});

// Close Checkout on page navigation
$(window).on('popstate', function() {
    handler.close();
});

//# sourceMappingURL=all.js.map
