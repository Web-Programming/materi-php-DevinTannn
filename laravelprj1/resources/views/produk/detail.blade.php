@extends('app.master')

@section('title', $title)

@section('sidebar')
    @parent
    @section('submenu-produk')
        <a href="{{ route('produk.create') }}"
            class="list-group-item list-group-item-action ps-4 
            {{ request()->is('produk/create') ? 'active' : '' }}">Tambah Produk</a>
        <a href="{{ route('produk.search') }}"
            class="list-group-item list-group-item-action ps-4 
            {{ request()->is('produk/search') ? 'active' : '' }}">Cari Produk</a>
    @endsection
@endsection

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>{{ $title }}</h1>
        <a href="{{ route('produk.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali ke Daftar
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Informasi Produk</h5>
        </div>
        <div class="card-body">
            
            <div class="row mb-3 align-items-center">
                <div class="col-md-3 d-flex justify-content-between">
                    <strong>ID Produk</strong>
                    <span>:</span>
                </div>
                <div class="col-md-9">
                    {{ $product->id }}
                </div>
            </div>

            <div class="row mb-3 align-items-center">
                <div class="col-md-3 d-flex justify-content-between">
                    <strong>Nama Produk</strong>
                    <span>:</span>
                </div>
                <div class="col-md-9">
                    {{ $product->name }}
                </div>
            </div>

            <div class="row mb-3 align-items-center">
                <div class="col-md-3 d-flex justify-content-between">
                    <strong>Harga</strong>
                    <span>:</span>
                </div>
                <div class="col-md-9">
                    <span class="badge bg-success fs-6">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                </div>
            </div>

            <div class="row mb-3 align-items-center">
                <div class="col-md-3 d-flex justify-content-between">
                    <strong>Stok Tersedia</strong>
                    <span>:</span>
                </div>
                <div class="col-md-9">
                    @if($product->stock > 0)
                        <span class="badge bg-info text-dark fs-6">{{ $product->stock }} Pcs</span>
                    @else
                        <span class="badge bg-danger fs-6">Stok Habis</span>
                    @endif
                </div>
            </div>

            <div class="row mb-3 align-items-center">
                <div class="col-md-3 d-flex justify-content-between">
                    <strong>Kondisi</strong>
                    <span>:</span>
                </div>
                <div class="col-md-9">
                    <span class="text-capitalize badge bg-light text-dark border fs-6">{{ $product->status }}</span>
                </div>
            </div>

            <div class="row mb-3 align-items-center">
                <div class="col-md-3 d-flex justify-content-between">
                    <strong>Status Penjualan</strong>
                    <span>:</span>
                </div>
                <div class="col-md-9">
                    @if($product->is_active == 1)
                        <span class="badge bg-success fs-6"><i class="bi bi-check-circle me-1"></i>Tersedia / Aktif</span>
                    @else
                        <span class="badge bg-secondary fs-6"><i class="bi bi-x-circle me-1"></i>Tidak Tersedia / Nonaktif</span>
                    @endif
                </div>
            </div>

        </div>
        
        <div class="card-footer bg-light">
            <a href="{{ route('produk.edit', $product->id) }}" class="btn btn-primary">
                <i class="bi bi-pencil"></i> Edit Produk
            </a>
            <a href="{{ route('produk.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-list"></i> Lihat Semua Produk
            </a>
        </div>
    </div>
</div>
@endsection