<?php

namespace App\Http\Controllers;

use App\libraries\converter;
use App\model\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['menu'] = Menu::where('parentid',0)->get();
        //dd($data);
        return view('admin.vmenu',$data);
    }


    public function listdata(){

        //echo "<pre>"; print_r("halo"); echo "</pre>";

        $arrWhere = array();
        $arrOrder = array();
        $where = "";
        $arrField = array("title", "link","icon","parent");

        //Value From Datatables
        $intDraw = (int)$_GET['draw'];
        $strTableSearch = $_GET['search']["value"];
        $strStart = $_GET['start'];
        $arrTableOrder = $_GET['order'];



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

        $iTotal = Menu::all();

        // $arrData = DB::table("menu")
        //     ->select(
        //         "menu.*",
        //         DB::raw("(SELECT title FROM menu as submenus
        //                         WHERE submenus.menu_id = menu.parentid) as parent")
        //     )
        //     ->offset($intOffset)
        //     ->limit($intLimit)
        //     ->orderBy('parentid', 'ASC')
        //     ->get()->toArray();

        $arrData = DB::select("select *,COALESCE((SELECT title FROM auth_menu as submenus
                                 WHERE submenus.menu_id = auth_menu.parentid),'PARENT') as parent from auth_menu order by parentid asc");

        //dd($arrData);
        // $arrData = Menu::where($arrWhere)
        //     ->offset($intOffset)
        //     ->limit($intLimit)
        //     ->orderBy('parentid', 'ASC')
        //     ->get()->toArray();

        $intRows = Menu::where($arrWhere)
            ->count();


        $arrValue = array();
        $arrAll = array();

        $convert = new converter();


        $iFilteredTotal = $intRows;
        foreach ($arrData as $objNews) {
            $arrValue = array();
            //    echo "<pre> 1"; print_r($objNews); echo "</pre>";
            $arrNews = $convert->objectToArray($objNews);

            foreach ($arrField as $strValue) {
              
       
                        array_push($arrValue, $arrNews[$strValue]);
             
            }

            //Button
            $strButton = "<a href=" . url('editmodule/' . $objNews->menu_id) . "><button class='btn btn-info' ><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button></a>";
            $strButton .= "<a href=" . url('delmodule/' . $objNews->menu_id) . " onclick='return confirm(`Are you suru to delete?`)'><button class='btn btn-danger'><i class='fa fa-trash' aria-hidden='true'></i></button></a>";
            array_push($arrValue, $strButton);

            array_push($arrAll, $arrValue);
        }

        $output = array(
            "iTotalRecords" => $iTotal,
            "iTotalDisplayRecords" => $iFilteredTotal,
            "aaData" => $arrAll
        );

        return response()->json($output);

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

        if($request->menu_id !== null){
            $brand = Menu::where('menu_id', $request->menu_id)
                ->update([
                'title' => $request->title,
                'link' => ($request->link == null) ? '' : $request->link,
                'icon' => ($request->icon == null) ? '' : $request->icon,
                'parentid' => ($request->parent=='parent') ? 0 : $request->parent,
                'updated_by' => Auth::user()->name,
                'updated_at' => now(),
                ]);
             return back()->with('success', 'updated successfully!');
        }else{

            $arrdata = [
                'title' => $request->title,
                'link'=> ($request->link==null) ? '' : $request->link,
                'icon' => ($request->icon==null) ? '' : $request->icon,
                'parentid' => ($request->parent=='parent') ? 0 : $request->parent,
                'created_by' => Auth::user()->name,
                'updated_by' => ''
            ];
    
            Menu::create($arrdata);
            return back()->with('success', 'created successfully!');
        }
       // dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['menu'] = Menu::where('parentid', 0)->get();
        $data['data'] = Menu::find($id);
        return view('admin.vmenu', $data);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Menu::find($id);
        $user->delete();
        return back()->with('success', 'deleted successfully!');
    }
}
