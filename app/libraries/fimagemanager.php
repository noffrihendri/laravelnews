<?php

namespace App\libraries;

use Illuminate\Http\Request;

use App\libraries\converter;

class Fimagemanager
{
    public function getimagenamager($key = '', $typeModule = 'news', $paramid = '', $arrDataImage = array())
    {

        $converter = new converter();


        $arrTypeModule  = array(
            'news' => array('path' => 'style/images/news/content/', 'controler' => 'news'),
        );

        $path = $arrTypeModule[$typeModule]['path'];

        $arrData['dropkey'] = $key;
        $imgupload = array();
        $imgdb       = array();

        if ($paramid != '') {

            //$objPhotoItem = $this->MBeritaimage->getListBeritaImage(array(), array('berita_id'=>$beritaId));
            $objPhotoItem = $arrDataImage;
            $strNewPath = './' . $path . $paramid . "/imagecontent/";
            if (empty($objPhotoItem)) {

                if (is_dir($strNewPath)) {
                    $files = scandir($strNewPath);
                    if (false !== $files) {
                        foreach ($files as $file) {
                            if ('.' != $file && '..' != $file) {
                                $objPhotoItem[]  = $converter->arraytoobject(array('photoname' => $file));
                            }
                        }
                    }
                }
            }

            if (Count($objPhotoItem) > 0) {
                $strItemId = $paramid;
                foreach ($objPhotoItem as $objPhoto) {
                    if (file_exists($strNewPath . $objPhoto->photoname)) {
                        $imgName =  $objPhoto->photoname;
                        if (strlen($imgName) > 20) {
                            $t = strlen($imgName) - 20;
                            $imgName =  substr($imgName, 0, strlen($imgName) - 10 - $t) . '..' . substr($imgName, -8);
                        }
                        $imgdb[] = array(
                            'path' => $path . $paramid . "/imagecontent/" . $objPhoto->photoname,
                            'fullpath' => url() . $path . $paramid . "/imagecontent/" . $objPhoto->photoname,
                            'name' => $imgName
                        );
                    }
                }
            }
        }


        if (is_dir('./' . $path . 'Temp/' . $key . '/imagecontent/')) {
            $files = scandir('./' . $path . 'Temp/' . $key . '/imagecontent/');
            if (false !== $files) {
                foreach ($files as $file) {
                    if ('.' != $file && '..' != $file) {
                        $imgName =  str_replace($key, '', $file);
                        if (strlen($imgName) > 20) {
                            $t = strlen($imgName) - 20;
                            $imgName =  substr($imgName, 0, strlen($imgName) - 10 - $t) . '..' . substr($imgName, -8);
                        }
                        $imgupload[] = array(
                            'path' => $path . 'Temp/' . $key . '/imagecontent/' . $file,
                            'fullpath' => url() . $path . 'Temp/' . $key . '/imagecontent/' . $file,
                            'name' => $imgName
                        );
                    }
                }
            }
        }

        $arrData['imgdb']     = $imgdb;
        $arrData['imgupload'] = $imgupload;
        $arrData['controler'] = $arrTypeModule[$typeModule]['controler'];


        // echo "<pre>";
        // print_r($arrData);
        // echo "</pre>";
        // die();
        return view('admin.news.imagemanager', $arrData);
    }

}