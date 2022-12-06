<?php

namespace App\Models\System;

use App\Models\Workshop\WorkshopInformations\WorkshopAdditionalField;
use App\Models\Workshop\WorkshopInformations\WorkshopContactForm;
use App\Models\Workshop\WorkshopInformations\WorkshopPlace;
use App\Traits\LogTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns;
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
        LogTrait;

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

    public function contactForm(): belongsTo
    {
        return $this->belongsTo(WorkshopContactForm::class);
    }

    public function places(): belongsToMany
    {
        return $this->belongsToMany(WorkshopPlace::class);
    }

    public function additionalFields(): belongsToMany
    {
        return $this->belongsToMany(WorkshopAdditionalField::class);
    }


}
