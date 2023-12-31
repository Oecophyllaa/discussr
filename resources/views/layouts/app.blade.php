<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/favicon/favicon.ico') }}" />

  <title>Discussr</title>

  <!-- ./Styles -->
  @vite(['resources/scss/app.scss', 'resources/js/app.js'])
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.16/dist/sweetalert2.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css">
</head>

<body>
  @include('partials.navbar')

  @yield('content')

  @include('partials.footer')

  <!-- ./Scripts -->
  @stack('before-script')
  @include('partials.script')
  @stack('after-script')

  <!-- ./Sweetalert-Notif-Success -->
  @if (Session::has('notif.success'))
    <script>
      Swal.fire({
        icon: 'success',
        text: '{{ Session::get('notif.success') }}',
        showConfirmButton: false,
        timer: 1500
      });
    </script>
  @endif
</body>

</html>
