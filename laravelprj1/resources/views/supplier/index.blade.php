@extends('app.master')

@section('title', $title)

@section('sidebar')
    @parent
    @section('submenu-supplier')
        <a href="{{ route('supplier.create') }}" class="list-group-item list-group-item-action ps-4 {{ request()->is('supplier/create') ? 'active' : '' }}">
            <i class="fas fa-plus-circle me-2"></i>Tambah Supplier
        </a>
        <a href="{{ route('supplier.search') }}" class="list-group-item list-group-item-action ps-4 {{ request()->is('supplier/search') ? 'active' : '' }}">
            <i class="fas fa-search me-2"></i>Cari Supplier
        </a>
    @endsection
@endsection

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
        {{-- Tombol Tambah di bagian atas tabel --}}
        <a href="{{ route('supplier.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Supplier Baru
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th width="50">No</th>
                            <th>Nama Supplier</th>
                            <th>Telepon</th>
                            <th>Alamat</th>
                            <th width="280" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($suppliers as $supplier)
                        <tr>
                            <td>{{ ($suppliers->currentPage() - 1) * $suppliers->perPage() + $loop->iteration }}</td>
                            <td>{{ $supplier->name }}</td>
                            <td>{{ $supplier->phone }}</td>
                            <td>{{ $supplier->address ?? '-' }}</td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    {{-- Tombol Detail --}}
                                    <a href="{{ route('supplier.show', $supplier->id) }}" class="btn btn-sm btn-info text-white">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                    
                                    {{-- Tombol Edit --}}
                                    <a href="{{ route('supplier.edit', $supplier->id) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>

                                    {{-- Tombol Hapus --}}
                                    <form action="{{ route('supplier.destroy', $supplier->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus supplier {{ $supplier->name }}?')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">Data supplier tidak ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="d-flex justify-content-between align-items-center mt-3">
                <small class="text-muted">
                    Menampilkan {{ $suppliers->firstItem() ?? 0 }} sampai {{ $suppliers->lastItem() ?? 0 }} dari {{ $suppliers->total() }} supplier
                </small>
                <div>
                    {{-- Navigasi Pagination --}}
                    {{ $suppliers->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection