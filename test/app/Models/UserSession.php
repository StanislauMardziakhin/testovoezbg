<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSession extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'access_token',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_sessions';
}

