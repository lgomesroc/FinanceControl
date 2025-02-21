<?php

namespace App\Providers;

use App\Models\Goal;
use App\Policies\GoalPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * O mapeamento das políticas do aplicativo.
     *
     * @var array
     */
    protected $policies = [
        Goal::class => GoalPolicy::class, // Registra a política para o modelo Goal
    ];

    /**
     * Registre quaisquer serviços de autenticação/autorização.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Exemplo de Gate global, caso precise
        // Gate::define('update-goal', function ($user, $goal) {
        //     return $user->id === $goal->user_id;
        // });
    }
}
