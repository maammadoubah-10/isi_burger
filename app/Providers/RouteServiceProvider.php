<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The default home path after authentication.
     *
     * @var string
     */
 // ✅ Laravel Breeze utilise cette constante
 public const HOME = '/redirect';
    /**
     * Redirect based on user role.
     */
    public static function getHomeRoute()
    {
        if (!Auth::check()) {
            return route('login');
        }

        return Auth::user()->role === 'gestionnaire'
            ? route('dashboard')
            : route('catalogue');
    }
    

    

    /**
     * Define route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}
