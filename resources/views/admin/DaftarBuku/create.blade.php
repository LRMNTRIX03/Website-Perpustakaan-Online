@extends('admin.layouts.mainAdmin')

@section('content')
<form method="POST" action="{{ route('buku.store') }}" enctype="multipart/form-data">
  @csrf

  <div class="mb-3">
    <label for="Judul" class="form-label fw-bold">Judul Buku</label>
    <input type="text" class="form-control @error('title') is-invalid @enderror" id="Judul" name="title" placeholder="Masukan Judul Buku" value="{{ old('title') }}">
    @error('title')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
    @enderror
  </div>

  <div class="mb-3">
    <label for="Penulis" class="form-label fw-bold">Penulis</label>
    <input type="text" class="form-control @error('author') is-invalid @enderror" id="Penulis" name="author" placeholder="Masukan Nama Penulis" value="{{ old('author') }}">
    @error('author')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
    @enderror
  </div>

  <div class="mb-3">
    <label for="Penerbit" class="form-label fw-bold">Penerbit</label>
    <input type="text" class="form-control @error('publisher') is-invalid @enderror" id="Penerbit" name="publisher" placeholder="Masukan Nama Penerbit" value="{{ old('publisher') }}">
    @error('publisher')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
    @enderror
  </div>

  <div class="mb-3">
    <label for="thnTerbit" class="form-label fw-bold">Tahun Terbit</label>
    <input type="text" class="form-control @error('year_published') is-invalid @enderror" id="thnTerbit" name="year_published" placeholder="Masukan Tahun Terbit" value="{{ old('year_published') }}">
    @error('year_published')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
    @enderror
  </div>

  <div class="mb-3">
    <label for="isbn" class="form-label fw-bold">ISBN</label>
    <input type="text" class="form-control @error('isbn') is-invalid @enderror" id="isbn" name="isbn" placeholder="Masukan ISBN" value="{{ old('isbn') }}" required>
    @error('isbn')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
    @enderror
  </div>

  <div class="mb-3">
    <label for="kategori" class="form-label fw-bold">Kategori</label>
    <select class="form-select @error('category_id') is-invalid @enderror" id="kategori" name="category_id">
      <option value="" selected>Pilih Kategori--</option>
      @foreach ($kategori as $kat)
        <option value="{{ $kat->id }}" {{ old('category_id') == $kat->id ? 'selected' : '' }}>{{ $kat->name }}</option>
      @endforeach
    </select>
    @error('category_id')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
    @enderror
  </div>
  <div class="form-group">
    <label for="deskripsi">Deskripsi</label>
    <textarea class="form-control @error('deskripsi') is-invalid  @enderror" id="exampleFormControlTextarea1" rows="3" name="deskripsi" value={{ old('deskripsi') }} required></textarea>
    @error('deskripsi')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

  <div class="mb-3">
    <label for="formFile" class="form-label">Upload Cover</label>
    <input class="form-control @error('formFile') is-invalid @enderror" type="file" id="formFile" name="formFile">
    <p class="text-danger">*File Maksimal 2 Mb</p>
    @error('formFile')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
    @enderror
  </div>
  <div class="mb-3">
    <label for="formPDF" class="form-label">Upload File Buku</label>
    <input class="form-control @error('formPDF') is-invalid @enderror" type="file" id="formPDF" name="formPDF">
    <p class="text-danger">*File Maksimal 50 MB</p>
    @error('formPDF')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
    @enderror
    @if (session('error'))
      <div class="invalid-feedback">
        {{ session('error') }}
      </div> 
    @endif
    <div class="invalid-feedback">
      
    </div>
  </div>
  <span> 
    <button type="submit" class="btn btn-primary mt-3 p-2">Submit</button>
    <a href="{{ route('buku.index') }}" class="btn btn-danger mt-3 p-2">Kembali ke Index</a>
  </span>
 
</form>

@endsection
