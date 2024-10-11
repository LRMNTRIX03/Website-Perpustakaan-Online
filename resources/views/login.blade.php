<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Website</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg p-4 m-0" >
      <div class="container-fluid">
        <a class="navbar-brand fw-bold text-light"><img src="{{asset('img/logoPerpus.png')}}" alt="" class="img-fluid " width="50px" height="50px" style="margin-right: 10px;"> SMA Arif Rahman Hakim </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto">
          </ul>
        </div>
      </div>
    </nav>
    <div class="container d-flex justify-content-center align-items-center vh-100">
      <div class="col-md-4">
        <div class="card p-4 shadow">
          <h3 class="text-center mb-4">Login</h3>
          <form action="/login" method="POST">
              @csrf
              <div class="mb-3">
                  <label for="name" class="form-label">Username</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="username" placeholder="Username" required value="{{ old('username') }}">
                  @error('username')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
                  @enderror
              </div>
              <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" required>
              </div>
              <div class="d-grid">
                  <button type="submit" class="btn btn-primary">Login</button>
              </div>
              @if(session()->has('Gagal'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  {{ session('Gagal') }}
              </div>
              @endif
          </form>
          <div class="text-center mt-3">
            <small><a href="{{ route('password.request') }}">Forgot your password?</a></small>
        </div>        
        </div>
      </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"></script>
  </body>
</html>
  