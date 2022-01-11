<?php
use App\libraries\imageloader;

    $imageloader = new imageloader();

    //dd($imageloader->getimage('test'));
?>

<style>
    .card-img-top {
        width: auto;
        max-height: 160px;
    }

    .card-title {

        font-size: calc(1vw + 2px);
    }

    .card-body {
        font-size: 14px;
    }

    .container {
        font-family: 'Montserrat';
    }
</style>

@extends('home._header')
@extends('home._navbar')

@section('content')



<div class="container">
    <section class="page-section" id="">

        <div class="row">
            <div class="col-sm-3 col-xs-12 mb-2">

                <div class="list-group">
                    <h3 href="#" class="list-group-item list-group-item-action disabled" style="border-bottom: double;">
                        Category
                    </h3>

                    @foreach ($newscategory as $category )
                    <a href="{{ url('news/category/'.$category->category) }}" class="list-group-item list-group-item-action">{{$category->category}}</a>
                    @endforeach



                </div>

            </div>

            <div class="col-sm-9 col-xs-12 mb-2">
                <div class="row">
                    @foreach ($news as $item)
                    <div class="col-sm-4 col-xs-12 mb-2">
                        <div class="card" style="width: auto; height:100%;">
                            <div class="text-center">
                                <img class="card-img-top" src="{{$imageloader->fCheckImage($item->news_img)}}"
                                    alt="Card image cap" style="" class="align-text-center">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{$item->news_title}}</h5>
                                <p>Publish : {{ date('d-M-Y',strtotime($item->created_at))}}</p>
                                <p class="card-text">{{ substr($item->news_synopsys,0,200) }}</p>

                            </div>
                            <div class="card-footer">
                                <a href="{{ url('news/detail/'.$item->news_slug)}}" class="btn btn-primary">read
                                    more</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $news->links() }}
                </div>

            </div>





        </div>


    </section>
</div>

@endsection