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
            <i class="bi bi-arrow-left"></i> Kembali ke Daftar
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Informasi Supplier</h5>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-3">
                    <strong>ID Supplier:</strong>
                </div>
                <div class="col-md-9">
                    {{ $supplier->id }}
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3">
                    <strong>Nama Supplier:</strong>
                </div>
                <div class="col-md-9">
                    {{ $supplier->name }}
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3">
                    <strong>Telepon:</strong>
                </div>
                <div class="col-md-9">
                    <i class="bi bi-telephone"></i> {{ $supplier->phone }}
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3">
                    <strong>Alamat:</strong>
                </div>
                <div class="col-md-9">
                    <i class="bi bi-geo-alt"></i> {{ $supplier->address ?? '-' }}
                </div>
            </div>
        </div>
        <div class="card-footer bg-light">
            <a href="{{ url('/supplier/' . $supplier->id . '/edit') }}" class="btn btn-primary shadow-sm">
                <i class="bi bi-pencil"></i> Edit Supplier
            </a>
            <a href="{{ route('supplier.index') }}" class="btn btn-secondary shadow-sm">
                <i class="bi bi-list"></i> Lihat Semua Supplier
            </a>
        </div>
    </div>
</div>
@endsection