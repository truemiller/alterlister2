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
            <article class="bg-white shadow-sm">
                <header class="row p-3 border-bottom">
                    <div class="col-lg-1 text-center my-auto">
                        <img src="{{$entity->logo}}" alt="{{"$entity->title logo"}}"
                             title="{{"$entity->title logo"}}"
                             class="img-fluid me-2" loading="lazy" width="86"></div>
                    <div class="col-lg-11 my-auto">
                        <h1 class="">Top {{$entity->alternatives()->count()}} <a href="{{$entity->link_1}}" title="{{$entity->title}}">{{$entity->title}}</a>
                            alternatives</h1>
{{--                        <span class="badge bg-light mb-2">{{$entity->events()->count()}} views</span>--}}
                        <p>
                            If you're looking for <strong>alternatives to {{$entity->title}}</strong>, you're in the right
                            place. We've compiled a list of the best {{$entity->title}} alternatives for you.
                            @if($entity->alternatives()->count() > 2)Including: @foreach($entity->alternatives()->take(2) as $alternative){{$alternative->title}}
                            , @endforeach and {{$entity->alternatives()[2]->title}}.
                            @endif
                        </p>
                    </div>
                </header>
                <div class="row">
                    <main class="col-lg-8 py-3">

                        @foreach($alternatives as $alternative)

                            <section class="row py-3" id="{{$alternative->slug}}">
                                <div class=col-lg-11">
                                    <h2 class="fw-bolder">
                                        <img src="{{$alternative->logo}}" alt="{{$alternative->title}} logo" title="{{$alternative->title}} logo"
                                             class="img-fluid mb-3" loading="lazy" style="height: 1em">
                                        {{$loop->index+1}}. <a
                                            href="{{$alternative->link_1}}"
                                            rel="external"
                                            class=" text-primary"
                                            title="{{$alternative->title}}">{{$alternative->title}}</a>
                                    </h2>
                                    <ul>
                                        <li>Platforms: @foreach($alternative->platforms as $platform)<span class="badge bg-light me-1">{{$platform->title}}</span>@endforeach</li>
                                        <li>Features: @foreach($alternative->tags as $tag)<span class="badge bg-light text-capitalize me-1">{{$tag->tag}}</span>@endforeach</li>
                                    </ul>


                                    <img src="{{$alternative->image_1}}" alt="An image of {{$alternative->title}}" title="An image of {{$alternative->title}}"
                                         class="img-fluid mb-3"  loading="lazy">

                                    <p>{!! $alternative->long_description !!}</p>

                                    <em class="">
                                        <a
                                            href="{{route("ent", ["ent"=>$alternative->slug])}}"
                                            rel="external"
                                            class="text-decoration-none text-primary"
                                            title="{{$alternative->title}} alternatives">{{$alternative->title}} alternatives</a>
                                    </em>
                                </div>
                                @if($alternative->image_1)
                                    <div class="col-lg-4 my-auto">
                                    </div>
                                @endif
                            </section>

                        @endforeach
                    </main>
                    <aside class="col-lg-4 py-3 bg-light">
                        <strong class="">{{$entity->title}} alternatives</strong>
                        <ol class="">
                            @foreach($entity->alternatives() as $alternative)
                                <li><a href="#{{$alternative->slug}}">{{$alternative->title}}</a></li>
                            @endforeach
                        </ol>
                    </aside>
                </div>
            </article>
        </div>
    </div>
@endsection

