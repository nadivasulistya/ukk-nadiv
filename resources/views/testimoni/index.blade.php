@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Testimoni Alumni</h2>
    
    <a href="{{ route('testimoni.create') }}" class="btn btn-primary mb-3">Tambah Testimoni</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Alumni</th>
                <th>Testimoni</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($testimonis as $index => $testimoni)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $testimoni->alumni->nama_depan }} {{ $testimoni->alumni->nama_belakang }}</td>
                <td>{{ Str::limit($testimoni->testimoni, 100) }}</td>
                <td>
                    @if($testimoni->tgl_testimoni)
                        {{ \Carbon\Carbon::parse($testimoni->tgl_testimoni)->format('d M Y') }}
                    @endif
                </td>
                <td>
                    <a href="{{ route('testimoni.show', $testimoni->id_testimoni) }}" class="btn btn-info btn-sm">Lihat</a>
                    <a href="{{ route('testimoni.edit', $testimoni->id_testimoni) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('testimoni.destroy', $testimoni->id_testimoni) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus testimoni?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection