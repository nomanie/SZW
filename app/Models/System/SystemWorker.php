<?php

namespace App\Models\System;

use App\Traits\UseSystemConnection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemWorker extends Model
{
    use HasFactory, UseSystemConnection;

    protected $table = 'workers';
}
