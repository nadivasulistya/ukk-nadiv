@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Status Alumni Baru</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('status_alumni.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="status">Status Alumni</label>
            <input 
                type="text" 
                name="status" 
                class="form-control @error('status') is-invalid @enderror" 
                value="{{ old('status') }}"
                required
                maxlength="25"
            >
            @error('status')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('status_alumni.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection