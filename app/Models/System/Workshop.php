<?php

namespace App\Models\System;

use App\Models\Workshop\Workers\Worker;
use App\Models\Workshop\WorkshopInformations\WorkshopAdditionalField;
use App\Models\Workshop\WorkshopInformations\WorkshopContactForm;
use App\Models\Workshop\WorkshopInformations\WorkshopPlace;
use App\Traits\LogTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns;
use Stancl\Tenancy\Database\Concerns\CentralConnection;
use Stancl\Tenancy\Database\TenantCollection;
use Stancl\Tenancy\Events;

/**
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $email
 *
 * @method static TenantCollection all($columns = ['*'])
 */
class Workshop extends Model implements TenantWithDatabase
{
    use Concerns\CentralConnection,
        Concerns\HasInternalKeys,
        Concerns\TenantRun,
        Concerns\InvalidatesResolverCache,
        Concerns\HasDatabase,
        LogTrait, CentralConnection;

    protected $table = 'system.workshops';
    protected $casts = [
        'owners' => 'array',
        'social_media' => 'array',
    ];

    public function getTenantKeyName(): string
    {
        return 'id';
    }

    public function getTenantKey()
    {
        return $this->getAttribute($this->getTenantKeyName());
    }

    public function newCollection(array $models = []): TenantCollection
    {
        return new TenantCollection($models);
    }

    protected $dispatchesEvents = [
        'saving' => Events\SavingTenant::class,
        'saved' => Events\TenantSaved::class,
        'creating' => Events\CreatingTenant::class,
        'created' => Events\TenantCreated::class,
        'updating' => Events\UpdatingTenant::class,
        'updated' => Events\TenantUpdated::class,
        'deleting' => Events\DeletingTenant::class,
        'deleted' => Events\TenantDeleted::class,
    ];

    /* {!! Relacje !!} */
    public function identity(): belongsTo
    {
        return $this->belongsTo(Identity::class);
    }

    public function contactForm(): hasOne
    {
        return $this->hasOne(WorkshopContactForm::class);
    }

    public function places(): hasMany
    {
        return $this->hasMany(WorkshopPlace::class, 'workshop_id', 'id');
    }

    public function additionalFields(): hasMany
    {
        return $this->hasMany(WorkshopAdditionalField::class);
    }

    public function workers(): hasMany
    {
        return $this->hasMany(Worker::class, 'workshop_id', 'id');
    }

}
