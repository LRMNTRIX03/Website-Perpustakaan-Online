@extends('user.layouts.mainUser')

@section('content')

<div class="container mt-5">
    <div class="row p-4">
        <div class="col-md-6">
            <img src="{{ asset('storage/' . $buku->urlFoto) }}" class="img-fluid" alt="{{ $buku->title }}" style="object-fit: cover; width:400px;height:400px;">
        </div>
        <div class="col-md-6">
            <h1>{{ $buku->title }}</h1>
            <h4 class="text-muted">{{ $buku->author }}</h4>
            <p class="mt-3">{{ $buku->deskripsi }}</p>
            <p><strong>Kategori:</strong> {{ $buku->category->name }}</p>
            <p><strong>Tanggal Terbit:</strong> {{ $buku->year_published }}</p>
            <!-- Pinjam Buku Button -->
            <button class="btn btn-primary {{ $buku->status == 'dipinjam' ? 'disabled' : '' }}" data-bs-toggle="modal" data-bs-target="#pinjamModal">
                @if ($buku->status == 'dipinjam')
                Telah Dipinjam
                @else
                Pinjam Buku
                @endif
            </button>
            <a href="{{ route('user.daftarBuku') }}" class="btn btn-secondary">Kembali ke Daftar Buku</a>
        </div>
    </div>
</div>

<!-- Modal Peminjaman -->
<div class="modal fade @if ($errors->any()) show @endif" id="pinjamModal" tabindex="-1" aria-labelledby="pinjamModalLabel" aria-hidden="true" @if ($errors->any()) style="display: block;" @endif>
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('buku.pinjam') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="pinjamModalLabel">Pinjam Buku</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="buku_id" value="{{ $buku->id }}">
                    <p>Anda akan meminjam buku <strong>{{ $buku->title }}</strong></p>

                    <div class="form-group">
                        <label for="tanggal_pinjam">Pilih Tanggal Pinjam</label>
                        <input type="date" name="tanggal_pinjam" class="form-control @error('tanggal_pinjam') is-invalid @enderror" value="{{ old('tanggal_pinjam') }}" required>
                        
                        <!-- Menampilkan pesan error jika validasi gagal -->
                        @error('tanggal_pinjam')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Pinjam Buku</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
