<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Submenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\model\User;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       //$this->middleware('auth');

      
       //echo "test";
      //  return view('admin.themeadmin');
       // View::make('admin.themeadmin');
       //$this->coba();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      // dd("halo");
      //  return $this->themeadmin();
        //$this->themeadmin();
      // return $this->coba();
        return view('admin.navbar');
        //return view('admin.themeadmin');
    }


    public function coba()
    {

        return view('layouts.vue');
    }
}
