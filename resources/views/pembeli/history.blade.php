@extends('layouts.lay-dash')

@section('title', 'History Pembelian')
@section('content')
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="mb-4">
                <h4 class="text-dark fw-semibold"><i class="bi bi-arrow-clockwise"></i> Riwayat Pembelian</h4>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered text-center">
                            <thead>
                                <tr class="align-middle">
                                    <th>No.</th>
                                    <th>Nama Kantin</th>
                                    <th>Menu</th>
                                    <th>Jumlah</th>
                                    <th>Total Harga</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($transacts->count() == 0)
                                    <tr>
                                        <td colspan="6">Belum ada data</td>
                                    </tr>
                                @else
                                    @foreach ($transacts as $transaction)
                                        <tr class="align-middle">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ \DB::table('canteens')->where('id',\DB::table('products')->where('id', $transaction->product_id)->value('canteen_id'))->value('name') }}
                                            <td>{{ \DB::table('products')->where('id', $transaction->product_id)->value('name') }}
                                            </td>
                                            <td>{{ $transaction->quantity }}</td>
                                            <td>Rp{{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                                            <td class="text-uppercase">
                                                @if ($transaction->status == 'diproses')
                                                    <span
                                                        class="badge bg-warning text-dark">{{ $transaction->status }}</span>
                                                @elseif ($transaction->status == 'selesai')
                                                    <span class="badge bg-success">{{ $transaction->status }}</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ $transaction->status }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
