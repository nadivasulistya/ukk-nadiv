@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Data Tracer Kuliah</h1>
    <form action="{{ route('tracer_kuliah.store') }}" method="POST">
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
            <label>Nama Kampus</label>
            <input type="text" name="tracer_kuliah_kampus" class="form-control @error('tracer_kuliah_kampus') is-invalid @enderror" value="{{ old('tracer_kuliah_kampus') }}">
            @error('tracer_kuliah_kampus')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Status</label>
            <input type="text" name="tracer_kuliah_status" class="form-control @error('tracer_kuliah_status') is-invalid @enderror" value="{{ old('tracer_kuliah_status') }}">
            @error('tracer_kuliah_status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Jenjang</label>
            <input type="text" name="tracer_kuliah_jenjang" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Jurusan</label>
            <input type="text" name="tracer_kuliah_jurusan" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Linier</label>
            <input type="text" name="tracer_kuliah_linier" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Alamat</label>
            <input type="text" name="tracer_kuliah_alamat" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection