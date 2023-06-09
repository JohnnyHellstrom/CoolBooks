<?php

namespace App\Providers;

use App\Models\Role;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('view-button-for-admin', function ($user){                        
            return $user->role_id === Role::IS_ADMIN;
        });

        Gate::define('view-button-for-moderator', function ($user){
            return $user->role_id === Role::IS_MODERATOR || $user->role_id === Role::IS_ADMIN;        
        });

        Gate::define('view-button-for-user', function ($user){
            return $user->role_id === Role::IS_USER || $user->role_id === Role::IS_MODERATOR || $user->role_id === Role::IS_ADMIN;
        });
    }
}
