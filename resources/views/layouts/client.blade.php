<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
    <div id="app">
      <header>
        <nav class="nav-client py-4">
          <div class="container d-flex justify-content-between align-items-center">
            {{-- <img src="{{asset('images/logo-horizontal.png')}}" class="img-fluid col-4" alt=""> --}}
            <p>Formulario para inscripciones</p>
          </div>
        </nav>
      </header>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
