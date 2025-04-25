@extends('layouts.main')

@section('container')
<!--====== Show Ruang ======-->
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
<section id="blog" class="container blog-area pt-170 pb-140">
    <div>
        <div class="container row align-items-center  ">
            <div class="col-xl-6 col-lg-6">
                <div class="welcome-content">
                    <div class="section-title">
                        <h3 class="mb-35 wow fadeInUp" data-wow-delay=".2s"> {{ $room->name }}</h3>
                    </div>
                    <div class="content">
                        <table>
                            <tr>
                                <td>
                                    <p class="wow fadeInUp" data-wow-delay=".2s">
                                        Kode Ruangan
                                    </p>
                                </td>
                                <td>
                                    <p class="wow fadeInUp" data-wow-delay=".2s">
                                        : {{ $room->code }}
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="wow fadeInUp" data-wow-delay=".2s">
                                        Gedung
                                    </p>
                                </td>
                                <td>
                                    <p class="wow fadeInUp" data-wow-delay=".2s">
                                        : {{ $room->building->name }}
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="wow fadeInUp" data-wow-delay=".2s">
                                        Lantai
                                    </p>
                                </td>
                                <td>
                                    <p class="wow fadeInUp" data-wow-delay=".2s">
                                        : {{ $room->floor }}
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="wow fadeInUp" data-wow-delay=".2s">
                                        Kapasitas
                                    </p>
                                </td>
                                <td>
                                    <p class="wow fadeInUp" data-wow-delay=".2s">
                                        : {{ $room->capacity }}
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="wow fadeInUp" data-wow-delay=".2s">
                                        Tipe Ruangan
                                    </p>
                                </td>
                                <td>
                                    <p class="wow fadeInUp" data-wow-delay=".2s">
                                        : {{ $room->type }}
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="wow fadeInUp" data-wow-delay=".2s">
                                        Deskripsi
                                    </p>
                                </td>
                                <td>
                                    <p class="wow fadeInUp" data-wow-delay=".2s">
                                        : {{ $room->description }}
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                @if ($room->img && Storage::exists('public/' . $room->img))
                <div class="welcome-img">
                    <img style="width: 400px; border-radius: 50px 50px 50px 50px / 25px 25px 25px 25px;"
                        src="{{ asset('storage/' . $room->img) }}" alt="">
                </div>
                @else
                @if ($room->img)
                <div class="welcome-img">
                    <img style="width: 400px; border-radius: 50px 50px 50px 50px / 25px 25px 25px 25px;"
                        src="{{ asset($room->img) }}" alt="">
                </div>
                @endif
                @endif
            </div>
        </div>
    </div>

    <hr class="mt-75">
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h3 class="wow fadeInUp" data-wow-delay=".4s">Form Pinjam Ruang {{ $room->name }}</h3>
            <p class="wow fadeInUp" data-wow-delay=".4s">Isi form secara lengkap untuk meminjam ruangan</p>

            <form class="row g-3 mt-3 needs-validation wow fadeInUp" data-wow-delay=".4s" action="/daftarpinjam"
                method="post" id="roomBookingForm">
                @csrf
                <div class="row mt-3">
                    <div class="col-md-6">
                        <label for="room_id" class="form-label d-block">Kode Ruangan</label>
                        <select class="form-select " aria-label="Default select example" name="room_id" id="room_id"
                            required>
                            @if ($room->code == request()->segment(count(request()->segments())))
                            <option value="{{ $room->id }}" selected> {{ $room->name }}</option>
                            @endif
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="purpose" class="form-label">Tujuan</label>
                        <input type="text" class="form-control  @error('purpose') is-invalid @enderror"
                            id="purpose" name="purpose" value="{{ old('purpose') }}" autocomplete="off" required>
                        @error('purpose')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <label for="time_start_use" class="form-label">Mulai Pinjam</label>
                        <input type="datetime-local" class="form-control @error('time_start_use') is-invalid @enderror" id="time_start_use" name="time_start_use"
                            value="{{ old('time_start_use') }}" required min="{{ date('Y-m-d\TH:i') }}">
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
                        <label for="time_end_use" class="form-label">Selesai Pinjam</label>
                        <input type="datetime-local" class="form-control @error('time_end_use') is-invalid @enderror" id="time_end_use" name="time_end_use"
                            value="{{ old('time_end_use') }}" required>
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

                <div class="col-12">
                    <button class="btn btn-warning rounded-pill btn-hover fw-semibold text-white" type="submit">Pinjam
                        Ruang</button>

                </div>
            </form>

        </div>
    </div>

    <hr class="mt-75">
    <h3 class="mb-15 wow fadeInUp text-center" data-wow-delay=".4s">Daftar Peminjaman</h3>
    <!-- Table -->
    <div class="card-body text-end me-3 wow fadeInUp text-center" data-wow-delay=".4s">
        <div class="table-responsive justify-content-center">
            <div class="d-flex justify-content-start">
                {{ $rents->links() }}
            </div>
            <table class="fl-table">
                <thead>
                    <tr>
                        <th scope="row">No.</th>
                        <th scope="row">Nama Peminjam</th>
                        <th scope="row">Mulai Pinjam</th>
                        <th scope="row">Selesai Pinjam</th>
                        <th scope="row">Tujuan</th>
                        <th scope="row">Waktu Transaksi</th>
                        <th scope="row">Status Pinjam</th>
                    </tr>
                </thead>
                <tbody class="rent-details">

                    @if ($rents->count() > 0)
                    @foreach ($rents as $rent)
                    <tr class="rent-detail">
                        <th scope="row">{{ $loop->iteration }}</th scope="row">
                        <td>{{ $rent->user->name }}</td>
                        <td class="detail-rent-room_start-time">{{ $rent->time_start_use }}</td>
                        <td>{{ $rent->time_end_use }}</td>
                        <td>{{ $rent->purpose }}</td>
                        <td>{{ $rent->transaction_start }}</td>
                        <td>{{ $rent->status }}</td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="7" class="text-center">
                            -- Belum Ada Peminjaman --
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const startTimeInput = document.getElementById('time_start_use');
        const endTimeInput = document.getElementById('time_end_use');
        const bookingForm = document.getElementById('roomBookingForm');

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
@endsection