@extends('user.layouts.mainUser')
@section('content')

<form action="{{ route('profile.update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
    @auth
    @csrf
    @method('PUT')
    @if (Auth::user()->fotoUrl == null)
    <i class="fa-solid fa-user" style="font-size: 10rem; margin-left:75vh; padding:2rem;"></i>
    @else
    <div class="img-container">
        <img src="{{ asset('storage/' . Auth::user()->fotoUrl) }}" alt="" width="300px" height="300px" class="rounded-circle d-flex justify-content-center align-items-center mb-3 mx-auto">
    </div>
    @endif

    <!-- Semua input form akan di-disabled secara default -->
    <div class="form-group mb-3">
        <label for="name">Nama Anggota</label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Masukkan Username" value="{{ Auth::user()->name }}" required disabled>
        @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label for="username">Username</label>
        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="Masukkan Username" value="{{ Auth::user()->username }}" required disabled>
        @error('username')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Masukkan Email" value="{{ Auth::user()->email }}" required disabled>
        @error('email')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label for="TTL">Tanggal Lahir</label>
        <input type="date" name="TTL" class="form-control @error('TTL') is-invalid @enderror" id="TTL" value="{{ Auth::user()->TTL }}" required disabled>
        @error('TTL')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label for="JenisKelamin">Jenis Kelamin</label>
        <select name="JenisKelamin" class="form-control @error('JenisKelamin') is-invalid @enderror" id="JenisKelamin" required disabled>
            <option value="Laki-Laki" {{ Auth::user()->JenisKelamin == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
            <option value="Perempuan" {{ Auth::user()->JenisKelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
        </select>
        @error('JenisKelamin')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label for="noTelp">No. Telp</label>
        <input type="text" name="noTelp" class="form-control @error('noTelp') is-invalid @enderror" id="noTelp" placeholder="Masukkan nomor telepon" value="{{ Auth::user()->noTelp }}" required disabled>
        @error('noTelp')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label for="alamat">Alamat</label>
        <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat" rows="3" placeholder="Masukkan alamat" required disabled>{{Auth::user()->alamat}}</textarea>
        @error('alamat')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label for="fotoUrl" class="form-label">Upload Foto</label>
        <input class="form-control @error('fotoUrl') is-invalid @enderror" type="file" id="formFile" name="fotoUrl" disabled>
        @error('fotoUrl')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <!-- Tombol untuk mulai mengedit -->
    <button type="button" class="btn btn-warning" id="editButton">Edit</button>

    <!-- Tombol untuk menyimpan data -->
    <button type="submit" class="btn btn-primary" id="saveButton" style="display: none;">Simpan</button>
    <a href="{{route('user.dashboard')}}" class="btn btn-secondary">Kembali Ke Dashboard</a>
    @endauth
</form>

<script>
  // Tombol Edit akan mengaktifkan semua input field
  document.getElementById('editButton').addEventListener('click', function () {
    let formElements = document.querySelectorAll('input, textarea, select');
    formElements.forEach(element => {
      element.removeAttribute('disabled');
    });
    
    // Tampilkan tombol "Simpan"
    document.getElementById('saveButton').style.display = 'inline-block';
    
    // Sembunyikan tombol "Edit"
    this.style.display = 'none';
  });
</script>
@endsection
