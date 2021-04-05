<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\models\Mnews;
use App\models\MnewsCategory;
use App\models\Mtagnews;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Driver\Xdebug;

class Newspage extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $news = new Mnews();
        $data['news'] = $news->paginate(3);

        $data['newscategory'] = MnewsCategory::all();
        //dd($data);

        return view('home.news',$data);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        

        $news = new Mnews();

        $data['latest_news'] = $news->orderby('news_id','DESC')
                             ->limit(10)
                             ->get();

        $data['news'] = $news->where('news_slug',$id)
                ->first();

        $tagnews = new Mtagnews();
        $arrtag = $tagnews->where('news_id', $data['news']->news_id)
                 ->get();

        $arrtagnews =[];
        foreach ($arrtag as $key => $value) {
            array_push($arrtagnews,$value->tag);
        }
        $data['rekomendasi'] ='';
        if(count($arrtagnews)>0){
            $arrtagnews = implode("','", $arrtagnews);
            $data['rekomendasi'] = $news->news_recomendasi($arrtagnews);
        }
        return view('home.newsdetail',$data);
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
        //
    }
}
