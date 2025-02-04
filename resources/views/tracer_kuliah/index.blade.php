@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Data Tracer Kuliah</h1>
    <a href="{{ route('tracer_kuliah.create') }}" class="btn btn-primary">Tambah Data</a>
    
    <table class="table">
        <thead>
            <tr>
                <th>Nama Alumni</th>
                <th>Kampus</th>
                <th>Status</th>
                <th>Jenjang</th>
                <th>Jurusan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tracerKuliahs as $tracer)
            <tr>
                <td>{{ $tracer->alumni->nama_depan }} {{ $tracer->alumni->nama_belakang }}</td>
                <td>{{ $tracer->tracer_kuliah_kampus }}</td>
                <td>{{ $tracer->tracer_kuliah_status }}</td>
                <td>{{ $tracer->tracer_kuliah_jenjang }}</td>
                <td>{{ $tracer->tracer_kuliah_jurusan }}</td>
                <td>
                    <a href="{{ route('tracer_kuliah.edit', $tracer->id_tracer_kuliah) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('tracer_kuliah.destroy', $tracer->id_tracer_kuliah) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection