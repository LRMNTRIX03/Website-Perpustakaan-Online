@extends('admin.layouts.mainAdmin')

@section('content')
<form action="{{ route('buku.update', $kategori->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="form-group">
        <h1>Update Data Kategori</h1>
        <label for="name" class="fw-bold">Nama kategori</label>
        <input type="text" class="form-control @error('name')  is-invalid @enderror" id="name" name="name" value="{{ $kategori->name }}" required>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <span> 
        <button type="submit" class="btn btn-primary mt-3 p-2">Tambah</button>
        <a href="{{ route('kategori.index') }}" class="btn btn-danger mt-3 p-2">Kembali ke Index</a>
      </span>
</form>
@endsection
