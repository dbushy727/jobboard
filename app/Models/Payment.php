<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'job_id',
        'amount',
        'transaction_id',
        'description',
        'email',
        'type',
        'last4',
        'exp_month',
        'exp_year',
        'name',
    ];

    public function job()
    {
        return $this->belongsTo('App\Models\Job');
    }

    public function refund()
    {
        return $this->hasOne('App\Models\Refund');
    }
}
