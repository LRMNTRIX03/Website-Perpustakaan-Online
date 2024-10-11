@extends('admin.layouts.mainAdmin')

@section('content')
<div class="table-responsive">
  <h1>Daftar Kategori</h1> 
  <form action="{{ route('kategori.index') }}" method="GET" class="mb-3">
    @csrf
    <div class="row g-2">
      <div class="col-12 col-md-8">
        <input type="text" name="search" class="form-control" placeholder="Cari di sini!" value="{{ request('search') }}">
      </div>
      <div class="col-12 col-md-4">
        <button type="submit" class="btn btn-primary w-100">Cari</button>
      </div>
    </div>
  </form>
  <a href="{{ route('kategori.index') }}" class="btn btn-success"><i class="fa-solid fa-arrows-rotate"></i> Refresh</a> 
  <table class="table table-bordered table-striped table-hover mt-5">
    <thead class="thead-dark">
      <tr>
        <th scope="col" style="width: 5%;">No.</th>
        <th scope="col" style="width: 20%;">Nama Kategori</th>
        <th scope="col" style="width: 20%;">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($kategori as $kat)
      <tr>
        <th scope="row">{{ $loop->iteration }}</th>
        <td> {{ $kat->name }}</td>
        <td>
          <!-- Tombol Edit -->
          <a href="{{ route('kategori.edit', $kat->id) }}" class="btn btn-sm btn-primary">Edit</a>
          
          <!-- Tombol Delete -->
          <form action="{{ route('kategori.destroy', $kat->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
        </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  
  <!-- Tombol Tambah Buku -->
  <a class="btn btn-success" href="{{ route('kategori.create') }}">Tambah Kategori</a>

  <div class="d-flex justify-content-center mt-4">
    {{ $kategori->onEachSide(1)->links('pagination::bootstrap-5') }}
  </div>
</div>
@endsection
