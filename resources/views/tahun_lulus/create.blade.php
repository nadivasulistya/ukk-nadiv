@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Tahun Lulus Baru</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('tahun_lulus.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="tahun_lulus">Tahun Lulus</label>
            <input 
                type="text" 
                name="tahun_lulus" 
                class="form-control @error('tahun_lulus') is-invalid @enderror" 
                value="{{ old('tahun_lulus') }}"
                required
                maxlength="10"
            >
            @error('tahun_lulus')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <textarea 
                name="keterangan" 
                class="form-control @error('keterangan') is-invalid @enderror"
                maxlength="50"
            >{{ old('keterangan') }}</textarea>
            @error('keterangan')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('tahun_lulus.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection