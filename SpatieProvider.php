<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Vite;

class SpatieProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot(Router $router): void
    {
        $this->permissionMiddleware($router);

        $this->cspMiddleware($router);

        // Declaration
        // Gate::policy(Subscriber::class, SubscriberPolicy::class);
        // Policy use in controller
        // Gate::authorize('create', Subscriber::class);

        // Implicitly grant "Super Admin" role all permissions
        // This works in the app by using gate-related functions like auth()->user->can() and @can()
        Gate::before(function ($user, $ability) {
            return $user->hasRole('superadmin') ? true : null;
        });
    }

    // Load permission middleware
    public function permissionMiddleware(Router $router)
    {
        $router->aliasMiddleware('role', \Spatie\Permission\Middleware\RoleMiddleware::class);
        $router->aliasMiddleware('permission', \Spatie\Permission\Middleware\PermissionMiddleware::class);
        $router->aliasMiddleware('role_or_permission', \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class);
    }

    // Load Csp policy middleware
    public function cspMiddleware(Router $router)
    {
        Vite::useCspNonce(app('csp-nonce'));

        $router->aliasMiddleware('csp-header', \Spatie\Csp\AddCspHeaders::class);
        $router->pushMiddlewareToGroup('web', \Spatie\Csp\AddCspHeaders::class);
        // $router->prependMiddlewareToGroup('web', \Spatie\Csp\AddCspHeaders::class);
    }
}
