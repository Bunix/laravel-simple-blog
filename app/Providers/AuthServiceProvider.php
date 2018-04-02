<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Tag' => 'App\Policies\TagPolicy',
        'App\Role' => 'App\Policies\RolePolicy',
        'App\Permission' => 'App\Policies\PermissionPolicy',
        'App\Category' => 'App\Policies\CategoryPolicy',
        'App\Article' => 'App\Policies\ArticlePolicy',
        'App\Video' => 'App\Policies\VideoPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $this->registerAdminAcessGate();
    }

    public function registerAdminAcessGate(){
        Gate::define('access_admin', function($user){
            return $user->hasAccess(['access-admin']);
        });
    }
}
