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
    <nav aria-label="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
        <ol class="breadcrumb">
            <div class="container flex-row d-flex">
                <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <a href="/" itemprop="item"><span itemprop="name">Home</span></a>
                    <meta itemprop="position" content="1"/>
                </li>
                @if(isset($category->parent))
                    <li class="breadcrumb-item" itemprop="itemListElement" itemscope
                        itemtype="https://schema.org/ListItem">
                        <a
                            itemprop="item"
                            href="{{route("cat", ["cat"=>$category->parent->slug])}}"
                        ><span itemprop="name">{{$category->parent->title}}</span></a>
                        <meta itemprop="position" content="2"/>
                    </li>
                    <li class="breadcrumb-item" itemprop="itemListElement" itemscope
                        itemtype="https://schema.org/ListItem">
                        <a
                            itemprop="item"
                            href="{{route("cat", ["cat"=>$category->slug])}}"
                        ><span itemprop="name">{{$category->title}}</span></a>
                        <meta itemprop="position" content="3"/>
                    </li>
                @elseif(isset($category))
                    <li class="breadcrumb-item" itemprop="itemListElement" itemscope
                        itemtype="https://schema.org/ListItem">
                        <a
                            itemprop="item"
                            href="{{route("cat", ["cat"=>$category->slug])}}"
                            itemprop="itemListElement"><span itemprop="name">{{$category->title}}</span></a>
                        <meta itemprop="position" content="2"/>
                    </li>
                @endif
            </div>
        </ol>
    </nav>

    <div class="container mt-4">
        <h1 itemprop="name">{{$category->title ?? ""}}</h1>

        {{--                <table class="table table-borderless">--}}
        {{--                    @foreach($popular_entities as $alternative)--}}
        {{--                        @include('includes.list-media-entity', ['alternative'=>$alternative])--}}
        {{--                    @endforeach--}}
        {{--                </table>--}}
        <p class="lead">{{$category->description }}</p>
        <div class="row">
            <h2>Popular</h2>
            @foreach($popular_entities as $alternative)
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                    @include('includes.list-media-category', ['alternative'=>$alternative])
                </div>
            @endforeach
        </div>
    </div>

    @if($category->children->count() > 0)
        <div class="container">
            <h2>More in {{$category->title}}</h2>
            <div class="row">
                @foreach($category->children as $child)
                        <div class="col-md-4">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h3 class="fw-bold h5"><a class="text-primary text-decoration-none"
                                                              href="{{route('cat', ["cat"=>$child->slug])}}">{{$child->title}}</a>
                                    </h3>
                                    <p>{{$child->entities->count()}} ranked apps and software.</p>
                                    <strong>Popular in this category</strong>
                                    <ul>
                                        @foreach($child->entities->take(3) as $entity)
                                            <li><a href="{{route('ent',["ent"=>$entity->slug])}}">{{$entity->title}}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                @endforeach
            </div>
        </div>
    @endif
@endsection



