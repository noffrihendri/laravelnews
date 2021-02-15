<?php

namespace App\libraries;

use Illuminate\Http\Request;

class treeviewdata
{
    public function ArrangeModuleTreeData($intParent, $arrRawData)
    {
        $arrResult = array();

        //Generate Menu
        if (isset($arrRawData[$intParent])) {
            $lstData = $arrRawData[$intParent];

            foreach ($lstData as $objData) {
                $arrModule = array();
                $arrModule["ModuleId"]         = $objData->menu_id;
                $arrModule["ModuleName"]     = $objData->title;
                $arrModule["PermaLink"]     = $objData->link;
                $arrModule["Child"]         = $this->ArrangeModuleTreeData($objData->menu_id, $arrRawData);

                array_push($arrResult, $arrModule);
            }
        }

        return $arrResult;
    }

    public function fShowModuleTree($lstModule, $strStatus, $onClick, $arrAkses = array())
    {
        // echo "<pre>"; print_r($lstModule); echo "</pre>";
        // echo "<pre>";
        // print_r($arrAkses);
        // echo "</pre>"; 
        // die();
        if (count($lstModule) > 0) {
            echo "<ul>";
            foreach ($lstModule as $objModule) {
                $strChecked = "";
                $strEvent = "";

                if (count($arrAkses) > 0) {
                  
                    if (in_array($objModule["ModuleId"], $arrAkses)) {
                        $strChecked = "Checked";
                     //   echo "masuk";
                    }
                }

                if ($onClick != "") {
                    $strEvent = "onclick=\"" . $onClick . "('" . $objModule["ModuleId"] . "');\" ";
                }

                if (Count($objModule["Child"]) > 0) {
                    echo "<li class=\"" . $strStatus . "\" id=\"" . $objModule["ModuleId"] . "\"><input name=\"chkModule[]\" " . $strChecked . " " . $strEvent . " value=\"" . $objModule["ModuleId"] . "\" type=\"checkbox\"><span> " . $objModule["ModuleName"] . "</span>";
                    $this->fShowModuleTree($objModule["Child"], $strStatus, $onClick, $arrAkses);
                } else {
                    echo "<li class=\"" . $strStatus . "\" id=\"" . $objModule["ModuleId"] . "\"><input name=\"chkModule[]\" " . $strChecked . " " . $strEvent . " value=\"" . $objModule["ModuleId"] . "\" type=\"checkbox\"><span> " . $objModule["ModuleName"] . "</span>";
                }
            }
            echo "</ul>";
        }
    }
}
