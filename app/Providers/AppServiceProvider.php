<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // 解决"SQLSTATE[42000]: Syntax error or access violation: 1071 Specified key was too long;
        // max key length is 767 bytes (SQL: alter table `users` add unique `users_email_unique`(`email`))"
        Schema::defaultStringLength(191);
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
