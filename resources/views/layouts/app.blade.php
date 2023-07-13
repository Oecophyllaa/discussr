<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/favicon/favicon.ico') }}" />

  <title>Discussr</title>

  @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>

<body>
  @include('partials.navbar')

  @yield('content')

  @include('partials.footer')

  @stack('before-script')
  @include('partials.script')
  @stack('after-script')
</body>

</html>
