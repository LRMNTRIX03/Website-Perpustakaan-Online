@extends('admin.layouts.mainAdmin')

@section('content')
<div class="table-responsive">
  <h1>Daftar Buku</h1>
  <form action="{{ route('buku.index') }}" method="GET" class="mb-3">
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
  <a href="{{ route('buku.index') }}" class="btn btn-success"><i class="fa-solid fa-arrows-rotate"></i> Refresh</a>
  <table class="table table-bordered table-striped table-hover mt-5">
    <thead class="thead-dark">
      <tr>
        <th scope="col" style="width: 5%;">No.</th>
        <th scope="col" style="width: 20%;">Nama Buku</th>
        <th scope="col" style="width: 15%;">Author</th>
        <th scope="col" style="width: 15%;">Penerbit</th>
        <th scope="col" style="width: 10%;">Tahun Terbit</th>
        <th scope="col" style="width: 15%;">ISBN</th>
        <th scope="col" style="width: 10%;">Kategori</th>
        <th scope="col" style="width: 30%;">Deskripsi</th>
        <th scope="col" style="width: 10%;">Status</th>
        <th scope="col" style="width: 10%;">Action</th>
      </tr>
    </thead>
    <tbody>
   
      @foreach($buku as $book)
      <tr>
        <th scope="row">{{ $loop->iteration + ($buku->currentPage() - 1) * $buku->perPage() }}</th>
        <td>
          {{ $book->title }}
          @if($book->urlFoto)
          <img src="{{ asset('storage/' . $book->urlFoto) }}" alt="Cover {{ $book->title }}" class="img-thumbnail" style="width: 100px; height: auto; display:block;">
          @else
              <div>-</div>
          @endif
        </td>
        <td>{{ $book->author }}</td>
        <td>{{ $book->publisher ?? '-' }}</td>
        <td>{{ $book->year_published ?? '-' }}</td>
        <td>{{ $book->isbn }}</td>
        <td>{{ $book->category->name ?? '-' }}</td>
        <td>{{ $book->deskripsi ?? '-' }}</td>
        <td>{{ ucfirst($book->status) }}</td>
        <td>
          <!-- Tombol Edit -->
          <a href="{{ route('buku.edit', $book->id) }}" class="btn btn-sm btn-primary">Edit</a>
          
          <!-- Tombol Delete -->
          <form action="{{ route('buku.destroy', $book->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  @if ($buku->isEmpty())
  <div class="alert alert-danger">Data Tidak Ditemukan</div>
@endif

  <!-- Tombol Tambah Buku -->
  <a class="btn btn-success" href="{{ route('buku.create') }}">Tambah Buku</a>

  <!-- Tampilkan tautan paginasi -->
  <div class="d-flex justify-content-center mt-4">
    {{ $buku->onEachSide(1)->links('pagination::bootstrap-5') }}
  </div>
</div>
@endsection
