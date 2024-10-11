@extends('user.layouts.mainUser')

@section('content')


<div class="container mb-3">
    <form action="{{ route('user.daftarBuku') }}" method="GET" id="searchForm">
        <div class="row">
            <div class="col-md-8">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari buku..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
                <a href="{{ route('user.daftarBuku') }}" class="btn btn-success mb-3"><i class="fa-solid fa-arrows-rotate"></i> Refresh</a>
            </div>
            <div class="col-md-4">
                <select name="category_id" class="form-control" id="categorySelect">
                    <option value="">Semua Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </form>
</div>



<div class="container">
    <div class="row">
        @if ($buku->isEmpty())
            <div class="col-12">
                <div class="alert alert-warning text-center bg-warning" role="alert">
                    Buku tidak ditemukan.
                </div>
            </div>
        @else
            <!-- If books are found, display them -->
            @foreach ($buku as $bk)
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <img src="{{ asset('storage/' . $bk->urlFoto) }}" class="card-img-top" alt="{{ $bk->title }}" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $bk->title }}</h5>
                        <h6 class="card-subtitle text-muted">{{ $bk->author }}</h6>
                        <p class="card-text">{{ Str::limit($bk->deskripsi, 100) }}</p>
                        <a href="{{ route('user.bookDetail', $bk->id) }}" class="btn btn-primary">Lihat Detail</a>
                    </div>
                </div>
            </div>
            @endforeach
        @endif
    </div>
</div>


<div class="d-flex justify-content-center mt-4">
    {{ $buku->appends(['search' => request('search'), 'category_id' => request('category_id')])->onEachSide(1)->links('pagination::bootstrap-4') }}
</div>

<script>

    document.getElementById('categorySelect').addEventListener('change', function() {
        document.getElementById('searchForm').submit();
    });
</script>

@endsection
