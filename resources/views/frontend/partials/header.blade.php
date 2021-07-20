<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title', 'Tohoney E-commerce')</title>
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="{{ asset('frontend/assets/images/favicon.png') }}">

    <!-- All css here -->
    <!-- bootstrap v4.0.0-beta.2 css -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">

    <!-- owl.carousel.2.0.0-beta.2.4 css -->
    <link rel="stylesheet" href="{{ asset('/frontend/assets/css/owl.carousel.min.css') }}">

    <!-- font-awesome v4.6.3 css -->
    <link rel="stylesheet" href="{{ asset('/frontend/assets/css/font-awesome.min.css') }}">

    <!-- flaticon.css -->
    <link rel="stylesheet" href="{{ asset('/frontend/assets/css/flaticon.css') }}">

    <!-- jquery-ui.css -->
    <link rel="stylesheet" href="{{ asset('/frontend/assets/css/jquery-ui.css') }}">

    <!-- metisMenu.min.css -->
    <link rel="stylesheet" href="{{ asset('/frontend/assets/css/metisMenu.min.css') }}">

    <!-- select2.min.css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">

    <!-- swiper.min.css -->
    <link rel="stylesheet" href="{{ asset('/frontend/assets/css/swiper.min.css') }}">

    <!-- style css -->
    <link rel="stylesheet" href="{{ asset('/frontend/assets/css/styles.css') }}">

    <!-- responsive css -->
    <link rel="stylesheet" href="{{ asset('/frontend/assets/css/responsive.css') }}">

    {{-- Select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- modernizr css -->
    <script src="{{ asset('/frontend/assets/js/vendor/modernizr-2.8.3.min.js') }}"></script>
    @yield('css')
</head>
<body>

    <!-- search-form here -->
    <div class="search-area flex-style">
        <span class="closebar">Close</span>
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2 col-12">
                    <div class="search-form">
                        <form action="{{ route('search') }}" method="GET">
                            {{-- @csrf --}}
                            <input type="text" placeholder="Search Here..." name="search">
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- search-form here -->

    <!-- header-area start -->
    <header class="header-area">
        <div class="header-top bg-2">
            <div class="fluid-container">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <ul class="d-flex header-contact">
                            <li><i class="fa fa-phone"></i> 6565765876</li>
                            <li><i class="fa fa-envelope"></i> admin@gmail.com</li>
                        </ul>
                    </div>
                    <div class="col-md-6 col-12">
                        <ul class="d-flex account_login-area">
                            @guest
                                <li>
                                    <a href="{{ route('login') }}">
                                        <i class="fa fa-sign-in"></i> Login</a>
                                </li>
                                <li>
                                    <a href="{{ route('register') }}">
                                        <i class="fa fa-user-plus"></i> Register</a>
                                </li>
                            @endguest()

                            @auth
                                <li><a href="{{ route('profile', auth()->user()->user_name) }}">{{ auth()->user()->name }}</a></li>
                                <li>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out"></i> Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            @endauth
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom">
            <div class="fluid-container">
                <div class="row">
                    <div class="col-lg-3 col-md-7 col-sm-6 col-6">
                        <div class="logo">
                            <a href="index.html">
                                <img src="assets/images/logo.png" alt="">
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-7 d-none d-lg-block">
                        <nav class="mainmenu">
                            <ul class="d-flex">
                                <li class="{{ Route::is('index') ? 'active':'' }}"><a href="{{ route('index') }}">Home</a></li>
                                <li>
                                    <a href="javascript:void(0);">Category <i class="fa fa-angle-down"></i></a>
                                    <ul class="dropdown_style">
                                        @foreach (cateogries() as $data)
                                        <li>
                                            <a href="{{ route('product.category', $data->slug) }}">{{ $data->name }}</a>

                                            {{-- @if($data->subcategory->count() > 0)
                                            <ul class="dropdown_style">
                                                @foreach ($data->subcategory as $subCat)
                                                <li>
                                                    <a href="{{ route('product.category', $subCat->slug) }}">{{ $subCat->name }}</a>
                                                </li>
                                                @endforeach
                                            </ul>
                                            @endif --}}
                                        </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li class="{{ Route::is('shop') ? 'active':'' }}"><a href="{{ route('shop') }}">shop</a></li>
                                <li class="{{ Route::is('cart.index') ? 'active':'' }}"><a href="{{ route('cart.index') }}">Cart</a></li>
                                <li class="{{ Route::is('about') ? 'active':'' }}"><a href="{{ route('about') }}">About us</a></li>
                                <li class="{{ Route::is('contact') ? 'active':'' }}"><a href="{{ route('contact') }}">Contact us</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-md-4 col-lg-2 col-sm-5 col-4">
                        <ul class="search-cart-wrapper d-flex">
                            <li class="search-tigger"><a href="javascript:void(0);"><i class="flaticon-search"></i></a></li>
                            <li>
                                <a href="javascript:void(0);"><i class="flaticon-shop"></i> <span>{{ total_cart_item() }}</span></a>
                                <ul class="cart-wrap dropdown_style">
                                @php
                                    $subtotal = 0;
                                @endphp
                                @foreach (cart_items() as $data)
                                    <li class="cart-items">
                                        <div class="cart-img">
                                            <img src="{{ asset('uploads/product/'.$data->products->image) }}" alt="" style="width: 80px; height:80px">
                                        </div>
                                        <div class="cart-content">
                                            <a href="{{ route('product.details', $data->products->slug) }}">{{ $data->products->name }}</a>
                                            <span>QTY : {{ $data->quantity }}</span>
                                            <p>U.P : {{ $data->products->price }} ৳</p>
                                            <p>T.P : {{ $data->products->price * $data->quantity }} ৳</p>
                                            <a href="{{ route('cart.destroy', $data->id) }}"><i class="fa fa-times"></i></a>
                                        </div>
                                        @php
                                            $subtotal += $data->products->price * $data->quantity;
                                        @endphp
                                    @endforeach
                                    </li><strong>Subtotal:</strong> <span class="pull-right">{{ $subtotal }} ৳</span></li>
                                    <li>
                                        {{-- <button>Check Out</button> --}}
                                        <a href="{{ route('cart.index') }}" class="btn btn-outline-danger">Check Out</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-1 col-sm-1 col-2 d-block d-lg-none">
                        <div class="responsive-menu-tigger">
                            <a href="javascript:void(0);">
                                <span class="first"></span>
                                <span class="second"></span>
                                <span class="third"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- responsive-menu area start -->
            <div class="responsive-menu-area">
                <div class="container">
                    <div class="row">
                        <div class="col-12 d-block d-lg-none">
                            <ul class="metismenu">
                                <li class="{{ Route::is('index') ? 'active':'' }}"><a href="{{ route('index') }}">Home</a></li>
                                <li class="sidemenu-items">
                                    <a class="has-arrow" aria-expanded="false"
                                        href="javascript:void(0);">Pages </a>
                                    <ul aria-expanded="false">
                                        <li><a href="about.html">About Page</a></li>
                                    </ul>
                                </li>
                                <li class="{{ Route::is('shop') ? 'active':'' }}"><a href="{{ route('shop') }}">shop</a></li>
                                <li class="{{ Route::is('cart.index') ? 'active':'' }}"><a href="{{ route('cart.index') }}">Cart</a></li>
                                <li class="{{ Route::is('about') ? 'active':'' }}"><a href="{{ route('about') }}">About us</a></li>
                                <li class="{{ Route::is('contact') ? 'active':'' }}"><a href="{{ route('contact') }}">Contact us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- responsive-menu area start -->
        </div>
    </header>
    <!-- header-area end -->
