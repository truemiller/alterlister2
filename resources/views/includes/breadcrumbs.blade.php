<nav aria-label="breadcrumb border-0">
    <ol itemscope itemtype="https://schema.org/BreadcrumbList" class="breadcrumb border-0 mb-0 mt-3">
        <li class="breadcrumb-item" itemprop="itemListElement" itemscope
            itemtype="https://schema.org/ListItem">
            <a href="{{route('home')}}" itemprop="name">Home</a>
        </li>
        @if($entity->parents->first()->parents)
            <li class="breadcrumb-item" itemprop="itemListElement" itemscope
                itemtype="https://schema.org/ListItem">
                <a itemprop="item" href="{{route('cat', ['category' => $entity->parents->first()->parents->first()])}}">
                    <span itemprop="name">{{$entity->parents->first()->parents->first()->title}}</span>
                </a>
                <meta itemprop="position" content="1" property="position" value="1">
            </li>
            <li class="breadcrumb-item" itemprop="itemListElement" itemscope
                itemtype="https://schema.org/ListItem">
                <a href="{{route('cat', ['category' => $entity->parents->first()->slug])}}" itemprop="item"
                   href="https://example.com/books">
                    <span itemprop="name">{{$entity->parents->first()->title}}
                </a>
                <meta itemprop="position" content="2" property="position" value="2">
            </li>
            <li class="breadcrumb-item" itemprop="itemListElement" itemscope
                itemtype="https://schema.org/ListItem">
                <a href="{{route('cat', ['category' => $entity->slug])}}">
                    <span itemprop="name">{{$entity->title}}</span>
                </a>
                <meta itemprop="position" content="3" property="position" value="3">
            </li>
        @elseif($entity->parents)
            <li class="breadcrumb-item" itemprop="itemListElement" itemscope
                itemtype="https://schema.org/ListItem">
                <a href="{{route('cat', ['category' => $entity->parents->first()->slug])}}" itemprop="item"
                   href="https://example.com/books">
                    <span itemprop="name">{{$entity->parents->first()->title}}</span>
                </a>
                <meta itemprop="position" content="1" property="position" value="1">
            </li>
            <li class="breadcrumb-item" itemprop="itemListElement" itemscope
                itemtype="https://schema.org/ListItem">
                <span itemprop="name">{{$entity->title}}</span>
                <meta itemprop="position" content="2" property="position" value="2">
            </li>
        @else
            <li class="breadcrumb-item" itemprop="itemListElement" itemscope
                itemtype="https://schema.org/ListItem">
                <span itemprop="name"> {{$entity->title}}</span>
                <meta itemprop="position" content="1" property="position" value="1">
            </li>
        @endif

    </ol>
</nav>
