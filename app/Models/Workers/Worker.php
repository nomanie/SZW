<?php

namespace App\Models\Workers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Worker extends Model
{
    use HasFactory;

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
