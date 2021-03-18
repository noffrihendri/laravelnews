<?php

namespace App\Http\Controllers;

use App\libraries\treeviewdata;
use App\model\Menu;
use App\model\Menu_role;
use App\model\Muser_role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use UserRole;

class Module extends Controller
{
    public function index(){

        $menus = new Menu();

        $mrole = new Menu_role();
        $resutListModul = $menus->module(Auth::user()->role);

        //$resutListModul = $menus->asObject()->findAll();

        // dd($resutListModul);

        $arrLstTemp = array();
        foreach ($resutListModul as $objModule) {

            if (!isset($arrLstTemp[$objModule->parentid])) {
                $arrLstTemp[$objModule->parentid] = array();
            }

            array_push($arrLstTemp[$objModule->parentid], $objModule);
        }

        $treeviewdata = new Treeviewdata();
        $lastmodule = $treeviewdata->ArrangeModuleTreeData(0, $arrLstTemp);


        $arrData['lstModule'] = $lastmodule;
        $arrData['arrAkses'] = array();
        $arrWhere = array();
        $arrData['data'] = Menu_role::all();
 
    //    dd($arrData);
        return view('admin/vmodule', $arrData);
    }


    public function listGroup()
    {

        $arrWhere = array();
        $arrOrder = array();
        $where = "";
        $arrField = array("role_name");

        //Value From Datatables
        $intDraw = (int)$_GET['draw'];
        $strTableSearch = $_GET['search']["value"];
        $strStart = $_GET['start'];
        $arrTableOrder = $_GET['order'];

        //Condition
        $arrWhere = array();

        //Order
        if ($intDraw == 1) {
            $arrOrder["created_at"] = "Desc";
        } else {
            foreach ($arrTableOrder as $arrTemp) {
                $strField = $arrField[(int)$arrTemp['column']];
                $arrOrder[$strField] = $arrTemp['dir'];
            }
        }

        // echo var_dump($strField); die();
        //Limit & offset
        // $intLimit = 10;
        $intLimit = $_GET['length'];
        $intOffset = $strStart;
        //  echo "<pre>"; print_r($arrWhere); echo "</pre>";
        // echo "<pre>"; print_r($intOffset); echo "</pre>";
   

        $iTotal = Muser_role::count();
        $intRows = Muser_role::where($arrWhere)
                       ->count();


        $arrData = Muser_role::where($arrWhere)->get();
        //dd($arrData);
        $arrValue = array();
        $arrAll = array();

        $iFilteredTotal = $intRows;
        foreach ($arrData as $objNews) {
            $arrValue = array();


            foreach ($arrField as $strValue) {

                array_push($arrValue, $objNews[$strValue]);
            }

            //Button
            $strButton = "<i class='fa fa-pencil' aria-hidden='true'><a href=" . url('editgroup/' . $objNews['role_id']) . " >edit</a></i>";
            $strButton .=
                "<i class='fa fa-trash' aria-hidden='true'><a href=" . url('delgroup/' . $objNews['role_id']) . " onclick=\"return confirm('Anda ingin menghapus data tersebut?')\">del</a></i>";
            $strButton .= "";
            array_push($arrValue, $strButton);

            array_push($arrAll, $arrValue);
        }

        $output = array(
            "iTotalRecords" => $iTotal,
            "iTotalDisplayRecords" => $iFilteredTotal,
            "aaData" => $arrAll
        );

        echo json_encode($output);
        die();
    }


