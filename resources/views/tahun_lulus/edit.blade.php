@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Tahun Lulus</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('tahun_lulus.update', $tahunLulus->id_tahun_lulus) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="tahun_lulus">Tahun Lulus</label>
            <input 
                type="text" 
                name="tahun_lulus" 
                class="form-control @error('tahun_lulus') is-invalid @enderror" 
                value="{{ old('tahun_lulus', $tahunLulus->tahun_lulus) }}"
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
            >{{ old('keterangan', $tahunLulus->keterangan) }}</textarea>
            @error('keterangan')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('tahun_lulus.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection