<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';

    protected $fillable = [
        'name',
        'href',
        'description',
        'id_province',
        'id_district',
        'id_added',
        'id_modify',
        'date_added',
        'date_modify',
        'is_deleted',
        'id_deleted',
        'date_deleted',
        'ip_deleted',
    ];

    public $timestamps = false;

    // Scope to get only non-deleted cities
    public function scopeActive($query)
    {
        return $query->where('is_deleted', 0);
    }
}
