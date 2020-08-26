<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\CovidPatient;
use App\CovidSample;

use App\Observers\CovidPatientObserver;
use App\Observers\CovidSampleObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (env('APP_ENV') != 'local')
            \Illuminate\Support\Facades\URL::forceScheme('https');
        
        CovidPatient::observe(CovidPatientObserver::class);
        CovidSample::observe(CovidSampleObserver::class);
    }
}
