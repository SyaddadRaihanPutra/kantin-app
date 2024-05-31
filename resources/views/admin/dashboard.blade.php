@extends('layouts.lay-dash')

@section('title', 'Dashboard')
@section('content')
    <section class="py-5">
        <div class="container">
            <div class="mb-4">
                <h4 class="text-dark">Dashboard</h4>
                <p class="text-dark">Selamat datang di dashboard admin</p>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card border-3 border border-primary text-dark mb-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <i class="bx bx-store" style="font-size: 75px"></i>
                                <div>
                                    <h5 class="card-title">Total Kantin</h5>
                                    <h2 class="card-text">{{ $cu }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-3 border border-primary text-dark mb-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <i class="bx bx-bowl-rice" style="font-size: 75px"></i>
                                <div>
                                    <h5 class="card-title">Total Produk</h5>
                                    <h2 class="card-text">{{ $cp }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-3 border border-primary text-dark mb-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <i class="bx bx-transfer-alt" style="font-size: 75px"></i>
                                <div>
                                    <h5 class="card-title">Total Transaksi</h5>
                                    <h2 class="card-text">{{ $ct }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card shadow-md text-dark mb-4">
                        <div class="card-body">
                            <h5 class="card-title"
                                style="font-size: 1.25rem; font-weight: 600; color: #000; margin-bottom: 1.25rem;">
                                Transaksi Terbaru</h5>
                            <div id="chart"></div>
                            <div class="table-responsive">
                                <table
                                    class="table table-hover text-center pe-auto text-nowrap table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nama Produk</th>
                                            <th scope="col">Kantin</th>
                                            <th scope="col">Pembeli</th>
                                            <th scope="col">Jumlah</th>
                                            <th scope="col">Total</th>
                                            <th scope="col">Tanggal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($latestTransactions as $lt)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $lt->product->name }}</td>
                                                <td>{{ $lt->product->canteen->name }}</td>
                                                <td>{{ $lt->user->name }}</td>
                                                <td>{{ $lt->quantity }} pcs</td>
                                                <td>Rp. {{ number_format($lt->total_price, 0, ',', '.') }}
                                                </td>
                                                <td>{{ $lt->created_at->format('d M Y H:i') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $latestTransactions->links() }}
                                <p><i><small>Show {{ $latestTransactions->count() }} of {{ $latestTransactions->total() }} transactions.</small></i></p>
                            </div>
                            <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
                            @php
                                $products = [];
                                $canteens = [];
                                $buyers = [];
                                $quantities = [];
                                $totals = [];
                                $dates = [];

                                foreach ($latestTransactions as $lt) {
                                    $products[] = $lt->product->name;
                                    $canteens[] = $lt->product->canteen->name;
                                    $buyers[] = $lt->user->name;
                                    $quantities[] = $lt->quantity;
                                    $totals[] = $lt->total_price;
                                    $dates[] = $lt->created_at->format('d M Y H:i');
                                }
                            @endphp
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    var options = {
                                        chart: {
                                            type: 'bar',
                                            height: 350
                                        },
                                        series: [{
                                            name: 'Total',
                                            data: @json($totals)
                                        }],
                                        xaxis: {
                                            categories: @json($dates)
                                        },
                                        yaxis: {
                                            title: {
                                                text: 'Total (Rp)'
                                            }
                                        },
                                    };
                                    var chart = new ApexCharts(document.querySelector("#chart"), options);
                                    chart.render();
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
