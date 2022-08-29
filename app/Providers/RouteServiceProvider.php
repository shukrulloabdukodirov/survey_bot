<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{

    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    protected $survey_namespace = "Base\Survey\Application\Http\Controllers\Api";
    protected $survey_dir = "base/Survey/Application/Http/Routes/";

    protected $application_namespace = "Base\Application\Application\Http\Controllers\Api";
    protected $application_dir = "base/Application/Application/Http/Routes/";

    protected $resource_namespace = "Base\Resource\Application\Http\Controllers\Api";
    protected $resource_dir = "base/Resource/Application/Http/Routes/";

    protected $applicant_namespace = "Base\User\Applicant\Application\Http\Controllers\Api";
    protected $applicant_dir = "base/User/Applicant/Application/Http/Routes/";
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {


            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            //            survey
            Route::prefix('api/v1/')
                ->middleware('api')
                ->namespace($this->survey_namespace)
                ->group(base_path($this->survey_dir . 'api.php'));
            //            application
            Route::prefix('api/v1/')
                ->middleware('api')
                ->namespace($this->application_namespace)
                ->group(base_path($this->application_dir . 'api.php'));

            //            resource
            Route::prefix('api/v1/')
                ->middleware('api')
                ->namespace($this->resource_namespace)
                ->group(base_path($this->resource_dir . 'api.php'));

            //            applicant
            Route::prefix('api/v1/')
                ->middleware('api')
                ->namespace($this->applicant_namespace)
                ->group(base_path($this->applicant_dir . 'api.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
