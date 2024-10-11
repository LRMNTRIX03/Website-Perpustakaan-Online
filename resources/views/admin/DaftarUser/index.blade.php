@extends('admin.layouts.mainAdmin')

@section('content')
<div class="table-responsive">
  <h1>Daftar Anggota</h1> 
  <form action="{{ route('anggota.index') }}" method="GET" class="mb-3">
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
  <a href="{{ route('anggota.index') }}" class="btn btn-success"><i class="fa-solid fa-arrows-rotate"></i> Refresh</a>
  <table class="table table-bordered table-striped table-hover mt-5">
    <thead class="thead-dark">
      <tr>
        <th scope="col" style="width: 5%;">No.</th>
        <th scope="col" style="width: 10%;">Nama Anggota</th>
        <th scope="col" style="width: 10%;">Username</th>
        <th scope="col" style="width: 15%;">Email</th>
        <th scope="col" style="width: 10%;">TTL</th>
        <th scope="col" style="width: 10%;">Jenis Kelamin</th>
        <th scope="col" style="width: 10%;">No. Telp</th>
        <th scope="col" style="width: 10%;">Alamat</th>
        <th scope="col" style="width: 10%;">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach($user as $usr)
      <tr>
        <th scope="row">{{ $loop->iteration }}</th>
        <td>
          {{ $usr->name }}
          @if($usr->fotoUrl)
          <img src="{{ asset('storage/' . $usr->fotoUrl) }}" alt="Cover {{ $usr->name }}" class="img-thumbnail" style="width: 100px; height: auto; display:block;">
          @else
              <div>-</div>
          @endif
        </td>
        <td>{{ $usr->username}}</td>
        <td>{{ $usr->email }}</td>
        <td>{{ $usr->TTL ?? '-' }}</td>
        <td>{{ $usr->JenisKelamin ?? '-' }}</td>
        <td>{{ $usr->noTelp }}</td>
        <td>{{ $usr->alamat ?? '-' }}</td>
        <td>
        
          <a href="{{ route('anggota.edit', $usr->id) }}" class="btn btn-sm btn-primary">Edit</a>
          <form action="{{ route('anggota.destroy', $usr->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus Anggota ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
          </form>
          <form action="" method="post">
            @csrf
          </form>
          <a href="{{ route('anggota.print', $usr->id) }}" target="_blank" class="btn btn-sm btn-success">Print</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  @if ($user->isEmpty())
  <div class="alert alert-danger">Data Tidak Ditemukan</div>
  @endif
  <a class="btn btn-success" href="{{ route('anggota.create') }}">Tambah Anggota</a>
  <div class="d-flex justify-content-center mt-4">
    {{ $user->onEachSide(1)->links('pagination::bootstrap-5') }}
  </div>
</div>
@endsection
