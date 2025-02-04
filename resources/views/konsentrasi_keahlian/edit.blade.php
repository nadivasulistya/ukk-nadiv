@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Konsentrasi Keahlian</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('konsentrasi_keahlian.update', $konsentrasi_keahlian->id_konsentrasi_keahlian) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="id_program_keahlian">Program Keahlian</label>
            <select class="form-control" id="id_program_keahlian" name="id_program_keahlian" required>
                <option value="">Pilih Program Keahlian</option>
                @foreach($program_keahlians as $program)
                    <option value="{{ $program->id_program_keahlian }}" 
                        {{ $konsentrasi_keahlian->id_program_keahlian == $program->id_program_keahlian ? 'selected' : '' }}>
                        {{ $program->program_keahlian }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="kode_konsentrasi_keahlian">Kode Konsentrasi Keahlian</label>
            <input type="text" class="form-control" id="kode_konsentrasi_keahlian" name="kode_konsentrasi_keahlian" value="{{ old('kode_konsentrasi_keahlian', $konsentrasi_keahlian->kode_konsentrasi_keahlian) }}" required maxlength="10">
        </div>
        <div class="form-group">
            <label for="konsentrasi_keahlian">Konsentrasi Keahlian</label>
            <input type="text" class="form-control" id="konsentrasi_keahlian" name="konsentrasi_keahlian" value="{{ old('konsentrasi_keahlian', $konsentrasi_keahlian->konsentrasi_keahlian) }}" required maxlength="100">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('konsentrasi_keahlian.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection