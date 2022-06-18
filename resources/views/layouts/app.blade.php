<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-WH2KTPT');</script>
    <!-- End Google Tag Manager -->

{{--    GA and Tag Manager --}}
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-148739386-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-148739386-1');
    </script>

    <meta charset="utf-8">
    <meta name="viewport" content=" user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#ffffff">
    {{--    Title--}}
    <title>@yield('title') {{env('APP_NAME')}}</title>
    <script async src="{{ asset('js/app.js') }}"></script>
@yield('ld+json')

@yield('og_tags')
<!-- Scripts -->
    <link rel="canonical" href="{{url()->current()}}">
    <link rel="prefetch" href="{{config('app.url')}}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        button {
            text-decoration: none;
        }
    </style>
{{--    Adsense --}}
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-3541252731032050"
            crossorigin="anonymous"></script>
</head>
<body class="bg-light vh-100 d-flex flex-column" itemscope itemtype="https://schema.org/WebPage">
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WH2KTPT"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<nav
    class="navbar navbar-expand-lg bg-white navbar-light sticky-top shadow-sm border-bottom">
    <div class="container d-flex flex-row">

        <a href="{{route('home')}}" class="navbar-brand d-sm-flex mx-2">
            <img src="{{asset('img/al.svg')}}" alt="{{config('app.name') . "logo"}}" style="height:32px; width:32px" loading="lazy">
            <span class="ms-2 fw-bolder">Alterlister</span>
        </a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <a href="/" class="nav-link">Home</a>
            <a href="/submit" class="nav-link">Submit</a>
            @if(Auth::check())
                <a href="/submissions" class="nav-link">Submissions</a>
                @endif
            <div class="nav-item dropdown" onclick="$('.dropdown-menu').toggle()" onmouseenter="$('.dropdown-menu').toggle()" onmouseleave="$('.dropdown-menu').hide()">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Categories
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    @foreach(\App\Models\Category::all()->where("parent", null)->sortBy("title") as $category)
                    <a class="dropdown-item" href="{{route('cat', ['cat'=>$category->slug])}}">{{$category->title}}</a>
                    @endforeach
                </div>
            </div>

        </div>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="btn-group">
            @if(Auth::check())
                <form action="/logout" method="post">
                    @csrf
                    <input type="submit" class="btn btn-danger" value="Logout">
                </form>
            @else
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalLogin">Login</button>
            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#modalRegister">Register</button>
            @endif
        </div>

    </div>

</nav>

<div class="main">
    @yield('main')
</div>

@include('includes/footer')

<!-- Styles -->

@include('includes/modalLogin')
@include('includes/modalRegister')

</body>
</html>
