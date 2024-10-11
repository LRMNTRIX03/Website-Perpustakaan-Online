
@extends('user.layouts.mainUser')
@section('content')
<form action="{{ route('profile.changePassword', Auth::user()->id) }}" method="post" class="form-group">
    @csrf
    @method('PUT')
    <div class="form-group mb-3">
        <label for="password_lama">Password Lama</label>
        <input type="password" name="password_lama" class="form-control @error('password_lama') is-invalid @enderror" id="passwordLama" placeholder="Masukkan Password" required>
        @error('password_lama')
            {{$message}}
        @enderror
    </div>
    <div class="form-group mb-3">
        <label for="password_baru">Password Baru</label>
        <input type="password" name="password_baru" class="form-control @error('password_baru') is-invalid @enderror" id="password" placeholder="Masukkan Password" required>
        @error('password_baru')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
  
    <button type="submit" class="btn btn-primary">Ganti Password</button>
    <a href="{{ route('profile') }}" class="btn btn-secondary">Kembali</a>
</form>

@endsection