@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Konsentrasi Keahlian</h1>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('konsentrasi_keahlian.create') }}" class="btn btn-primary mb-3">Tambah Konsentrasi Keahlian</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Program Keahlian</th>
                <th>Kode Konsentrasi</th>
                <th>Konsentrasi Keahlian</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($konsentrasi_keahlians as $index => $konsentrasi)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $konsentrasi->programKeahlian->program_keahlian }}</td>
                <td>{{ $konsentrasi->kode_konsentrasi_keahlian }}</td>
                <td>{{ $konsentrasi->konsentrasi_keahlian }}</td>
                <td>
                    <a href="{{ route('konsentrasi_keahlian.edit', $konsentrasi->id_konsentrasi_keahlian) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('konsentrasi_keahlian.destroy', $konsentrasi->id_konsentrasi_keahlian) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection