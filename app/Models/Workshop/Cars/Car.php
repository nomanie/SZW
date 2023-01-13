<?php

namespace App\Models\Workshop\Cars;

use App\Models\Workshop\Documents\Document;
use App\Traits\LogTrait;
use App\Traits\UseTenantConnection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use HasFactory, UseTenantConnection, SoftDeletes, LogTrait;

    /* * * * * * * * * * * * * * * * * * *
    *            Relacje                *
    * * * * * * * * * * * * * * * * * * */

    public function client(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }
}
