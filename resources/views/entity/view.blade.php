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
            "image": "{{$entity->image_1}}",
            "datePublished": "{{$entity->created_at->tz('UTC')->toAtomString()}}",
            "dateModified" : "{{$entity->updated_at->tz('UTC')->toAtomString()}}",
            "headline": "{{$entity->title}} Alternatives: {{count($alternatives)}}+ {{$entity->parent->title}}
        for {{date("Y")}}",
            "alternativeHeadline": "{{$entity->title}} Alternatives",
                "author": {
                "@type": "Person",
                "name": "{{$entity->user->name}}",
                "url": "https://alterlister.com"
            },
            "editor": "Josh Miller",
            "keywords": "@foreach($entity->tags as $tag){{`$tag->title, `}}@endforeach",
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
    <main class="container">
        <article class="row col-md-8">
            <h1 class="" itemprop="name">{{$entity->title}} alternatives</h1>
            <strong class="mb-3">
                We have {{$alternatives->count()}} alternatives to {{$entity->title}}. The
                best {{$entity->title}} alternatives
                are @foreach($entity->alternatives()->take(3) as $alternative)
                    {{$loop->index === 2 ? "and " : ""}}<a
                        href="{{$alternative->link_1}}">{{$alternative->title}}</a>{{$loop->index === 2 ? "." : ","}}
                @endforeach
            </strong>
            <p>
                {!! nl2br(e($entity->description)) !!}
            </p>

            <table class="table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Platforms</th>
                </tr>
                </thead>
                <tbody>
                @foreach($entity->alternatives() as $alternative)
                    <tr>
                        <td><a href="{{$alternative->link_1}}">{{$alternative->title}}</a></td>
                        <td>@foreach($alternative->platforms as $platform){{$platform->title}}{{$loop->index === $alternative->platforms->count() - 1 ? "." : ", "}}@endforeach</td>

                    </tr>
                    @endforeach
                </tbody>
            </table>

            @include('entity.alternatives')
{{--            @include('entity.reviews')--}}

        </article>
    </main>
@endsection

