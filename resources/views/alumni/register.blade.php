@extends('layouts.user')

@section('content')
<div class="container my-5" style="padding-top: 100px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Pendaftaran Alumni</h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form action="{{ route('alumni.register.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_user" value="{{ Auth::id() }}">

                        <div class="mb-3 position-relative">
                            <label>Cari Nama Alumni</label>
                            <input type="text" id="search_name" class="form-control" placeholder="Ketik nama untuk mencari...">
                            <div id="search_results" class="list-group position-absolute w-100 shadow-sm" style="display:none; z-index: 1000;">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>NISN</label>
                                <input type="text" name="nisn" id="nisn" class="form-control @error('nisn') is-invalid @enderror" value="{{ old('nisn') }}" readonly>
                                @error('nisn')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>NIK</label>
                                <input type="text" name="nik" id="nik" class="form-control @error('nik') is-invalid @enderror" value="{{ old('nik') }}" readonly>
                                @error('nik')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Nama Depan</label>
                                <input type="text" name="nama_depan" class="form-control @error('nama_depan') is-invalid @enderror" value="{{ old('nama_depan') }}">
                                @error('nama_depan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>Nama Belakang</label>
                                <input type="text" name="nama_belakang" class="form-control @error('nama_belakang') is-invalid @enderror" value="{{ old('nama_belakang') }}">
                                @error('nama_belakang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" value="{{ old('tempat_lahir') }}">
                                @error('tempat_lahir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Tanggal Lahir</label>
                                <input type="date" name="tgl_lahir" class="form-control @error('tgl_lahir') is-invalid @enderror" value="{{ old('tgl_lahir') }}">
                                @error('tgl_lahir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>No. HP</label>
                                <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" value="{{ old('no_hp') }}">
                                @error('no_hp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Alamat</label>
                            <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="3">{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Tahun Lulus</label>
                                <select name="id_tahun_lulus" class="form-control @error('id_tahun_lulus') is-invalid @enderror">
                                    <option value="">Pilih Tahun Lulus</option>
                                    @foreach($tahunLulus as $tahun)
                                        <option value="{{ $tahun->id_tahun_lulus }}" {{ old('id_tahun_lulus') == $tahun->id_tahun_lulus ? 'selected' : '' }}>
                                            {{ $tahun->tahun_lulus }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_tahun_lulus')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>Konsentrasi Keahlian</label>
                                <select name="id_konsentrasi_keahlian" class="form-control @error('id_konsentrasi_keahlian') is-invalid @enderror">
                                    <option value="">Pilih Konsentrasi</option>
                                    @foreach($konsentrasiKeahlian as $konsentrasi)
                                        <option value="{{ $konsentrasi->id_konsentrasi_keahlian }}" {{ old('id_konsentrasi_keahlian') == $konsentrasi->id_konsentrasi_keahlian ? 'selected' : '' }}>
                                            {{ $konsentrasi->konsentrasi_keahlian }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_konsentrasi_keahlian')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Status Alumni</label>
                                <select name="id_status_alumni" class="form-control @error('id_status_alumni') is-invalid @enderror">
                                    <option value="">Pilih Status</option>
                                    @foreach($statusAlumni as $status)
                                        <option value="{{ $status->id_status_alumni }}" {{ old('id_status_alumni') == $status->id_status_alumni ? 'selected' : '' }}>
                                            {{ $status->status }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_status_alumni')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label>Akun Facebook (Opsional)</label>
                                <input type="text" name="akun_fb" class="form-control @error('akun_fb') is-invalid @enderror" value="{{ old('akun_fb') }}">
                                @error('akun_fb')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label>Akun Instagram (Opsional)</label>
                                <input type="text" name="akun_ig" class="form-control @error('akun_ig') is-invalid @enderror" value="{{ old('akun_ig') }}">
                                @error('akun_ig')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label>Akun TikTok (Opsional)</label>
                                <input type="text" name="akun_tiktok" class="form-control @error('akun_tiktok') is-invalid @enderror" value="{{ old('akun_tiktok') }}">
                                @error('akun_tiktok')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group text-center mt-4">
                            <button type="submit" class="btn btn-primary">Daftar Sebagai Alumni</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.list-group-item-action {
    cursor: pointer;
    padding: 0.5rem 1rem;
}

.list-group-item-action:hover {
    background-color: #f8f9fa;
}

#search_results {
    max-height: 200px;
    overflow-y: auto;
    border: 1px solid #ddd;
    border-radius: 0.25rem;
    background: white;
    margin-top: 2px;
}
</style>
@endpush

@push('scripts')
<script>
document.getElementById('search_name').addEventListener('input', debounce(function(e) {
    const searchTerm = e.target.value;
    const resultsDiv = document.getElementById('search_results');
    
    if (searchTerm.length < 3) {
        resultsDiv.style.display = 'none';
        return;
    }

    fetch(`/alumni/search?term=${searchTerm}`)
        .then(response => response.json())
        .then(data => {
            resultsDiv.innerHTML = '';
            if (data.length > 0) {
                data.forEach(student => {
                    const div = document.createElement('div');
                    div.className = 'list-group-item list-group-item-action';
                    div.textContent = student.name;
                    div.addEventListener('click', () => {
                        document.getElementById('nisn').value = student.nisn;
                        document.getElementById('nik').value = student.nik;
                        document.getElementById('search_name').value = student.name;
                        resultsDiv.style.display = 'none';
                    });
                    resultsDiv.appendChild(div);
                });
                resultsDiv.style.display = 'block';
            } else {
                resultsDiv.innerHTML = '<div class="list-group-item">Tidak ada hasil ditemukan</div>';
                resultsDiv.style.display = 'block';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            resultsDiv.innerHTML = '<div class="list-group-item text-danger">Terjadi kesalahan saat mencari data</div>';
            resultsDiv.style.display = 'block';
        });
}, 300));

// Tambahkan fungsi debounce untuk mengurangi jumlah request
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Sembunyikan hasil pencarian ketika mengklik di luar
document.addEventListener('click', function(e) {
    const searchResults = document.getElementById('search_results');
    const searchInput = document.getElementById('search_name');
    
    if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
        searchResults.style.display = 'none';
    }
});
</script>
@endpush 