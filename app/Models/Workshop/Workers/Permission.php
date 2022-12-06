<?php

namespace App\Models\Workshop\Workers;

use App\Models\Workers\Group;
use App\Traits\LogTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    use HasFactory, LogTrait;

    /* * * * * * * * * * * * * * * * * * *
     *            Relacje                *
     * * * * * * * * * * * * * * * * * * */
    public function groups(): belongsToMany
    {
        return $this->belongsToMany(Group::class);
    }

    /* * * * * * * * * * * * * * * * * * *
     *            Funkcje                *
     * * * * * * * * * * * * * * * * * * */
}