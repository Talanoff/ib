<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="locales" content="{{ json_encode(config('app.locales')) }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') . (isset($title) ? ' | ' . $title : '') }}</title>

    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicons/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('images/favicons/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('images/favicons/safari-pinned-tab.svg') }}" color="#5bbad5">
    <link rel="shortcut icon" href="{{ asset('images/favicons/favicon.ico') }}">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config" content="{{ asset('images/favicons/browserconfig.xml') }}">
    <meta name="theme-color" content="#ffffff">
</head>
<body>
@include('partials.admin.layout.icons')
@include('partials.admin.alert.success')
@include('partials.admin.alert.errors')

<div id="app" v-cloak>
    @includeIf('partials.admin.layout.header')
    @includeIf('partials.admin.layout.aside')

    <main>
        <section class="content">
            @yield('content')
        </section>
    </main>
</div>

<script src="{{ asset('js/admin.js') }}"></script>
@stack('scripts')
</body>
</html>
