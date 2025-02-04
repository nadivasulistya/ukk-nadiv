@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Program Keahlian</h1>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('program_keahlian.create') }}" class="btn btn-primary mb-3">Tambah Program Keahlian</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Bidang Keahlian</th>
                <th>Kode Program</th>
                <th>Program Keahlian</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($program_keahlians as $index => $program)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $program->bidangKeahlian->bidang_keahlian }}</td>
                <td>{{ $program->kode_program_keahlian }}</td>
                <td>{{ $program->program_keahlian }}</td>
                <td>
                    <a href="{{ route('program_keahlian.edit', $program->id_program_keahlian) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('program_keahlian.destroy', $program->id_program_keahlian) }}" method="POST" class="d-inline">
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