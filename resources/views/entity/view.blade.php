@extends('layouts.app')

@section('title')
    {{$entity->title}} Alternatives: {{count($alternatives)}}+ {{$entity->parent->title}} for {{date("Y")}}
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
         "headline": "{{$entity->title}} Alternatives: {{count($alternatives)}}+ {{$entity->parent->title}}
        for {{date("Y")}}",
         "alternativeHeadline": "{{$entity->title}} Alternatives",
         "author": {
            "@type": "Person",
            "name": "{{$entity->user->name}}",
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
    <nav aria-label="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
        <ol class="breadcrumb">
            <div class="container flex-row d-flex">
                <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <a href="/" itemprop="item"><span itemprop="name">Home</span></a>
                    <meta itemprop="position" content="1"/>
                </li>
                @if(isset($entity->parent->parent))
                    <li class="breadcrumb-item" itemprop="itemListElement" itemscope
                        itemtype="https://schema.org/ListItem">
                        <a
                            itemprop="item"
                            href="{{route("cat", ["cat"=>$entity->parent->parent->slug])}}"
                        ><span itemprop="name">{{$entity->parent->parent->title}}</span></a>
                        <meta itemprop="position" content="2"/>
                    </li>
                    <li class="breadcrumb-item" itemprop="itemListElement" itemscope
                        itemtype="https://schema.org/ListItem">
                        <a
                            itemprop="item"
                            href="{{route("cat", ["cat"=>$entity->parent->slug])}}"
                        ><span itemprop="name">{{$entity->parent->title}}</span></a>
                        <meta itemprop="position" content="3"/>
                    </li>
                @elseif(isset($entity->parent))
                    <li class="breadcrumb-item" itemprop="itemListElement" itemscope
                        itemtype="https://schema.org/ListItem">
                        <a
                            itemprop="item"
                            href="{{route("cat", ["cat"=>$entity->parent->slug])}}"
                            itemprop="itemListElement"><span itemprop="name">{{$entity->parent->title}}</span></a>
                        <meta itemprop="position" content="2"/>
                    </li>
                @endif
            </div>
        </ol>
    </nav>
    <div class="container" itemscope itemtype="https://schema.org/Product">
        <div class="row mt-4">
            <article>
                <header class="mb-2">
                    <div class="card card-body">
                        <div class="row">
                            <div class="col text-center my-auto">
                                <img src="{{$entity->logo}}" alt="{{"$entity->title logo"}}"
                                     title="{{"$entity->title logo"}}"
                                     class="img-fluid me-2" loading="lazy" width="100" height="100" itemprop="logo">
                            </div>
                            <div class="col-lg-8 my-auto">
                                <span class="badge bg-light">{{$entity->getViews()}} views</span><br>
                                <h1 class="" itemprop="name">{{$entity->title}}</h1>
                                @for($i=1; $i<=$entity->reviews->avg("stars"); $i++ )
                                    <i class="fa fa-star text-warning"></i>
                                @endfor
                                <br>
                                <span class="badge bg-light mb-2"
                                      itemprop="category">{{$entity?->parent?->title}}</span>
                                <br>
                                <strong>Description</strong>
                                <div>
                                    <div id="entity-short-desc" itemprop="disambiguatingDescription">
                                        {{ Str::words($entity->description, "100", "...") }}
                                    </div>
                                    <a href="#" id="read-more"
                                       onclick="$('#entity-short-desc,#read-more').hide();$('#entity-long-desc,#read-less').show();">Read
                                        more</a>
                                    <div id="entity-long-desc" style="display: none" itemprop="description">
                                        {!! nl2br(e($entity->description)) !!}
                                    </div>
                                    <a href="#" id="read-less" style="display: none"
                                       onclick="$('#entity-long-desc,#read-less').hide();$('#entity-short-desc,#read-more').show();">Read
                                        less</a>
                                </div>
                                <br>
                                <strong>Platforms</strong><br>
                                @foreach($entity->platforms as $platform)<span
                                    class="badge bg-light me-1">{{$platform->title}}</span>@endforeach
                                <br><br>
                                <strong>Tags</strong><br>
                                @foreach($entity->tags as $tag)
                                    <span class="badge bg-light me-1" itemprop="keywords">{{$tag->tag}}</span>
                                @endforeach
                                <br><br>
                                <strong>Links</strong>
                                <br>
                                <a href="{{$entity->link_1}}" class="btn btn-danger mb-3">Goto Homepage</a>
                            </div>
                            <div class="col-md-3 d-flex flex-column align-middle">
                                <img src="{{$entity->image_1}}" alt="Screenshot of {{$entity->title}}."
                                     title="Screenshot of {{$entity->title}}" class="mb-3" itemprop="image">
                                <button type="button" class="btn btn-primary mt-auto" data-bs-toggle="modal"
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
                                <ul class="">
                                    <li>
                                        <a class=""
                                           href="#alternatives">Alternatives</a></li>
                                    <ol class=" ">
                                        @foreach($alternatives as $alternative)
                                            <li>
                                                <a href="#{{$alternative->slug}}"
                                                   class="">{{$alternative->title}}</a>
                                            </li>
                                        @endforeach
                                    </ol>
                                    <li><a class="" href="#reviews">Reviews</a></li>
                                </ul>
                            </div>
                        </div>
                    </aside>
                </div>
            </article>
        </div>

    </div>
@endsection

