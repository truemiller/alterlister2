@extends('layouts.app')

@section('title')
    {{$category->title}}{{$category->parent ? " ".$category->parent->title:''}}
@endsection

@section ('og_tags')
    <meta property="og:title"
          content="{{$category->title}}{{$category->parent ? " ".$category->parent->title." -":''}} Similar Software"/>
    <meta property="og:description"
          content="Listing the best similar software to things."/>
    <meta property="og:image" content=""/>
    <meta property="og:type" content="website"/>
    <meta property="og:locale" content="en_US"/>
    <meta property="og:site_name" content="{{config('app.name')}}"/>

    <meta property="description"
          content="{{config('app.name')}} creates lists of similar software. Finding the best alternative is only a click, a search, or a link away.">
@endsection

@section ('ld+json')
    <script type="application/ld+json">

    </script>
@endsection

@section('main')
    <div class="container mt-4">
        <section class="row">
            <div class="col">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="row">
                            @foreach($popular_entities as $alternative)
                                @include('includes.list-media-category', ['alternative'=>$alternative])
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection



