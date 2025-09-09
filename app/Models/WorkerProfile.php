<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkerProfile extends Model
{
    protected $fillable = [
        'user_id',
        'headline',
        'address',
        'city_id',
        'phone',
        'profile_picture',
        'bio',
        'tagline',
        'experience_years',
        'availability',
        'working_hours',
        'resume',
        'category_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function category()
    {
        return $this->belongsTo(JobCategory::class, 'category_id', 'cat_id');
    }
}
