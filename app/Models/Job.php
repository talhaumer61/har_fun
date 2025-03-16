<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Job extends Model
{
    use HasFactory;

    protected $table = 'hf_jobs'; // Define table name if it's not 'jobs'
    protected $primaryKey = 'job_id'; // Define primary key

    protected $fillable = [
        'job_status',
        'id_customer',
        'job_title',
        'job_href',
        'job_desc',
        'job_location',
        'job_budget',
        'id_currency',
        'job_photo',
        'id_cat',
        'id_city',
        'id_added',
        'id_modify',
        'date_added',
        'date_modify',
        'is_deleted',
        'id_deleted',
        'date_deleted',
        'ip_deleted'
    ];

    public $timestamps = false; // using custom timestamps
}
