<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WorkerPortfolio extends Model
{
    use HasFactory;

    protected $table = 'worker_portfolios';

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'description',
        'image',
        'external_link',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
