<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public $timestamps = false;
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'status',
        'id_role',
        'login_type',
        'photo',
        'phone',
        'id_added',
        'id_modify',
        'date_added',
        'date_modify',
        'is_deleted',
        'id_deleted',
        'date_deleted',
        'ip_deleted',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'salt',
        'ip_deleted',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_deleted' => 'boolean',
        'status' => 'integer',
        'login_type' => 'integer',
    ];

    public function conversationsAsClient()
    {
        return $this->hasMany(Conversation::class, 'client_id');
    }

    public function conversationsAsWorker()
    {
        return $this->hasMany(Conversation::class, 'worker_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function workerProfile()
    {
        return $this->hasOne(WorkerProfile::class, 'user_id');
    }

    public function reviewsReceived()
    {
        return $this->hasMany(Review::class, 'worker_id');
    }
    
    public function reviewsGiven()
    {
        return $this->hasMany(Review::class, 'customer_id');
    }


}
