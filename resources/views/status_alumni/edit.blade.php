@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Status Alumni</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('status_alumni.update', $statusAlumni) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="status">Status Alumni</label>
            <input 
                type="text" 
                name="status" 
                class="form-control @error('status') is-invalid @enderror" 
                value="{{ old('status', $statusAlumni->status) }}"
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
            <label>Alumni dengan Status Ini</label>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>NISN</th>
                        <th>Tahun Lulus</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($statusAlumni->alumni as $alumni)
                    <tr>
                        <td>{{ $alumni->nama_depan }} {{ $alumni->nama_belakang }}</td>
                        <td>{{ $alumni->nisn }}</td>
                        <td>{{ $alumni->tahunLulus->tahun_lulus ?? 'Tidak Diketahui' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center">Tidak ada alumni dengan status ini</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('status_alumni.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection