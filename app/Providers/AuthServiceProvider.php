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
        Gate::define('admin', function ($user){
            return $user->isRole('ADMIN');
        });
        Gate::define('student', function ($user){
            return $user->isRole('STUDENT');
        });
        Gate::define('teacher', function ($user){
            return $user->isRole('TEACHER');
        });
        Gate::define('permission', function ($user, $permission){
            return $user->hasPermission($permission);
        });
    }
}
