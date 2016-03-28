<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'session_id',
        'company_name',
        'url',
        'logo',
        'email',
        'title',
        'location',
        'description',
        'application_method',
        'is_featured',
        'is_remote',
        'is_active',
        'is_paid',
        'price',
    ];

    /**
     * limit job postings to last 30 days
     *
     * @param  Illuminate\Database\Eloquent\Builder $query
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeCurrent($query)
    {
        return $query->where('created_at', '>=', Carbon::today()->subDay(30));
    }

    public function scopeRejected($query)
    {
        return $query->where('is_rejected', true);
    }

    public function scopeNotRejected($query)
    {
        return $query->where('is_rejected', false);
    }

    public function scopePaid($query)
    {
        return $query->where('is_paid', true);
    }

    public function scopeNotPaid($query)
    {
        return $query->where('is_paid', false);
    }

    public function scopeActive($query)
    {
        return $query->paid()
            ->notRejected()
            ->where('is_active', true);
    }

    public function scopePending($query)
    {
        return $query->paid()
            ->notRejected()
            ->where('is_active', false);
    }

    public function activate()
    {
        return $this->update(['is_active' => true]);
    }

    public function pay()
    {
        return $this->update(['is_paid' => true]);
    }

    public function reject()
    {
        return $this->update(['is_rejected' => true]);
    }

    public function payment()
    {
        return $this->hasOne('App\Models\Payment');
    }

    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = $this->attributes['is_featured'] ? env('BASE_PRICE') + env('FEATURE_PRICE') : env('BASE_PRICE');
    }

    public function setSessionIdAttribute($value)
    {
        $this->attributes['session_id'] = \Session::getId();
    }
}
