<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WrtCamera extends Controller
{
    public function index(){
        return view('testing.wrtcamera');
    }


    public function uploadimg(Request $request){

        $img = $request->json('img');



        $img = str_replace('data:image/png;base64,', '', $img);
        //dd($img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $img = 'ktp-'.date("y-m-d")."-".uniqid() . '.png';
        $strImagePath = "ktp-image";

        // Generate Pathing untuk Picture
        $strImagePath = 'assets/images/' . $strImagePath;
        $strFilePath = './' . $strImagePath;

        if (!is_dir($strFilePath)) {
            mkdir($strFilePath, 0777, true);
        }
        $strFilePath = $strFilePath . "/" . $img;

        $success = file_put_contents($strFilePath, $data);

        $image = str_replace('./', '', $strFilePath);


        
        $arrresult = array( );
        if($success){
              $arrresult = array(
            'valid' => true,
            'message' => 'berhasil'
        );
        }else{
            $arrresult = array(
                'valid' => false,
                'message' => 'gagal'
            );
        }

        return response()->json($arrresult);

    }
}
