@extends('layouts.app')

@section('title')
    {{count($alternatives)}}+ Best {{$entity->title}} Alternatives for {{date("Y")}} -
@endsection

@section ('og_tags')
    <meta property="og:title"
          content="{{count($alternatives)}}+ Best {{$entity->title}} Alternatives for {{date("Y")}} - {{config('app.name')}}"/>
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
         "image": "{{$entity->logo}}",
         "headline": "{{count($alternatives)}}+ Best {{$entity->title}} Alternatives for {{date("Y")}}",
         "alternativeHeadline": "{{$entity->title}} Alternatives",
         "author": {
            "@type": "Person",
            "name": "Alterlister",
            "url": "https://alterlister.com"
         },
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
                @if(isset($entity->parent->parent))
                    <li class="breadcrumb-item"><a
                            href="{{route("cat", ["cat"=>$entity->parent->parent->slug])}}">{{$entity->parent->parent->title}}</a>
                    </li>
                @endif
                @if(isset($entity->parent))
                    <li class="breadcrumb-item"><a
                            href="{{route("cat", ["cat"=>$entity->parent->slug])}}">{{$entity->parent->title}}</a>
                    </li>
                @endif
            </div>
        </ol>
    </nav>
    <div class="container">
        <div class="row mt-4">
            <article>
                <header class="mb-2">
                    <div class="card card-body">
                        <div class="row">
                            <div class="col text-center my-auto">
                                <img src="{{$entity->logo}}" alt="{{"$entity->title logo"}}"
                                     title="{{"$entity->title logo"}}"
                                     class="img-fluid me-2" loading="lazy" width="100" height="100"></div>
                            <div class="col-lg-8 my-auto">
                                <span class="badge bg-light">{{$entity->getViews()}} views</span><br>
                                <h1 class="">{{$entity->title}}</h1>

                                <span class="badge bg-light mb-2"><a
                                        href="{{ route('cat', ["cat"=>$entity->parent->id]) }}" class=" text-dark text-decoration-none">{{$entity->parent->title}}</a></span>
                                <br>
                                <strong>Description</strong>
                                <div>
                                    <div id="entity-short-desc">
                                        {{ Str::words($entity->description, "100", "...") }}
                                        <a href="#"
                                           onclick="$('#entity-long-desc').toggle(); $('#entity-short-desc').toggle()">Read
                                            more</a>
                                    </div>
                                    <div id="entity-long-desc" style="display: none">
                                        {!! nl2br(e($entity->description)) !!}
                                        <a href="#"
                                           onclick="$('#entity-long-desc').toggle(); $('#entity-short-desc').toggle()">Read
                                            less</a>
                                    </div>
                                </div>
                                <br>
                                <strong>Platforms</strong><br>
                                @foreach($entity->platforms as $platform)<span
                                    class="badge bg-light me-1">{{$platform->title}}</span>@endforeach
                                <br><br>
                                <strong>Tags</strong><br>
                                @foreach($entity->tags as $tag)
                                    <span class="badge bg-light me-1">{{$tag->tag}}</span>
                                @endforeach
                                <br><br>
                                <strong>Links</strong>
                                <br>
                                <a href="{{$entity->link_1}}" class="btn btn-primary">Goto Homepage</a>
                            </div>
                            <div class="col-md-3 d-flex flex-column align-middle">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="{{Auth::check() ? "#reviewModal" : "#modalRegister"}}">
                                    Post a review
                                </button>
                            </div>
                        </div>
                    </div>
                </header>
                <div class="row">
                    <main class="col-lg-8 py-3">
                        <section>
                            @include('entity.alternatives')
                        </section>
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

