<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'amount',
        'limit',
        'uses'
    ];

    public function isMaxedOut()
    {
        return $this->uses == $this->limit;
    }

    public function useIt()
    {
        $this->uses++;
        $this->save();
    }
}
