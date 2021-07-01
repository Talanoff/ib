<header id="app-header">
    <{!! app('router')->currentRouteName() !== 'app.home' ? 'a class="logo" href="'. url('/') . '"' : 'div class="logo"' !!}>
    <img src="{{ asset('images/logo.svg') }}" alt="{{ config('app.name') }}" style="height: 80px;">
    <{!! app('router')->currentRouteName() !== 'app.home' ? '/a' : '/div' !!}>

    <div id="nav" class="flex align-center">
        <ul class="lang flex mr-4 mb-0 text-uppercase">
            @foreach(config('app.locales') as $lang)
                <li class="{{ !$loop->last ? 'mr-2' : '' }}">
                    <{!! app()->getLocale() === $lang ? 'span' : 'a data-turbolinks="false" href="'.route('app.lang', $lang).'"' !!}
                    >
                    {{ $lang }}
                    <{{ app()->getLocale() === $lang ? '/span' : '/a' }}>
                </li>
            @endforeach
        </ul>

        <svg width="32" height="24" class="nav-icon" @click="navVisible = !navVisible">
            <use xlink:href="#icon-menu"></use>
        </svg>

        <nav id="app-nav" class="flex flex-column justify-center text-center" :class="{'nav-visible': navVisible}">
            @foreach($nav as $item)
                <div class="nav-item {{ app('router')->currentRouteNamed($item['compare']) ? 'is-active' : '' }}">
                    <a href="{{ route($item['route']) }}">
                        {{ $item['name'] }}
                    </a>
                </div>
            @endforeach
        </nav>
    </div>
</header>
