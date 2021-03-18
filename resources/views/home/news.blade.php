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

            @foreach ($news as $item)
            <div class="col-sm-4 col-xs-12 mb-2">
                <div class="card" style="width: auto; height:100%;">
                    <div class="text-center">
                        <img class="card-img-top" src="{{$imageloader->fCheckImage($item->news_img)}}"
                            alt="Card image cap" style="width: auto; max-height:300px;" class="align-text-center">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{$item->news_title}}</h5>
                        <p>Publish : {{ date('d-M-Y',strtotime($item->created_at))}}</p>
                        <p class="card-text">{{$item->news_synopsys}}</p>

                    </div>
                    <div class="card-footer">
                        <a href="{{ url('news/detail/'.$item->news_slug)}}" class="btn btn-primary">read more</a>
                    </div>
                </div>
            </div>
            @endforeach



        </div>


    </section>
</div>

@endsection