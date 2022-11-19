<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Log extends Model
{
    use HasFactory;

    protected $casts = [
        'old_data' => 'array',
        'new_data' => 'array',
    ];

    public function model(): MorphTo
    {
        return $this->morphTo();
    }
}
