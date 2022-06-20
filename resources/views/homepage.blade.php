@extends('layouts.app')

@section('title')
@endsection

@section ('og_tags')
    <meta property="og:title"
          content="AlterLister"/>
    <meta property="og:description"
          content="Listing the best alternatives to things."/>
    <meta property="og:image" content=""/>
    <meta property="og:type" content="website"/>
    <meta property="og:locale" content="en_US"/>
    <meta property="og:site_name" content="{{config('app.name')}} "/>
    <meta property="description"
          content="{{config('app.name')}} aggregates lists of popular alternatives. You want a change, you're sure to find it here.">
@endsection

@section('main')
    <div class="container">
        <div class="row py-4 mt-5">
            <div class="col">
                <div class="d-flex flex-column justify-content-center text-center">
                    <h1 class="mb-0 " style="">
                        AlterLister
                    </h1>
                    <p class="h4">We find the best alternatives for you.</p>

                    <form action="{{route('search')}}" method="get">
                        <input id="search" class="typeahead form-control mr-sm-1 flex-grow-1" type="text"
                               placeholder="Input software name" aria-label="Search" name="query">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <section class="row">
            <div class="col">
                <h2>Popular</h2>
                <div class="row">
                    @foreach($popular_entities as $alternative)
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                            @include('includes.list-media-category', ['alternative'=>$alternative])
                        </div>
                    @endforeach
                </div>
                <h2>Latest</h2>
                <div class="row">
                    @foreach($latest_entities as $alternative)
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                            @include('includes.list-media-category', ['alternative'=>$alternative])
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection

