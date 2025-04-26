@extends('layouts.main')

@section('content')
<div style="background-color: #f2efe7;" class="vh-100">
    <div class="container pt-5 pb-5">
        <!-- Bagian Atas: Gambar + Info dan Form -->
        <div class="d-flex rounded" style="width: 100%; min-height: 60vh;">
            <!-- Kiri: Gambar + Informasi Ruangan -->
            <div class="position-relative col-md-6 d-none d-md-block">
                @if ($room->img && Storage::exists('public/' . $room->img))
                    <img src="{{ asset('storage/' . $room->img) }}" class="w-100 h-100" style="object-fit: cover; border-radius: 25px 0 0 25px;" alt="{{ $room->name }}">
                @else
                    @if ($room->img)
                        <img src="{{ asset($room->img) }}" class="w-100 h-100" style="object-fit: cover; border-radius: 25px 0 0 25px;" alt="{{ $room->name }}">
                    @else
                        <div class="w-100 h-100 d-flex align-items-center justify-content-center" style="background-color: #8ab2a6; border-radius: 25px 0 0 25px; color: #f2efe7;">
                            <p>Gambar tidak tersedia</p>
                        </div>
                    @endif
                @endif
                <div class="position-absolute top-50 translate-middle-y ps-3 text-start" style="left: 7%; background-color: rgba(242, 239, 231, 0.9); padding: 20px; border-radius: 15px;">
                    <h3 style="color: #3e3f5b; font-family: 'Cal Sans', sans-serif;">{{ $room->name }}</h3>
                    <table class="table table-borderless" style="color: #3e3f5b; background-color: transparent;">
                        <tbody>
                            <tr style="background-color: #8ab2a6;">
                                <td><strong>Kode Ruangan</strong></td>
                                <td>: {{ $room->code }}</td>
                            </tr>
                            <tr>
                                <td><strong>Gedung</strong></td>
                                <td>: {{ $room->building->name }}</td>
                            </tr>
                            <tr style="background-color: #8ab2a6;">
                                <td><strong>Lantai</strong></td>
                                <td>: {{ $room->floor }}</td>
                            </tr>
                            <tr>
                                <td><strong>Kapasitas</strong></td>
                                <td>: {{ $room->capacity }}</td>
                            </tr>
                            <tr style="background-color: #8ab2a6;">
                                <td><strong>Tipe Ruangan</strong></td>
                                <td>: {{ $room->type }}</td>
                            </tr>
                            <tr>
                                <td><strong>Deskripsi</strong></td>
                                <td>: {{ $room->description }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Kanan: Form Peminjaman -->
            <div class="col-md-6 d-flex align-items-center justify-content-center" style="background-color: #3e3f5b; border-radius: 0 25px 25px 0;">
                <form action="/daftarpinjam" method="post" style="width: 80%;" id="roomBookingForm">
                    @csrf
                    <div class="mb-3 text-start">
                        <label for="room_id" class="form-label" style="color: #f2efe7;">Kode Ruangan</label>
                        <select class="form-select" name="room_id" id="room_id" style="border-radius: 25px; height: 45px; border-color: #66897e; background-color: #f2efe7;" required>
                            @if ($room->code == request()->segment(count(request()->segments())))
                                <option value="{{ $room->id }}" selected>{{ $room->name }}</option>
                            @endif
                        </select>
                    </div>
                    <div class="mb-3 text-start">
                        <label for="purpose" class="form-label" style="color: #f2efe7;">Tujuan</label>
                        <input type="text" class="form-control @error('purpose') is-invalid @enderror" id="purpose" name="purpose"
                            placeholder="Masukan tujuan peminjaman" style="border-radius: 25px; height: 45px; border-color: #66897e; background-color: #f2efe7;" required>
                        @error('purpose')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col mb-3 text-start">
                            <label for="time_start_use" class="form-label" style="color: #f2efe7;">Mulai Pinjam</label>
                            <input type="datetime-local" class="form-control @error('time_start_use') is-invalid @enderror" id="time_start_use" name="time_start_use"
                                style="border-radius: 25px; height: 45px; border-color: #66897e; background-color: #f2efe7;" required min="{{ date('Y-m-d\TH:i') }}">
                            @error('time_start_use')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="invalid-feedback" id="time_start_feedback">
                                Waktu mulai pinjam tidak boleh di masa lalu.
                            </div>
                        </div>
                        <div class="col mb-3 text-start">
                            <label for="time_end_use" class="form-label" style="color: #f2efe7;">Selesai Pinjam</label>
                            <input type="datetime-local" class="form-control @error('time_end_use') is-invalid @enderror" id="time_end_use" name="time_end_use"
                                style="border-radius: 25px; height: 45px; border-color: #66897e; background-color: #f2efe7;" required>
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
                    <button type="submit" class="btn w-100" style="background-color: #8ab2a6; border-radius: 25px; height: 50px; font-family: 'Cal Sans', sans-serif; color: #f2efe7; letter-spacing: 3px; transition: transform 0.3s, text-shadow 0.3s;"
                        onmouseover="this.style.transform='scale(1.1)'; this.style.textShadow='0px 0px 5px #f2efe7';"
                        onmouseout="this.style.transform='scale(1)'; this.style.textShadow='none';">KIRIM</button>
                </form>
            </div>
        </div>

        <!-- Bagian Bawah: Tabel Daftar Peminjaman -->
        <div class="row mt-5">
            <div class="col-12">
                <h3 class="mb-4 text-center" style="font-family: 'Cal Sans', sans-serif; color: #3e3f5b;">Daftar Peminjaman</h3>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="d-flex justify-content-start">
                            {{ $rents->links('pagination::bootstrap-5') }}
                        </div>
                        <table class="table table-hover" style="color: #3e3f5b; background-color: #f2efe7;">
                            <thead style="background-color: #8ab2a6;">
                                <tr>
                                    <th scope="col" class="text-center">No.</th>
                                    <th scope="col" class="text-center">Nama Peminjam</th>
                                    <th scope="col" class="text-center">Mulai Pinjam</th>
                                    <th scope="col" class="text-center">Selesai Pinjam</th>
                                    <th scope="col" class="text-center">Tujuan</th>
                                    <th scope="col" class="text-center">Waktu Transaksi</th>
                                    <th scope="col" class="text-center">Status Pinjam</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($rents->count() > 0)
                                    @foreach ($rents as $rent)
                                        <tr style="
                                            @if($rent->status == 'dipinjam') background-color: #66897e; color: #f2efe7;
                                            @elseif($rent->status == 'selesai') background-color: #acd3a8; color: #3e3f5b;
                                            @elseif($rent->status == 'ditolak') background-color: #8ab2a6; color: #3e3f5b;
                                            @else background-color: #f2efe7; color: #3e3f5b;
                                            @endif
                                        ">
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">{{ $rent->user->name }}</td>
                                            <td class="text-center">{{ $rent->time_start_use }}</td>
                                            <td class="text-center">{{ $rent->time_end_use }}</td>
                                            <td class="text-center">{{ $rent->purpose }}</td>
                                            <td class="text-center">{{ $rent->transaction_start }}</td>
                                            <td class="text-center">
                                                <span class="badge
                                                    @if ($rent->status == 'dipinjam') bg-primary
                                                    @elseif ($rent->status == 'selesai') style='background-color: #acd3a8; color: #3e3f5b;'
                                                    @elseif ($rent->status == 'ditolak') style='background-color: #8ab2a6; color: #3e3f5b;'
                                                    @else bg-secondary
                                                    @endif
                                                ">
                                                    {{ ucfirst($rent->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7" class="text-center" style="color: #3e3f5b;">
                                            -- Belum Ada Peminjaman --
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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