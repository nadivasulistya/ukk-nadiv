@extends('layouts.user')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Detail Testimoni</h5>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <div class="d-flex align-items-center mb-3">
                            <img src="{{ asset('images/default-avatar.png') }}" alt="Profile" class="rounded-circle" style="width: 64px; height: 64px;">
                            <div class="ms-3">
                                <h5 class="mb-1">{{ $testimoni->alumni->nama_depan }} {{ $testimoni->alumni->nama_belakang }}</h5>
                                <p class="text-muted mb-0">
                                    <i class="bi bi-calendar"></i>
                                    {{ \Carbon\Carbon::parse($testimoni->tgl_testimoni)->format('d M Y') }}
                                </p>
                            </div>
                        </div>
                        
                        <div class="testimoni-content">
                            <p class="mb-0">{{ $testimoni->testimoni }}</p>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        
                        @if(auth()->user()->id === $testimoni->alumni->user_id)
                        <div>
                            <a href="{{ route('testimoni.edit', $testimoni->id_testimoni) }}" class="btn btn-warning">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <form action="{{ route('testimoni.destroy', $testimoni->id_testimoni) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus testimoni ini?')">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.testimoni-content {
    background-color: #f8f9fa;
    border-radius: 0.5rem;
    padding: 1.5rem;
    margin: 1rem 0;
}

.card {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}

.btn {
    margin-left: 0.5rem;
}

.btn:first-child {
    margin-left: 0;
}
</style>
@endsection 