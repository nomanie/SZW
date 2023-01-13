<?php

namespace App\Models\Workshop\Documents;

use App\Models\Workshop\Cars\Car;
use App\Models\Workshop\Clients\Client;
use App\Traits\LogTrait;
use App\Traits\MediableTrait;
use App\Traits\UseTenantConnection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use HasFactory, UseTenantConnection, SoftDeletes, LogTrait, MediableTrait;

    /* * * * * * * * * * * * * * * * * * *
    *            Relacje                *
    * * * * * * * * * * * * * * * * * * */

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function documentContents(): HasMany
    {
        return $this->hasMany(DocumentContent::class);
    }
}
