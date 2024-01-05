<?php

namespace App\Providers;

use App\Models\Agenda;
use App\Repositories\AgendaRepository;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AgendaRepository::class, function ($app) {
            return new AgendaRepository(new Agenda());
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
