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
        'company_name',
        'url',
        'logo',
        'email',
        'title',
        'location',
        'description',
        'application_method',
        'is_featured',
        'is_active',
        'is_paid',
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

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopePending($query)
    {
        return $query->where('is_active', false);
    }

    public function activate()
    {
        return $this->update(['is_active' => true]);
    }

    public function pay()
    {
        return $this->update(['is_paid' => true]);
    }
}
