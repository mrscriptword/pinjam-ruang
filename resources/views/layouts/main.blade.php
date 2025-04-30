<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }} | Universitas Sultan Ageng Tirtayasa</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/Logo_UNTIRTA.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cal+Sans&display=swap" rel="stylesheet">
</head>
<body style="background-color: #f6f1de;">
    <nav class="navbar navbar-expand-lg px-3" style="background-color: #3e3f5b;">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="/">
                <img src="{{ asset('assets/images/Logo_UNTIRTA.png') }}" style="width: 50px" alt="">
                <span class="nav-link fw-bold ms-2" style="color: #f6f1de; font-size: 1rem;">Sipirang UNTIRTA</span>
            </a>

            <div class="mx-auto d-flex gap-4">
                <a class="nav-link fw-bold" href="/daftarruang"
                style="color: #f6f1de; transition: color 0.3s, text-shadow 0.3s, transform 0.3s;" onmouseover="this.style.color='#ffffff'; this.style.textShadow='0px 0px 5px #ffffff'; this.style.transform='scale(1.1)';" onmouseout="this.style.color='#f6f1de'; this.style.textShadow='none'; this.style.transform='scale(1)';">Daftar Ruangan</a>
                <a class="nav-link fw-bold" href="/" style="color: #f6f1de; transition: color 0.3s, text-shadow 0.3s, transform 0.3s;" onmouseover="this.style.color='#ffffff'; this.style.textShadow='0px 0px 5px #ffffff'; this.style.transform='scale(1.1)';" onmouseout="this.style.color='#f6f1de'; this.style.textShadow='none'; this.style.transform='scale(1)';">Beranda</a>
                <a class="nav-link fw-bold" href="/daftarpinjam" style="color: #f6f1de; transition: color 0.3s, text-shadow 0.3s, transform 0.3s;" onmouseover="this.style.color='#ffffff'; this.style.textShadow='0px 0px 5px #ffffff'; this.style.transform='scale(1.1)';" onmouseout="this.style.color='#f6f1de'; this.style.textShadow='none'; this.style.transform='scale(1)';">Daftar Peminjaman</a>
            </div>

            <div class="d-flex align-items-center gap-4">
                @auth
                    <i class="bi bi-bell-fill fs-5" style="color: #f6f1de; transition: transform 0.3s, color 0.3s; cursor: pointer;" onmouseover="this.style.transform='scale(1.2)'; this.style.color='#ffffff';" onmouseout="this.style.transform='scale(1)'; this.style.color='#f6f1de';"></i>
                    <form action="/logout" method="post">
                        @csrf
                        <button type="submit" class="btn border border-warning rounded-pill text-warning">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </button>
                    </form>
                @else
                    <a href="/login" class="btn border border-warning rounded-pill text-warning">
                        <i class="bi bi-box-arrow-in-right"></i> Login
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container mt-5" style="margin-bottom: 10%">
        @yield('content')
    </div>

    <footer class="text-white text-center py-3 mt-5 position-relative" style="background-color: #3e3f5b;">
        <div class="container position-relative" style="height: 200px;">
            <div class="position-absolute" style="right: 20px; top: 50%; transform: translateY(-50%); text-align: right;">
                <p class="mb-0 fw-bold">Our Team</p>
                <p class="mb-0">Abdulhadi Muntashir</p>
                <p class="mb-0">Rendy Ilyasa</p>
                <p class="mb-0">Damar Bayu Hanugrah</p>
                <p class="mb-0">Yolanda Wulandari</p>
                <p class="mb-0">Naufal Arhab Fadhil Muhammad</p>
                <p class="mb-0">Maulana Faizar Rasyadan</p>
                <p class="mb-0">Naufal Pancar Nugraha</p>
            </div>
        </div>
        <img src="/assets/images/batik.svg" alt="Tata Logo" class="position-absolute" style="bottom: 0; left: 0; height: 100%; margin: 0;">
        <style>
            footer {
                padding-top: 50px;
                padding-bottom: 50px;
            }
        </style>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>
