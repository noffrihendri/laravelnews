<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\libraries\treeviewdata;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\models\User;
use App\models\Menu;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

use Illuminate\Support\Facades\Schema;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
            'admin.navbar','App\Http\ViewComposers\UserComposer'
        );
        Schema::defaultStringLength(191);
       
    }
}
