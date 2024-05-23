@extends('layouts.app')

@section('title', 'Masuk')
@section('content')
    <div class="container">
        <div class="row align-items-center justify-content-center" style="min-height: 100vh;">
            <div class="col-md-5">
                <div class="card shadow-lg border border-3 border-primary">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-center gap-1 mb-4">
                            {{-- <img src="assets/images/logo.png" style="width: 40px" alt="Logo"> --}}
                            <p class="mb-0 text-dark fw-bold fs-3 text-uppercase">Boedoet <span class="text-primary">Food</span></p>
                        </div>
                        <hr>
                        <h5 class="text-dark fw-bold mb-4 text-center">Masuk Aplikasi</h5>
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="mb-1">Alamat Email</label>
                                @if ($errors->has('email'))
                                    <div class="text-danger" role="alert">
                                        Kesalahan saat mengisi alamat email
                                    </div>
                                @endif
                                <input type="text" name="email" class="form-control"
                                    placeholder="Tulis alamat email kamu" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="mb-1">Password</label>
                                @if ($errors->has('password'))
                                    <div class="text-danger" role="alert">
                                        Pastikan password yang kamu masukkan benar
                                    </div>
                                @endif
                                <input type="password" name="password" class="form-control"
                                    placeholder="Masukkan password kamu" required>
                            </div>

                            <button class="btn btn-primary d-block w-100" type="submit">Masuk</button>
                        </form>
                        <p class="pt-4 text-center">Belum punya akun? <a href="{{ route('register') }}">Daftar</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
