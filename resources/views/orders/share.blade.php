<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Transaksi</title>
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/boxicons/css/boxicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            .card, .card * {
                visibility: visible;
            }
            #printBtn {
                display: none;
            }
        }
    </style>
</head>

<body>
    @php
        $transact = Request::segment(2);
        $product = \DB::table('transactions')->where('id', $transact)->value('product_id');
        $quantity = \DB::table('transactions')->where('id', $transact)->value('quantity');
        $total_price = \DB::table('transactions')->where('id', $transact)->value('total_price');
        $status = \DB::table('transactions')->where('id', $transact)->value('status');
        $canteen_name = \DB::table('canteens')
            ->where('id', \DB::table('products')->where('id', $product)->value('canteen_id'))
            ->value('name');
    @endphp
    <div class="container pt-5" style="width: 100%">
        <div class="col-md-5 col-12 mx-auto d-block">
            <div class="card shadow-lg border-dark border-3 p-4 m-3" style="border-style: dashed">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex align-items-center justify-content-center flex-column">
                            <i class="bi bi-check-circle-fill text-success" style="font-size: 60px"></i>
                            <h4>Transaksi Berhasil</h4>
                        </div>
                        <hr>
                        <p class="fw-semibold text-uppercase" style="color: #959595">
                            <small>Detail Produk</small>
                        </p>
                        <p class="d-flex justify-content-between">
                            <span><strong>{{ \DB::table('products')->where('id', $product)->value('name') }}</strong></span>
                            <span>Rp.
                                {{ number_format(\DB::table('products')->where('id', $product)->value('price'), 0, ',', '.') }}
                        </p>
                        <hr>
                        <p><strong>Quantity:</strong> {{ $quantity }}</p>
                        <p><strong>Total Price:</strong> Rp. {{ number_format($total_price, 0, ',', '.') }}</p>
                        <p><strong>Status:</strong>
                            @if ($status == 'diproses')
                                <span class="text-warning fw-semibold text-uppercase">{{ $status }}</span>
                            @elseif ($status == 'selesai')
                                <span class="text-success fw-semibold text-uppercase">{{ $status }}</span>
                            @else
                                <span class="text-danger fw-semibold text-uppercase">{{ $status }}</span>
                            @endif
                        <p><strong>Order Date:</strong>
                            {{ \DB::table('transactions')->where('id', $transact)->value('created_at') }}</p>
                        <p class="mt-5 text-center">
                            Hormat kami,<br>
                            <strong>{{ $canteen_name }}</strong>
                        </p>
                    </div>
                </div>
            </div>
            <button class="btn btn-outline-primary d-block mx-auto w-50 mt-5" id="printBtn" onclick="printPage()">
                <i class="bi bi-printer"></i> &nbsp;Print</button>
            <script>
                function printPage() {
                    var printBtn = document.getElementById('printBtn');
                    printBtn.style.display = 'none';
                    window.print();
                    setTimeout(function() {
                        printBtn.style.display = 'block';
                    }, 1000); // Timeout to ensure print dialog is completed
                }
            </script>
        </div>
    </div>
</body>

</html>
