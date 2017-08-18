<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Jenssegers\Date\Date;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Carbon::setLocale(config('app.locale'));

        Date::setLocale(config('app.locale'));

        setlocale(LC_TIME, "ru_RU");

        Validator::extend('without_spaces', function($attr, $value){
            return str_slug($value) == $value;
        }, 'Поле должно быть валидным URI');

        Cache::flush();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
