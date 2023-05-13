<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\System\Identity;
use App\Models\System\Token;
use App\Resolvers\PathTenantResolver;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Session;
use Stancl\Tenancy\Exceptions\RouteIsMissingTenantParameterException;
use Stancl\Tenancy\Middleware\IdentificationMiddleware;
use Stancl\Tenancy\Tenancy;

class InitializeTenancyByPath extends IdentificationMiddleware
{
    /** @var callable|null */
    public static $onFail;

    /** @var Tenancy */
    protected $tenancy;

    /** @var PathTenantResolver */
    protected $resolver;

    public function __construct(Tenancy $tenancy, PathTenantResolver $resolver)
    {
        $this->tenancy = $tenancy;
        $this->resolver = $resolver;
    }

    public function handle(Request $request, Closure $next)
    {
        /** @var Route $route */
        $route = $request->route();

        // Only initialize tenancy if tenant is the first parameter
        // We don't want to initialize tenancy if the tenant is
        // simply injected into some route controller action.

        if ($route->parameterNames()[0] === PathTenantResolver::$tenantParameterName || ($route->parameterNames()[0] === 'api' && $route->parameterNames()[1] === PathTenantResolver::$tenantParameterName)) {
            Session::put('bearer', $request->bearerToken());
            return $this->initializeTenancy(
                $request, $next, $route
            );
        } else {
            throw new RouteIsMissingTenantParameterException;
        }
        return $next($request);
    }
}
