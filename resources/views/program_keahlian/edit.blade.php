@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Program Keahlian</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('program_keahlian.update', $program_keahlian->id_program_keahlian) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="id_bidang_keahlian">Bidang Keahlian</label>
            <select class="form-control" id="id_bidang_keahlian" name="id_bidang_keahlian" required>
                <option value="">Pilih Bidang Keahlian</option>
                @foreach($bidang_keahlians as $bidang)
                    <option value="{{ $bidang->id_bidang_keahlian }}" 
                        {{ $program_keahlian->id_bidang_keahlian == $bidang->id_bidang_keahlian ? 'selected' : '' }}>
                        {{ $bidang->bidang_keahlian }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="kode_program_keahlian">Kode Program Keahlian</label>
            <input type="text" class="form-control" id="kode_program_keahlian" name="kode_program_keahlian" value="{{ old('kode_program_keahlian', $program_keahlian->kode_program_keahlian) }}" required maxlength="10">
        </div>
        <div class="form-group">
            <label for="program_keahlian">Program Keahlian</label>
            <input type="text" class="form-control" id="program_keahlian" name="program_keahlian" value="{{ old('program_keahlian', $program_keahlian->program_keahlian) }}" required maxlength="100">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('program_keahlian.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection