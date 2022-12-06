<?php

namespace App\Models\Workshop\WorkshopInformations;

use App\Models\System\Workshop;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class WorkshopPlace extends Model
{
    use HasFactory;

    /* {!! Relacje !!} */
    public function workshop(): hasOne
    {
        return $this->hasOne(Workshop::class);
    }
}
