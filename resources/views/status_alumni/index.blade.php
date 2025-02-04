@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Status Alumni</h1>
    
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
            <a href="{{ route('status_alumni.create') }}" class="btn btn-primary">
                Tambah Status Alumni
            </a>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Status</th>
                <th>Jumlah Alumni</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($statusAlumni as $item)
            <tr>
                <td>{{ $item->id_status_alumni }}</td>
                <td>{{ $item->status }}</td>
                <td>{{ $item->alumni->count() }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <a href="{{ route('status_alumni.edit', $item) }}" class="btn btn-warning btn-sm">
                            Edit
                        </a>
                        <form action="{{ route('status_alumni.destroy', $item) }}" method="POST" class="d-inline">
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
                <td colspan="4" class="text-center">Tidak ada data status alumni</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{ $statusAlumni->links() }}
</div>
@endsection