<?php

namespace App\Http\Controllers\Vue;

use App\Http\Controllers\Controller;
use App\models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class Authvue extends Controller
{
    function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Headers:Origin, X-Requested-With, Content-Type, Accept');
    }

    public function login(Request $request){
        $email = $request->json('email');
        $password = $request->json('password');
        //echo "halo";
       // echo "<pre>"; print_r(bcrypt($password)); echo "</pre>"; ;
        $arrresult =[];
        $data = User::where('email', $email)->first();


        //echo "<pre>"; print_r($data); echo "</pre>"; die();

        if($data){
            if (Auth::attempt(['email' => $email, 'password' => $password])) {

                 $arrresult = [
                    'valid' => true,
                    'message' => "berhasil login",
                    'data' => $data
                ];
            }else{
                $arrresult = [
                    'valid' => false,
                    'message' => "password anda salah"
                ];
            }
        }else{
            $arrresult =[
                'valid' => false,
                'message' => "alamat email tidak terdaftar"
            ];
        }
     
        return response()->json($arrresult);
    }
}
