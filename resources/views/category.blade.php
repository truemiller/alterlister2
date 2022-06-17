@extends('layouts.app')

@section('title')
    {{$category->title}}{{$category->parent ? " ".$category->parent->title:''}} -
@endsection

@section ('og_tags')
    <meta property="og:title"
          content="{{$category->title}}{{$category->parent ? " ".$category->parent->title." -":''}} AlterLister"/>
    <meta property="og:description"
          content="Listing the best alternatives to things."/>
    <meta property="og:image" content=""/>
    <meta property="og:type" content="website"/>
    <meta property="og:locale" content="en_US"/>
    <meta property="og:site_name" content="{{config('app.name')}}"/>

    <meta property="description"
          content="{{config('app.name')}} creates lists of alternatives to different things. Finding the best alternative is only a click, a search, or a link away.">
@endsection

@section('main')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <div class="container flex-row d-flex">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                @if(isset($category->parent))
                    <li class="breadcrumb-item"><a
                            href="{{route("cat", ["cat"=>$category->parent->slug])}}">{{$category->parent->title}}</a>
                    </li>
                @endif
                <li class="breadcrumb-item">
                    <a href="{{route("cat", ["cat"=>$category->slug])}}">{{$category->title}}</a>
            </div>
        </ol>
    </nav>

    <div class="container mt-4">
        <section class="row">
            <h1 itemprop="name">{{$category->title ?? ""}}</h1>

            {{--                <table class="table table-borderless">--}}
            {{--                    @foreach($popular_entities as $alternative)--}}
            {{--                        @include('includes.list-media-entity', ['alternative'=>$alternative])--}}
            {{--                    @endforeach--}}
            {{--                </table>--}}
            <p class="lead">{{$category->description }}</p>
            <div class="col">
                <div class="row">
                    @foreach($popular_entities as $alternative)
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                            @include('includes.list-media-category', ['alternative'=>$alternative])
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection



