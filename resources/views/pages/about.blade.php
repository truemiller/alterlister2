@extends('layouts.app')
@section("title")
    About
@endsection
@section("og_tags")
    <meta property="og:title"
          content="About - Alterlister"/>
    <meta property="og:description"
          content="All about Alterlister."/>
@endsection
@section('main')
    <div class="container mt-3">
        <div class="card" itemscope itemtype="https://schema.org/AboutPage">
            <div class="card-body" >
                <h1 itemprop="name" itemprop="headline">About <span itemprop="about">Alterlister</span></h1>
                <p itemprop="text">Alterlister is focussed on listing alternatives to popular media, software, apps.</p>
            </div>
        </div>
    </div>
@endsection
