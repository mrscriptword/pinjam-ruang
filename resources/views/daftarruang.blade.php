@extends('layouts.main')

@section('container')
<!--====== Daftar Ruang ======-->
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
<section id="blog" class="blog-area pt-170 pb-140">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-7">
                <div class="section-title">
                    <h2 class="wow fadeInUp" data-wow-delay=".2s">Daftar Ruangan</h2>
                    <p class="wow fadeInUp" data-wow-delay=".4s">Pesan Ruang dengan Lebih Mudah! Kami menyediakan solusi
                        peminjaman ruang yang praktis untuk mahasiswa dan staf universitas.</p>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($rooms as $room)
            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="single-blog">
                    <div class="blog-img">
                        <a href="/showruang/{{ $room->code }}">
                            @if ($room->img && Storage::exists('public/' . $room->img))
                            <img src="{{ asset('storage/' . $room->img) }}" alt="">
                            @else
                            @if ($room->img)
                            <img src="{{ $room->img }}" alt="FotoRuang">
                            @endif
                            @endif
                        </a>
                    </div>
                    <div class="blog-content">
                        <h4><a href="/showruang/{{ $room->code }}">{{ $room->name }}</a></h4>
                        <p>Gedung : {{ $room->building->name }}</p>
                        <p>Kapasitas : {{ $room->capacity }}</p>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="d-flex justify-content-end">
                {{ $rooms->links() }}
            </div>
        </div>


    </div>
</section>

<section id="contact" class="contact-area">
    <div class="map-bg">
        <img src="assets/images/map-bg.svg" alt="">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xl-5 col-lg-5">
                <div class="section-title">
                    <h2 class="wow fadeInUp" data-wow-delay=".2s">Form Pinjam Ruang</h2>
                    <p class="wow fadeInUp" data-wow-delay=".4s">Isi form secara lengkap untuk meminjam ruangan</p>
                </div>
            </div>
            <div class="col-xl-7 col-lg-7">
                <div class="contact-form-wrapper">
                    <form action="/daftarpinjam" method="post">
                        @csrf
                        <input type="hidden" name="room_id_hidden" id="room_id_hidden">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="room_id" class="form-label d-block">Kode Ruangan</label>
                                <select class="form-select" aria-label="Default select example" name="room_id"
                                    id="room_id" required>
                                    @if (count(request()->segments()) < 3)
                                        <option selected disabled>Pilih Kode Ruangan</option>
                                        @endif
                                        @foreach ($allRooms as $room)
                                        @if ($room->code == request()->segment(count(request()->segments())))
                                        <option value="{{ $room->id }}" selected>{{ $room->code }}
                                            @else
                                        <option value="{{ $room->id }}">{{ $room->name }}
                                        </option>
                                        @endif
                                        @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label for="time_start" class="form-label">Mulai Pinjam</label>
                                <input type="datetime-local" class="form-control @error('time_start_use') is-invalid @enderror" id="time_start_use"
                                    name="time_start_use" value="{{ old('time_start_use') }}" required min="{{ date('Y-m-d\TH:i') }}">
                                @error('time_start_use')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <div class="invalid-feedback" id="time_start_feedback">
                                    Waktu mulai pinjam tidak boleh di masa lalu.
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="time_end" class="form-label">Selesai Pinjam</label>
                                <input type="datetime-local" class="form-control @error('time_end_use') is-invalid @enderror" id="time_end_use"
                                    name="time_end_use" value="{{ old('time_end_use') }}" required>
                                @error('time_end_use')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <div class="invalid-feedback" id="time_end_feedback">
                                    Waktu selesai pinjam harus setelah waktu mulai pinjam.
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="purpose" class="form-label">Tujuan</label>
                                <input type="text" class="form-control  @error('purpose') is-invalid @enderror"
                                    id="purpose" name="purpose" value="{{ old('purpose') }}" autocomplete="off"
                                    required>
                                @error('purpose')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-right">
                                <button class="main-btn btn-hover" type="submit">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--====== Daftar Ruang ======-->
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const startTimeInput = document.getElementById('time_start_use');
        const endTimeInput = document.getElementById('time_end_use');
        const bookingForm = document.querySelector('form[action="/daftarpinjam"]');

        // Set minimum date for start time (today)
        const now = new Date();
        const year = now.getFullYear();
        const month = String(now.getMonth() + 1).padStart(2, '0');
        const day = String(now.getDate()).padStart(2, '0');
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const nowString = `${year}-${month}-${day}T${hours}:${minutes}`;

        startTimeInput.setAttribute('min', nowString);

        // Validation event for start time
        startTimeInput.addEventListener('change', function() {
            const startTime = new Date(this.value);
            const currentTime = new Date();

            if (startTime < currentTime) {
                this.classList.add('is-invalid');
                return false;
            } else {
                this.classList.remove('is-invalid');
                // Update minimum for end time when start time changes
                if (this.value) {
                    endTimeInput.setAttribute('min', this.value);
                }
            }
        });

        // Validation event for end time
        endTimeInput.addEventListener('change', function() {
            const endTime = new Date(this.value);
            const startTime = new Date(startTimeInput.value);

            if (endTime <= startTime) {
                this.classList.add('is-invalid');
                return false;
            } else {
                this.classList.remove('is-invalid');
            }
        });

        // Form submission validation
        bookingForm.addEventListener('submit', function(event) {
            const startTime = new Date(startTimeInput.value);
            const endTime = new Date(endTimeInput.value);
            const currentTime = new Date();

            let formValid = true;

            if (startTime < currentTime) {
                startTimeInput.classList.add('is-invalid');
                formValid = false;
            }

            if (endTime <= startTime) {
                endTimeInput.classList.add('is-invalid');
                formValid = false;
            }

            if (!formValid) {
                event.preventDefault();
            }
        });
    });
</script>