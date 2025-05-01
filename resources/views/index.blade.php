@extends('layouts.main')

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        body {
            background-color: #f3f4f6;
            font-family: 'Poppins', sans-serif;
        }

        .hero-area {
            background: none;
            min-height: 90vh;
            display: flex;
            align-items: center;
        }

        h2 {
            font-weight: 700;
            color: #1f2937;
            font-size: 2.5rem;
            line-height: 1.3;
            margin-bottom: 1.5rem;
        }

        .hero-content h2 span {
            color: #576ebb;
        }

        .hero-content p {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #4b5563;
            margin-bottom: 2rem;
        }

        .main-btn {
            background-color: #576ebb;
            color: #fff !important;
            justify-content: center;
            border-color: #576ebb;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .main-btn:hover {
            background-color: #3e3f5b;
            border-color: #3e3f5b;
            color: #fff !important;
        }

        .hero-btn {
            text-align: center;
        }

        .hero-left {
            position: relative;
            height: 600px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            background: none;
        }

        .hero-left:hover {
            transform: translateY(-5px);
        }

        .hero-left img:first-child {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 20px;
            max-height: 500px;
            max-width: 100%;
        }

        .single-skill {
            background-color: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .skill-content h4 {
            font-weight: 600;
            color: #1f2937;
            margin: 1rem 0;
        }

        .skill-content p {
            color: #6b7280;
            line-height: 1.7;
        }

        .section-title p {
            font-size: 1.1rem;
            color: #4b5563;
            margin-bottom: 3rem;
        }

        .feature-cards {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-top: 2rem;
        }

        .feature-card {
            flex: 0 1 auto;
            margin: 0 10px;
        }

        .feature-icon {
            width: 230px;
            height: auto;
            transition: transform 0.3s ease;
        }

        .feature-card-highlighted .feature-icon {
            width: 260px;
            transform: scale(1.1);
        }

        @media (max-width: 992px) {
            .hero-area {
                background: #e5e7eb;
                padding: 4rem 0;
                min-height: auto;
            }

            .hero-left {
                height: 400px;
                margin-top: 3rem;
            }

            .hero-left img:first-child {
                max-height: 300px;
            }
        }
    </style>

    <div class="preloader">
        <!-- Preloader tetap sama -->
    </div>

    <section id="home" class="hero-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 order-lg-2">
                    <div class="hero-left">
                        <img src="assets/images/crodas.png" alt="Crodas maskot UNTIRTA" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-6 order-lg-1">
                    <div class="hero-content pe-lg-5">
                        <h2 class="wow fadeInUp" data-wow-delay=".2s">
                            Sistem Peminjaman Ruangan<br>
                            <span>Fakultas Teknik UNTIRTA</span>
                        </h2>
                        <p class="wow fadeInUp" data-wow-delay=".4s">
                            Layanan peminjaman ruangan terintegrasi untuk civitas akademika.
                            Kelola jadwal, ajukan permohonan, dan pantau status peminjaman
                            secara real-time melalui sistem kami.
                        </p>
                        <div class="hero-btns">
                            <a href="/daftarruang" class="main-btn wow fadeInUp" data-wow-delay=".6s"
                               style="text-decoration: none;">
                                Ajukan Peminjaman
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                     class="bi bi-arrow-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                          d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="skill" class="skill-area pt-170">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-7 col-md-10 mx-auto">
                    <div class="section-title text-center">
                        <h2 class="mb-15 wow fadeInUp" data-wow-delay=".2s" style="margin-top: 40px;">Tentang Sipirang</h2>
                        <p class="wow fadeInUp" data-wow-delay=".4s">
                            Sipirang (Sistem Peminjaman Ruangan) adalah platform digital yang dirancang untuk mempermudah
                            pengelolaan dan peminjaman ruang di lingkungan Fakultas Teknik UNTIRTA.
                            Sistem ini bertujuan untuk menciptakan transparansi, efisiensi, dan kenyamanan bagi seluruh
                            civitas akademika.
                        </p>
                    </div>
                </div>
            </div>

            <div class="feature-cards d-flex justify-content-center align-items-center">
                <div class="feature-card">
                    <img src="assets/images/Tata1.png" alt="Icon 1" class="feature-icon">
                </div>
                <div class="feature-card feature-card-highlighted">
                    <img src="assets/images/Tata2.png" alt="Icon 2" class="feature-icon">
                </div>
                <div class="feature-card">
                    <img src="assets/images/Tata3.png" alt="Icon 3" class="feature-icon">
                </div>
            </div>

            <div class="row" style="margin-top: 10%;">
                <div class="col-xl-6 col-lg-7 col-md-10 mx-auto">
                    <div class="section-title text-center">
                        <h2 class="mb-15 wow fadeInUp" data-wow-delay=".2s">Cara Pinjam?</h2>
                        <p class="wow fadeInUp" data-wow-delay=".4s">Tata Cara Penggunaan Sistem Peminjaman Ruangan
                            <br> Universitas Sultan Ageng Tirtayasa</p>
                    </div>
                </div>
            </div>

            <div class="row" style="margin-top: 20px;">
                @php
                    $steps = [
                        ['icon' => 'bi-box-arrow-in-down', 'title' => 'Login', 'desc' => 'Silahkan login terlebih dahulu sesuai dengan username yang telah disediakan oleh admin'],
                        ['icon' => 'bi-chat-square-text-fill', 'title' => 'Isi Form', 'desc' => 'Silakan menuju ke menu Daftar Ruangan. Jika ruangan tersedia, isi form peminjaman secara lengkap, dan submit.'],
                        ['icon' => 'bi-snapchat', 'title' => 'Konfirmasi', 'desc' => 'Admin akan memverifikasi permohonan peminjaman dan menginformasikan status peminjaman.']
                    ];
                @endphp

                @foreach ($steps as $i => $step)
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="single-skill wow fadeInUp" data-wow-delay=".{{ 2 + $i * 2 }}s">
                            <div class="skill-icon">
                                <i class="bi {{ $step['icon'] }}" style="font-size: 40px;"></i>
                            </div>
                            <div class="skill-content">
                                <h4>{{ $step['title'] }}</h4>
                                <p>{{ $step['desc'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
