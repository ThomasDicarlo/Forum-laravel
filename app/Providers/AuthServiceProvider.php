<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('manage-users', function ($user){
            return $user->hasAnyRole(['auteur','admin']);
        });

        /* Authorizing admins users to edit and delete users*/

        Gate::define('edit-users', function ($user){
            return $user->hasAnyRole(['auteur','admin']);
        });

        Gate::define('not-ban', function ($user){
            return $user->hasAnyRole(['auteur','admin','utilisateur']);
        });

        Gate::define('delete-users', function ($user){
            return $user->isAdmin();
        });



    }
}
