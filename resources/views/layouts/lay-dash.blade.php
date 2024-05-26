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
        <nav class="shadow-sm navbar navbar-expand-lg p-3 bg-white mt-4 rounded-5 fixed-top m-4 d-none d-lg-block">
            <div class="container">
                <a class="navbar-brand logo" href="{{ route('dashboard') }}">
                    <p class="mb-0 text-dark fw-bold fs-5 text-uppercase">Boedoet <span class="text-primary">Food</span>
                    </p>
                </a>
                <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{ route('dashboard') }}">Beranda</a>
                        </li>
                        @if (Auth::user()->role == 'pemilik')
                            @php
                                $unique_code = \DB::table('canteens')
                                    ->where('owner_id', Auth::user()->id)
                                    ->value('unique_code');
                            @endphp

                            @if ($unique_code)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('settings.canteen', $unique_code) }}">Pengaturan</a>
                            </li>
                            @endif
                        @elseif (Auth::user()->role == 'admin')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('canteen.all') }}">Kantin</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('canteens.index') }}">List Kantin</a>
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
        <nav
            class="navbar navbar-light bg-white navbar-expand fixed-bottom m-3 rounded-5 d-md-none d-lg-none d-xl-none p-0 shadow-lg">
            <ul class="navbar-nav nav-justified w-100 d-flex justify-content-center">
                <li class="nav-item d-flex justify-content-center align-items-center">
                    <a href="{{ route('dashboard') }}" class="nav-link text-center">
                        <i class="bi bi-house"></i>
                        <span class="small d-block">Beranda</span>
                    </a>
                </li>
                @if (Auth::user()->role == 'pemilik')
                    @php
                        $unique_code = \DB::table('canteens')
                            ->where('owner_id', Auth::user()->id)
                            ->value('unique_code');
                    @endphp

                    @if ($unique_code)
                        <li class="nav-item d-flex justify-content-center align-items-center">
                            <a href="{{ route('settings.canteen', $unique_code) }}" class="nav-link text-center">
                                <i class="bi bi-shop"></i>
                                <span class="small d-block">Pengaturan</span>
                            </a>
                        </li>
                    @endif
                @elseif (Auth::user()->role == 'admin')
                    <li class="nav-item d-flex justify-content-center align-items-center">
                        <a href="{{ route('canteen.all') }}" class="nav-link text-center">
                            <i class="bi bi-shop"></i>
                            <span class="small d-block">Kantin</span>
                        </a>
                    </li>
                @else
                    <li class="nav-item d-flex justify-content-center align-items-center">
                        <a href="{{ route('history.pembeli') }}" class="nav-link text-center">
                            <i class="bi bi-arrow-clockwise"></i>
                            <span class="small d-block">History</span>
                        </a>
                    </li>
                @endif
                <li class="nav-item dropup d-flex justify-content-center align-items-center">
                    <a href="#" class="nav-link text-center" role="button" data-bs-toggle="dropdown"
                        aria-expanded="true">
                        <i class="bi bi-person"></i>
                        <span class="small d-block">Profile</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end border mt-3" data-bs-popper="static">
                        <li class="text-center fw-semibold">
                            <i><span style="font-size: 13px;">Login as {{ Auth::user()->name }}</span></i>
                        </li>
                        <hr>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"></i>&nbsp;
                                    Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>

        <!-- For larger screens -->
        <div class="mt-lg-5 pt-lg-5 mb-sm-5 pb-sm-5">
            @yield('content')
        </div>
    </div>
    <script src="{{ asset('assets/vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        $('.dropdown-toggle').dropdown()
    </script>
</body>

</html>
