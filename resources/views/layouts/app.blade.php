<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="" rel="stylesheet">
    <link href="{{ asset('/css/font-awesome.min.css') }}"rel="stylesheet">
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">

    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI=" crossorigin="anonymous"> --}}
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        body {
            font-family: "Cairo", sans-serif;

        }
    </style>
</head>

<body>
    <div id="app">
        {{-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('Dashboard') }}">
                                   لوجة التحكم
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
        </nav> --}}
        <nav class="navbar   navbar-dark bg-dark shadow-sm">
            <a class="navbar-brand col-md-3 col-lg-2 mx-3 col-4    me-5  " href="#">
                <i class="fas fa-syringe"></i>

                صيدلية عروس كردفان
            </a>
            <div class=" ">
                <ul class="nav header mx-5 p-0 me-auto">
                    @if (Route::has('login'))
                        @auth
                            @if (Auth::user()->type == 0)
                                <li class="nav-item dropdown">
                                    <a class="nav-link p-2 dropdown-toggle text-light" href="#" id="dropdownId"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                            class="fa fa-user" aria-hidden="true"></i> {{ Auth::user()->name }}</a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownId">
                                        <div class="az-dropdown-header d-sm-none">
                                            <a href="" class="az-header-arrow"><i
                                                    class="icon ion-md-arrow-back"></i></a>
                                        </div>
                                        <div class="me-3" style='text-align:center; '>
                                            <div class="az-img-user" style="font-size: 30px;">
                                                <i class="fa fa-user-secret"></i>
                                            </div><!-- az-img-user -->
                                            <a href="" class="dropdown-item  text-bold " style='text-align:right;'><i
                                                    class="fa fa-user"></i> الملف الشخصي </a>
                                            <a href="{{ route('dashboard.index') }}" style='text-align:right;'
                                                class="dropdown-item   "><i class="fa fa-tachometer"></i> لوحة التحكم </a>
                                            <a href="{{ route('logout') }}" class="dropdown-item " style='text-align:right;'
                                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();"><i
                                                    class="fa fa-power-off">
                                                </i> نسجيل الخروج </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>
                                        </div><!-- az-header-profile -->
                                    </div><!-- dropdown-menu -->
                                </li>
                            @else
                                <li class="nav-item dropdown">
                                    <a class="nav-link p-2 dropdown-toggle text-light" href="#" id="dropdownId"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                            class="fa fa-user" aria-hidden="true"></i> {{ Auth::user()->name }}</a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownId">
                                        <div class="az-dropdown-header d-sm-none">
                                            <a href="" class="az-header-arrow"><i
                                                    class="icon ion-md-arrow-back"></i></a>
                                        </div>
                                        <div class="me-3" style='text-align:center; '>
                                            <div class="az-img-user" style="font-size: 30px;">
                                                <i class="fa fa-user-secret"></i>
                                            </div><!-- az-img-user -->
                                            <a href="" class="dropdown-item  text-bold " style='text-align:right;'><i
                                                    class="fa fa-user"></i> الملف الشخصي </a>

                                            <a href="{{ route('logout') }}" class="dropdown-item " style='text-align:right;'
                                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();"><i
                                                    class="fa fa-power-off">
                                                </i> نسجيل الخروج </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>
                                        </div><!-- az-header-profile -->
                                    </div><!-- dropdown-menu -->
                                </li>
                            @endif
                            {{-- @else
                            <a href="{{ route('login') }}" class="text-sm nav-link text-light   d-inline p-1">تسجيل
                                دخول</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class=" text-sm text-light  nav-link d-inline p-1 mx-2  ">تسجيل جديد</a>
                            @endif --}}
                            <li class="nav-item">
                                <a class="nav-link  text-light  " href="">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> 2
                                </a>
                            </li>
                        @endauth

                    @endif

                </ul>
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
  <script>
    function showAlert() {
      const alertBox = document.getElementById('alertBox');
      alertBox.classList.remove('d-none'); // Show the alert
      setTimeout(() => {
        alertBox.classList.add('d-none'); // Hide the alert after 3 seconds
      }, 2000);

    }
    showAlert();
  </script>
    {{-- <script src="{{asset("js/bootstrap.min.js")}}"></script> --}}
    <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('js/order.js') }}"></script>
    <script src="{{ asset('js/printThis.js') }}"></script>
    <script src="{{ asset('js/jquery-number-master/jquery.number.min.js') }}"></script>

</body>

</html>
