<?php

namespace App\Models\Workshop\Workers;

use App\Models\Workers\Group;
use App\Traits\LogTrait;
use App\Traits\UseTenantConnection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    use HasFactory, LogTrait, UseTenantConnection;

    /* * * * * * * * * * * * * * * * * * *
     *            Relacje                *
     * * * * * * * * * * * * * * * * * * */
    public function workers(): belongsToMany
    {
        return $this->belongsToMany(Worker::class);
    }

    /* * * * * * * * * * * * * * * * * * *
     *            Funkcje                *
     * * * * * * * * * * * * * * * * * * */
}
