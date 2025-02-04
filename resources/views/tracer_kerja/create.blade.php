@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Data Tracer Kerja</h2>
    
    <form action="{{ route('tracer_kerja.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label>Alumni</label>
            <select name="id_alumni" class="form-control @error('id_alumni') is-invalid @enderror">
                <option value="">Pilih Alumni</option>
                @foreach($alumnis as $alumni)
                    <option value="{{ $alumni->id_alumni }}" {{ old('id_alumni') == $alumni->id_alumni ? 'selected' : '' }}>
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
            <input type="text" name="tracer_kerja_pekerjaan" class="form-control @error('tracer_kerja_pekerjaan') is-invalid @enderror" value="{{ old('tracer_kerja_pekerjaan') }}">
            @error('tracer_kerja_pekerjaan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Nama Perusahaan</label>
            <input type="text" name="tracer_kerja_nama" class="form-control @error('tracer_kerja_nama') is-invalid @enderror" value="{{ old('tracer_kerja_nama') }}">
            @error('tracer_kerja_nama')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Jabatan</label>
            <input type="text" name="tracer_kerja_jabatan" class="form-control @error('tracer_kerja_jabatan') is-invalid @enderror" value="{{ old('tracer_kerja_jabatan') }}">
            @error('tracer_kerja_jabatan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Status Pekerjaan</label>
            <select name="tracer_kerja_status" class="form-control @error('tracer_kerja_status') is-invalid @enderror">
                <option value="">Pilih Status Pekerjaan</option>
                <option value="Tetap" {{ old('tracer_kerja_status') == 'Tetap' ? 'selected' : '' }}>Tetap</option>
                <option value="Kontrak" {{ old('tracer_kerja_status') == 'Kontrak' ? 'selected' : '' }}>Kontrak</option>
                <option value="Freelance" {{ old('tracer_kerja_status') == 'Freelance' ? 'selected' : '' }}>Freelance</option>
            </select>
            @error('tracer_kerja_status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Lokasi</label>
            <input type="text" name="tracer_kerja_lokasi" class="form-control @error('tracer_kerja_lokasi') is-invalid @enderror" value="{{ old('tracer_kerja_lokasi') }}">
            @error('tracer_kerja_lokasi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Alamat</label>
            <textarea name="tracer_kerja_alamat" class="form-control @error('tracer_kerja_alamat') is-invalid @enderror">{{ old('tracer_kerja_alamat') }}</textarea>
            @error('tracer_kerja_alamat')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Tanggal Mulai</label>
            <input type="date" name="tracer_kerja_tgl_mulai" class="form-control @error('tracer_kerja_tgl_mulai') is-invalid @enderror" value="{{ old('tracer_kerja_tgl_mulai') }}">
            @error('tracer_kerja_tgl_mulai')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Gaji (Format: Rp 1.000.000)</label>
            <input type="text" name="tracer_kerja_gaji" class="form-control @error('tracer_kerja_gaji') is-invalid @enderror" value="{{ old('tracer_kerja_gaji') }}" placeholder="Rp 1.000.000">
            @error('tracer_kerja_gaji')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection