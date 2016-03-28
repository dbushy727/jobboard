<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    protected $fillable = [
        'payment_id',
        'amount',
        'transaction_id',
        'reason',
    ];

    public function payment()
    {
        return $this->belongsTo('App\Models\Payment');
    }
}
