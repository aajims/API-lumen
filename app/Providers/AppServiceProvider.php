<?php

namespace App\Providers;

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
        $isDbListen = env('APP_DB_LISTEN', config('APP_DB_LISTEN', false));
        if ($isDbListen) {
            DB::listen(function ($query) {
                $context = ['bind' => $query->bindings, 'time' => $query->time];
                \Log::log($query->sql, $context);
            });
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Lumen IDE helper for PhpStorm.
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }
}
