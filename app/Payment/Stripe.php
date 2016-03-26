<?php

namespace App\Payment;

use Stripe\Charge;
use Stripe\Error\Card as CardError;
use Stripe\Stripe as StripeClient;

class Stripe
{
    protected $api_token;

    protected $stripe;

    protected $charge;

    protected $currency = 'usd';

    protected $default_payment_amount = 20000;

    protected $default_description = 'Application Fee';

    public function __construct(StripeClient $stripe, Charge $charge)
    {
        $this->stripe = $stripe;
        $this->charge = $charge;
        $this->setApiToken();
    }

    protected function setApiToken()
    {
        $this->api_token = getenv('STRIPE_SECRET_KEY');
        $this->stripe->setApiKey($this->api_token);
    }

    public function charge($params)
    {
        $params['amount']       = array_get($params, 'amount', $this->default_payment_amount);
        $params['currency']     = array_get($params, 'currency', $this->currency);
        $params['description']  = array_get($params, 'description', $this->default_description);
        $params['source']       = array_pull($params, 'token');

        try {
            $charge = $this->charge->create($params);

            return [
                'status'  => 'success',
                'message' => $charge,
            ];

        } catch (CardError $e) {
            return [
                'status'  => 'error',
                'message' => $e->getMessage(),
            ];
        }
    }
}
