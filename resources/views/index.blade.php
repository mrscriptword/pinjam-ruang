@extends('layouts.main')

@section('container')
    <div class="preloader">
        <div class="loader">
            <div class="ytp-spinner">
                <div class="ytp-spinner-container">
                    <div class="ytp-spinner-rotator">
                        <div class="ytp-spinner-left">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                        <div class="ytp-spinner-right">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section id="home" class="hero-area bg_cover" style="background: linear-gradient(to bottom right, #fefae0, #d9ed92); min-height: 90vh;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="hero-content">
                        <h2 class="mb-4 wow fadeInUp" data-wow-delay=".2s" style="font-weight: bold; color: #081c15;">Halo, Selamat Datang di SIPIRANG!</h2>
                        <p class="wow fadeInUp" data-wow-delay=".4s" style="color: #081c15;">Sistem Peminjaman Ruangan Fakultas Teknik Universitas Sultan Ageng Tirtayasa. Mudah, cepat, dan efisien!</p>
                        <div class="hero-btns mt-4">
                            <a href="/daftarruang" class="main-btn wow fadeInUp" data-wow-delay=".6s" style="background-color: #52b788; color: white; padding: 10px 20px; border-radius: 10px;">Pinjam Sekarang</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 text-center">
                    <img src="{{ asset('assets/images/maskot-badak.png') }}" alt="Maskot Badak" class="img-fluid" style="max-height: 400px;">
                </div>
            </div>
        </div>
    </section>

    <section id="tentang" class="about-area pt-100 pb-100" style="background-color: #e9f5db;">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <h2 class="mb-4 wow fadeInUp" data-wow-delay=".2s" style="font-weight: bold; color: #081c15;">Tentang SIPIRANG</h2>
                    <p class="wow fadeInUp" data-wow-delay=".4s" style="color: #344e41;">
                        SIPIRANG adalah sistem informasi peminjaman ruangan di Fakultas Teknik UNTIRTA untuk mendukung efektivitas penggunaan ruang kampus secara online. 
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section id="bantuan" class="skill-area pt-100 pb-100">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <h2 class="mb-4 wow fadeInUp" data-wow-delay=".2s" style="font-weight: bold;">Panduan Penggunaan</h2>
                    <p class="wow fadeInUp" data-wow-delay=".4s" style="color: #081c15;">
                        Ikuti langkah berikut untuk memanfaatkan SIPIRANG secara maksimal:
                    </p>
                </div>
            </div>
            <div class="row pt-5">
                <div class="col-md-4">
                    <div class="single-skill wow fadeInUp" data-wow-delay=".2s" style="background-color: #fefae0; padding: 30px; border-radius: 15px; box-shadow: 0px 2px 10px rgba(0,0,0,0.1);">
                        <h4 class="mb-3">1. Login</h4>
                        <p>Masuk menggunakan akun yang diberikan admin untuk mengakses sistem peminjaman.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-skill wow fadeInUp" data-wow-delay=".4s" style="background-color: #fefae0; padding: 30px; border-radius: 15px; box-shadow: 0px 2px 10px rgba(0,0,0,0.1);">
                        <h4 class="mb-3">2. Pilih Ruangan</h4>
                        <p>Buka menu Daftar Ruangan dan cek ketersediaan, lalu isi form peminjaman.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-skill wow fadeInUp" data-wow-delay=".6s" style="background-color: #fefae0; padding: 30px; border-radius: 15px; box-shadow: 0px 2px 10px rgba(0,0,0,0.1);">
                        <h4 class="mb-3">3. Tunggu Konfirmasi</h4>
                        <p>Cek status peminjaman melalui menu Daftar Peminjaman setelah mengisi form.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
