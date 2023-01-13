<?php

namespace App\Models\Workshop\Clients;

use App\Models\Workshop\Cars\Car;
use App\Models\Workshop\Documents\Document;
use App\Traits\LogTrait;
use App\Traits\MediableTrait;
use App\Traits\UseTenantConnection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, UseTenantConnection, SoftDeletes, LogTrait, MediableTrait;

    /* * * * * * * * * * * * * * * * * * *
    *            Relacje                *
    * * * * * * * * * * * * * * * * * * */

    public function cars(): HasMany
    {
        return $this->hasMany(Car::class);
    }

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }
}
