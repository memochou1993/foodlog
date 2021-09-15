<?php

namespace App\Providers;

use App\Models\Token;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Sanctum::ignoreMigrations();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Sanctum::usePersonalAccessTokenModel(Token::class);

        Gate::guessPolicyNamesUsing(function ($model) {
            return 'App\\Policies\\'.class_basename($model).'Policy';
        });
    }
}
