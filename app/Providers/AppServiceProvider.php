<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use mixisLv\NameDays\NameDays;

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
    public function boot()
    {
        View::composer('layouts.navigation', function ($view) {
            $carbon = Carbon::now()->locale('lv');
            $dayName = ucfirst($carbon->translatedFormat('l'));
            $date = $carbon->format('j');
            $monthName = $carbon->translatedFormat('F');
            $fullDate = $dayName . ', ' . $date . '. ' . $monthName;

            // Get Latvian namedays using mixisLv\NameDays\NameDays package
            $nameDays = new NameDays();
            $namedays = $nameDays->getNames($carbon->format('m-d'))->toArray();

            $view->with('fullDate', $fullDate)->with('namedays', $namedays);
        });
    }
}
