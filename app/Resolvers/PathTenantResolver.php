<?php

declare(strict_types=1);

namespace App\Resolvers;

use App\Models\System\Identity;
use App\Models\System\Workshop;
use Illuminate\Routing\Route;
use Stancl\Tenancy\Contracts\Tenant;
use Stancl\Tenancy\Exceptions\TenantCouldNotBeIdentifiedByPathException;
use Stancl\Tenancy\Resolvers\Contracts\CachedTenantResolver;

class PathTenantResolver extends CachedTenantResolver
{
    public static $tenantParameterName = 'tenant';

    /** @var bool */
    public static $shouldCache = false;

    /** @var int */
    public static $cacheTTL = 3600; // seconds

    /** @var string|null */
    public static $cacheStore = null; // default

    public function resolveWithoutCache(...$args): Tenant
    {
        /** @var Route $route */
        $route = $args[0];

        if ($id = $route->parameter(static::$tenantParameterName)) {
            $route->forgetParameter(static::$tenantParameterName);
            $workshop = Workshop::with('identity')->whereHas('identity', function ($query) use($id) {
               $query->where('uuid', $id);
            })->first();
            if ($tenant = $workshop) {
                return $tenant;
            }
        }

        throw new TenantCouldNotBeIdentifiedByPathException($id);
    }

    public function getArgsForTenant(Tenant $tenant): array
    {
        return [
            [$tenant->id],
        ];
    }
}
