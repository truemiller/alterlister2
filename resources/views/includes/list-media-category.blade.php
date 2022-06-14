<div class="bg-white mb-3 p-3 shadow-sm border d-flex flex-row  align-items-center">
    <a class="text-decoration-none " href="{{ route('ent',['ent'=>$alternative->slug]) }}">
        <div class="d-flex flex-column">
            <img src="{{$alternative->logo}}" alt="" class="d-inline-block my-2 me-3" loading="lazy" width="50px">
        </div>
    </a>
    <div class="d-flex flex-column">
        <a class="text-decoration-none text-dark" href="{{ route('ent',['ent'=>$alternative->slug]) }}">
            <h3 class="d-inline-block mb-0 fw-bold h5 text-primary" itemprop="itemListElement">{{$alternative->title}}</h3>
        </a>
        <span class="text-muted">{{$alternative->parent?->title}}</span>
        <small>{{$alternative->alternatives()->count()}} alternatives</small>
    </div>
</div>


