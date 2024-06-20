<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

      
        Gate::define('acesso-restritoClienteContrato', function ($user) {
            $authorizedEmails = [
                'don@don.com.br','matheus.castro@orlario.com.vc','thiago.martins@orlario.com.vc','guilherme@orlario.com.vc'
            ];

            return in_array($user->email, $authorizedEmails);
        });

        Gate::define('acesso-restritoFinanceiro', function ($user) {
            $authorizedEmails = [
                'don@don.com.br','matheus.castro@orlario.com.vc','kelly.gomes@orlario.com.vc','guilherme@orlario.com.vc'
            ];

            return in_array($user->email, $authorizedEmails);
        });
        Gate::define('acesso-restritoTotal', function ($user) {
            $authorizedEmails = [
                'don@don.com.br','matheus.castro@orlario.com.vc','guilherme@orlario.com.vc'
            ];

            return in_array($user->email, $authorizedEmails);
        });


    }
}
