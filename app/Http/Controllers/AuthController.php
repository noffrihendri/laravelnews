<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input; //untuk input::get
use Illuminate\Support\Facades\Auth;

use Redirect; //untuk redirect

use App\models\User;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function login(){
        // echo "halo"; die();
        return view('login');
    }

    public function loginPost(Request $request){

        $email = $request->email;
        $password = $request->password;

       // dd($request);
        $data = User::where('email',$email)->first();
       // dd($data);
        if($data){ //apakah email tersebut ada atau tidak
                ///cek auththentifikasi dan setting juga guard berdasarkan rolenya
                $auth =  Auth::guard($data->role)->attempt(['email' => $email, 'password' => $password]);
                //dump($this->middleware('auth'));
                //echo "login post";
                dd($auth);
            if($auth){
                 return redirect('dashboard');
             }else{
                 return redirect('loginadmin')->with('alert','Password atau Email, Salah !');
             }

        }else{
            return redirect('loginadmin')->with('alert','Password atau Email, Salah!');
        }
    }

    public function home_user_admin(){
        return view('header');
    }

    public function logout(){
        Auth::logout();
        Session::flush();
        return redirect('/login')->with('alert','Kamu sudah logout');
    }

    public function register(Request $request){
        return view('register');
    }

    public function registerPost(Request $request){


      //  dd($request);
        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|min:4|email|unique:users',
            'password' => 'required',
            'confirmation' => 'required|same:password',
        ]);

        $data =  new User();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->email_verified_at = date("Y-m-d h:i:s");
        $data->password = bcrypt($request->password);
        $data->role = "user";
        $data->image= "";
        $data->created_by = "user";
        $data->created_at = date("Y-m-d h:i:s");
        $data->updated_at = date("Y-m-d h:i:s");

        $data->save();
        return redirect('/loginadmin')->with('alert-success','Kamu berhasil Register');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //


    }

    /**
     * Display the specified resource.
     *
     * @param  \app\models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \app\models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \app\models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \app\models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
