<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <link rel="shortcut icon" href="{{ asset('assets/dashboard/img/svg/logo.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('storage/assets/dashboard/css/style.min.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/assets/dashboard/css/style.css') }}">
</head>

<body>

    <div class="layer"></div>

    <main class="page-center">
        @yield('content')
    </main>

    <!-- Chart library -->
    <script src="{{ asset('storage/assets/dashboard/plugins/chart.min.js') }}"></script>
    <!-- Icons library -->
    <script src="{{ asset('storage/assets/dashboard/plugins/feather.min.js') }}"></script>
    <!-- Custom scripts -->
    <script src="{{ asset('storage/assets/dashboard/js/script.js') }}"></script>

</body>

</html>
