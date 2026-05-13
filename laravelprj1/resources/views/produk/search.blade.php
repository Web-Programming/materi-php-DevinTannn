@extends('app.master')

@section('title', 'Pencarian Produk')

@section('sidebar')
    @parent
    @section('submenu-produk')
        <a href="{{ route('produk.index') }}" class="list-group-item list-group-item-action ps-4">
            <i class="fas fa-list me-2"></i>Daftar Produk
        </a>
        <a href="{{ route('produk.search') }}" class="list-group-item list-group-item-action ps-4 active">
            <i class="fas fa-search me-2"></i>Cari Produk
        </a>
    @endsection
@endsection

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Cari Produk</h1>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form action="{{ route('produk.search') }}" method="GET">
                <div class="input-group input-group-lg">
                    <input type="text" name="keyword" class="form-control" 
                           placeholder="Ketik nama produk lalu tekan Enter..." 
                           value="{{ request('keyword') }}" autofocus>
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search me-1"></i> Cari
                    </button>
                </div>
            </form>
        </div>
    </div>

    @if(request('keyword'))
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h6 class="mb-0">Hasil Pencarian untuk: "<strong>{{ request('keyword') }}</strong>"</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td class="text-center">
                                <a href="{{ route('produk.show', $item->id) }}" class="btn btn-sm btn-info text-white">Detail</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-4">Produk tidak ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $products->appends(['keyword' => request('keyword')])->links() }}
            </div>
        </div>
    </div>
    @else
    <div class="text-center py-5">
        <i class="fas fa-search fa-4x text-gray-300 mb-3"></i>
        <p class="text-muted">Silakan masukkan kata kunci untuk mulai mencari produk.</p>
    </div>
    @endif
</div>
@endsection