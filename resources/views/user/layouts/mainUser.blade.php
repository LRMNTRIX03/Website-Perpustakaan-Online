@use('Illuminate\Support\Facades\Auth')
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/mainAdmin.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
  </head>
  <body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg p-4 m-0">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold text-white"><img src="{{asset('img/logoPerpus.png')}}" alt="" class="img-fluid" width="50px" height="50px" style="margin-right: 10px;"> SMA Arif Rahman Hakim</a>
        <!-- Tombol untuk membuka sidebar di layar kecil -->
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
            <i class="bi bi-list"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        </div>
    </div>
</nav>

<!-- Sidebar untuk layar besar -->
<nav class="sidebar d-none d-lg-block">
    <div class="position-sticky">
        <ul class="nav flex-column">
            @auth
                <div class="container-profile">
                    @if (Auth::user()->fotoUrl == null)
                    <i class="fa-solid fa-user side-icon" style="font-size: 2rem; margin-top:2vh;"></i>
                    @else
                    <span class="img-profile"><img src="{{ asset('storage/' . Auth::user()->fotoUrl)}}" alt="Profile" style="width:50px; height:50px;" class="mt-4"></span>
                    @endif
                    <p class="profile fw-bold">{{Auth::user()->name}}</p>
                </div>
                <hr class="divider">
            @endauth
            <li class="side-item">
                <a class="side-item side-link {{ request()->is('dashboard') ? 'active' : '' }}" href="{{ route('user.dashboard') }}" id="side-item"> <i class="fa-solid fa-house side-icon"></i>Dashboard</a>
            </li>
            <li class="side-item">
                <a class="side-item side-link {{ request()->is('profile') ? 'active' : '' }}" href="{{ route('profile') }}" id="side-item"><i class="fa-solid fa-user side-icon"></i>Profile</a>
            </li>
            <li class="side-item">
                <a class="side-item side-link {{ request()->is(['DaftarBuku', 'DaftarBuku/*']) ? 'active' : '' }}" href="{{ route('user.daftarBuku') }}" id="side-item"><i class="fa-solid fa-book side-icon"></i>Daftar Buku</a>
            </li>
            <li class="side-item">
                <a class="side-item side-link {{ request()->is(['peminjaman', 'peminjaman/*']) ? 'active' : '' }}" href="{{ route('pinjam.index')  }}" id="side-item"><i class="fa-solid fa-cart-shopping side-icon"></i>Riwayat Peminjaman</a>
            </li>
            @auth
            <li class="side">
                <form id="logout-form" action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="button" class="btn btn-danger p-3 w-100" onclick="confirmLogout()" style="margin-top: 15vh"><i class="fa-solid fa-right-from-bracket side-icon"></i>Logout</button>
                </form>
            </li>
            @endauth
        </ul>
    </div>
</nav>

<!-- Sidebar untuk layar kecil (offcanvas) -->
<div class="offcanvas offcanvas-start sidebar d-lg-none" tabindex="-1" id="offcanvasSidebar" aria-labelledby="offcanvasSidebarLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasSidebarLabel">Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="nav flex-column">
            @auth
                <div class="container-profile">
                    @if (Auth::user()->fotoUrl == null)
                    <i class="fa-solid fa-user side-icon" style="font-size: 2rem; margin-top:2vh;"></i>
                    @else
                    <span class="img-profile"><img src="{{ asset('storage/' . Auth::user()->fotoUrl)}}" alt="Profile" style="width:50px; height:50px;" class="mt-4"></span>
                 @endif
                    <p class="profile fw-bold">{{Auth::user()->name}}</p>
                </div>
                <hr class="divider">
            @endauth
            <li class="nav-item p-2">
                <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="{{ route('user.dashboard') }}" id="side-item"><i class="fa-solid fa-house side-icon"></i>Dashboard</a>
            </li>
            <li class="side-item">
              <a class="side-item side-link {{ request()->is('profile') ? 'active' : '' }}" href="{{ route('profile') }}" id="side-item"><i class="fa-solid fa-user side-icon"></i>Profile</a>
          </li>
         
          <li class="side-item">
              <a class="side-item side-link {{ request()->is(['DaftarBuku', 'DaftarBuku/*']) ? 'active' : '' }}" href="{{ route('user.daftarBuku') }}" id="side-item"><i class="fa-solid fa-book side-icon"></i>Daftar Buku</a>
          </li>
          <li class="side-item">
              <a class="side-item side-link {{ request()->is(['peminjaman', 'peminjaman/*']) ? 'active' : '' }}" href="{{ route('pinjam.index') }}" id="side-item"><i class="fa-solid fa-cart-shopping side-icon"></i>Riwayat Peminjaman</a>
          </li>
           
            @auth
            <li class="nav-item p-2">
                <form id="logout-form" action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="button" class="btn btn-danger p-3 w-100" onclick="confirmLogout()"><i class="fa-solid fa-right-from-bracket side-icon"></i>Logout</button>
                </form>
            </li>
            @endauth
        </ul>
    </div>
</div>

<!-- Main Content -->
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 content">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"></div>
    <div class="content">
        <div class="container-fluid">@yield('content')</div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
  function confirmLogout() {
    let confirmation = confirm("Apakah Anda yakin ingin logout?");
    if (confirmation) {
      document.getElementById('logout-form').submit();
    }
  }
</script>
</body>
</html>
