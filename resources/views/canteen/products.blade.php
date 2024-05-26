@extends('layouts.lay-dash')

@section('title', 'Produk Kantin')
@section('content')
    <style>
        /* Hide the up and down arrows in number input fields */
        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield;
            /* Firefox */
        }
    </style>
    <section class="py-5">
        <div class="container">
            <a class="btn btn-outline-dark mb-3 btn-sm" href="{{ route('canteens.index') }}">
                <i class="bx bx-arrow-back"></i> Kembali </a>
            <div class="mb-4">
                <h4 class="text-dark fw-semibold"><i class="bi bi-shop"></i> Daftar Produk di
                    {{ \DB::table('canteens')->where('unique_code', Request::segment(2))->value('name') }}
                </h4>
            </div>
            <div class="card border-0">
                <div class="card-body">
                    @if (Auth::user()->role == 'admin')
                        <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">
                            <i class="bx bx-plus"></i> Tambah Produk
                        </a>
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Produk</th>
                                        <th>Deskripsi</th>
                                        <th>Harga</th>
                                        <th>Kantin</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr class="align-middle">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->description }}</td>
                                            <td>{{ $product->price }}</td>
                                            <td>{{ $product->canteen->name }}</td>
                                            <td>
                                                <div class="d-flex gap-2 align-items-center">
                                                    <form action="{{ route('products.destroy', $product->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-light">
                                                            <i class="bx bx-trash"></i> Hapus
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
                        <div class="modal fade" id="invoiceModal" tabindex="-1" aria-labelledby="invoiceModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="invoiceModalLabel">Invoice <p class="fw-semibold"
                                                style="font-size: 17px"><i><u>#{{ session('id') }}</u></i></p>
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container">
                                            @if (session('success'))
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div
                                                            class="d-flex align-items-center justify-content-center flex-column">
                                                            <i class="bi bi-check-circle-fill text-success"
                                                                style="font-size: 60px"></i>
                                                            <h4>Transaksi Berhasil</h4>
                                                        </div>
                                                        <hr>
                                                        <p class="fw-semibold text-uppercase" style="color: #959595">
                                                            <small>Detail Produk</small>
                                                        </p>
                                                        <p class="d-flex justify-content-between">
                                                            <span><strong>{{ \DB::table('products')->where('id', session('product_id'))->value('name') }}</strong></span>
                                                            <span>Rp.
                                                                {{ number_format(\DB::table('products')->where('id', session('product_id'))->value('price')) }}</span>
                                                        </p>
                                                        <hr>
                                                        <p><strong>Quantity:</strong> {{ session('quantity') }} pcs</p>
                                                        <p><strong>Total Price:</strong> Rp.
                                                            {{ number_format(session('total_price'), 0, ',', '.') }}</p>
                                                        <p><strong>Status:</strong> <span
                                                                class="text-uppercase badge bg-warning text-dark">{{ session('status') }}</span>
                                                        </p>
                                                        <p><strong>Order Date:</strong> {{ session('created_at') }}</p>
                                                    </div>
                                                </div>
                                            @else
                                                <p>No order data available.</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" onclick="window.print();">Print
                                            Invoice</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if (session('success'))
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    var invoiceModal = new bootstrap.Modal(document.getElementById('invoiceModal'), {});
                                    invoiceModal.show();
                                });
                            </script>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        <div class="row d-flex justify-content-center align-items-center gap-5">
                            @if ($products->count() == 0)
                                <div class="col-12">
                                    <div class="alert alert-warning">Belum ada produk</div>
                                </div>
                            @else
                                @foreach ($products as $product)
                                    <div class="card p-4 mb-3 col-12 col-sm-6 col-md-4 col-lg-3 shadow-lg rounded-4">
                                        <img src="{{ asset('storage/product/' . $product->product) }}" class="card-img-top"
                                            alt="{{ $product->name }} Img"
                                            style="object-fit: contain; width: 100%; height: 150px;">
                                        <div class="my-3">
                                            <h5 class="card-title fw-semibold fs-3">{{ $product->name }}</h5>
                                            <p class="card-text">{{ $product->description }}</p>
                                            <p class="card-text fs-3 text-center">Rp.
                                                {{ number_format($product->price, 0, ',', '.') }},-</p>
                                        </div>
                                        <hr>
                                        <div class="row d-flex justify-content-center gap-2">
                                            <form action="{{ route('orders.store') }}" method="POST" class="w-100">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <input type="hidden" name="status" value="diproses">
                                                @php $inputId = 'quantity-input-' . $loop->index; @endphp
                                                <div class="input-group mb-3 d-flex justify-content-center">
                                                    <div class="d-flex">
                                                        <button class="btn btn-outline-secondary btn-sm" type="button"
                                                            onclick="decrement('{{ $inputId }}')"
                                                            id="button-decrement-{{ $loop->index }}">-</button>
                                                        <input type="number" name="quantity"
                                                            class="border-0 ms-2 text-center fw-semibold fs-4"
                                                            value="1" min="1" id="{{ $inputId }}"
                                                            style="max-width: 55px;">
                                                    </div>
                                                    <div class="d-flex ms-2">
                                                        <button class="btn btn-outline-secondary btn-sm" type="button"
                                                            onclick="increment('{{ $inputId }}')"
                                                            id="button-increment-{{ $loop->index }}">+</button>
                                                    </div>
                                                </div>
                                                <button type="submit"
                                                    class="btn btn-primary btn-block w-100 d-block d-md-inline mt-2 mt-md-0">Pesan</button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        <script>
                            function increment(inputId) {
                                document.getElementById(inputId).stepUp();
                            }

                            function decrement(inputId) {
                                document.getElementById(inputId).stepDown();
                            }
                        </script>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
