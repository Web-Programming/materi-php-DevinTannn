@extends('app.master')

@section('title', 'Dashboard')

{{-- Bagian ini yang paling penting agar sidebar tidak hilang --}}
@section('sidebar')
    @parent
@endsection

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body text-center py-5">
            <div class="mb-4">
                {{-- Menggunakan icon speedometer untuk dashboard --}}
                <i class="fas fa-tachometer-alt fa-4x text-gray-200"></i>
            </div>
            <h5 class="text-muted">Selamat Datang</h5>
            <p class="text-muted mb-0">Silakan pilih menu di samping untuk mulai bekerja.</p>
        </div>
    </div>
</div>
@endsection