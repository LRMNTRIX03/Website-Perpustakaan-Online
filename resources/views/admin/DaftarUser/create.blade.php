@extends('admin.layouts.mainAdmin')

@section('content')
<div class="container">
  <h1>Tambah Anggota Baru</h1>

  <form action="{{ route('anggota.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group mb-3">
      <label for="name">Nama Anggota</label>
      <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Masukkan name" required>
      @error('name')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
    @enderror
    </div>

    <div class="form-group mb-3">
      <label for="username">Username</label>
      <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="Masukkan Username" required>
      @error('username')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="form-group mb-3">
      <label for="email">Email</label>
      <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Masukkan email" required>
      @error('email')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="form-group mb-3">
      <label for="TTL">Tanggal Lahir</label>
      <input type="date" name="TTL" class="form-control @error('TTL') is-invalid @enderror" id="TTL" required>
      @error('TTL')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="form-group mb-3">
      <label for="JenisKelamin">Jenis Kelamin</label>
      <select name="JenisKelamin" class="form-control @error('JenisKelamin') is-invalid @enderror " id="JenisKelamin" required>
        <option value="Laki-Laki">Laki-Laki</option>
        <option value="Perempuan">Perempuan</option>
      </select>
      @error('TTL')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="form-group mb-3">
      <label for="noTelp">No. Telp</label>
      <input type="text" name="noTelp" class="form-control @error('noTelp') is-invalid @enderror" id="noTelp" placeholder="Masukkan nomor telepon" required>
      @error('TTL')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="form-group mb-3">
      <label for="alamat">Alamat</label>
      <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat" rows="3" placeholder="Masukkan alamat" required></textarea>
      @error('alamat')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="form-group mb-3">
        <label for="fotoUrl" class="form-label">Upload Foto</label>
        <input class="form-control @error('fotoUrl') is-invalid @enderror" type="file" id="formFile" name="fotoUrl">
        <p class="text-danger">*File Maksimal 2 Mb</p>
        @error('fotoUrl')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
  </form>
</div>
@endsection
