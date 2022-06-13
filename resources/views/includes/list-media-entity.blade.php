<div class="mb-3 ">
    <div class="bg-white p-3 shadow">
        <div class="d-flex">

            <div class="p-2 pl-5">
                <h3 class="ml-3 mt-2" height="50px">
                    {{$loop->index+1}}. <a class="text-decoration-none" href="{{ route('ent',['ent'=>$alternative->slug]) }}">
                    {{ $alternative->title }}</a>
                </h3>
                <p class="mb-2 mt-1">
                <span class="badge  bg-{{ $alternative->price != 0.0 ? 'primary' : 'success' }} border">
                    <i class="fas fa-hand-holding-usd"></i> {{ $alternative->price != 0.0 ? '$' . $alternative->price : 'Free' }}
                </span>
                    @if (count($alternative->platforms) > 0)
                        @foreach ($alternative->platforms as $platform)
                            <span class="badge bg-light text-dark border"><i class="{{ $platform->fa }}"></i> {{ $platform->title }}</span>
                        @endforeach
                    @endif
                </p>
                <p>{{ Str::words($alternative->long_description,20) }} <a href="{{ route('ent', ['ent'=>$alternative->slug]) }}">Read more</a></p>
            </div>


            <aside class="p-2 m-2 align-self-start">
                <img class="rounded d-flex align-items-start mb-2" src="{{ $alternative->logo }}"
                     alt="{{ $alternative->title }} logo" width="50px" loading="lazy"/>
            </aside>
        </div>
    </div>
</div>
