@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Testimoni User -->
            @if($userTestimoni)
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Testimoni Anda</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-start">
                        <div class="ms-3">
                            <h6 class="mb-1">{{ $userTestimoni->alumni->nama_depan }} {{ $userTestimoni->alumni->nama_belakang }}</h6>
                            <small class="text-muted">{{ \Carbon\Carbon::parse($userTestimoni->tgl_testimoni)->format('d M Y') }}</small>
                            <p class="mt-2">{{ $userTestimoni->testimoni }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="card mb-4">
                <div class="card-body text-center">
                    <p>Anda belum memberikan testimoni.</p>
                    <a href="{{ route('testimoni.create') }}" class="btn btn-primary">Buat Testimoni</a>
                </div>
            </div>
            @endif

            <!-- Testimoni Terbaru -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Testimoni Terbaru Alumni</h5>
                </div>
                <div class="card-body">
                    @if($recentTestimonis->count() > 0)
                        @foreach($recentTestimonis as $testimoni)
                        <div class="border-bottom mb-3 pb-3">
                            <div class="d-flex align-items-start">
                                <div class="ms-3">
                                    <h6 class="mb-1">{{ $testimoni->alumni->nama_depan }} {{ $testimoni->alumni->nama_belakang }}</h6>
                                    <small class="text-muted">{{ \Carbon\Carbon::parse($testimoni->tgl_testimoni)->format('d M Y') }}</small>
                                    <p class="mt-2">{{ $testimoni->testimoni }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <p class="text-center">Belum ada testimoni.</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Menu Cepat</h5>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        <a href="{{ route('tracer_kuliah.create') }}" class="list-group-item list-group-item-action">
                            Isi Tracer Study Kuliah
                        </a>
                        <a href="{{ route('tracer_kerja.create') }}" class="list-group-item list-group-item-action">
                            Isi Tracer Study Kerja
                        </a>
                        <a href="{{ route('testimoni.create') }}" class="list-group-item list-group-item-action">
                            Buat Testimoni
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    margin-bottom: 1.5rem;
}

.card-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid rgba(0,0,0,.125);
}

.border-bottom:last-child {
    border-bottom: none !important;
    margin-bottom: 0 !important;
    padding-bottom: 0 !important;
}
</style>
@endsection 