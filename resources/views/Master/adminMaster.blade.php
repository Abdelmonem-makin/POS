<!DOCTYPE html>
@if (app()->getlocale() == 'en')
    <html dir="ltr" lang="{{ app()->getLocale() }}">
@else
    <html dir="rtl" lang="{{ app()->getLocale() }}">
@endif


<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') </title>
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/font-awesome.min.css') }}"rel="stylesheet">
    <link href="{{ asset('/css/style.css') }}"rel="stylesheet">
    <style>
        body {
            font-family: 'cairo', sans-serif;
        }
    </style>
</head>

<body class="antialiased my-5">

    @include('include.dashbordnav')
    <div class="container-fluid ">
        <div class="row">
            <main class="col-md-3 col-lg-2 ">
                <div class="content  my-5"></div>
            </main>
            <main class="col-md-6 col-lg-10 ">
                <div class="content my-4 ">
                    @yield('content')
                </div>
            </main>

        </div>
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
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('js/order.js') }}"></script>
    <script src="{{ asset('js/printThis.js') }}"></script>
    <script src="{{ asset('js/jquery-number-master/jquery.number.min.js') }}"></script>
    @yield('script')

</body>

</html>
