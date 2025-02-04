@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Data Tracer Kuliah</h1>
    <form action="{{ route('tracer_kuliah.update', $tracerKuliah->id_tracer_kuliah) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Alumni</label>
            <select name="id_alumni" class="form-control">
                @foreach($alumnis as $alumni)
                    <option value="{{ $alumni->id_alumni }}" 
                        {{ $alumni->id_alumni == $tracerKuliah->id_alumni ? 'selected' : '' }}>
                        {{ $alumni->nama_depan }} {{ $alumni->nama_belakang }}
                    </option>
                @endforeach
            </select>
        </div>
        <!-- Similar input fields as create view, pre-filled with current data -->
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection