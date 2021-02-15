<?php

namespace App\Http\ViewComposers;

use App\libraries\treeviewdata;
use App\model\Menu;
use Illuminate\View\View;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;



class UserComposer
{
    public function compose(View $view)
    {

        $currentURL = \Request::path();

        //dd($currentURL);

      //  dd(Auth::user());
        $menu = new Menu();
        $resutListModul = $menu->module(Auth::user()->role);

        //dd($resutListModul);

        $arrLstTemp = array();
        foreach ($resutListModul as $objModule) {

            if (!isset($arrLstTemp[$objModule->parentid])) {
                $arrLstTemp[$objModule->parentid] = array();
            }

            array_push($arrLstTemp[$objModule->parentid], $objModule);
        }

        $treeviewdata = new treeviewdata();
        $lastmodule = $treeviewdata->ArrangeModuleTreeData(0, $arrLstTemp);
        //dd($lastmodule);
        //$data['lstModule'] = $lastmodule;
        //view()->share('lstModule', $lastmodule);
        $view->with('isactive', $currentURL);
        $view->with('lstModule', $lastmodule);
    }

    // public function compose(View $view)
    // {

    //     //dd("coba");
    //     $view->with('lstModule', 'nuge');
    // }
}
