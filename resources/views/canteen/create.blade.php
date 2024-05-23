@extends('layouts.lay-dash')

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="mb-4">
                <h4 class="text-dark">Tambah Kantin</h4>
                {{-- <p class="text-dark">Dihalaman ini anda dapat menamb semua kantin yang ada di SMKN 1 Jakarta</p> --}}
            </div>
            <div class="card border-0">
                <div class="card-body">
                    <form action="{{ route('canteens.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Kantin</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Deskripsi</label>
                            <textarea name="description" id="description" class="form-control" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="stock" class="form-label">Pemilik</label>
                            <select name="owner_id" id="owner_id" class="form-select" required>
                                <option value="" selected disabled>Pilih Pemilik</option>
                                @foreach ($owners as $owner)
                                    <option value="{{ $owner->id }}">{{ $owner->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah Produk</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
