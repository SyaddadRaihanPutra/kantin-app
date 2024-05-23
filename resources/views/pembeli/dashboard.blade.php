@extends('layouts.lay-dash')

@section('title', 'Dashboard Pembeli')
@section('content')
    <div class="row mt-5">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">History Pembelian</h5>
                    <p class="card-text">Lihat pembelian yang telah kamu lakukan</p>
                    <a href="#" class="btn btn-primary">Lihat</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Keranjang</h5>
                    <p class="card-text">Lihat keranjang belanja kamu</p>
                    <a href="#" class="btn btn-primary">Lihat</a>
                </div>
            </div>
        </div>
    </div>
@endsection
