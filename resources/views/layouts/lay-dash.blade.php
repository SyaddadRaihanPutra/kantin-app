<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}" type="image/x-icon">
    <title>@yield('title') | Kantin Apps</title>

    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/boxicons/css/boxicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="bg-soft-blue">
    <div class="container">
        <nav class="shadow-sm navbar navbar-expand-lg p-3 bg-white mt-4 rounded-5 fixed-top m-4">
            <div class="container">
                <a class="navbar-brand logo" href="{{ route('dashboard') }}">
                    <p class="mb-0 text-dark fw-bold fs-5 text-uppercase">Boedoet <span class="text-primary">Food</span>
                    </p>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                        @if (Auth::user()->role == 'pemilik')
                            <li class="nav-item">
                                <a class="nav-link"
                                    href="{{ route('settings.canteen',\DB::table('canteens')->where('owner_id', Auth::user()->id)->value('unique_code')) }}">Pengaturan
                                    Kantin</a>
                            </li>
                        @endif
                    </ul>
                    <ul class="navbar-nav">
                        <ul class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown"
                                aria-expanded="true">
                                {{ Auth::user()->name }}
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end border mt-3" data-bs-popper="static">
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </ul>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Bottom Navbar -->
        <nav class="navbar navbar-dark bg-primary navbar-expand fixed-bottom d-md-none d-lg-none d-xl-none p-0">
            <ul class="navbar-nav nav-justified w-100">
                <li class="nav-item">
                    <a href="#" class="nav-link text-center">
                        <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-house" fill="currentColor"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                            <path fill-rule="evenodd"
                                d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
                        </svg>
                        <span class="small d-block">Home</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link text-center">
                        <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z" />
                            <path fill-rule="evenodd"
                                d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z" />
                        </svg>
                        <span class="small d-block">Search</span>
                    </a>
                </li>
                <li class="nav-item dropup">
                    <ul class="nav-item dropdown">
                        <a href="#" class="nav-link" role="button" data-bs-toggle="dropdown"
                            aria-expanded="true">
                            <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-person"
                                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                            </svg>
                            <span class="small d-block">Profile</span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end border mt-3" data-bs-popper="static">
                            <li class="text-center fw-semibold"><i><span style="font-size: 13px;">Login as {{ Auth::user()->name }}</span></i></li>
                            <hr>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"></i>&nbsp; Logout</button>
                                </form>
                            </li>
                        </ul>
                    </ul>
                    <!-- Dropup menu for profile -->
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuProfile">
                        <a class="dropdown-item" href="#">Edit Profile</a>
                        <a class="dropdown-item" href="#">Notification</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div class="mt-5 pt-5">
            @yield('content')
        </div>
    </div>
    <script src="{{ asset('assets/vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        $('.dropdown-toggle').dropdown()
    </script>
</body>

</html>
