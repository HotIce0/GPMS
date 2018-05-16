<?php

namespace App\Providers;

use App\Repository\ThesisRepo;
use Illuminate\Support\ServiceProvider;


class ThesisServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind('ThesisLogic',function (){
            return new ThesisRepo();
        });
    }
}
