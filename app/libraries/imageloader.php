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


class imageloader
{



    public function saveimg(Request $request, $strImagePath)
    {

		$request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $file = $request->file('image');

        // isi dengan nama folder tempat kemana file diupload
        $strImagePath = 'assets/image/' . $strImagePath;
        $strFilePath = './' . $strImagePath;

        $imgpath = '/' . $strImagePath;

        if (!is_dir($strFilePath)) {
            mkdir($strFilePath, 0777, true);
        }
		$tujuan_upload = 'public/image';
        
                // upload file
        $path = $imgpath."/".$file->getClientOriginalName();
        //dump($path);
        $file->move($strFilePath,$file->getClientOriginalName());
        
        return $path;
        
        
    }
}
