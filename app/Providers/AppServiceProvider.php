<?php

namespace App\Providers;

use App\Log;
use Illuminate\Support\Facades\DB;
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
        DB::listen(function ($query) {
            if (strpos($query->sql, "insert into `logs`") === false && strpos($query->sql, "select") === false) {
                $log = new Log;
                $log->sql = $query->sql;
                $log->save();
            }
        });
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
