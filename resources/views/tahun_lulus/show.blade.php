@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Tahun Lulus</h1>

    <div class="card">
        <div class="card-header">
            Tahun Lulus: {{ $tahunLulus->tahun_lulus }}
        </div>
        <div class="card-body">
            <p><strong>Keterangan:</strong> {{ $tahunLulus->keterangan }}</p>
        </div>
    </div>

    <a href="{{ route('tahun_lulus.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection