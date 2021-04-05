<?php

namespace App\Http\Controllers;

use App\libraries\treeviewdata;
use Facade\FlareClient\View;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\models\User;
use App\models\Menu;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;




    public function themeadmin(){

       $role = Auth::User()->role;

       // dd(Auth::User());
        $menu = new Menu();
        $resutListModul = $menu->module($role);

        $arrLstTemp = array();
        foreach ($resutListModul as $objModule) {

            if (!isset($arrLstTemp[$objModule->parentid])) {
                $arrLstTemp[$objModule->parentid] = array();
            }

            array_push($arrLstTemp[$objModule->parentid], $objModule);
        }

        $treeviewdata = new treeviewdata();
        $lastmodule = $treeviewdata->ArrangeModuleTreeData(0, $arrLstTemp);
        $data = array(
                'username' => Auth::User()->name,
                'email' => Auth::User()->email,
                'role' => Auth::User()->role,
            );

        $data['lstModule'] = $lastmodule;

      //  dd($data);

        //dump("navbar");
       // return view('admin.themeadmin');
        return view('admin.navbar',$data);
    }

}
