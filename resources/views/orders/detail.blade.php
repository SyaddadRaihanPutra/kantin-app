@extends('layouts.lay-dash')

@section('title', 'Detail Pesanan')
@section('content')
    <section class="py-5">
        <div class="container">
            <div class="mb-4">
                <h4 class="text-dark fw-semibold">Detail Pesanan</h4>
            </div>
            <div class="card border-0">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Produk</th>
                                    <th>Jumlah</th>
                                    <th>Total Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->products as $product)
                                    <tr class="align-middle">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->pivot->quantity }}</td>
                                        <td>Rp {{ number_format($product->pivot->total_price, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="fw-semibold">Total Harga</p>
                            <p class="fw-semibold">Status</p>
                        </div>
                        <div>
                            <p>Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                            <p>{{ $order->status }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
