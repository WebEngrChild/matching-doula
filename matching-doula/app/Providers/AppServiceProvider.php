<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Payjp\Payjp;

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
        //決済処理用に追加
        Payjp::setApiKey(config('payjp.secret_key'));
    }
}
