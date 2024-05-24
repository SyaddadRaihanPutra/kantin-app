@extends('layouts.lay-dash')

@section('title', 'Dashboard')
@section('content')
    @if (\DB::table('canteens')->where('owner_id', Auth::user()->id)->exists())
        <section class="py-5">
            <div class="container">
                <div class="mb-4">
                    <h4 class="text-dark">Dashboard Owner</h4>
                    <p class="text-dark">Dihalaman ini anda dapat mengelola kantin yang anda miliki</p>
                </div>
                <div class="row gap-5 justify-content-center">
                    <div class="card col-12 col-md-5 rounded-5 bg-dark">
                        <div class="card-body">
                            <div class="row mb-3">
                                <h4 class="text-white fw-bold"><i class="bi bi-cash-coin fs-1"></i> &nbsp;Total Pemasukan
                                </h4>
                                <p class="text-white">Total pemasukan pada kantin anda</p>
                            </div>
                            <h1 class="text-white">Rp. {{ number_format($totalIncome, 2, ',', '.') }},-</h1>
                        </div>
                    </div>
                    <div class="card col-12 col-md-5 border border-3 border-secondary rounded-5">
                        <div class="card-body">
                            <div class="row mb-3">
                                <h4 class="text-dark fw-bold"><i class="bi bi-graph-up-arrow fs-1"></i> &nbsp;Total
                                    Transaksi</h4>
                                <p class="text-dark">Total transaksi yang terjadi pada kantin anda</p>
                            </div>
                            <div class="row">
                                <div class="col d-flex align-items-center">
                                    <h1 class="text-dark mb-0">{{ $totalTransaction }}</h1>
                                    <a href="{{ route('transactions.index') }}"
                                        class="btn btn-outline-primary btn-sm rounded-5 ms-3">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border-0 mt-5">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card border-0">
                                    <div class="row mb-3">
                                        <div class="col-12 d-flex justify-content-between align-items-center">
                                            <h4 class="bg-white border-0 mb-0">Produk yang anda jual</h4>
                                            <button type="button" class="btn btn-primary btn-sm d-none d-md-block"
                                                data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                Tambah Produk
                                            </button>
                                        </div>
                                        <div class="col-12 mt-3 d-block d-md-none">
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal">
                                                Tambah Produk
                                            </button>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="exampleModal" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Produk</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('products.store') }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="canteen_id"
                                                            value="{{ \DB::table('canteens')->where('owner_id', Auth::user()->id)->first()->id }}">
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Gambar produk</label>
                                                            <input type="file" class="form-control" id="product"
                                                                name="product" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Nama Produk</label>
                                                            <input type="text" class="form-control" id="name"
                                                                name="name" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Deskripsi</label>
                                                            <textarea class="form-control" id="description" name="description" required></textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="price" class="form-label">Harga Produk</label>
                                                            <input type="number" class="form-control" id="price"
                                                                name="price" required>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Tambah
                                                            Produk</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if (session('success'))
                                        <div role="alert" class="alert alert-success alert-dismissible">
                                            <button type="button" data-bs-dismiss="alert" aria-label="Close"
                                                class="btn-close"></button>
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    <div class="table-responsive">
                                        <table class="table text-nowrap text-center">
                                            <thead>
                                                <tr class="align-middle">
                                                    <th>No.</th>
                                                    <th>Gambar</th>
                                                    <th>Nama Produk</th>
                                                    <th>Deskripsi</th>
                                                    <th>Harga</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($products as $product)
                                                    <tr valign="middle">
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>
                                                            <div class="position-relative"
                                                                style="width: 100%; padding-top: 100%;">
                                                                <img src="{{ asset('storage/product/' . $product->product) }}"
                                                                    class="card-img-top position-absolute top-0 start-0 w-100 h-100 shadow-sm"
                                                                    alt="{{ $product->name }} Img"
                                                                    style="object-fit: contain;">
                                                            </div>
                                                        </td>
                                                        <td>{{ $product->name }}</td>
                                                        <td>{{ $product->description }}</td>
                                                        <td>Rp. {{ number_format($product->price, 2, ',', '.') }}</td>
                                                        <td>
                                                            <button type="button"
                                                                class="btn btn-primary btn-sm rounded-5"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#exampleModal{{ $product->id }}">
                                                                <i class="bi bi-pencil-square"></i> </button>
                                                            <div class="modal fade" id="exampleModal{{ $product->id }}"
                                                                tabindex="-1" aria-labelledby="exampleModalLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="exampleModalLabel">
                                                                                Edit
                                                                                Produk</h5>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form
                                                                                action="{{ route('products.update', $product->id) }}"
                                                                                method="POST"
                                                                                enctype="multipart/form-data">
                                                                                @csrf
                                                                                @method('PUT')
                                                                                <input type="hidden" name="canteen_id"
                                                                                    value="{{ \DB::table('canteens')->where('owner_id', Auth::user()->id)->first()->id }}">
                                                                                <div class="mb-3">
                                                                                    <label for="name"
                                                                                        class="form-label">Gambar
                                                                                        produk</label>
                                                                                    <input type="file"
                                                                                        class="form-control"
                                                                                        id="product" name="product"
                                                                                        required>
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label for="name"
                                                                                        class="form-label">Nama
                                                                                        Produk</label>
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        id="name" name="name"
                                                                                        value="{{ $product->name }}"
                                                                                        required>
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label for="name"
                                                                                        class="form-label">Deskripsi</label>
                                                                                    <textarea class="form-control" id="description" name="description" required>{{ $product->description }}</textarea>
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label for="price"
                                                                                        class="form-label">Harga
                                                                                        Produk</label>
                                                                                    <input type="number"
                                                                                        class="form-control"
                                                                                        id="price" name="price"
                                                                                        value="{{ $product->price }}"
                                                                                        required
                                                                                        onkeypress="return isNumberKey(event);"
                                                                                        oninput="validateNumberInput(this);">

                                                                                    <script>
                                                                                        function isNumberKey(evt) {
                                                                                            var charCode = (evt.which) ? evt.which : evt.keyCode;
                                                                                            // Allow only numbers (0-9)
                                                                                            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                                                                                                return false;
                                                                                            }
                                                                                            return true;
                                                                                        }

                                                                                        function validateNumberInput(input) {
                                                                                            // Remove any non-numeric characters
                                                                                            input.value = input.value.replace(/[^0-9]/g, '');
                                                                                        }
                                                                                    </script>

                                                                                </div>
                                                                                <button type="submit"
                                                                                    class="btn btn-primary">Edit
                                                                                    Produk</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <form action="{{ route('products.destroy', $product->id) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-danger btn-sm rounded-5"><i class="bi bi-trash"></i></button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @else
        <section class="py-5">
            <div class="container">
                <div class="mb-4">
                    <h4 class="text-dark">Buat Kantin Anda</h4>
                    <p class="text-dark">Anda belum memiliki kantin, silahkan buat kantin anda sekarang</p>
                </div>
                <div class="card border-0">
                    <div class="card-body">
                        <div class="alert alert-info" role="alert">
                            <i class="bi bi-info-circle"></i> &nbsp; <strong>Info!</strong> &nbsp; <br> <br>
                            <p>Anda belum memiliki kantin, silahkan buat kantin anda sekarang</p>
                        </div>
                        <form action="{{ route('canteens.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="owner_id" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="unique_code" value="{{ Str::random(10) }}">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Kantin</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Deskripsi Kantin</label>
                                <textarea class="form-control" id="description" name="description" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="thumbnail" class="form-label">Foto Kantin</label>
                                <input type="file" class="form-control" id="thumbnail" name="thumbnail" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Tambah Kantin</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection
