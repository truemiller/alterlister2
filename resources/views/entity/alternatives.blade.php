<div class="card">
    <div class="card-body">
        <h2 id="alternatives">Alternatives to {{$entity->title}}</h2>
        @foreach($alternatives as $alternative)
            <section class="row py-3" id="{{$alternative->slug}}">
                <div class="col-lg-12 border-top pt-3">
                    <h2 class="fw-bolder">
                        <img src="{{$alternative->logo}}" alt="{{$alternative->title}} logo" title="{{$alternative->title}} logo"
                             class="img-fluid mb-3" loading="lazy" style="height: 1em">
                        {{$loop->index+1}}. <a
                            href="{{route('ent', ["ent"=>$alternative->slug])}}"
                            rel="external"
                            class=" text-primary"
                            title="{{$alternative->title}}">{{$alternative->title}}</a>
                    </h2>
                    <ul>
                        <li>Platforms: @foreach($alternative->platforms as $platform)<span class="badge bg-light me-1">{{$platform->title}}</span>@endforeach</li>
                        <li>Features: @foreach($alternative->tags as $tag)<span class="badge bg-light text-capitalize me-1">{{$tag->tag}}</span>@endforeach</li>
                    </ul>
                    <p>{!! Str::words($alternative->description, "100", "...") !!}</p>
                </div>
            </section>
        @endforeach
    </div>
</div>
