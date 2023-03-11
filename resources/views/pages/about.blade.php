@extends('layouts.app')
@section("title")
    About
@endsection
@section("og_tags")
    <meta property="og:title"
          content="About - Similar Software"/>
    <meta property="og:description"
          content="All about Similar Software."/>
@endsection
@section('main')
    <div class="container mt-3">
        <div class="card" itemscope itemtype="https://schema.org/AboutPage">
            <div class="card-body" >
                <h1 itemprop="name" itemprop="headline">About <span itemprop="about">Similar Software</span></h1>
                <p itemprop="text">Similar Software is focussed on listing alternatives to popular software and apps.</p>
            </div>
        </div>
    </div>
@endsection
