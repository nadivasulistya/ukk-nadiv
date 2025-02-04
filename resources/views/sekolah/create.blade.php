<!DOCTYPE html>
<html>
<head>
    <title>Tambah Sekolah Baru</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Tambah Sekolah Baru</h2>
        
        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('sekolah.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>NPSN</label>
                <input type="text" name="npsn" class="form-control" value="{{ old('npsn') }}" required>
            </div>
 
            <div class="form-group">
                <label>NSS</label>
                <input type="text" name="nss" class="form-control" value="{{ old('nss') }}" required>
            </div>

            <div class="form-group">
                <label>Nama Sekolah</label>
                <input type="text" name="nama_sekolah" class="form-control" value="{{ old('nama_sekolah') }}" required>
            </div>

            <div class="form-group">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control" required>{{ old('alamat') }}</textarea>
            </div>

            <div class="form-group">
                <label>No Telepon</label>
                <input type="text" name="no_telp" class="form-control" value="{{ old('no_telp') }}" required>
            </div>

            <div class="form-group">
                <label>Website</label>
                <input type="text" name="website" class="form-control" value="{{ old('website') }}">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('sekolah.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>