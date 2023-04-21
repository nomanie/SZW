<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthorizedDevice extends Model
{
    use HasFactory;

    protected $fillable = [
        'identity_id',
        'ip_address',
        'mac_address'
    ];
}
