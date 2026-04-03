<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\ProductoGuardado;
use App\Listeners\RegistrarActividad;

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
        // Aquí conectamos tu Evento con tu Listener (Estilo Laravel 11)
        Event::listen(
            ProductoGuardado::class,
            RegistrarActividad::class,
        );
    }
}