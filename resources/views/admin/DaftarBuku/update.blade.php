@extends('admin.layouts.mainAdmin')

@section('content')
<h1>Update Data Buku</h1>
<form action="{{ route('buku.update', $buku->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="Judul">Judul Buku</label>
        <input type="text" class="form-control @error('title')  is-invalid @enderror" id="Judul" name="title" value="{{ $buku->title }}" required>
        @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="Penulis">Pengarang</label>
        <input type="text"  class="form-control @error('author') is-invalid  @enderror" id="Penulis" name="author" value="{{ $buku->author }}" required>
        @error('author')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="form-group">
        <label for="Penerbit">Penerbit</label>
        <input type="text"  class="form-control @error('publisher') is-invalid @enderror" id="Penerbit" name="publisher" value="{{ $buku->publisher }}">
        @error('publisher')
            {{ $message }}
        @enderror
    </div>

    <div class="form-group">
        <label for="thnTerbit">Tahun Terbit</label>
        <input type="text"  class="form-control @error('year_published') is-invalid @enderror" id="thnTerbit" name="year_published" value="{{ $buku->year_published }}">
        @error('year_published')
            {{ $message }}
        @enderror
    </div>

    <div class="form-group">
        <label for="ISBN">ISBN</label>
        <input type="text"  class="form-control @error('isbn') is-invalid @enderror" id="ISBN" name="isbn" value="{{ $buku->isbn }}" required>
        @error('isbn')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="form-group">
        <label for="kategori">Kategori</label>
        <select  id="kategori" class="form-control @error('category_id') is-invalid @enderror" name="category_id">
            @foreach($kategori as $k)
                <option value="{{ $k->id }}" {{ $buku->kategori == $k->id ? 'selected' : '' }}>{{ $k->name }}</option>
            @endforeach
        </select>
        @error('category_id')
            {{ $message }}
        @enderror
    </div>
    <div class="form-group">
        <label for="deskripsi">Deskripsi</label>
        <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" value="{{ $buku->deskripsi }}" required> </textarea>
        @error('deskripsi')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="form-group">
        <label for="formFile">Cover Buku</label>
        <input type="file" class="form-control @error('formFile') is-invalid @enderror" id="formFile" name="formFile">
        @if($buku->urlFoto)
            <img src="{{ asset('storage/' . $buku->urlFoto) }}" alt="Cover Buku" style="width: 150px; height: auto;">
        @endif

        @error('formFile')
            <div class="inavlid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <span> 
        <button type="submit" class="btn btn-primary mt-3 p-2">Tambah</button>
        <a href="{{ route('buku.index') }}" class="btn btn-danger mt-3 p-2">Kembali ke Index</a>
      </span>
</form>
@endsection
