@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Testimoni</h2>
    
    <form action="{{ route('testimoni.update', $testimoni->id_testimoni) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label>Alumni</label>
            <select name="id_alumni" class="form-control @error('id_alumni') is-invalid @enderror">
                @foreach($alumnis as $alumni)
                    <option value="{{ $alumni->id_alumni }}"
                        {{ $testimoni->id_alumni == $alumni->id_alumni ? 'selected' : '' }}>
                        {{ $alumni->nama_depan }} {{ $alumni->nama_belakang }}
                    </option>
                @endforeach
            </select>
            @error('id_alumni')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Testimoni</label>
            <textarea name="testimoni" class="form-control" rows="5" required>{{ old('testimoni', $testimoni->testimoni) }}</textarea>
            @error('testimoni')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Tanggal Testimoni</label>
            <input type="date" name="tgl_testimoni" class="form-control" 
                   value="{{ old('tgl_testimoni', $testimoni->tgl_testimoni->format('Y-m-d')) }}" required>
            @error('tgl_testimoni')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Testimoni</button>
    </form>
</div>
@endsection