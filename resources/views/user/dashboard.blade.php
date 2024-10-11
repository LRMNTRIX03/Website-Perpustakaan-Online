@extends('user.layouts.mainUser')
@section('content')
<div class="container-fluid">
    <div id="carouselExample" class="carousel slide mb-5">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="container-fluid text-center">
                    <img src="{{ asset('img/perpus.jpg') }}" alt="" class="img-fluid" style="width:100%; height:50vh;">
                    <h1 class="carousel-caption d-none d-md-block">Selamat Datang di Perpustakaan Online</h1>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container-fluid text-center">
                    <img src="{{ asset('img/fiksi.jpg') }}" alt="" class="img-fluid" style="width:100%; height:50vh;">
                    <h1 class="carousel-caption d-none d-md-block">Bukalah Jendela Ilmu mu!</h1>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container-fluid text-center">
                    <img src="{{ asset('img/pendidikan.png') }}" alt="" class="img-fluid" style="width:100%; height:50vh;">
                    <h1 class="carousel-caption d-none d-md-block">Ayo Baca Buku</h1>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

   
    <div class="book-category mt-5">
      <h2 class="text-center mb-4">Buku-Buku</h2>
      <div class="d-flex justify-content-end mb-3">
          <a href="{{ route('user.daftarBuku') }}" class="btn btn-primary">Lihat Koleksi Buku</a>
      </div>
      <div class="row">
          @foreach ($buku as $bk)
          <div class="col-lg-3 col-md-4 col-sm-6 mb-4 d-flex justify-content-center">
              <div class="card h-100 text-center" style="width: 18rem;">
                  <img src="{{ asset('storage/'. $bk->urlFoto) }}" class="card-img-top" alt="{{ $bk->title }}" style="height: 200px; object-fit: cover;">
                  <div class="card-body">
                      <h5 class="card-title">{{ $bk->title }}</h5>
                      <a href="{{ route('user.bookDetail', $bk->id) }}" class="btn btn-primary">Lihat Buku</a>
                  </div>
              </div>
          </div>
          @endforeach
      </div>
  </div>
  
</div>
@endsection
