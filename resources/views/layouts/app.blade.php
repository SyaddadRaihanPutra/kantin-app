<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">
    <title>@yield('title') | Kantin Apps</title>

    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/boxicons/css/boxicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body class="bg-soft-blue" style="background-image: url('{{ asset('assets/images/bg-food.png') }}'); background-size: cover; backround-repeat: no-repeat;">
    @yield('content')
    <p class="text-center text-dark">&copy; {{ now()->year }} by <a href="https://syaddad.pages.dev" target="_blank">syaddad.dev</a><br><small>App Version 1.0</small></p>
    <script src="assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
