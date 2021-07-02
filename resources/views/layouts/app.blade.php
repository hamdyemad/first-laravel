<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Styles -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('/css/libs/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/libs/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
</head>
<body>
{{-- Start Admin Layout --}}
  <div class="admin">
    {{-- Start Admin Sidebar --}}
    @include('navbars.sidebar')
    {{-- End Admin Sidebar --}}
    <div class="last">
      {{-- Start Admin Sidebar Top --}}
      @include('navbars.side-top')
      {{-- End Admin Sidebar Top --}}
      {{-- Start Content --}}
      @yield('content')
      {{-- End Content --}}
    </div>

  </div>
{{-- End Admin Layout --}}

<script src="/js/libs/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="/js/libs/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="/js/app.js"></script>

@yield('script')
</body>
</html>
