@extends('layouts.lay-dash')

@section('title', 'Dashboard')
@section('content')
    <section class="py-5">
        <div class="container">
            <div class="mb-4">
                <h4 class="text-dark">Dashboard</h4>
                <p class="text-dark">Selamat datang di dashboard admin</p>
            </div>
            <div class="card border-0">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Lengkap</th>
                                    <th>Alamat Email</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            {{-- <tbody>
                                @foreach ($transacts as $transact)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $transact->user->name }}</td>
                                        <td>{{ $transact->user->email }}</td>
                                        <td>
                                            <a href="{{ route('admin.transact.show', $transact->id) }}"
                                                class="btn btn-primary btn-sm">Detail</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody> --}}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
