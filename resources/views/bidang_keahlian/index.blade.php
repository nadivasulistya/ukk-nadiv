@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Bidang Keahlian</h1>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('bidang_keahlian.create') }}" class="btn btn-primary mb-3">Tambah Bidang Keahlian</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Bidang Keahlian</th>
                <th>Bidang Keahlian</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bidang_keahlians as $index => $bidang)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $bidang->kode_bidang_keahlian }}</td>
                <td>{{ $bidang->bidang_keahlian }}</td>
                <td>
                    <a href="{{ route('bidang_keahlian.edit', $bidang->id_bidang_keahlian) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('bidang_keahlian.destroy', $bidang->id_bidang_keahlian) }}" method="POST" class="d-inline">
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