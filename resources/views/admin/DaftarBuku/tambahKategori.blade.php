@extends('admin.layouts.mainAdmin')

@section('content')
<form method="POST" action="{{ route('kategori.store') }}" enctype="multipart/form-data">
  @csrf

  <div class="mb-3">
    <label for="name" class="form-label fw-bold">Nama Kategori</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="Judul" name="name" placeholder="Masukan Nama Kategori" value="{{ old('name') }}">
    @error('name')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
    @enderror
  </div>
  <span> 
    <button type="submit" class="btn btn-primary mt-3 p-2">Submit</button>
    <a href="{{ route('kategori.index') }}" class="btn btn-danger mt-3 p-2">Kembali ke Index</a>
  </span>
 
</form>

@endsection
