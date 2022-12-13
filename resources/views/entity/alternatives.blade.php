@foreach($alternatives as $alternative)
    <h2>
        <span>{{$loop->index+1}}</span>. <a
            href="{{$alternative->link_1}}"
            rel="external"
            class="text-primary"
            title="{{$alternative->title}} alternatives"
        >{{$alternative->title}}</a>
    </h2>
    <img class="my-3" src="{{$alternative->image_1}}" alt="Screenshot of {{$alternative->title}}." loading="lazy" title="{{$alternative->title}}">
    <strong class="mb-3">
        {{$alternative->title}} runs on
        @foreach($alternative->platforms as $platform){{$platform->title}}{{$loop->index === $alternative->platforms->count() - 1 ? "." : ", "}}@endforeach
    </strong>
    <p itemprop="description">{!! nl2br(e($alternative->description)) !!}</p>
@endforeach

