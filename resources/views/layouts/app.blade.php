<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'IB') . (isset($app_title) ? ' | ' . $app_title : '') }}</title>

    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Alegreya+Sans:400,400i,700,700i&amp;subset=cyrillic"
          rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @if (app('router')->currentRouteName() != 'app.home')
        <meta property="og:title"
              content="{{ config('app.name', 'IB') . (isset($app_title) ? ' | ' . $app_title : '') }}"/>
    @else
        <meta property="og:title" content="{{ config('app.name', 'IB') }}"/>
    @endif
    <meta property="og:description" content="Профессиональная разработка, дизайн и маркетинг для веб-сайтов."/>
    <meta property="og:url" content="{{url()->current()}}"/>
    <meta property="og:type" content="article"/>
    <meta property="og:image" content="{{ asset('images/favicons/android-chrome-512x512.png') }}"/>
    <meta property="og:image:width" content="512">
    <meta property="og:image:height" content="512">
    <meta property="fb:app_id" content="357482571679823">

    <meta name="description" content='Evolution Technology — создание уникальных сайтов. Магазины, Лендинги, Корпоративные.'>
    <meta name="keywords" content="создание сайтов, веб-студия, запорожье, разработка, студия">
    <link rel="alternate" hreflang="ru" href="{{url()->current()}}">
    <link rel="alternate" hreflang="en" href="{{url()->current()}}">

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicons/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('images/favicons/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('images/favicons/safari-pinned-tab.svg') }}" color="#5bbad5">
    <link rel="shortcut icon" href="{{ asset('images/favicons/favicon.ico') }}">
    <meta name="apple-mobile-web-app-title" content="Evolution Technology">
    <meta name="application-name" content="Evolution Technology">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config" content="{{ asset('images/favicons/browserconfig.xml') }}">
    <meta name="theme-color" content="#0c0c0c">

    <script>
        window.fbAsyncInit = function () {
            FB.init({
                appId: '357482571679823',
                cookie: true,
                xfbml: true,
                version: 'v3.2'
            });
            FB.AppEvents.logPageView();
        };

        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {
                return;
            }
            js = d.createElement(s);
            js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
</head>
<body class="loading">
@include('partials.app.loader')
@include('partials.app.icons')

<div id="app" v-cloak>
    @include('partials.app.header')
    <main>
        @yield('content')
    </main>
    @include('partials.app.footer')
</div>

@stack('libs')
<script src="{{ asset('js/app.js') }}" defer></script>
@stack('scripts')
</body>
</html>
