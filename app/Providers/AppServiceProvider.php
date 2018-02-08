<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
//use Illuminate\Validation\Validator;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //自定义身份证验证(18位可带X)
        Validator::extend('identitycards',function ($attribute,$value,$parameters)
        {
            return preg_match('/^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}([0-9]|X)$/',$value);
        });

        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
