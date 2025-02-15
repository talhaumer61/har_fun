<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobCategory extends Model
{
    use HasFactory;

    protected $table = 'hf_job_categories';
    protected $primaryKey = 'cat_id';
    public $timestamps = false;

    protected $fillable = [
        'cat_id', 'cat_status', 'cat_name', 'cat_href', 'cat_desc', 'cat_detail', 
        'id_added', 'id_modify', 'date_added', 'date_modify', 
        'is_deleted', 'id_deleted', 'date_deleted', 'ip_deleted', 'cat_icon'
    ];
}
