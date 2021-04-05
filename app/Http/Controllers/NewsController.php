<?php

namespace App\Http\Controllers;

use App\libraries\converter;
use App\libraries\Fimagemanager;
use App\libraries\imageloader;
use App\models\Mnews;
use App\models\MnewsCategory;
use App\models\Mtagnews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
        $data['newscategory'] = MnewsCategory::all();
        //dd($data);

        return view('admin.news.addnews',$data);
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


    public function imagemanager($key = "", $paramId = "")
    {

       // dd('coba');
        $fimagemanager = new Fimagemanager();
        return $fimagemanager->getimagenamager($key, 'news', $paramId, array());
    }

    public function uploadimage(Request $request){

 
        $response = [];
        if ($request->file('image')) {
            $imageloader = new imageloader();
            $imgpath = "news";
            $pathimage = $imageloader->uploadimage($request, $imgpath);

          //  dd('off');
            if ($pathimage['valid']) {
                $pathimg = $pathimage['path'];
                $response = [
                    'valid' => true,
                    'filename'=> $pathimage['filename'],
                    'path' => url($pathimage['path']),
                    'message' => 'berhasil'
                ];
            }else{
                $response = [
                    'valid' => false,
                    'message' => $pathimage['message']
                ];
            }
        }else{
            $response = [
                'valid' => false,
                'message' => 'file tidak ada'
            ];
        }
        echo json_encode($response); die();
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        //dump($request);
        $pathimg="NULL";

        $arrtag = explode(";",$request->tagit);

        if ($request->file('image')) {
            $imageloader = new imageloader();
            $imgpath = "news";
            $pathimage = $imageloader->uploadimage($request, $imgpath);
            if ($pathimage['valid']) {
                $pathimg = $pathimage['path'];
            }
            
        }
        

     //  dd($arrtag);
        if($request->news_id == null){
            
            
        
                $arrdata = [
                    'news_title' => $request->title,
                    'news_description'=> '',
                    'news_slug'=> Str::slug($request->title),
                    'news_category_id' => $request->news_category,
                    'news_synopsys' => $request->synopsys,
                    'news_content' => $request->news_content,
                    'news_level' => $request->news_level,
                    'news_metatitle' => $request->meta_title,
                    'news_metadescription' => !empty($request->news_metadescription) ? $request->news_metadescription :'',
                    'news_status' => $request->news_type,
                    'created_by' => Auth::User()->name,
                    'updated_by' =>'',
                    'news_img' => $pathimg,
                    'is_active' => $request->status
                ];
                // dump($request);
                // dd($arrdata);
                $news = Mnews::create($arrdata);
                $idnews = $news->news_id;

               // dd($idnews);
                foreach($arrtag as $tag){
                    if($tag !==''){
                    Mtagnews::create([
                        'news_id' => $idnews,
                        'tag' => $tag,
                        'created_by' => Auth::User()->name,
                        'updated_by' => ''
                    ]);
                    }
                }
             
                return back()->with('success', 'created successfully!');
        }else{
            
                $arrdata = [
                    'news_title' => $request->title,
                    'news_description'=> '',
                    'news_slug'=> Str::slug($request->title),
                    'news_synopsys' => $request->synopsys,
                    'news_content' => $request->news_content,
                'news_category_id' => $request->news_category,
                    'news_level' => $request->news_level,
                    'news_metatitle' => $request->meta_title,
                    'news_metadescription' => !empty($request->news_metadescription) ? $request->news_metadescription :'',
                    'news_status' => $request->news_type,
                    'updated_by' => Auth::User()->name,
                    'news_img' => $pathimg,
                    'is_active' => $request->status
                ];

                Mnews::where('news_id',$request->news_id)
                ->update($arrdata);

                $Mtagnews = Mtagnews::where('news_id', $request->news_id);
                $Mtagnews->delete();

                    foreach ($arrtag as $tag) {
                        if ($tag !== '') {
                            Mtagnews::create([
                                'news_id' => $request->news_id,
                                'tag' => $tag,
                                'created_by' => Auth::User()->name,
                                'updated_by' => ''
                            ]);
                        }
                    }

                return back()->with('success', 'updated successfully!');
        }

    }

    public function listnews(){
        return view('admin.news.vnews');
    }

    public function tagit()
    {
        $arrTag = array();
        $lstag = Mtagnews::all();

        foreach ($lstag as $objTag) {
            array_push($arrTag, $objTag->tag);
        }

        echo "availableTags = " . json_encode($arrTag);
        die();
    }

    public function newsdata()
    {
        
        $imageloader = new imageloader();
        $arrWhere = array();
        $arrOrder = array();
        $where = "";
        $arrField = array("news_title", "news_synopsys", "news_img", "created_at");

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

        $iTotal = Mnews::all();

 
  
        //dd($arrData);
        $arrData = Mnews::where($arrWhere)
            ->offset($intOffset)
            ->limit($intLimit)
            ->orderBy('news_id', 'desc')
            ->get()->toArray();

        $intRows = Mnews::where($arrWhere)
            ->count();

        // echo "<pre> 1"; print_r($arrData); echo "</pre>"; die();
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
                    case "news_img":
                        array_push($arrValue, "<img width='100' height='100' src='" .$imageloader->fCheckImage($objNews['news_img'])."'>");
                        break;
                    default:

                         array_push($arrValue, $arrNews[$strValue]);
                    }
            }

            //Button
            $strButton = "<a href=" . url('editnews/' . $objNews['news_id']) . "><button class='btn btn-info' ><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button></a>";
            $strButton .= "<a href=" . url('delnews/' . $objNews['news_id']) . " onclick='return confirm(`Are you suru to delete?`)'><button class='btn btn-danger'><i class='fa fa-trash' aria-hidden='true'></i></button></a>";
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['data'] = Mnews::find($id);
        $data['newscategory'] = MnewsCategory::all();
      //  dd($data);
        return view('admin.news.addnews',$data);
        //dd($data);
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
         $data = Mnews::where('news_id',$id);
        $data->delete();
        return back()->with('success','sub brand deleted successfully!');
    }
}
