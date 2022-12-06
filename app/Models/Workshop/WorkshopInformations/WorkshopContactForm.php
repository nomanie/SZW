<?php

namespace App\Models\Workshop\WorkshopInformations;

use App\Models\System\Workshop;
use App\Traits\UseTenantConnection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Stancl\Tenancy\Database\Concerns\ResourceSyncing;

class WorkshopContactForm extends Model implements Syncable
{
    use HasFactory, ResourceSyncing;

    protected $connection = 'tenant';

    /* {!! Relacje !!} */
    public function workshop(): hasOne
    {
        return $this->hasOne(Workshop::class);
    }
}
