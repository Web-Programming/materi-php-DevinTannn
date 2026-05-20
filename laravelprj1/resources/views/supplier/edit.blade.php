@extends('app.master')

@section('title', $title)

@section('sidebar')
    @parent
    @section('submenu-supplier')
        {{-- Hanya menampilkan Tambah dan Cari dengan border-bottom --}}
        <a href="{{ route('supplier.create') }}" class="list-group-item list-group-item-action ps-4 border-bottom {{ request()->is('supplier/create') ? 'bg-secondary bg-opacity-10 text-dark fw-bold' : 'text-muted' }}">
            <i class="fas fa-plus-circle me-2"></i>Tambah Supplier
        </a>
        <a href="{{ route('supplier.search') }}" class="list-group-item list-group-item-action ps-4 border-bottom {{ request()->is('supplier/search') ? 'bg-secondary bg-opacity-10 text-dark fw-bold' : 'text-muted' }}">
            <i class="fas fa-search me-2"></i>Cari Supplier
        </a>
    @endsection
@endsection

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
        <a href="{{ route('supplier.index') }}" class="btn btn-secondary shadow-sm">
            <i class="bi bi-arrow-left"></i> Batal
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('supplier.update', $supplier->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-bold">Nama Supplier</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $supplier->name) }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Nomor Telepon</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                            value="{{ old('phone', $supplier->phone) }}">
                    </div>
                    @error('phone')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Alamat Supplier</label>
                    <textarea name="address" rows="4" class="form-control @error('address') is-invalid @enderror">{{ old('address', $supplier->address) }}</textarea>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <hr>
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary px-4 shadow-sm">
                        <i class="bi bi-save"></i> Simpan Perubahan
                    </button>
                    <a href="{{ route('supplier.index') }}" class="btn btn-light px-4 border">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection