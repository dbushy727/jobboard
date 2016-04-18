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
        'application_method',
        'company_name',
        'description',
        'email',
        'is_featured',
        'is_remote',
        'location',
        'logo',
        'replacement_id',
        'title',
        'url',
    ];

    /******************
        RELATIONSHIPS
     *****************/

    public function payment()
    {
        return $this->hasOne('App\Models\Payment');
    }

    public function original()
    {
        return $this->belongsTo('App\Models\Job', 'replacement_id');
    }

    public function replacement()
    {
        return $this->hasOne('App\Models\Job', 'replacement_id');
    }


    /******************
        QUERY SCOPES
     *****************/

    /**
     * Find job postings from the last 30 days
     *
     * @param  Illuminate\Database\Eloquent\Builder $query
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeCurrent($query)
    {
        return $query->where('created_at', '>=', Carbon::today()->subDay(30));
    }

    /**
     * Find rejected jobs
     *
     * @param  Illuminate\Database\Eloquent\Builder $query
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeRejected($query)
    {
        return $query->where('is_rejected', true);
    }

    /**
     * Find not rejected jobs
     *
     * @param  Illuminate\Database\Eloquent\Builder $query
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeNotRejected($query)
    {
        return $query->where('is_rejected', false);
    }

    /**
     * Find jobs that have been paid for
     *
     * @param  Illuminate\Database\Eloquent\Builder $query
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopePaid($query)
    {
        return $query->where('is_paid', true);
    }

    /**
     * Find jobs that haven't been paid for yet
     *
     * @param  Illuminate\Database\Eloquent\Builder $query
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeNotPaid($query)
    {
        return $query->where('is_paid', false);
    }

    /**
     * Find jobs that are currently active
     *
     * @param  Illuminate\Database\Eloquent\Builder $query
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->paid()
            ->notRejected()
            ->where('is_active', true);
    }

    /**
     * Find jobs that are pending approval
     *
     * @param  Illuminate\Database\Eloquent\Builder $query
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopePending($query)
    {
        return $query->paid()
            ->notRejected()
            ->where('is_active', false);
    }

    public function scopeReplacements($query)
    {
        return $query->whereNotNull('replacement_id');
    }

    /**
     * Search through active current jobs
     *
     * @param  Illuminate\Database\Eloquent\Builder $query
     * @param  string $term
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $term)
    {
        return $query->active()->current()->where(function ($q) use ($term) {
            $q->where('title', 'like', "%{$term}%");
            $q->orWhere('description', 'like', "%{$term}%");
        });
    }

    /******************
        ACTIONS
     *****************/

    /**
     * Activate a job
     *
     * @return bool
     */
    public function activate()
    {
        $this->is_active = true;
        return $this->save();
    }

    /**
     * Set job to paid
     *
     * @return bool
     */
    public function pay()
    {
        $this->is_paid = true;
        $this->save();
    }

    public function replace()
    {
        foreach ($this->fillable as $attribute) {
            $this->$attribute = $this->replacement->$attribute;
        }

        $this->replacement_id = null;

        return $this->save() && $this->replacement->delete();
    }

    /**
     * Reject a job
     *
     * @return bool
     */
    public function reject()
    {
        $this->is_rejected = true;
        return $this->save();
    }

    /******************
        LOOK-UPS
     *****************/

    public function isReplacement()
    {
        return $this->replacement_id !== null;
    }
}
