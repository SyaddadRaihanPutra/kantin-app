@extends('layouts.lay-dash')

@section('title', 'List Transaksi Kantin Anda')
@section('content')
    <section class="py-5">
        <div class="container">
            <div class="mb-4">
                <h4 class="text-dark">List Transaksi Kantin Anda</h4>
                {{-- <p class="text-dark">Dihalaman ini anda dapat menambahkan semua kantin yang ada di SMKN 1 Jakarta</p> --}}
            </div>
            <div class="card border-0">
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Harga Produk</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Pembeli</th>
                                <th scope="col">Total Pembelian</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transacts as $transact)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ \DB::table('products')->where('id', $transact->product_id)->value('name') }}</td>
                                    <td>{{ number_format(\DB::table('products')->where('id', $transact->product_id)->value('price'), 0, ',', '.') }}</td>
                                    <td>{{ $transact->quantity }} pcs</td>
                                    <td>{{ \DB::table('users')->where('id', $transact->user_id)->value('name') }}</td>
                                    <td>Rp {{ number_format($transact->total_price, 0, ',', '.') }}</td>
                                    <td>
                                        <form action="{{ route('transactions.destroy', $transact->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
