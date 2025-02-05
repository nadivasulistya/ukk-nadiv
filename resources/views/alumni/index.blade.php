@extends('kerangka.master')

@section('content')
<div class="page-content">
    <section class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Data Alumni</h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Foto</th>
                                    <th>NIK</th>
                                    <th>NISN</th>
                                    <th>Nama Lengkap</th>
                                    <th>Jurusan</th>
                                    <th>Tahun Lulus</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($alumnis as $index => $alumni)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <img src="{{ $alumni->foto ? asset('storage/'.$alumni->foto) : asset('images/images.png') }}"
                                            alt="Foto {{ $alumni->nama_depan }}"
                                            class="rounded-circle"
                                            width="40" height="40"
                                            style="object-fit: cover;">
                                    </td>
                                    <td>{{ $alumni->nik }}</td>
                                    <td>{{ $alumni->nisn }}</td>
                                    <td>{{ $alumni->nama_depan }} {{ $alumni->nama_belakang }}</td>
                                    <td>{{ optional($alumni->konsentrasiKeahlian)->konsentrasi_keahlian ?? '-' }}</td>
                                    <td>{{ optional($alumni->tahunLulus)->tahun_lulus ?? '-' }}</td>
                                    <td>

                                        @if($alumni->tracerKerja && $alumni->tracerKuliah)
                                        <span class="badge bg-primary">Bekerja & Berkuliah</span>
                                        @elseif($alumni->tracerKerja)
                                        <span class="badge bg-success">Bekerja</span>
                                        @elseif($alumni->tracerKuliah)
                                        <span class="badge bg-info">Berkuliah</span>
                                        @else
                                        <span class="badge bg-secondary">Belum Ada Data</span>
                                        @endif

                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('alumni.detail', $alumni->id_alumni) }}"
                                                class="btn btn-info btn-sm"
                                                title="Detail">
                                                <i class="bi bi-eye-fill"></i>
                                            </a>
                                            <a href="{{ route('alumni.edit', $alumni->id_alumni) }}"
                                                class="btn btn-warning btn-sm"
                                                title="Edit">
                                                <i class="bi bi-pencil-fill"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#table1').DataTable({
            "pageLength": 10,
            "ordering": true,
            "info": true,
            "lengthChange": true,
            "searching": true
        });
    });
</script>
@endpush
@endsection