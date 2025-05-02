@extends('layouts.main')

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        :root {
            --primary-color: #576ebb;
            --primary-dark: #3e3f5b;
            --secondary-color: #f3f4f6;
            --accent-color: #f59e0b;
            --text-dark: #1f2937;
            --text-medium: #4b5563;
            --text-light: #6b7280;
        }

        body {
            background-color: var(--secondary-color);
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
        }

        /* Hero Section */
        .hero-area {
            min-height: 90vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .hero-area::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 100%;
            z-index: 0;
        }

        h2 {
            font-weight: 700;
            color: var(--text-dark);
            font-size: 2.8rem;
            line-height: 1.3;
            margin-bottom: 1.5rem;
            position: relative;
            display: inline-block;
        }

        .hero-content h2 span {
            color: var(--primary-color);
            position: relative;
        }

        .hero-content h2 span::after {
            content: '';
            position: absolute;
            bottom: 5px;
            left: 0;
            width: 100%;
            height: 8px;
            z-index: -1;
            border-radius: 4px;
        }

        .hero-content p {
            font-size: 1.15rem;
            line-height: 1.8;
            color: var(--text-medium);
            margin-bottom: 2rem;
            max-width: 90%;
        }

        .main-btn {
            background-color: var(--primary-color);
            color: #fff !important;
            border-color: var(--primary-color);
            padding: 14px 32px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 4px 6px rgba(87, 110, 187, 0.2);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .main-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: 0.5s;
            z-index: -1;
        }

        .main-btn:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(87, 110, 187, 0.3);
        }

        .main-btn:hover::before {
            left: 100%;
        }

        .hero-left {
            position: relative;
            height: 600px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
            transition: all 0.4s ease;
            background: none;
            z-index: 1;
        }

        .hero-left::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, rgba(87,110,187,0.1) 0%, rgba(255,255,255,0) 50%);
            z-index: -1;
        }

        .hero-left:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 30px 60px -12px rgba(0, 0, 0, 0.2);
        }

        .hero-left img:first-child {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 20px;
            max-height: 500px;
            max-width: 100%;
        }

        /* About Section */
        .skill-area {
            padding: 100px 0;
        }

        /* Feature Cards */
        .feature-cards {
            display: flex;
            justify-content: center;
            align-items: flex-end;
            gap: 1.5rem;
            margin-top: 3rem;
            padding: 2rem 0;
        }

        .feature-card {
            flex: 0 1 auto;
            transition: all 0.3s ease;
            position: relative;
        }

        .feature-card:hover {
            transform: translateY(-10px);
        }

        .feature-icon {
            width: 200px;
            height: auto;
            transition: all 0.3s ease;
            filter: drop-shadow(0 10px 8px rgba(0,0,0,0.1));
        }

        .feature-card-highlighted {
            align-self: flex-start;
        }

        .feature-card-highlighted .feature-icon {
            width: 240px;
            filter: drop-shadow(0 15px 12px rgba(0,0,0,0.15));
        }

        /* How To Section */
        .how-to-section {
            position: relative;
            padding: 5rem 0;
        }

        .how-to-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .step-container {
            position: relative;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .step-line {
            position: absolute;
            left: 50%;
            top: 0;
            bottom: 0;
            width: 4px;
            background: var(--primary-color);
            transform: translateX(-50%);
            z-index: 1;
        }

        .step-line::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: -8px;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: var(--primary-color);
            z-index: 2;
        }

        .steps-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 60px;
            position: relative;
            z-index: 2;
        }

        .steps-row:last-child {
            margin-bottom: 0;
        }

        .step-card {
            width: calc(50% - 60px);
            padding: 30px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
            position: relative;
            transition: all 0.3s ease;
        }

        .step-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px -5px rgba(0, 0, 0, 0.1);
        }

        .step-card.left {
            text-align: right;
        }

        .step-card.right {
            margin-left: auto;
        }

        .step-number {
            position: absolute;
            width: 50px;
            height: 50px;
            background: var(--primary-color);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.5rem;
            box-shadow: 0 4px 8px rgba(87, 110, 187, 0.3);
        }

        .step-card.left .step-number {
            right: -75px;
            top: 50%;
            transform: translateY(-50%);
        }

        .step-card.right .step-number {
            left: -75px;
            top: 50%;
            transform: translateY(-50%);
        }

        .step-icon {
            width: 60px;
            height: 60px;
            margin-bottom: 20px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(87, 110, 187, 0.1);
            border-radius: 50%;
            color: var(--primary-color);
        }

        .step-card.left .step-icon {
            float: right;
            margin-left: 20px;
            margin-right: 0;
        }

        .step-card.right .step-icon {
            float: left;
            margin-right: 20px;
            margin-left: 0;
        }

        .step-content h4 {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 1rem;
            font-size: 1.3rem;
        }

        .step-content p {
            color: var(--text-medium);
            line-height: 1.7;
            margin-bottom: 0;
        }

        /* Responsive Adjustments */
        @media (max-width: 1200px) {
            .step-card {
                width: calc(50% - 40px);
            }
            
            .step-card.left .step-number {
                right: -60px;
            }
            
            .step-card.right .step-number {
                left: -60px;
            }
        }

        @media (max-width: 992px) {
            .hero-area {
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

            .hero-content h2 {
                font-size: 2.2rem;
            }

            .hero-content p {
                max-width: 100%;
            }

            .feature-cards {
                flex-direction: column;
                align-items: center;
                gap: 2rem;
            }

            .feature-card-highlighted {
                align-self: center;
            }

            .feature-icon {
                width: 180px;
            }

            .feature-card-highlighted .feature-icon {
                width: 200px;
            }

            /* Timeline adjustments for tablet */
            .step-line {
                left: 40px;
            }

            .steps-row {
                margin-bottom: 40px;
                flex-direction: column;
            }

            .step-card {
                width: 100%;
                margin-left: 80px !important;
                margin-bottom: 20px;
                text-align: left !important;
            }

            .step-card.left .step-number,
            .step-card.right .step-number {
                left: -60px;
                right: auto;
                top: 30px;
                transform: none;
            }

            .step-card.left .step-icon,
            .step-card.right .step-icon {
                float: none;
                margin: 0 0 15px 0;
            }
        }

        @media (max-width: 768px) {
            .hero-content h2 {
                font-size: 1.8rem;
            }

            .hero-content p {
                font-size: 1rem;
            }

            .main-btn {
                padding: 12px 24px;
                font-size: 1rem;
            }

            /* Timeline adjustments for mobile */
            .step-line {
                left: 30px;
            }

            .step-card {
                margin-left: 60px !important;
                padding: 20px;
            }

            .step-card.left .step-number,
            .step-card.right .step-number {
                left: -50px;
                width: 40px;
                height: 40px;
                font-size: 1.2rem;
            }

            .step-icon {
                width: 50px;
                height: 50px;
                margin-bottom: 15px;
            }

            .step-content h4 {
                font-size: 1.1rem;
            }
        }
    </style>

    <section id="home" class="hero-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 order-lg-2">
                    <div class="hero-left wow fadeInRight" data-wow-delay=".4s">
                        <img src="assets/images/crodas.png" alt="Crodas maskot UNTIRTA" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-6 order-lg-1">
                    <div class="hero-content pe-lg-5">
                        <h2 class="wow fadeInUp" data-wow-delay=".2s">
                            Sistem Peminjaman Ruangan<br>
                            <span>Fakultas Teknik UNTIRTA</span>
                        </h2>
                        <p class="wow fadeInUp" data-wow-delay=".3s">
                            Layanan peminjaman ruangan terintegrasi untuk civitas akademika.
                            Kelola jadwal, ajukan permohonan, dan pantau status peminjaman
                            secara real-time melalui sistem kami.
                        </p>
                        <div class="hero-btns wow fadeInUp" data-wow-delay=".4s">
                            <a href="/daftarruang" class="main-btn" style="text-decoration: none;">
                                Ajukan Peminjaman
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/>
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
                        <h2 class="mb-15 wow fadeInUp" data-wow-delay=".2s">Tentang Sipirang</h2>
                        <p class="wow fadeInUp" data-wow-delay=".3s">
                            Sipirang (Sistem Peminjaman Ruangan) adalah platform digital yang dirancang untuk mempermudah
                            pengelolaan dan peminjaman ruang di lingkungan Fakultas Teknik UNTIRTA.
                            Sistem ini bertujuan untuk menciptakan transparansi, efisiensi, dan kenyamanan bagi seluruh
                            civitas akademika.
                        </p>
                    </div>
                </div>
            </div>

            <div class="feature-cards">
                <div class="feature-card wow fadeInUp" data-wow-delay=".2s">
                    <img src="assets/images/Tata1.png" alt="Icon 1" class="feature-icon">
                </div>

                <div class="feature-card feature-card-highlighted wow fadeInUp" data-wow-delay=".3s">
                    <img src="assets/images/Tata2.png" alt="Icon 2" class="feature-icon">
                </div>

                <div class="feature-card wow fadeInUp" data-wow-delay=".4s">
                    <img src="assets/images/Tata3.png" alt="Icon 3" class="feature-icon">
                </div>
            </div>
        </div>
    </section>

    <section class="how-to-section">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-7 col-md-10 mx-auto">
                    <div class="section-title text-center">
                        <h2 class="mb-15 wow fadeInUp" data-wow-delay=".2s">Cara Pinjam Ruangan</h2>
                        <p class="wow fadeInUp" data-wow-delay=".3s">
                            Tata Cara Penggunaan Sistem Peminjaman Ruangan<br>
                            Universitas Sultan Ageng Tirtayasa
                        </p>
                    </div>
                </div>
            </div>

            <div class="step-container">
                <div class="step-line"></div>
                
                <div class="steps-row wow fadeInUp" data-wow-delay=".2s">
                    <div class="step-card left">
                        <div class="step-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"/>
                                <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                            </svg>
                        </div>
                        <div class="step-content">
                            <h4>Login ke Sistem</h4>
                            <p>
                                Silahkan login terlebih dahulu menggunakan akun yang telah terdaftar. 
                                Jika belum memiliki akun, hubungi admin untuk mendapatkan akses.
                            </p>
                        </div>
                        <div class="step-number">1</div>
                    </div>
                </div>
                
                <div class="steps-row wow fadeInUp" data-wow-delay=".3s">
                    <div class="step-card right">
                        <div class="step-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                            </svg>
                        </div>
                        <div class="step-content">
                            <h4>Isi Formulir Peminjaman</h4>
                            <p>
                                Pilih ruangan yang tersedia, isi data lengkap termasuk tanggal, waktu, 
                                dan tujuan peminjaman. Pastikan data yang dimasukkan valid.
                            </p>
                        </div>
                        <div class="step-number">2</div>
                    </div>
                </div>
                
                <div class="steps-row wow fadeInUp" data-wow-delay=".4s">
                    <div class="step-card left">
                        <div class="step-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-hourglass-split" viewBox="0 0 16 16">
                                <path d="M2.5 15a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1h-11zm2-13v1c0 .537.12 1.045.337 1.5h6.326c.216-.455.337-.963.337-1.5V2h-7zm3 6.35c0 .701-.478 1.236-1.011 1.492A3.5 3.5 0 0 0 4.5 13s.866-1.299 3-1.48V8.35zm1 0v3.17c2.134.181 3 1.48 3 1.48a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351z"/>
                            </svg>
                        </div>
                        <div class="step-content">
                            <h4>Tunggu Proses Verifikasi</h4>
                            <p>
                                Permohonan Anda akan diverifikasi oleh admin. Anda akan menerima notifikasi 
                                via email atau SMS saat status peminjaman berubah.
                            </p>
                        </div>
                        <div class="step-number">3</div>
                    </div>
                </div>
                
                <div class="steps-row wow fadeInUp" data-wow-delay=".5s">
                    <div class="step-card right">
                        <div class="step-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                            </svg>
                        </div>
                        <div class="step-content">
                            <h4>Peminjaman Disetujui</h4>
                            <p>
                                Setelah disetujui, Anda akan menerima konfirmasi resmi. 
                                Status peminjaman dapat dicek kapan saja melalui dashboard akun Anda.
                            </p>
                        </div>
                        <div class="step-number">4</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection