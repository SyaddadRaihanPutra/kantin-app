@extends('layouts.app')

@section('title', 'Daftar')
@section('content')
    <div class="container">
        <div class="row align-items-center justify-content-center" style="min-height: 100vh">
            <div class="col-md-5">
                <div class="card shadow-lg m-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-center gap-1 mb-4">
                            {{-- <img src="assets/images/logo.png" style="width: 40px" alt="Logo"> --}}
                            <p class="mb-0 text-dark fw-bold fs-3 text-uppercase">Boedoet <span class="text-primary">Food</span></p>
                        </div>
                        <hr>
                        <h5 class="text-dark fw-bold mb-4 text-center">Daftar Aplikasi</h5>
                        <form action="{{ route('register') }}" method="POST">
                            @csrf
                            <input type="hidden" name="role" value="pembeli">
                            <div class="mb-3">
                                <label for="email" class="mb-1">Nama Lengkap</label>
                                @if ($errors->has('name'))
                                    <div class="text-danger" role="alert">
                                        Kesalahan saat mengisi nama lengkap
                                    </div>
                                @endif
                                <input type="text" name="name" class="form-control"
                                    placeholder="Jhon Doe" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="mb-1">Alamat Email</label>
                                @if ($errors->has('email'))
                                    <div class="text-danger" role="alert">
                                        Kesalahan saat mengisi alamat email
                                    </div>
                                @endif
                                <input type="text" name="email" class="form-control"
                                    placeholder="jhon@mail.com" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="mb-1">Password</label>
                                @if ($errors->has('password'))
                                    <div class="text-danger" role="alert">
                                        Pastikan password kamu minimal 8 karakter
                                    </div>
                                @endif
                                <input type="password" name="password" class="form-control"
                                    placeholder="******" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="mb-1">Konfirmasi Password</label>
                                @if ($errors->has('password_confirmation'))
                                    <div class="text-danger" role="alert">
                                        Pastikan password kamu sama dengan konfirmasi password
                                    </div>
                                @endif
                                <input type="password" name="password_confirmation" class="form-control"
                                    placeholder="******" required>
                            </div>
                            <button class="btn btn-primary d-block w-100" type="submit">Masuk</button>
                        </form>
                        <p class="pt-4 text-center">Sudah punya akun? <a href="{{ route('login') }}">Masuk</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
