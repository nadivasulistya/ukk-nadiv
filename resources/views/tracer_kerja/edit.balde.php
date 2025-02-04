@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Data Tracer Kerja</h2>
<form action="{{ route('tracer_kerja.update', $tracerKerja->id_tracer_kerja) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label>Alumni</label>
            <select name="id_alumni" class="form-control @error('id_alumni') is-invalid @enderror">
                @foreach($alumnis as $alumni)
                    <option value="{{ $alumni->id_alumni }}" 
                        {{ $alumni->id_alumni == $tracerKerja->id_alumni ? 'selected' : '' }}>
                        {{ $alumni->nama_depan }} {{ $alumni->nama_belakang }}
                    </option>
                @endforeach
            </select>
            @error('id_alumni')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Pekerjaan</label>
            <input type="text" name="tracer_kerja_pekerjaan" 
                value="{{ $tracerKerja->tracer_kerja_pekerjaan }}" 
                class="form-control" required>
        </div>

        <div class="form-group">
            <label>Nama Perusahaan</label>
            <input type="text" name="tracer_kerja_nama" 
                value="{{ $tracerKerja->tracer_kerja_nama }}" 
                class="form-control" required>
        </div>

        <div class="form-group">
            <label>Jabatan</label>
            <input type="text" name="tracer_kerja_jabatan" 
                value="{{ $tracerKerja->tracer_kerja_jabatan }}" 
                class="form-control" required>
        </div>

        <div class="form-group">
            <label>Status Pekerjaan</label>
            <select name="tracer_kerja_status" class="form-control">
                <option value="Tetap" {{ $tracerKerja->tracer_kerja_status == 'Tetap' ? 'selected' : '' }}>Tetap</option>
                <option value="Kontrak" {{ $tracerKerja->tracer_kerja_status == 'Kontrak' ? 'selected' : '' }}>Kontrak</option>
                <option value="Magang" {{ $tracerKerja->tracer_kerja_status == 'Magang' ? 'selected' : '' }}>Magang</option>
                <option value="Freelance" {{ $tracerKerja->tracer_kerja_status == 'Freelance' ? 'selected' : '' }}>Freelance</option>
            </select>
        </div>

        <div class="form-group">
            <label>Lokasi</label>
            <input type="text" name="tracer_kerja_lokasi" 
                value="{{ $tracerKerja->tracer_kerja_lokasi }}" 
                class="form-control" required>
        </div>

        <div class="form-group">
            <label>Alamat</label>
            <textarea name="tracer_kerja_alamat" class="form-control" required>{{ $tracerKerja->tracer_kerja_alamat }}</textarea>
        </div>

        <div class="form-group">
            <label>Tanggal Mulai</label>
            <input type="date" name="tracer_kerja_tgl_mulai" 
                value="{{ $tracerKerja->tracer_kerja_tgl_mulai->format('Y-m-d') }}" 
                class="form-control" required>
        </div>

        <div class="form-group">
            <label>Gaji</label>
            <input type="number" name="tracer_kerja_gaji" 
                value="{{ $tracerKerja->tracer_kerja_gaji }}" 
                class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection