<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    // Cuando creemos la politica, la registramos aqui, juntando el modelo Videojuego con la politica creada.
    protected $policies = [
        'App\Models\Videojuego' => 'App\Policies\VideojuegoPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies(); // Hay que usar esta funcion para terminar de registrar la politica
    }
}
