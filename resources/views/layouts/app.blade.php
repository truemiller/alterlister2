<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
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
    <title>@yield('title') - {{env('APP_NAME')}}</title>
    <script defer src="{{ asset('js/app.js') }}"></script>
@yield('ld+json')

@yield('og_tags')
<!-- Scripts -->
    <link rel="canonical" href="{{url()->current()}}">
    <style>
        button {
            text-decoration: none;
        }
    </style>
</head>
<body class="vh-100 d-flex flex-column" itemscope itemtype="https://schema.org/WebPage">

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-Z1KSJ3YJJ2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-Z1KSJ3YJJ2');
</script>

<nav
    class="navbar navbar-expand-lg bg-white navbar-light sticky-top shadow-sm border-bottom"
itemscope itemtype="https://schema.org/SiteNavigationElement">
    <div class="container d-flex flex-row">

        <a href="{{route('home')}}" class="navbar-brand d-sm-flex mx-2">
            <img src="{{asset('img/al.svg')}}" alt="{{config('app.name') . "logo"}}" style="height:32px; width:32px" loading="lazy">
            <span class="ms-2 fw-bolder">Similar Software</span>
        </a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            @if(Auth::check() and Auth::user()->admin)
                <a href="/submit" class="nav-link">Submit</a>
                <a href="/submissions" class="nav-link">Submissions</a>
                @endif
            <div class="nav-item dropdown" onclick="$('.dropdown-menu').toggle()" onmouseenter="$('.dropdown-menu').toggle()" onmouseleave="$('.dropdown-menu').hide()">
                <a class="nav-link dropdown-toggle" href="/categories" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Categories
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    @foreach(\App\Models\Category::all()->where("parent", null)->sortBy("title") as $category)
                    <a class="dropdown-item" href="{{route('cat', ['cat'=>$category->slug])}}">{{$category->title}}</a>
                    @endforeach
                </div>
            </div>

        </div>

        <div class="btn-group">
            @if(Auth::check())
                <form action="/logout" method="post">
                    @csrf
                    <input type="submit" class="btn btn-danger" value="Logout">
                </form>
            @else
            <a class="btn btn-primary" href="/login">Login</a>
            <a class="btn btn-light" href="/register" >Register</a>
            @endif
        </div>

    </div>

</nav>


@yield('main')

@include('includes/footer')

<!-- Styles -->

</body>
</html>
