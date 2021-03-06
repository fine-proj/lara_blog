<?php

namespace Corp\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Corp\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        //'Corp\Model' => 'Corp\Policies\ModelPolicy',
        'Corp\Article' => 'Corp\Policies\ArticlePolicy',
        'Corp\Permission' => 'Corp\Policies\PermissionPolicy',
        'Corp\Menu' => 'Corp\Policies\MenusPolicy',
        'Corp\User' => 'Corp\Policies\UsersPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies();

        $gate->define('VIEW_ADMIN', function (User $user){

           return $user->canDo('VIEW_ADMIN');
        });

        $gate->define('VIEW_ADMIN_ARTICLES', function (User $user){

            return $user->canDo('VIEW_ADMIN_ARTICLES');
        });

        $gate->define('EDIT_USERS', function (User $user){

            return $user->canDo('EDIT_USERS');
        });

        $gate->define('VIEW_ADMIN_MENU', function (User $user){

            return $user->canDo('VIEW_ADMIN_MENU');
        });

        $gate->define('EDIT_USERS', function (User $user){

            return $user->canDo('EDIT_USERS');
        });
    }
}
