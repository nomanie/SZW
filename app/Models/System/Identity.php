<?php

namespace App\Models\System;

use App\Models\Workshop;
use App\Traits\LogTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;
use Stancl\Tenancy\Database\TenantCollection;
use Stancl\Tenancy\Events;

/**
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $email
 *
 * @method static TenantCollection all($columns = ['*'])
 */
class Identity extends Authenticatable implements TenantWithDatabase
{
    use Concerns\CentralConnection,
        Concerns\HasInternalKeys,
        Concerns\TenantRun,
        Concerns\InvalidatesResolverCache,
        HasDatabase, HasDomains,
        HasApiTokens, HasFactory, Notifiable, LogTrait;

    protected $table = 'identities';
    protected $primaryKey = 'id';
    protected $guarded = [];
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

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function workshop(): hasOne
    {
        return $this->hasOne(Workshop::class, 'identity_id', 'id');
    }

    public function user(): hasOne
    {
        return $this->hasOne(User::class, 'identity_id', 'id');
    }

}
