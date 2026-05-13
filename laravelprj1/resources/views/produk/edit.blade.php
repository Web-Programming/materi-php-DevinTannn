@extends('app.master')

@section('title', $title)

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>{{ $title }}</h1>
        <a href="{{ route('produk.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Batal
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('produk.update', $product->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Nama Produk -->
                <div class="mb-3">
                    <label class="form-label font-weight-bold">Nama Produk</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $product->name) }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <!-- Harga -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label font-weight-bold">Harga</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" name="price" class="form-control @error('price') is-invalid @enderror"
                                value="{{ old('price', $product->price) }}">
                        </div>
                        @error('price')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tanggal Rilis -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label font-weight-bold">Tanggal Rilis</label>
                        <input type="date" name="release_date" class="form-control @error('release_date') is-invalid @enderror"
                            value="{{ old('release_date', $product->release_date) }}">
                        @error('release_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Deskripsi -->
                <div class="mb-3">
                    <label class="form-label font-weight-bold">Deskripsi</label>
                    <textarea name="description" rows="3"
                        class="form-control @error('description') is-invalid @enderror">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <!-- Status -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label font-weight-bold">Status</label>
                        <select name="status" class="form-select">
                            <option value="new" {{ old('status', $product->status) == 'new' ? 'selected' : '' }}>New</option>
                            <option value="used" {{ old('status', $product->status) == 'used' ? 'selected' : '' }}>Used</option>
                        </select>
                    </div>

                    <!-- Is Active -->
                    <div class="col-md-6 mb-3 d-flex align-items-end">
                        <div class="form-check mb-2">
                            <input type="checkbox" name="is_active" class="form-check-input" id="is_active" 
                                {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Produk Aktif / Dijual</label>
                        </div>
                    </div>
                </div>

                <hr>
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-save"></i> Simpan Perubahan
                    </button>
                    <a href="{{ route('produk.index') }}" class="btn btn-light px-4">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection