<?php

namespace App\Http\Controllers;

use App\Mbrand;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use libraries\converter\converter;

class brandcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('product.vbrand');

    }

    public function listdata()
    {

               //echo "<pre>"; print_r("halo"); echo "</pre>";

                $arrWhere = array();
                $arrOrder = array();
                $where ="";
                $arrField = array("brand_name","created_at");

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

                $iTotal = Mbrand::all();
                $arrData = Mbrand::where($arrWhere)
                                ->offset($intOffset)
                                ->limit($intLimit)
                                ->orderBy('created_at','DESC')
                                ->get()->toArray();

                $intRows = Mbrand::where($arrWhere)
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
                      switch ($strValue) {
                        case "created_at":
                            array_push($arrValue, date("d-M-Y h:i",strtotime($objNews['created_at'])));
                        break;
                        default:
                        array_push($arrValue, $arrNews[$strValue]);
                    }

                    }

                    //Button
                    $strButton = "<button class='btn btn-info' onclick='editbrand(`".$objNews['id_brand']."`)' ><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button>";
                    $strButton .= "<a href=".url('deletebrand/'.$objNews['id_brand'])."><button class='btn btn-danger'><i class='fa fa-trash' aria-hidden='true'></i></button></a>";
                    array_push($arrValue, $strButton);

                    array_push($arrAll, $arrValue);
                }

                $output = array(
                    "iTotalRecords" => $iTotal,
                    "iTotalDisplayRecords" => $iFilteredTotal,
                    "aaData" => $arrAll
                );

             echo json_encode($output);

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
        $validatedData = $request->validate([
            'brand' => 'required',
        ]);

        if($request->id == null){
            // save into table
            $user = Mbrand::create([
                'brand_name' => $request->brand,
                'created_by' => Auth::user()->name,
                'updated_by' => '',
            ]);
            return response()->json(['valid' => 'true', 'message' => 'Brand berhasil ditambahkan']);
        }else{

            $brand = Mbrand::where('id_brand',$request->id)
                        ->update([
                        'brand_name' => $request->brand,
                        'updated_by' => Auth::user()->name,
                        'updated_at' => now(),
                        ]);

            return response()->json(['valid' => 'true', 'message' => 'Brand berhasil diupdate']);

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $id = $request->id;

        $brand = Mbrand::where('id_brand',$id)
        ->first();
        return response()->json(['valid' => 'true', 'message' => $brand]);

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

        $user = Mbrand::where('id_brand',$id);
        $user->delete();
        return back()->with('success','brand deleted successfully!');
    }
}
