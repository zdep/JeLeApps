<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UsersAuth extends Model
{
    protected $table = 'users_auth';
    public $timestamps = false;
    protected $fillable = [
		'token',
        'users_id',
    ];

	//******************************************************************
    public function user(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'users_id',
            'id'
        );
    }
}
