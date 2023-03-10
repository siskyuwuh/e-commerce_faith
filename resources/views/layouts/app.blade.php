<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'FAITH') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <!-- Scripts -->
    @if (request()->is('/'))
        <link rel="stylesheet" href="carousel.css">
    @else
    @endif
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm" style="height: 119px">
            <div class="container-fluid">
                @cannot('AdminSession')
                    <a class="navbar-brand fs-2 mx-5" href="{{ url('/') }}">
                        {{ config('app.name', 'FAITH') }}
                    </a>
                @endcannot
                @can('AdminSession')
                <a class="navbar-brand fs-2 mx-5" href="{{ url('/admin/home') }}">
                    {{ config('app.name', 'FAITH') }}
                </a>
                @endcan
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse me-5 navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto fs-5">

                        @cannot('AdminSession')
                            <li class="nav-item mx-3">
                                <a class="nav-link {{ request()->is('/') ? 'active' : '' }}"
                                    {{ request()->is('/') ? 'aria-current="page"' : '' }}
                                    href="{{ url('/') }}">{{ __('Home') }}</a>
                            </li>
                            <li class="nav-item mx-3">
                                <a class="nav-link {{ request()->is('shop') ? 'active' : '' }}"
                                    {{ request()->is('shop') ? 'aria-current="page"' : '' }}
                                    href="{{ url('/shop') }}">{{ __('Shop') }}</a>
                            </li>
                            <li class="nav-item mx-3">
                                <a class="nav-link {{ request()->is('about') ? 'active' : '' }}"
                                    {{ request()->is('about') ? 'aria-current="page"' : '' }}
                                    href="{{ url('/about') }}">{{ __('About') }}</a>
                            </li>
                        @endcannot
                        @can('AdminSession')
                            {{-- Admin Things --}}

                            <li class="nav-item mx-3">
                                <a class="nav-link {{ request()->is('admin/home') ? 'active' : '' }}"
                                    {{ request()->is('admin/home') ? 'aria-current="page"' : '' }}
                                    href="{{ route('admin.home') }}">{{ __('Home') }}</a>
                            </li>
                            <li class="nav-item mx-3">
                                <a class="nav-link {{ request()->is('admin/product') || request()->is('admin/product/create') ? 'active' : '' }}"
                                    {{ request()->is('admin/product') || request()->is('admin/product/create') ? 'aria-current="page"' : '' }}
                                    href="{{ route('product.index') }}">{{ __('Product') }}</a>
                            </li>
                            <li class="nav-item mx-3">
                                <a class="nav-link {{ request()->is('order/admin') ? 'active' : '' }}"
                                    {{ request()->is('order/admin') ? 'aria-current="page"' : '' }}
                                    href="{{ route('order.list') }}">{{ __('Order') }}</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link {{ request()->is('admin/product/index') ? 'active' : '' }}"
                                    {{ request()->is('admin/product/index') ? 'aria-current="page"' : '' }}
                                    href="{{ route('product.index') }}">{{ __('Product') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('admin/product/index') ? 'active' : '' }}"
                                    {{ request()->is('admin/product/index') ? 'aria-current="page"' : '' }}
                                    href="{{ route('product.index') }}">{{ __('Product') }}</a>
                            </li> --}}
                        @endcan

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto fs-5">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item mx-3">
                                    <a class="nav-link btn btn-outline-dark"
                                        href="{{ route('login') }}">{{ __('Masuk') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item mx-3">
                                    <a class="nav-link btn btn-dark"
                                        href="{{ route('register') }}">{{ __('Daftar') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item mx-3 dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    @cannot('AdminSession')
                                        <a class="dropdown-item"
                                            href="{{ route('order.customer', auth()->user()->username) }}">
                                            {{ __('My Order') }}
                                        </a>
                                    @endcannot
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-0">
            @include('layouts.alerts')
            @yield('content')
        </main>
    </div>

</body>

</html>
