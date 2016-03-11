<?php

namespace App\Models;

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
        'headquarters',
        'description',
        'application_method',
        'is_featured',
    ];
}
