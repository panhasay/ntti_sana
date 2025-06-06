<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Cache\RateLimiting\Limit;
use App\Models\Certificates\CertSubModule;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });

        try {
            $subModules = CertSubModule::where('active', 1)
                ->whereNotNull('route')
                ->get();

            Route::middleware(['web', 'auth'])
                ->prefix('certificate/{dept_code}')
                ->group(function () use ($subModules) {
                    foreach ($subModules as $item) {
                        $controller = 'App\Http\Controllers\Certificates\CertificateController@' . $item->controller;
                        Route::get($item->route . '/{module_code}', $controller)
                            ->name('certificate.' . $item->route);
                    }
                });
        } catch (\Exception $e) {
            Log::warning('Could not load dynamic submodules: ' . $e->getMessage());
        }
    }

    /**
     * Configure the rate limiters for the application.
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
