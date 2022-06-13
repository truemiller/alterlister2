@extends('layouts.app')

@section('title')
    {{--    The {{count($alternatives)}} Best {{$entity->title}} Alternatives--}}
    {{count($alternatives)}} {{$entity->title}} Alternatives for {{today()->format('Y')}} -
@endsection

@section ('og_tags')
    <meta property="og:title"
          content="{{count($alternatives)}} Best {{$entity->title}} Alternatives - {{config('app.name')}}"/>
    <meta property="og:description" content="Find the best alternatives to {{ $entity->title }}.
        More than {{count($alternatives)}} alternatives like {{$entity->title}}. Including {{$alternatives->first()->title ?? 'N/A'}} and more ... "/>
    <meta property="og:image" content="{{$entity->image_1}}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:locale" content="en_US"/>
    <meta property="og:site_name" content="{{config('app.name')}}"/>

    <meta name="description" content="Here are {{count($alternatives)}} alternatives to {{$entity->title}}!">
@endsection

@section ('ld+json')
    <script type="application/ld+json">
            {
              "@context": "http://schema.org",
              "@type": "ItemList",
              "numberOfItems": {{count($alternatives)}},
              "name": "{{count($alternatives)}} {{$entity->title}} Alternatives for {{today()->format('Y')}} ",

              "itemListElement": [
                @foreach($alternatives as $alternative)
            {
                "@type": "ListItem",
                "position": {{$loop->index + 1}},
                        "name": "{{$alternative->title}}",
                        "url": "{{ route('ent',['ent'=>$alternative->slug]) }}",
                        "image": "{{$alternative->logo}}",

                    }
                    @if((count($alternatives) > $loop->index + 1))
                ,
@endif
        @endforeach
        ]
}


    </script>
@endsection

@section('main')
    <div class="container">
        <div class="row mt-3">
            <div class="col-md-8 col-lg-8">
                <div class="d-flex">
                    <div class="flex-column">
                        <h1>
                            <span class="font-weight-bolder align-items-center">
                            <img src="{{$entity->logo}}" alt="" width="50px"> {{$entity->title}}</span>
                        </h1>

                        <p>{{$entity->long_description . (substr($entity->long_description,-1) != "." ? "." : "")}}</p>
                        <ul class="small">
                            @if($publisher = $entity->publisher()->first())
                                <li><strong>Publisher</strong>: <a
                                        href="{{$publisher->link_1}}">{{ $publisher->title }}</a></li>
                            @endif
                            <li><strong>Updated</strong>: {{$entity->updated_at->format('d M Y')}}</li>
                            <li><strong>Links</strong>: <a href="{{$entity->link_1}}">Download {{$entity->title}}</a>
                            </li>
                        </ul>
                        {{-- Entitiy screenshot--}}
                        @if($entity->image_1)
                            <figure class="figure bg-white rounded p-3">
                                <img src="{{$entity->image_1}}" class="figure-img img-fluid rounded mx-auto"
                                     alt="{{$entity->title}}">
                                {{--                                    <figcaption class="figure-caption text-right">A screenshot of {{$entity->title}}--}}
                                {{--                                        .--}}
                                {{--                                    </figcaption>--}}
                            </figure>
                        @endif
                        <p>In this article, we'll cover <strong>{{count($alternatives)}} alternatives
                                to {{$entity->title}}</strong>, including applications
                            like {{$alternatives->first()->title}}.</p>
                        {{-- Table of contents--}}
                        <div class="flex-row">
                            <h2>{{$entity->title}} Alternatives</h2>
                            <ol class="bg-light px-5 p-3">
                                @foreach($alternatives as $alternative)
                                    <li><a href="#{{$alternative->slug}}">{{$alternative->title}}</a></li>
                                @endforeach
                            </ol>
                        </div>
                        {{-- Alternative loop --}}
                        @foreach($alternatives as $alternative)
                            <div id="{{$alternative->slug}}" class="my-3">
                                <h3>{{$loop->index+1}}. <a href="{{route('ent', ['ent'=>$alternative->slug])}}"
                                                           rel="external"
                                                           class="text-decoration-none">{{$alternative->title}}</a></h3>
                                <p>{{$alternative->long_description}}</p>
                                @if($alternative->image_1)
                                    <figure class="figure bg-white rounded p-3">
                                        <img src="{{$alternative->image_1}}"
                                             class="figure-img img-fluid rounded mx-auto"
                                             alt="An image of {{$alternative->title}}, an alternative to {{$entity->title}}."
                                             title="An image of {{$alternative->title}}, an alternative to {{$entity->title}}.">
                                        {{--                                    <figcaption class="figure-caption text-right">A screenshot--}}
                                        {{--                                        of {{$alternative->title}}.--}}
                                        {{--                                    </figcaption>--}}
                                    </figure>
                                @endif

                                <ul>
                                    <li>
                                        <strong> Avaliable on: </strong>
                                        @if(count($alternative->platforms)==1)

                                            {{ $alternative->platforms->first()->title . "." }}
                                        @elseif(count($alternative->platforms)==2)
                                            @foreach($alternative->platforms as $platform)
                                                {{ $loop->index < count($alternative->platforms)-1 ? $platform->title . " and" : $platform->title . "." }}
                                            @endforeach
                                        @else
                                            @foreach($alternative->platforms as $platform)
                                                {{ $loop->index < count($alternative->platforms)-1 ? $platform->title . "," : " and ".$platform->title . "." }}
                                            @endforeach
                                        @endif
                                    </li>
                                    <li>
                                        <strong>Links: </strong> <a
                                            href="{{$alternative->link_1}}">Download {{$alternative->title}}</a>
                                    </li>
                                </ul>
                            </div>
                        @endforeach

                    </div>

                </div>


            </div>
        </div>
    </div>
@endsection

