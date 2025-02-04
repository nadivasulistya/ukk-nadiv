@extends('kerangka.master')

@section('title', 'Detail Alumni')

@section('content')
<div class="page-content">
    <section class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Detail Alumni</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="text-center mb-4">
                                <img src="{{ $alumni->foto ? asset('storage/'.$alumni->foto) : asset('images/images.png') }}"
                                    class="rounded-circle img-fluid"
                                    style="width: 150px; height: 150px; object-fit: cover;">
                            </div>
                            <div class="profile-info">
                                <h5>{{ $alumni->nama_depan }} {{ $alumni->nama_belakang }}</h5>
                                <p><i class="bi bi-envelope"></i> {{ optional($alumni->user)->email ?? '-' }}</p>
                                <p><i class="bi bi-phone"></i> {{ $alumni->no_hp ?? '-' }}</p>
                                <p><i class="bi bi-geo-alt"></i> {{ $alumni->alamat ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="profile-tab" data-bs-toggle="tab"
                                        data-bs-target="#profile" type="button" role="tab">Data Diri</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="tracer-kerja-tab" data-bs-toggle="tab"
                                        data-bs-target="#tracer-kerja" type="button" role="tab">Tracer Kerja</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="tracer-kuliah-tab" data-bs-toggle="tab"
                                        data-bs-target="#tracer-kuliah" type="button" role="tab">Tracer Kuliah</button>
                                </li>
                            </ul>

                            <div class="tab-content" id="myTabContent">
                                <!-- Tab Data Diri -->
                                <div class="tab-pane fade show active p-3" id="profile" role="tabpanel">
                                    <table class="table">
                                        <tr>
                                            <th width="30%">NIS</th>
                                            <td>{{ $alumni->nis ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>NISN</th>
                                            <td>{{ $alumni->nisn ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tahun Lulus</th>
                                            <td>{{ optional($alumni->tahunLulus)->tahun_lulus ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Jurusan</th>
                                            <td>{{ optional($alumni->konsentrasiKeahlian)->nama_konsentrasi_keahlian ?? '-' }}</td>
                                        </tr>
                                    </table>
                                </div>

                                <!-- Tab Tracer Kerja -->
                                <div class="tab-pane fade p-3" id="tracer-kerja" role="tabpanel">
                                    @if($alumni->tracerKerja)

                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h6 class="card-title">{{ $alumni->tracerKerja->tracer_kerja_pekerjaan ?? '-' }}</h6>
                                            <p class="mb-1"><strong>Perusahaan:</strong> {{ $alumni->tracerKerja->tracer_kerja_nama ?? '-' }}</p>
                                            <p class="mb-1"><strong>Jabatan:</strong> {{ $alumni->tracerKerja->tracer_kerja_jabatan ?? '-' }}</p>
                                            <p class="mb-1"><strong>Status:</strong> {{ $alumni->tracerKerja->tracer_kerja_status ?? '-' }}</p>
                                            <p class="mb-1"><strong>Gaji:</strong> {{ $alumni->tracerKerja->tracer_kerja_gaji ?? '-' }}</p>
                                            <p class="mb-1"><strong>Lokasi:</strong> {{ $alumni->tracerKerja->tracer_kerja_lokasi ?? '-' }}</p>
                                            <p class="mb-0"><strong>Mulai Kerja:</strong>
                                                {{ $alumni->tracerKerja->tracer_kerja_tgl_mulai ?\Carbon\Carbon::parse($alumni->tracerKerja->tracer_kerja_tgl_mulai)->format('d M Y') : '-' }}
                                            </p>
                                        </div>
                                    </div>

                                    @else
                                    <div class="alert alert-info">Belum ada data tracer kerja</div>
                                    @endif
                                </div>

                                <!-- Tab Tracer Kuliah -->
                                <div class="tab-pane fade p-3" id="tracer-kuliah" role="tabpanel">
                                    @if($alumni->tracerKuliah )

                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h6 class="card-title">{{$alumni->tracerKuliah->tracer_kuliah_kampus ?? '-' }}</h6>
                                            <p class="mb-1"><strong>Status:</strong> {{$alumni->tracerKuliah->tracer_kuliah_status ?? '-' }}</p>
                                            <p class="mb-1"><strong>Jenjang:</strong> {{$alumni->tracerKuliah->tracer_kuliah_jenjang ?? '-' }}</p>
                                            <p class="mb-1"><strong>Jurusan:</strong> {{$alumni->tracerKuliah->tracer_kuliah_jurusan ?? '-' }}</p>
                                            <p class="mb-1"><strong>Linier:</strong> {{$alumni->tracerKuliah->tracer_kuliah_linier ?? '-' }}</p>
                                            <p class="mb-0"><strong>Alamat:</strong> {{$alumni->tracerKuliah->tracer_kuliah_alamat ?? '-' }}</p>
                                        </div>
                                    </div>

                                    @else
                                    <div class="alert alert-info">Belum ada data tracer kuliah</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection