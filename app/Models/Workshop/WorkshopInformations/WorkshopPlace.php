<?php

namespace App\Models\Workshop\WorkshopInformations;

use App\Models\System\Workshop;
use App\Traits\UseTenantConnection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkshopPlace extends Model
{
    use HasFactory, UseTenantConnection;

    /* {!! Relacje !!} */
    public function workshop(): belongsTo
    {
        return $this->belongsTo(Workshop::class);
    }
}
