@extends('layouts.lay-dash')

@section('title', 'List Transaksi Kantin Anda')
@section('content')
    <section class="py-5">
        <div class="container">
            <div class="mb-4">
                <h4 class="text-dark">List Transaksi Kantin Anda</h4>
            </div>
            <div class="card border-0">
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered text-center text-nowrap">
                            <thead>
                                <tr class="align-middle">
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col">Harga Produk</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Pembeli</th>
                                    <th scope="col">Total Pembelian</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transacts as $transact)
                                    <tr class="align-middle">
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ \DB::table('products')->where('id', $transact->product_id)->value('name') }}
                                        </td>
                                        <td>{{ number_format(\DB::table('products')->where('id', $transact->product_id)->value('price'),0,',','.') }}
                                        </td>
                                        <td>{{ $transact->quantity }} pcs</td>
                                        <td>{{ \DB::table('users')->where('id', $transact->user_id)->value('name') }}</td>
                                        <td>Rp {{ number_format($transact->total_price, 0, ',', '.') }}</td>
                                        <td class="text-uppercase">
                                            @if ($transact->status == 'diproses')
                                                <span class="badge bg-warning text-dark">{{ $transact->status }}</span>
                                            @elseif ($transact->status == 'selesai')
                                                <span class="badge bg-success">{{ $transact->status }}</span>
                                            @else
                                                <span class="badge bg-secondary">{{ $transact->status }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#detail{{ $transact->id }}">
                                                <i class="bi bi-hourglass-split"></i>
                                            </button>
                                            <div class="modal fade" id="detail{{ $transact->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Ubah status</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body" style="text-align: left!important">
                                                            <div class="mb-3">
                                                                <form
                                                                    action="{{ route('transactions.update', $transact->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="mb-3">
                                                                        <select class="form-select form-select-sm"
                                                                            name="status" id="status">
                                                                            <option value="diproses"
                                                                                {{ $transact->status == 'diproses' ? 'selected' : '' }}>
                                                                                Pending</option>
                                                                            <option value="selesai"
                                                                                {{ $transact->status == 'selesai' ? 'selected' : '' }}>
                                                                                Success</option>
                                                                            <option value="dibatalkan"
                                                                                {{ $transact->status == 'dibatalkan' ? 'selected' : '' }}>
                                                                                Cancel</option>
                                                                        </select>
                                                                    </div>
                                                                    <button type="submit"
                                                                        class="btn btn-outline-primary btn-sm col-12 rounded-5">Ubah
                                                                        status</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <form action="{{ route('transactions.destroy', $transact->id) }}"
                                                onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?')"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"><i
                                                        class="bi bi-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $transacts->links() }}
                    <p><small>Showing {{ $transacts->count() }} of {{ $transacts->total() }} entries</small></p>
                </div>
            </div>
        </div>
    </section>
@endsection
