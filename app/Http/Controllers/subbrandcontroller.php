<?php

namespace App\Http\Controllers;

use App\Mbrand;
use App\Msubbrand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use libraries\converter\converter;

class subbrandcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['brand'] = Mbrand::all();
        return view('product.subbrand',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }


    public function listsubbrand(){

           //echo "<pre>"; print_r("halo"); echo "</pre>";

           $arrWhere = array();
           $arrOrder = array();
           $where ="";
           $arrField = array("brand_name","subsbrand_name","created_at");

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

           $iTotal = Msubbrand::all();
        //    $arrData = Msubbrand::where($arrWhere)
        //                    ->offset($intOffset)
        //                    ->limit($intLimit)
        //                    ->orderBy('created_at','DESC')
        //                    ->get()->toArray();

            $arrData = DB::table("produk_subsbrand")
                ->select("produk_subsbrand.*",
                        DB::raw("(SELECT brand_name FROM produk_brand
                                WHERE produk_brand.id_brand = produk_subsbrand.id_brand) as brand_name"))
                ->offset($intOffset)
                ->limit($intLimit)
                ->orderBy('created_at','DESC')
                ->get();

           $intRows = Msubbrand::where($arrWhere)
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
                            array_push($arrValue, date("d-M-Y h:i",strtotime($objNews->created_at)));
                        break;
                        
                   default:
                   array_push($arrValue, $arrNews[$strValue]);
               }

               }

               //Button
               $strButton = "<button class='btn btn-info' onclick='editbrand(`".$objNews->id_subsbrand."`)' ><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button>";
               $strButton .= "<a href=".url('deletesubbrand/'.$objNews->id_subsbrand)."><button class='btn btn-danger'><i class='fa fa-trash' aria-hidden='true'></i></button></a>";
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // dd($request);
        $validatedData = $request->validate([
            'brand' => 'required',
            'subbrand' => 'required'
        ]);

        if($request->id == null){
            // save into table
            $brand = Msubbrand::create([
                'id_brand' => $request->brand,
                'subsbrand_name' => $request->subbrand,
                'created_by' => Auth::user()->name,
                'updated_by' => '',
            ]);
            return response()->json(['valid' => 'true', 'message' => 'SubBrand berhasil ditambahkan']);
        }else{

            $brand = Msubbrand::where('id_subsbrand',$request->id)
                        ->update([
                        'id_brand' => $request->brand,
                        'subsbrand_name' => $request->subbrand,
                        'updated_by' => Auth::user()->name,
                        'updated_at' => now(),
                        ]);

            return response()->json(['valid' => 'true', 'message' => 'SubBrand berhasil diupdate']);

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

        $arrData = DB::table("produk_subsbrand")
                    ->select("produk_subsbrand.*",
                            DB::raw("(SELECT brand_name FROM produk_brand
                                    WHERE produk_brand.id_brand = produk_subsbrand.id_brand) as brand_name"))
                    ->where("id_subsbrand",$id)
                    ->first();
        return response()->json(['valid' => 'true', 'message' => $arrData]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $data = Msubbrand::where('id_subsbrand',$id);
        $data->delete();
        return back()->with('success','sub brand deleted successfully!');
    }
}
