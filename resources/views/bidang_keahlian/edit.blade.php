@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Bidang Keahlian</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('bidang_keahlian.update', $bidang_keahlian->id_bidang_keahlian) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="kode_bidang_keahlian">Kode Bidang Keahlian</label>
            <input type="text" class="form-control" id="kode_bidang_keahlian" name="kode_bidang_keahlian" value="{{ old('kode_bidang_keahlian', $bidang_keahlian->kode_bidang_keahlian) }}" required maxlength="10">
        </div>
        <div class="form-group">
            <label for="bidang_keahlian">Bidang Keahlian</label>
            <input type="text" class="form-control" id="bidang_keahlian" name="bidang_keahlian" value="{{ old('bidang_keahlian', $bidang_keahlian->bidang_keahlian) }}" required maxlength="100">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('bidang_keahlian.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection