<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\models\User;
use App\models\Menu;
use App\libraries\treeviewdata;
use Illuminate\Support\Facades\Auth;

class ComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
       // dd(Auth::guard());
        // Using class based composers...
        View::composer('admin.navbar',
            'App\Http\ViewComposers\UserComposer'
        );
    }

    // public function compose(View $view)
    // {
    //       //$role = Auth::User()->role;

    //     // dd(Auth::User());
    //     $menu = new Menu();
    //     $resutListModul = $menu->module(1);

    //     //dd($resutListModul);

    //     $arrLstTemp = array();
    //     foreach ($resutListModul as $objModule) {

    //         if (!isset($arrLstTemp[$objModule->parentid])) {
    //             $arrLstTemp[$objModule->parentid] = array();
    //         }

    //         array_push($arrLstTemp[$objModule->parentid], $objModule);
    //     }

    //     $treeviewdata = new treeviewdata();
    //     $lastmodule = $treeviewdata->ArrangeModuleTreeData(0, $arrLstTemp);
    //     //dd($lastmodule);
    //     //$data['lstModule'] = $lastmodule;
    //     view()->share('lstModule', $lastmodule);

    // }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
