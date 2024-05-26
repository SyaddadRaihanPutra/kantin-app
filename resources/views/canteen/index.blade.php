@extends('layouts.lay-dash')

@section('title', 'Kantin')
@section('content')
    <section class="py-5">
        <div class="container">
            <div class="mb-4">
                <h4 class="text-dark fw-semibold">
                    <i class="bi bi-shop"></i>
                    Daftar Kantin
                </h4>
            </div>
            <div class="card border-0">
                <div class="card-body">
                    @if (Auth::user()->role == 'admin')
                        <a href="{{ route('canteens.create-admin.view') }}" class="btn btn-primary mb-3 d-block col-md-2">
                            <i class="bx bx-plus"></i> Tambah Pemilik
                        </a>
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <div class="alert alert-info d-inline-block" style="font-size: 13px">
                            <i class="bi bi-info-circle"></i>
                            Anda hanya dapat menambahkan pemilik kantin.
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered text-center">
                                <thead>
                                    <tr class="align-middle">
                                        <th>No.</th>
                                        <th>Nama Kantin</th>
                                        <th>Deskripsi</th>
                                        <th>Pemilik</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($canteens as $canteen)
                                        <tr class="align-middle">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $canteen->name }}</td>
                                            <td>{{ $canteen->description }}</td>
                                            <td>{{ $canteen->owner->name }}</td>
                                            <td>
                                                <div class="d-flex gap-2 justify-content-center align-items-center">
                                                    <form action="{{ route('canteen.hapus', $canteen->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class="bx bx-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="row d-flex justify-content-center align-items-center gap-5">
                            @foreach ($canteens as $canteen)
                                <div class="card p-3 mb-3 col-md-3 shadow-lg rounded-4">
                                    <div class="d-flex align-items-center justify-content-center" style="height: 200px; overflow: hidden;">
                                        <img src="{{ asset('storage/thumbnail/' . $canteen->thumbnail) }}" class="card-img-top img-fluid" alt="{{ $canteen->name }} Img" style="object-fit: cover; height: 100%; width: 100%;">
                                    </div>
                                    <div class="my-3">
                                        <h5 class="card-title fw-bold"><i class="bi bi-shop"></i> {{ $canteen->name }}</h5>
                                        <p class="card-text">
                                            {{ Str::limit($canteen->description, 20) }}
                                        </p>
                                    </div>
                                    <div class="row d-flex justify-content-center gap-2">
                                        <a href="{{ route('canteens.show', $canteen->unique_code) }}"
                                            class="btn btn-outline-dark btn-sm rounded-5 col-8">
                                            Kunjungi Kantin
                                        </a>
                                        <!-- Button to trigger modal -->
                                        <button data-bs-toggle="modal" data-bs-target="#modal{{ $canteen->id }}"
                                            class="btn btn-outline-primary btn-sm rounded-5 col-3">
                                            <i class="bi bi-info-circle"></i>
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="modal{{ $canteen->id }}" tabindex="-1"
                                            aria-labelledby="modalLabel{{ $canteen->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalLabel{{ $canteen->id }}">
                                                            {{ $canteen->name }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p class="fs-4"><i class="bi bi-person-check"></i> Pemilik: {{ $canteen->owner->name }}</p>
                                                        <p>{{ $canteen->description }}</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Tutup</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
