<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Log;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Session;
// use Illuminate\Support\Carbon;

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
        try {
            Paginator::useBootstrap();

            $ip = request()->ip();
            $key = 'ip_' . $ip;
            $currentTime = now();

            if (!Session::has($key)) {
                // If the IP address hasn't visited before, set the initial timestamp
                Session::put($key, $currentTime);
            }

            // Calculate the time elapsed since the first visit
            $firstVisitTime = Session::get($key);
            $timeElapsed = $currentTime->diffInMinutes($firstVisitTime);

            // Calculate the remaining time (60 minutes limit)
            $remainingTime = 60 - $timeElapsed;

            // Determine if the button should be enabled or disabled
            $disabled = ($remainingTime <= 0);
            view()->share('disabled', $disabled);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
