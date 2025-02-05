@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Tahun Lulus</h1>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="row mb-3">
        <div class="col-md-6">
            <a href="{{ route('tahun_lulus.create') }}" class="btn btn-primary">
                Tambah Tahun Lulus
            </a>
        </div>
        <div class="col-md-6">
            <form action="{{ route('tahun_lulus.index') }}" method="GET" class="form-inline justify-content-end">
            </form>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tahun Lulus</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tahunLulus as $item)
            <tr>
                <td>{{ $item->id_tahun_lulus }}</td>
                <td>{{ $item->tahun_lulus }}</td>
                <td>{{ $item->keterangan }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <a href="{{ route('tahun_lulus.edit', $item) }}" class="btn btn-warning btn-sm">
                            Edit
                        </a>
                        <form action="{{ route('tahun_lulus.destroy', $item) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data?')">
                                Hapus
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">Tidak ada data tahun lulus</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{ $tahunLulus->links() }}
</div>
@endsection