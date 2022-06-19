@extends('layouts.app')

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
