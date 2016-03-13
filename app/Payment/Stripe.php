<?php

namespace App\Payment\Stripe;

use Stripe\Stripe;

class Stripe
{
    protected $api_token;

    protected $client;

    public function __construct(Stripe $stripe)
    {
        $this->client = $stripe;
    }

    public function setApiToken()
    {
        $this->api_token = getenv('STRIPE_API_SECRET');
    }

    public function charge($params)
    {
        return $this->client->charge($params);
    }
}
