<div class="card">
    <div class="card-body" itemscope itemtype="https://schema.org/ItemList">
        <h2 id="alternatives" itemprop="name">Alternatives to {{$entity->title}}</h2>
        @foreach($alternatives as $alternative)
            <section class="row py-3" id="{{$alternative->slug}}" itemprop="itemListElement" itemscope
                     itemtype="https://schema.org/Product">
                <div class="col-lg-12 border-top pt-3">
                    <img src="{{$alternative->logo}}" alt="{{$alternative->title}} logo"
                         title="{{$alternative->title}} logo"
                         class="img-fluid mb-3 d-inline-block"
                         width="32"
                         loading="lazy"
                         itemprop="logo"
                    >
                    <h2 class="fw-bolder d-inline-block">
                        <span >{{$loop->index+1}}</span>. <a
                            href="{{route('ent', ["ent"=>$alternative->slug])}}"
                            rel="external"
                            class="text-primary"
                            title="{{$alternative->title}} alternatives"
                        ><span itemprop="name">{{$alternative->title}}</span></a>
                    </h2>
                    <ul>
                        <li><strong>Category</strong>: <a href="/category/{{$alternative?->parent?->slug}}" itemprop="category">{{$alternative?->parent?->title}}</a></li>
                        <li><strong>Platforms</strong>: @foreach($alternative->platforms as $platform)<span
                                class="badge bg-light me-1" ><i class="{{$platform->fa}}"></i> {{$platform->title}}</span>@endforeach</li>
                        <li><strong>Tags</strong>: @foreach($alternative->tags as $tag)<span
                                class="badge bg-light me-1" itemprop="keywords">{{$tag->tag}}</span>@endforeach</li>
                    </ul>
                    @if($alternative->image_1)
                        <img src="{{$alternative->image_1}}" alt="An image of {{$alternative->title}}." title="An image of {{$alternative->title}}." width="804" class="mb-3 w-100" loading="lazy" itemprop="image">
                    @endif
                    <p itemprop="description">{!! nl2br(e(Str::words($alternative->description, 50, "..."))) !!}</p>
                    <a href="{{route('ent', ["ent"=>$alternative->slug])}}" class="btn btn-outline-primary">More
                        details</a>
                </div>
            </section>
        @endforeach
    </div>
</div>
