<?php

namespace App\Http\Controllers;

use App\libraries\converter;
use App\models\Mnews;
use App\models\MnewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsCategory extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.news.newscategory');
    }

    public function listdata()
    {

        //echo "<pre>"; print_r("halo"); echo "</pre>";

        $arrWhere = array();
        $arrOrder = array();
        $where = "";
        $arrField = array("category", "created_by", "created_at");

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

        $iTotal = MnewsCategory::all();

        $arrData = MnewsCategory::where($arrWhere)
            ->offset($intOffset)
            ->limit($intLimit)
            ->orderBy('category_id', 'desc')
            ->get()->toArray();


        $intRows = MnewsCategory::where($arrWhere)
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
                        array_push($arrValue, date("d-M-Y h:i", strtotime($objNews['created_at'])));
                        break;
                    default:

                        array_push($arrValue, $arrNews[$strValue]);
                }
            }

            //Button
            $strButton = "<a href=" . url('editcategory/' . $objNews['category_id']) . "><button class='btn btn-info' ><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button></a>";
            $strButton .= "<a href=" . url('deletecategory/' . $objNews['category_id']) . " onclick='return confirm(`Are you suru to delete?`)'><button class='btn btn-danger'><i class='fa fa-trash' aria-hidden='true'></i></button></a>";
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
        MnewsCategory::create(['category'=>$request->category,'created_by' => Auth::user()->name]);
        return back()->with('success', 'created successfully!');
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
       // dd($id);
        $news = MnewsCategory::destroy($id);

        return back()->with('success', 'deleted successfully!');
    }
}
