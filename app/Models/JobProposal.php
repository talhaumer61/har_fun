<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobProposal extends Model
{
    protected $table = 'hf_job_proposals';

    protected $primaryKey = 'id';

    protected $fillable = [
        'job_id',
        'worker_id',
        'bid_amount',
        'cover_letter',
        'attachment',
        'status',
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
}
