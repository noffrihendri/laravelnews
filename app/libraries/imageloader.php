<?php

namespace App\libraries;

use App\Menu;
use App\Submenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\model\User;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Constraint\FileExists;
use Validator;

class imageloader
{



    public function uploadimage(Request $request, $strImagePath)
    {
        

        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024'
        ]);
        $arrresponse = [];
        $file = $request->file('image');
        if(!$validator->fails()){
            // isi dengan nama folder tempat kemana file diupload
            $strImagePath = 'assets/image/temp' . $strImagePath;
            $strFilePath = './' . $strImagePath;

            $imgpath = '/' . $strImagePath;

            if (!is_dir($strFilePath)) {
                mkdir($strFilePath, 0777, true);
            }
            $tujuan_upload = 'public/image';

            $pathimg = $imgpath . "/" . $file->getClientOriginalName();
            //dump($path);
            $file->move($strFilePath, $file->getClientOriginalName());

           
            $path = public_path($pathimg);
            $isExists = file_exists($path);
            if ($isExists) {
                $arrresponse = [
                    'valid' => true,
                    'message' => 'success upload',
                    'filename' => $file->getClientOriginalName(),
                    'path' => $pathimg
                ];
            } else {
                $arrresponse = [
                    'valid' => false,
                    'message' => 'failed upload'
                ];
            }
        }else{
            $arrresponse = [
                'valid' => false,
                'message' => $validator->errors()->first()
            ];
        }        

        return $arrresponse;
        
        
    }


    public function fCheckImage($url){
        $path = public_path($url);
        
        $isExists = file_exists($path);
        if($isExists){
            return url($url);
        }else{
            return url('image/noimage.jpg');
        }
      //  dd($isExists);
    }
}
