@extends('layouts.app')

@section('main')
    <div class="container mt-3">
        <h1>Search results for: {{{$query}}}</h1>
        @if($ents->count() > 0)
            @foreach($ents as $ent)
                <div id="{{$ent->slug}}" class="d-flex flew-row border shadow-sm p-3 bg-white mb-2">
                    <div class="d-flex flex-column">
                        <img src="{{$ent->logo}}" alt="{{"$ent->title logo"}}"
                             title="{{"$ent->title logo"}}" width="48" class="me-3 img-thumbnail"/>
                    </div>
                    <div class="flex-column w-100">
                        <div class="d-flex flex-row justify-content-between">
                            <h3 class="fw-bolder">
                                <a
                                    href="{{route("ent", ["ent"=>$ent->slug])}}"
                                    rel="external"
                                    class="text-decoration-none text-primary"
                                    title="{{$ent->title}} alternatives">{{$ent->title}}</a>
                            </h3>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-lg-12 order-lg-first order-md-last">
                                <ul>
                                    <li>
                                        <strong>Price</strong>: {!! $ent->price == 0.00 ? "<strong class='text-success'>Free</strong>" : "$".$ent->price !!}
                                    </li>
                                    <li>
                                        <strong> Available on</strong>:
                                        @if(count($ent->platforms)==1)

                                            {{ $ent->platforms->first()->title . "." }}
                                        @elseif(count($ent->platforms)==2)
                                            @foreach($ent->platforms as $platform)
                                                {{ $loop->index < count($ent->platforms)-1 ? $platform->title . " and" : $platform->title . "." }}
                                            @endforeach
                                        @else
                                            @foreach($ent->platforms as $platform)
                                                {{ $loop->index < count($ent->platforms)-1 ? $platform->title . "," : " and ".$platform->title . "." }}
                                            @endforeach
                                        @endif
                                    </li>
                                    <li><strong>Tags</strong>:
                                        @foreach($ent->tags->unique("tag") as $tag)
                                            <span class="badge bg-light text-black">{{$tag->tag}}</span>
                                        @endforeach
                                    </li>
                                    @if($ent->publisher())
                                        @if($publisher = $ent->publisher()->first())
                                            <li><strong>Publisher</strong>: <a
                                                    href="{{$publisher->link_1}}">{{ $publisher->title }}</a>
                                            </li>
                                        @endif
                                    @endif
                                    <li>
                                        <strong>Link</strong>: <a href="{{$ent->link_1}}">Official
                                            website</a>
                                    </li>
                                </ul>
                                <p>{!! $ent->long_description !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            No results found
        @endif
    </div>
@endsection
