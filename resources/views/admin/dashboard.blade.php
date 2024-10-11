@extends('admin.layouts.mainAdmin')
@section('content')
<div class="dashboard-content" style="margin-top: 10vh;">
    <div class="row">
        <!-- Card 1 - Judul -->
        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3 shadow-lg" style="max-width: 18rem; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">Jumlah Buku</h5>
                        <p class="card-text display-4">{{ $jmlBuku }}</p>
                    </div>
                    <i class="fas fa-book fa-4x"></i> 
                </div>
                <a href="{{ route('buku.index') }}" class="card-footer text-white text-center">Detail <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>

        <!-- Card 2 - Konten Digital -->
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3 shadow-lg" style="max-width: 18rem; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">Jumlah Pinjaman</h5>
                        <p class="card-text display-4">{{ $jmlPinjaman }}</p>
                    </div>
                    <i class="fa-solid fa-cart-shopping fa-4x"></i> <!-- Digital Content Icon -->
                </div>
                <a href="{{ route('admin.peminjaman.index') }}" class="card-footer text-white text-center">Detail <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>

        <!-- Card 3 - Eksemplar -->
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3 shadow-lg" style="max-width: 18rem; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">Jumlah Antrian</h5>
                        <p class="card-text display-4">{{ $jmlantrianPinjaman }}</p>
                    </div>
                    <i class="fa-solid fa-hourglass-start fa-4x"></i> <!-- Book Open Icon -->
                </div>
                <a href="{{ route('admin.peminjaman.index') }}" class="card-footer text-white text-center">Detail <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>

        <!-- Card 4 - Anggota -->
        <div class="col-md-3">
            <div class="card text-white bg-info mb-3 shadow-lg" style="max-width: 18rem; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">Anggota</h5>
                        <p class="card-text display-4">{{ $jmlUser }}</p>
                    </div>
                    <i class="fas fa-users fa-4x"></i> <!-- Users Icon -->
                </div>
                <a href="{{ route('anggota.index')  }}" class="card-footer text-white text-center">Detail <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</div>
@endsection
