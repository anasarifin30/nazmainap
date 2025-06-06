<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Midtrans\Config;

class MidtransServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('midtrans', function ($app) {
            Config::$serverKey = config('midtrans.server_key');
            Config::$isProduction = config('midtrans.is_production');
            Config::$isSanitized = config('midtrans.is_sanitized');
            Config::$is3ds = config('midtrans.is_3ds');

            return new Config();
        });
    }

    public function boot()
    {
        //
    }
}