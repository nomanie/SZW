<?php

namespace App\Models\Workshop\Workers;

use App\Models\System\Workshop;
use App\Traits\LogTrait;
use App\Traits\UseTenantConnection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Worker extends Model
{
    use UseTenantConnection, HasFactory, LogTrait;
    /* * * * * * * * * * * * * * * * * * *
    *            Relacje                *
    * * * * * * * * * * * * * * * * * * */
    public function permissions(): hasMany
    {
        return $this->hasMany(Permission::class);
    }

    public function workshop(): belongsTo
    {
        return $this->belongsTo(Workshop::class);
    }

    public function contracts(): HasMany
    {
        return $this->hasMany(WorkerContract::class);
    }

    public function currentContract(): HasOne
    {
        return $this->hasOne(WorkerContract::class)->whereNull('archived_at');
    }

    /* * * * * * * * * * * * * * * * * * *
     *            Funkcje                *
     * * * * * * * * * * * * * * * * * * */
}
