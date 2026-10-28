<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //Restrict login, 5 times for mail, 10 times for ip
       RateLimiter::for('login', function (Request $request) {
            return [
                Limit::perMinute(5)->by($request->input('email')), 
                Limit::perMinute(10)->by($request->ip()),           
            ];
        });
        
        //The same but for register
        RateLimiter::for('register', function (Request $request) {
            return [
                Limit::perMinute(5)->by($request->input('email')), 
                Limit::perMinute(10)->by($request->ip()),          
            ];
});
    }
}
