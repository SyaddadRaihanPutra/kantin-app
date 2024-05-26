@extends('layouts.lay-dash')

@section('title', 'Dashboard Pembeli')
@section('content')
    <div class="row mt-5 gap-3 mb-5">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Kantin SMKN 1 Jakarta</h5>
                    <p class="card-text">Anda dapat melihat daftar kantin yang tersedia</p>
                    <a href="{{ route('canteens.index') }}" class="btn btn-outline-primary col-12">Lihat</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Riwayat pembelian</h5>
                    <p class="card-text">Anda dapat melihat riwayat pembelian anda</p>
                    <a href="{{ route('history.pembeli') }}" class="btn btn-outline-primary col-12">Detail</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Informasi</h5>
                    <div class="alert alert-info mt-3" style="font-size: 13px">
                        <i class="bi bi-info-circle"></i>&nbsp;
                        <span>Versi Beta 1.0 </span>
                    </div>
                    <ul>
                        <li>Developer: <span class="fw-semibold"><a href="https://syaddad.pages.dev">syaddad</a></span></li>
                        <li>Framework: <span class="fw-semibold">Laravel 10</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
