@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Data Tracer Kerja</h2>
    
    <a href="{{ route('tracer_kerja.create') }}" class="btn btn-primary mb-3">Tambah Data</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Alumni</th>
                <th>Pekerjaan</th>
                <th>Perusahaan</th>
                <th>Jabatan</th>
                <th>Status</th>
                <th>Gaji</th>
                <th>Tanggal Mulai</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tracerKerjas as $index => $tracerKerja)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $tracerKerja->alumni->nama_depan }} {{ $tracerKerja->alumni->nama_belakang }}</td>
                <td>{{ $tracerKerja->tracer_kerja_pekerjaan }}</td>
                <td>{{ $tracerKerja->tracer_kerja_nama }}</td>
                <td>{{ $tracerKerja->tracer_kerja_jabatan }}</td>
                <td>{{ $tracerKerja->tracer_kerja_status }}</td>
                <td>
                    @if(is_numeric($tracerKerja->tracer_kerja_gaji))
                        Rp {{ number_format((float)$tracerKerja->tracer_kerja_gaji, 0, ',', '.') }}
                    @else
                        Rp 0
                    @endif
                </td>
                <td>{{ \Carbon\Carbon::parse($tracerKerja->tracer_kerja_tgl_mulai)->format('d M Y') }}</td>
                <td>
                    <a href="{{ route('tracer_kerja.edit', $tracerKerja->id_tracer_kerja) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('tracer_kerja.destroy', $tracerKerja->id_tracer_kerja) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection