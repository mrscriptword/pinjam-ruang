<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }} | Sipirang UNTIRTA </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cal+Sans&display=swap" rel="stylesheet">
</head>
  <body style="background-color: #f6f1de;" class="d-flex justify-content-center align-items-center vh-100">

    <div class="d-flex text-center rounded" style="width: 75%; height: 75%; background-color: #3e3f5b;">
        <div class="position-relative col-md-6 d-none d-md-block">
            <img src="/assets/images/login-estetik.png"
                 class="w-100 h-100"
                 style="object-fit: cover;"
                 alt="Gambar Login">
          
            <div class="position-absolute top-50 translate-middle-y ps-3 text-start" style="left: 7%">
                <h1 style="color: #f6f1de !important; font-family: 'Cal Sans'; font-size:100px">Selamat Datang !!</h1>
            </div>
            <div class="position-absolute" style="left: 4%; top: 4%">
                <img src="assets/images/LOGO_ORIGINAL.png" alt="" style="width: 60px; height: 60px;">
            </div>
        </div>

        <div class="col-md-6 d-flex align-items-center justify-content-center flex-column">
            <h2 style="color: #f6f1de !important; font-family: 'Cal Sans'; margin-bottom: 20px;">Log In</h2>
            <form action="/login" method="post" style="width: 75%;">
                @csrf
                @if (session()->has('loginError'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('loginError') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session()->has('regisSuccess'))
                    <div class="col-md-16 mx-auto alert alert-success text-center alert-dismissible fade show"
                        style="margin-top: 50px" role="alert">
                        {{ session('regisSuccess') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="mb-3 text-start">
                    <label for="email" class="form-label" style="color: #f6f1de">Email address</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Masukan email" value="{{ old('email') }}" style="height: 50px;" required>
                    @error('email')
                        <div class="invalid-feedback" style="display: block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3 text-start">
                    <label for="password" class="form-label" style="color: #f6f1de">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Masukan password" style="height: 50px;" required>
                    @error('password')
                        <div class="invalid-feedback" style="display: block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn w-100" style="background-color: #8ab2a6; height: 50px; font-family: 'Cal Sans'; color: #f6f1de">LOGIN</button>
                
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
  </body>
</html>