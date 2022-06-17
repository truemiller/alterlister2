<div class="card">
    <div class="card-body" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <h2 id="alternatives" >Alternatives to {{$entity->title}}</h2>
        @foreach($alternatives as $alternative)
            <section class="row py-3" id="{{$alternative->slug}}">
                <div class="col-lg-12 border-top pt-3">
                    <h2 class="fw-bolder">
                        <img src="{{$alternative->logo}}" alt="{{$alternative->title}} logo"
                             title="{{$alternative->title}} logo"
                             class="img-fluid mb-3" loading="lazy" style="height: 1em">
                        <span itemprop="position">{{$loop->index+1}}</span>. <a
                            href="{{route('ent', ["ent"=>$alternative->slug])}}"
                            rel="external"
                            class="text-primary"
                            title="{{$alternative->title}}"
                            itemprop="name">{{$alternative->title}}</a>
                    </h2>
                    <ul>
                        <li><strong>Platforms</strong>: @foreach($alternative->platforms as $platform)<span
                                class="badge bg-light me-1">{{$platform->title}}</span>@endforeach</li>
                        <li><strong>Tags</strong>: @foreach($alternative->tags as $tag)<span
                                class="badge bg-light me-1">{{$tag->tag}}</span>@endforeach</li>
                    </ul>
                    @if($alternative->image_1)
                        <img src="{{$alternative->image_1}}" alt="An image of {{$alternative->title}}.">
                    @endif
                    <p>{{ Str::words($alternative->description, "100", "...") }}</p>
                    <a href="{{route('ent', ["ent"=>$alternative->slug])}}" class="btn btn-outline-primary">More
                        details</a>
                </div>
            </section>
        @endforeach
    </div>
</div>
