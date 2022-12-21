<?php

namespace App\Models\Workshop\Workers;

use App\Traits\LogTrait;
use App\Traits\UseTenantConnection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkerContract extends Model
{
    use HasFactory,UseTenantConnection, LogTrait;

    /* * * * * * * * * * * * * * * * * * *
    *            Relacje                *
    * * * * * * * * * * * * * * * * * * */
    public function worker(): BelongsTo
    {
        return $this->belongsTo(Worker::class);
    }

    /* * * * * * * * * * * * * * * * * * *
       *            Funkcje                *
       * * * * * * * * * * * * * * * * * * */
}
