@extends('layouts.lay-dash')

@section('title', 'Pengaturan Kantin')
@section('content')
    <section class="py-5">
        <div class="container">
            <div class="mb-4">
                <h4 class="text-dark">Pengaturan Kantin</h4>
                <p class="text-dark">Dihalaman ini anda dapat mengatur kantin anda</p>
            </div>
            <div class="card border-0">
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form action="{{ route('settings.update', $canteen->unique_code) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="unique_code" value="{{ $canteen->unique_code }}">
                        <input type="hidden" name="owner_id" value="{{ $canteen->owner_id }}">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Kantin</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name', $canteen->name) }}">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $canteen->description) }}</textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="thumbnail" class="form-label">Thumbnail Kantin</label>
                            @if ($canteen->thumbnail != null)
                                <div>
                                    <img src="{{ asset('storage/thumbnail/' . $canteen->thumbnail) }}" alt="thumbnail" class="img-fluid mb-3 rounded-3 shadow-lg" width="250">
                                </div>
                            @endif
                            <input type="file" class="form-control" id="thumbnail" name="thumbnail">
                            @error('thumbnail')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
