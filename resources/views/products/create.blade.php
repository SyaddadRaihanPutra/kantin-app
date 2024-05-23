@extends('layouts.lay-dash')

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="mb-4">
                <h4 class="text-dark">Tambah Produk</h4>
                {{-- <p class="text-dark">Dihalaman ini anda dapat menamb semua kantin yang ada di SMKN 1 Jakarta</p> --}}
            </div>
            <div class="card border-0">
                <div class="card-body">
                    <form action="{{ route('products.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Harga Produk</label>
                            <input type="number" class="form-control" id="price" name="price" required>
                        </div>
                        <div class="mb-3">
                            <label for="stock" class="form-label">Stok Produk</label>
                            <input type="number" class="form-control" id="stock" name="stock" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah Produk</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
