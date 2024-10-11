@extends('admin.layouts.mainAdmin')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Daftar Peminjaman Buku</h1>

    <!-- Form Pencarian -->
    <form action="{{ route('admin.peminjaman.index') }}" method="GET" class="mb-3">
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

    <!-- Tombol Refresh dan Edit Biaya -->
    <a href="{{ route('admin.peminjaman.index') }}" class="btn btn-success mb-3">
        <i class="fa-solid fa-arrows-rotate"></i> Refresh
    </a>

    <!-- Tabel Daftar Peminjaman -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col" style="width: 5%;">No.</th>
                    <th scope="col" style="width: 10%;">Nama Anggota</th>
                    <th scope="col" style="width: 10%;">Nama Buku</th>
                    <th scope="col" style="width: 10%;">Tanggal Awal Peminjaman</th>
                    <th scope="col" style="width: 10%;">Tanggal Tenggat Peminjaman</th>
                    <th scope="col" style="width: 10%;">Tanggal Pengembalian</th>
                    <th scope="col" style="width: 10%;">Status</th>
                    <th scope="col" style="width: 10%;">Denda</th>
                    <th scope="col" style="width: 10%;">Bukti Bayar Denda</th>
                    <th scope="col" style="width: 10%;">Aksi</th>
                    <th scope="col" style="width: 10%;">Hapus</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($peminjaman as $p)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $p->user->name }}</td>
                    <td>

                        {{ $p->buku->title }}
                        @if($p->buku->urlFoto)
                        <img src="{{ asset('storage/' . $p->buku->urlFoto) }}" alt="{{ $p->buku->title }}" width="80px" height="80px">
                        @else
                        <div>-</div>
                        @endif
                    </td>
                    <td>{{ $p->tanggal_pinjam }}</td>
                    <td>{{ $p->tanggal_tenggat }}</td>
                    <td>{{ $p->tanggal_kembali }}</td>
                    <td>{{ $p->status }}</td>
                    <td>{{ $p->denda }}</td>
                    <td>
                        @if($p->bukti_denda)
                        <a href="{{ asset('storage/' . $p->bukti_denda) }}" target="_blank" class="btn btn-success">
                            <i class="fa-solid fa-eye"></i> Lihat Bukti
                        </a>
                        @else
                        <p>-</p>
                        @endif
                    </td>
                    <td>
                        @if($p->status == 'dipinjam')
                        <span class="badge badge-success text-black">Buku Sedang Dipinjam</span>
                        @elseif ($p->status == 'diproses')
                        <span class="d-flex flex-row">
                            <form action="{{ route('admin.peminjaman.approve', $p->id) }}" method="post">
                                @csrf
                                <input type="submit" class="btn btn-success btn-xl" value="Terima">
                            </form>
                            <form action="{{ route('admin.peminjaman.reject', $p->id) }}" method="post">
                                @csrf
                                <input type="submit" class="btn btn-danger btn-xl ml-5" value="Tolak" style="margin-left: 20px">
                            </form>
                        </span>
                        @elseif($p->status == 'ditolak')
                        <span class="badge badge-danger" style="color: black;">Peminjaman Ditolak</span>
                        @elseif($p->denda > 0 && $p->status_denda == 'ada denda')
                        <!-- Kolom Konfirmasi Bukti -->
                        <div class="mb-3">
                            <form action="{{ route('admin.pinjaman.konfirmasi', $p->id) }}" method="post">
                                @csrf
                                <input type="submit" value="Konfirmasi" class="btn btn-warning btn-xl">  
                            </form>
                        </div>
                        <!-- Kolom Penolakan Bukti -->
                        <div class="mb-3">
                            <form action="{{ route('admin.pinjaman.penolakan', $p->id) }}" method="post" onsubmit="return confirmDelet()">
                                @csrf
                                <input type="submit" value="Tolak" class="btn btn-danger btn-xl">
                            </form>
                        </div>
                        @else
                        <span class="badge badge-success text-black">Buku Sudah Dikembalikan</span>
                        @endif
                    </td>
                    <!-- Kolom Hapus hanya muncul jika status 'dikembalikan' atau 'ditolak' -->
                    <td>
                        @if ($p->status == 'dikembalikan' || $p->status == 'ditolak')
                        <form action="{{ route('admin.pinjaman.destroy', $p->id) }}" method="post" onsubmit="return confirmDelet()">
                            @csrf
                            <input type="submit" value="Hapus" class="btn btn-danger btn-xl">
                        </form>
                        @else
                        <div>-</div> <!-- Kolom kosong jika status bukan dikembalikan atau ditolak -->
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Tampilkan pesan jika data kosong -->
        @if ($peminjaman->isEmpty())
        <div class="alert alert-danger">Data Tidak Ditemukan</div>
        @endif

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $peminjaman->onEachSide(1)->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

<script>
    function confirmDelet() {
        return confirm('Apakah Anda yakin ingin menghapus data ini?');
    }
</script>

@endsection