    public function editgroup(Request $request)
    {
        $id = $request->id;
      //  dd($id);
        //$id = $this->request->getGet('id');

        $GroupId = $id;
        $arrData = array(
            "role_id" => "",
            "role_name" => ""
        );

        // $mrole = new Muserrole();

        // $objGroup = $mrole->get()->getResult();

        $objGroup = Muser_role::all();
        

        $arrData['group'] = $objGroup;

        $arrOrder["role_id"] = "DESC";

        // $arrData['data'] =
        // $mrole->where('role_id', $id)
        //     ->get()->getResult();

 
        $arrData['data'] = Muser_role::where('role_id',$id)->get()->toArray();



        if (count($arrData['data']) > 0) {
            foreach ($arrData['data'] as $arrGroup) {
  
                if ($arrGroup['role_id'] == $GroupId) {
                  
                    foreach ($arrGroup as $strField => $strValue) {
                   
                        $arrData[$strField] = $strValue;
                    }
                }
            }
        }

        $arrAkses = array();
        // dd($GroupId);
        $arrwhere = array('id_role' => $GroupId);
        $arrLstAksesModule = Menu_role::where($arrwhere)->get();
        //->getCompiledSelect();


        foreach ($arrLstAksesModule as $objAksesModule) {
            array_push($arrAkses, $objAksesModule->id_menu);
        }

        $menus = new Menu();

        $resutListModul = $menus->module(Auth::user()->role);

       // dd($resutListModul);

        $arrLstTemp = array();

        foreach ($resutListModul as $objModule) {

            if (!isset($arrLstTemp[$objModule->parentid])) {
                $arrLstTemp[$objModule->parentid] = array();
            }

            array_push($arrLstTemp[$objModule->parentid], $objModule);
        }

        $treeviewdata = new Treeviewdata();
        $lastmodule = $treeviewdata->ArrangeModuleTreeData(0, $arrLstTemp);


        $arrData['lstModule'] = $lastmodule;
        $arrData['arrAkses'] = $arrAkses;

        $arrData['GroupId'] = $GroupId;
        $arrData['Module'] = Menu::all();

        //dd($arrData);
        return view('admin/vmodule', $arrData);
    }

    public function savegroup(Request $request)
    {

        //dd($request);

        $strGroupName = $request->txtGroupName;
        $strGroupID = $request->txtGroupId;
        $arrModuleAkses = $request->chkModule;
        $arrWhere = array("GroupId" => $strGroupID);
        $arrGroup = array('GroupName' => $strGroupName);

        $strMessage = "";
        if ($strGroupID != "") {

            $arrWhere = array("role_id" => $strGroupID);
            $arrGroup = array(
                'role_name' => $strGroupName,
                'updated_by' => Auth::user()->name,
                'updated_at' => date("Y-m-d H:i:s")
        
        );

            Muser_role::where($arrWhere)
                    ->update($arrGroup);

         //   $this->mroles->update($arrWhere, $arrGroup);

            if (count($arrModuleAkses) > 0) {

                $deletedRows = Menu_role::where('id_role', $strGroupID)->delete();
              
                foreach ($arrModuleAkses as $value) {
                    $data = array(
                        'id_role' => $strGroupID,
                        'id_menu' => $value,
                        
                        'created_by' => Auth::user()->name,
                        'updated_by' => Auth::user()->name
                    );

                    Menu_role::create($data);
                }

                $strMessage = "Data has been edit";
            }
        } else {
            $data = array(
                'role_name' => $strGroupName,
                'is_active' => 1,
                'created_by' => Auth::user()->name,
                'updated_by' => Auth::user()->name
            );
            $menu = Muser_role::create($data);
            $id = $menu->role_id;
            //dd($id);

            foreach ($arrModuleAkses as $value) {
                $data = array(
                    'id_role' => $id,
                    'id_menu' => $value,
                    'created_by' => Auth::user()->name,
                    'updated_by' => Auth::user()->name,
                );

                Menu_role::create($data);
            }
            $strMessage = "Data has been add";
        }

        echo '<script>
			alert("' . $strMessage . '");
			location = "' . url('listmenu') . '";
		</script>';
    }


    public function destroy($id){

        $menu = Muser_role::find($id);
        $menu->delete();


        $role = Menu_role::where('id_role',$id);
        $role->delete();

        $strMessage = "Data has been deleted";

        echo '<script>
			alert("' . $strMessage . '");
			location = "' . url('listmenu') . '";
		</script>';
    }

}
