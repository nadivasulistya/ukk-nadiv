@extends('layouts.app')

@section('content')

    <div class="container mt-5">
        <h2>Daftar Sekolah</h2>
        
        @if(session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <a href="{{ route('sekolah.create') }}" class="btn btn-primary mb-3">Tambah Sekolah Baru</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th> 
                    <th>NPSN</th>
                    <th>Nama Sekolah</th>
                    <th>Alamat</th>
                    <th>No Telepon</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sekolahs as $index => $sekolah)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $sekolah->npsn }}</td>
                    <td>{{ $sekolah->nama_sekolah }}</td>
                    <td>{{ $sekolah->alamat }}</td>
                    <td>{{ $sekolah->no_telp }}</td>
                    <td>{{ $sekolah->email }}</td>
                    <td>
                        <a href="{{ route('sekolah.edit', $sekolah->id_sekolah) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('sekolah.destroy', $sekolah->id_sekolah) }}" method="POST" style="display:inline;">
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