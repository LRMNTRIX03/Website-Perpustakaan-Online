@extends('user.layouts.mainUser')

@section('content')
<div class="container mt-5">
  <h1 class="mb-4">Daftar Peminjaman Buku</h1>
  <form action="{{ route('pinjam.index') }}" method="GET" class="mb-3">
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
  <a href="{{ route('pinjam.index') }}" class="btn btn-success mb-3"><i class="fa-solid fa-arrows-rotate"></i> Refresh</a>
  <div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
      <thead class="thead-dark">
        <tr>
          <th scope="col" style="width: 5%;">No.</th>
          <th scope="col" style="width: 10%;">Nama Buku</th>
          <th scope="col" style="width: 10%;">Status Peminjaman</th>
          <th scope="col" style="width: 10%;">Tanggal Peminjaman</th>
          <th scope="col" style="width: 10%;">Tanggal Tenggat</th>
          <th scope="col" style="width: 20%;">Tanggal Kembali</th>
          <th scope="col" style="width: 20%;">Denda</th>
          <th scope="col" style="width: 30%;">Bukti Pembayaran Denda</th>
          <th scope="col" style="width: 30%;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($peminjaman as $p)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $p->buku->title }}</td>
          <td>{{ $p->status }}</td>
          <td>{{ $p->tanggal_pinjam }}</td>
          <td>{{ $p->tanggal_tenggat }}</td>
          <td>{{ $p->tanggal_kembali }}</td>
          <td>@if($p->denda)
            {{ $p->denda }}
            @else
            <p>-</p>
            @endif
          </td>
          <td> @if($p->bukti_denda)
            <a href="{{ asset('storage/' . $p->bukti_denda) }}" target="_blank" class="btn btn-success">
              <i class="fa-solid fa-eye"></i> Lihat Bukti
          </a>
            @elseif ($p->bukti_denda == null && $p->denda > 0)
            <form action="{{ route('pinjam.buktiBayar', $p->id) }}" method="post" enctype="multipart/form-data">
              @csrf
              <input class="form-control @error('bukti_denda') is-invalid @enderror" type="file" id="bukti_denda" name="bukti_denda">
              @error('bukti_denda')
             <div class="invalid-feedback">{{ $message }}</div> 
              @enderror
              <input type="submit" value="Kirim" class="btn btn-primary sm">
            </form>
            @else
            <p>-</p>
            @endif
          </td>
          <td>
            @if($p->status == 'dipinjam')
              <form action="{{ route('buku.kembalikan', $p->id) }}" method="post" class="d-inline">
                @csrf
                <button class="btn btn-warning btn-sm" type="submit">Kembalikan Buku</button>
              </form>
              <a href="{{ route('buku.baca', $p->id) }}" class="btn btn-success btn-sm">Baca Buku</a>
            @elseif ($p->status == 'diproses')
              <span class="badge badge-warning text-black">Sedang Diproses oleh Admin</span>
            @elseif($p->status == 'ditolak')
              <span class="badge badge-success text-black">Peminjaman Ditolak</span>
            @else
            <span class="badge badge-success text-black">Buku Sudah dikembalikan</span>
            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <div class="d-flex justify-content-center mt-4">
      {{ $peminjaman->onEachSide(1)->links('pagination::bootstrap-5') }}
    </div>
  </div>
</div>
@endsection
