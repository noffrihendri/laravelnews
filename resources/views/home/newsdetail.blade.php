<?php
use App\libraries\imageloader;

    $imageloader = new imageloader();

    //dd($imageloader->getimage('test'));
?>

@extends('home._header')
@extends('home._navbar')

@section('content')



<div class="container">
    <section class="page-section" id="">

        <div class="row">

            <div class="col-sm-3">
                <h3 for="">Latest news</h3>
                @foreach ($latest_news as $item)
                <div class="card">

                    <div class="card-body">
                        <div class="row" style="font-size:12px; font-weight: bold;">
                            <div class="col-4 col-md-12" style="padding-left: 0%">
                                <img class="card-img-top" src="{{ $imageloader->fCheckImage($item->news_img) }}"
                                    alt="Card image cap" style="width: auto; max-height:80px;" class="align-text-left">
                            </div>
                            <div class="col-8 col-md-0">
                                <label for="">{{ date("d-M-Y",strtotime($item->created_at))}}</label>
                                <br>
                                <a href="{{ url('news/detail/'.$item->news_slug) }}"
                                    style="color: black; ">{{ substr($item->news_title,0,50)."..."}}</a>

                            </div>
                        </div>

                    </div>
                </div>



                @endforeach

            </div>


            <div class="col-sm-9 col-xs-12 mb-2">

                <div class="text-center">
                    <img src="{{$imageloader->fCheckImage($news->news_img)}}" class="img-fluid" alt="Responsive image"
                        style="max-height: 1000px; width:auto;">
                </div>
                <h3 class="text-left">{{$news->news_title}}</h3>
                <h5 class="text-right">Publish : {{ date("d-M-Y",strtotime($news->created_at)) }}</h5>
                <p><?= $news->news_content ?></p>

            </div>



        </div>

        <div class="row mt-4">
            <div class="col-sm-3 co-xs-0">

            </div>
            <div class="col-sm-9 co-xs-12">
                <div class="row mb-2">
                    <label style="font-weight: bold; font-size:18px;">REKOMENDASI UNTUK KAMU:</label>
                </div>

                <div class="row">


                    @foreach ($rekomendasi as $item )
                    <div class="col-sm-4 col-xs-12 mb-2 ">
                        <div class="card" style="width: auto; height:100%;">
                            <div class="text-center">
                                <img class="card-img-top" src="{{$imageloader->fCheckImage($item->news_img)}}"
                                    alt="Card image cap" style="width: auto; max-height:250px;"
                                    class="align-text-center">
                            </div>
                            <div class="card-body">
                                <p>Publish : {{ date('d-M-Y',strtotime($item->created_at))}}</p>
                                <p class="card-text">{{ substr($item->news_title,0,50)."..."}}</p>

                            </div>
                            <div class="card-footer">
                                <a href="{{ url('news/detail/'.$item->news_slug)}}" class="btn btn-primary">read
                                    more</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>


            </div>
        </div>


    </section>
</div>

@endsection