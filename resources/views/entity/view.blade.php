@extends('layouts.app')

@section('title')
    {{$entity->title}} Alternatives: {{count($alternatives)}}+ Similar {{$entity->parents->first()->title}} Apps for {{today()->format('Y')}} -
@endsection

@section ('og_tags')
    <meta property="og:title"
          content="{{count($alternatives)}}+ Best {{$entity->title}} Alternatives - {{config('app.name')}}"/>
    <meta property="og:description"
          content="A list of {{count($alternatives)}} {{$entity->title}}+ alternatives. Including @foreach($alternatives->take(3) as $alternative){{$alternative->title}}, @endforeach ..."/>
    <meta property="og:image" content="{{$entity->image_1}}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:locale" content="en_US"/>
    <meta property="og:site_name" content="{{config('app.name')}}"/>

    <meta name="description"
          content="A list of {{count($alternatives)}} {{$entity->title}} alternatives. Including @foreach($alternatives->take(3) as $alternative){{$alternative->title}}, @endforeach ...">
@endsection

@section('ld+json')
    <script type="application/ld+json">
        {
        "@context": "https://schema.org",
         "@type": "Article",
         "headline": "{{count($alternatives)}}+ {{$entity->title}} Alternatives for {{today()->format('Y')}}",
         "alternativeHeadline": "{{$entity->title}} Alternatives",
         "image": "{{$entity->image_1}}",
         "author": "Alterlister",
         "editor": "Josh Miller",
         "keywords": "@foreach($entity->tags as $tag){{`$tag->title `}}@endforeach",
        "publisher": {
            "@type": "Organization",
            "name": "Alterlister"
          },
         "url": "{{\Route::current()->url}}",
           "mainEntityOfPage": {
            "@type": "WebPage",
            "@id": "https://google.com/article"
          },
         "description": "A list of {{count($alternatives)}} {{$entity->title}}
        alternatives. Including @foreach($alternatives->take(3) as $alternative){{$alternative->title}}, @endforeach ..."
         }

    </script>
@endsection

@section('main')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <div class="container flex-row d-flex">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                @if(isset($entity->parents->first()->parent))
                    <li class="breadcrumb-item"><a
                            href="{{route("cat", ["cat"=>$entity->parents->first()->parent->slug])}}">{{$entity->parents->first()->parent->title}}</a>
                    </li>
                @endif
                @foreach($entity->parents as $category)
                    <li class="breadcrumb-item"><a
                            href="{{route("cat", ["cat"=>$category->slug])}}">{{$category->title}}</a>
                    </li>
                @endforeach

            </div>
        </ol>
    </nav>
    <div class="container">
        <div class="row mt-4">
            <article>
                <header class="mb-2">
                    <div class="card card-body">
                        <div class="row">
                            <div class="col-lg-1 text-center my-auto">
                                <img src="{{$entity->logo}}" alt="{{"$entity->title logo"}}"
                                     title="{{"$entity->title logo"}}"
                                     class="img-fluid me-2" loading="lazy" width="86"></div>
                            <div class="col-lg-8 my-auto">
                                <h1 class=""><a href="{{$entity->link_1}}"
                                                title="{{$entity->title}}">{{$entity->title}}</a></h1>
                                <span class="badge bg-light mb-2">{{$entity->events()->count()}} views</span>
                                @foreach($entity->parents as $category)
                                    <span class="badge bg-light mb-2">{{$category->title}}</span>
                                @endforeach
                                <br>
                                <strong>Description</strong>
                                <p>
                                    <span id="entity-short-desc">{!!Str::words($entity->long_description, "40", "...")!!} <a
                                            href="#"
                                            onclick="$('#entity-long-desc').toggle(); $('#entity-short-desc').toggle()">Read more</a></span>
                                    <span id="entity-long-desc" style="display: none;">{!! $entity->long_description !!} <a
                                            href="#"
                                            onclick="$('#entity-long-desc').toggle(); $('#entity-short-desc').toggle()">Read less</a></span>
                                </p>
                                <strong>Links</strong>
                                <br>
                                <a href="{{$entity->link_1}}" class="btn btn-primary">Goto Homepage</a>
                            </div>
                            <div class="col-md-3 d-flex flex-column align-middle">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="{{Auth::check() ? "#reviewModal" : "#modalRegister"}}">
                                    Post a review
                                </button>
                            </div>
                        </div>
                    </div>
                </header>
                <div class="row">
                    <main class="col-lg-8 py-3">
                        @include('entity.alternatives')
                        @include('entity.reviews')
                    </main>
                    <aside class="col-lg-4 py-3">
                        <div class="card">
                            <div class="card-body">
                                <h2>Table of Contents</h2>
                                <div class="list-group list-group-flush">
                                    <a class="list-group-item list-group-item-action"
                                       href="#alternatives">Alternatives</a>
                                    <a class="list-group-item list-group-item-action" href="#reviews">Reviews</a>
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
            </article>
        </div>

    </div>
@endsection
