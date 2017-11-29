<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
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
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);
        //判断是否是对应角色
        Gate::define('ADMIN', function ($user){
            return $user->isRole('admin');
        });
        Gate::define('STUDENT', function ($user){
            return $user->isRole('student');
        });
        Gate::define('TEACHER', function ($user){
            return $user->isRole('teacher');
        });
        Gate::define('permission', function ($user, $permission){
            return $user->hasPermission($permission);
        });
    }
}
