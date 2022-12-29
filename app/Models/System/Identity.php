<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Identity extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    protected $table = 'system.identities';
    protected $primaryKey = 'id';
    protected $guarded = [];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function workshop(): hasOne
    {
        return $this->hasOne(Workshop::class, 'identity_id', 'id');
    }

    public function user(): hasOne
    {
        return $this->hasOne(User::class, 'identity_id', 'id');
    }

    public function worker(): hasOne
    {
        return $this->hasOne(SystemWorker::class, 'identity_id', 'id');
    }

}
