<?php

namespace App\Http\Controllers;

use App\libraries\imageloader;
use App\models\Menu;
use App\models\Muser_role;
use App\models\User;
use Carbon\Traits\Timestamp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
Use App\libraries\libraries;



class Usercontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
      //  dd(session('login'));
       // dump(session());
    //dd($this->middleware('auth'));
       


    }

    public function index()
    {
        //return $this->themeadmin();
        //$data['user'] = User::all();

        $data['user']  = DB::table('users')
            ->select('*', DB::raw("(Select role_name from auth_user_role where auth_user_role.role_id=users.role) as role_name"))
            ->get();
       // echo "<pre>"; print_r($users); echo "</pre>";die();
        // dd($data);
        return view('admin.vwuser',$data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['role'] = Muser_role::all();
                 
       // dd($data);
        return view('admin.adduser',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->file('image')){
            $imageloader = new imageloader();
            $imgpath = "profil";
            $pathimage = $imageloader->uploadimage($request, $imgpath);

        }
        //dd($request);

        //dd($pathimage);

        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'password_confirmation' => 'required_with:password|same:password|min:6'
        ]);



        // save into table
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'email_verified_at' => date("Y-m-d h:i:s"),
            'image' => isset($pathimage) ? $pathimage :'',
            'role' => $request->role,
            'created_by' => Auth::user()->name
        ]);

        return back()->with('success','user created successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['user'] = User::find($id);

        $data['role'] = Muser_role::all();
        //dd($data);
        return view('admin.adduser',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'password_confirmation' => 'required_with:password|same:password|min:6'
        ]);

        if($request->file('image')){
                $imageloader = new imageloader();
                $imgpath = "profil";
                $pathimage = $imageloader->uploadimage($request, $imgpath);
                if ($pathimage['valid']) {
                    $pathimg = $pathimage['path'];
                }
        }
 

        

        $user = User::find($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        if($request->file('image')){
            $user->image = $pathimg;
        }
        
        $user->role = $request->role;
        $user->updated_at = date("Y-m-d h:i:s");

        $user->save();

        return back()->with('success','user updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return back()->with('success','user deleted successfully!');
    }
}
