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
        try {
            $charge = $this->charge->create([
                'source'        => array_get($params, 'token'),
                'amount'        => array_get($params, 'amount', $this->default_payment_amount),
                'currency'      => array_get($params, 'currency', $this->currency),
                'description'   => array_get($params, 'description', $this->default_description),
                'metadata'      => array_get($params, 'metadata'),
                'receipt_email' => array_get($params, 'receipt_email', null),
            ]);

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
