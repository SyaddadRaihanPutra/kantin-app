@extends('layouts.lay-dash')

@section('title', 'Kantin')

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="mb-4">
                <h4 class="text-dark fw-semibold">Buat Pemilik Kantin</h4>
            </div>
            <div class="card border-0">
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <form action="{{ route('canteens.create-admin') }}" method="POST">
                        @csrf
                        <input type="hidden" name="role" value="pemilik">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Pemilik</label>
                                <input type="text" class="form-control" id="name" name="name" required placeholder="Wanto Ari"/>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Pemilik</label>
                                <input type="email" class="form-control" id="email" name="email" required placeholder="wanto123@mail.com"/>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required placeholder="******"/>
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required placeholder="******"/>
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-between">
                            <a href="{{ route('canteen.all') }}" class="btn btn-secondary btn-sm"><i class="bx bx-arrow-back me-2"></i>Batal</a>
                            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
