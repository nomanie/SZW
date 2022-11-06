<?php

namespace App\Models\Workers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Group extends Model
{
    use HasFactory;

    /* * * * * * * * * * * * * * * * * * *
     *            Relacje                *
     * * * * * * * * * * * * * * * * * * */
    public function permissions(): hasMany
    {
        return $this->hasMany(Permission::class);
    }

    public function workers(): hasMany
    {
        return $this->hasMany(Worker::class);
    }

    /* * * * * * * * * * * * * * * * * * *
     *            Funkcje                *
     * * * * * * * * * * * * * * * * * * */
}
