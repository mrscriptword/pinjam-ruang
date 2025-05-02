@extends('layouts.main')

@section('content')
    <div style="background-color: #f6f1de">
        <div class="container pt-5 pb-4">
            <h1 class="mt" style="font-family: 'Cal Sans'; color: #3e3f5b !important;">Form peminjaman</h1>
            <h6 style="width: 55%; color: #3e3f5b;">Isi form di bawah ini untuk mengajukan peminjaman ruangan sesuai
                kebutuhan Anda. Pastikan semua informasi yang dimasukkan sudah benar sebelum mengirimkan permohonan.</h6>

            <div class="container pt-5 pb-4">
                <!-- Bagian Atas: Gambar + Detail + Form -->
                <div class="d-flex flex-column flex-md-row gap-4" style="width: 100%; min-height: 65vh;">
                    <!-- Kiri: Gambar dan Detail Ruangan dalam satu div dengan background menyatu -->
                    <div class="col-md-6 rounded" style="background-color: #f2efe7; padding: 1.5rem; display: flex; flex-direction: column; gap: 1.5rem; border-radius: 25px;">
                        <!-- Gambar Ruangan - Diperbesar -->
                        <div class="rounded" style="flex: 1; overflow: hidden; display: flex; align-items: center; justify-content: center; background-color: #f2efe7;">
                            @if ($room->img && Storage::exists('public/' . $room->img))
                                <img src="{{ asset('storage/' . $room->img) }}" 
                                     style="object-fit: contain; max-height: 40vh; width: auto; max-width: 100%; border-radius: 15px;" 
                                     alt="{{ $room->name }}">
                            @elseif ($room->img)
                                <img src="{{ asset($room->img) }}" 
                                     style="object-fit: contain; max-height: 40vh; width: auto; max-width: 100%; border-radius: 15px;" 
                                     alt="{{ $room->name }}">
                            @else
                                <div class="w-100 h-100 d-flex align-items-center justify-content-center rounded"
                                    style="background-color: #8ab2a6; color: #f2efe7;">
                                    <p>Gambar tidak tersedia</p>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Detail Ruangan -->
                        <div class="rounded p-3" style="flex: 1; background-color: #f2efe7;">
                            <div class="h-100 d-flex flex-column">
                                <!-- Header dengan nama ruangan -->
                                <div class="text-center mb-3">
                                    <h3 style="font-family: 'Cal Sans', sans-serif; font-size: 24px; color: #3e3f5b; margin-bottom: 10px;">
                                        {{ strtoupper($room->name) }}
                                    </h3>
                                    <div class="d-flex justify-content-center mb-2">
                                        <span class="badge rounded-pill" style="background-color: #8ab2a6; color: #3e3f5b; font-size: 13px; padding: 6px 12px;">
                                            {{ strtoupper($room->type) }}
                                        </span>
                                    </div>
                                </div>
                                
                                <!-- Detail ruangan dalam grid -->
                                <div class="room-details-grid mb-3">
                                    <div class="detail-item">
                                        <i class="fas fa-building me-2" style="color: #66897e; width: 20px; text-align: center;"></i>
                                        <div>
                                            <div class="detail-label">GEDUNG</div>
                                            <div class="detail-value">{{ $room->building->name }}</div>
                                        </div>
                                    </div>
                                    <div class="detail-item">
                                        <i class="fas fa-layer-group me-2" style="color: #66897e; width: 20px; text-align: center;"></i>
                                        <div>
                                            <div class="detail-label">LANTAI</div>
                                            <div class="detail-value">LT. {{ $room->floor }}</div>
                                        </div>
                                    </div>
                                    <div class="detail-item">
                                        <i class="fas fa-users me-2" style="color: #66897e; width: 20px; text-align: center;"></i>
                                        <div>
                                            <div class="detail-label">KAPASITAS</div>
                                            <div class="detail-value">{{ $room->capacity }} ORANG</div>
                                        </div>
                                    </div>
                                    <div class="detail-item">
                                        <i class="fas fa-hashtag me-2" style="color: #66897e; width: 20px; text-align: center;"></i>
                                        <div>
                                            <div class="detail-label">KODE RUANGAN</div>
                                            <div class="detail-value">{{ $room->code }}</div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Deskripsi ruangan -->
                                <div class="mt-auto">
                                    <h5 style="font-family: 'Cal Sans', sans-serif; font-size: 15px; color: #3e3f5b;">
                                        <i class="fas fa-info-circle me-2" style="color: #66897e;"></i> DESKRIPSI
                                    </h5>
                                    <div class="description-box">
                                        @if($room->description)
                                            {!! nl2br(e($room->description)) !!}
                                        @else
                                            <span style="color: #66897e; font-style: italic;">Tidak ada deskripsi tambahan</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kanan: Form Peminjaman -->
                    <div class="col-md-6 d-flex align-items-center justify-content-center"
                        style="background-color: #3e3f5b; border-radius: 25px;">
                        <form action="/daftarpinjam" method="post" style="width: 80%;" id="roomBookingForm">
                            @csrf
                            <div class="mb-3 text-start">
                                <label for="room_id" class="form-label" style="color: #f2efe7;">Kode Ruangan</label>
                                <select class="form-select" name="room_id" id="room_id"
                                    style="border-radius: 25px; height: 45px; border-color: #66897e; background-color: #f2efe7;"
                                    required>
                                    @if ($room->code == request()->segment(count(request()->segments())))
                                        <option value="{{ $room->id }}" selected>{{ $room->code }}</option>
                                    @endif
                                </select>
                            </div>
                            <div class="mb-3 text-start">
                                <label for="purpose" class="form-label" style="color: #f2efe7;">Tujuan</label>
                                <input type="text" class="form-control @error('purpose') is-invalid @enderror"
                                    id="purpose" name="purpose" placeholder="Masukan tujuan peminjaman"
                                    style="border-radius: 25px; height: 45px; border-color: #66897e; background-color: #f2efe7;"
                                    required>
                                @error('purpose')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col mb-3 text-start">
                                    <label for="time_start_use" class="form-label" style="color: #f2efe7;">Mulai
                                        Pinjam</label>
                                    <input type="datetime-local"
                                        class="form-control @error('time_start_use') is-invalid @enderror"
                                        id="time_start_use" name="time_start_use"
                                        style="border-radius: 25px; height: 45px; border-color: #66897e; background-color: #f2efe7;"
                                        required min="{{ date('Y-m-d\TH:i') }}">
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
                                    <label for="time_end_use" class="form-label" style="color: #f2efe7;">Selesai
                                        Pinjam</label>
                                    <input type="datetime-local"
                                        class="form-control @error('time_end_use') is-invalid @enderror" id="time_end_use"
                                        name="time_end_use"
                                        style="border-radius: 25px; height: 45px; border-color: #66897e; background-color: #f2efe7;"
                                        required>
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
                            <button type="submit" class="btn w-100"
                                style="background-color: #8ab2a6; border-radius: 25px; height: 50px; font-family: 'Cal Sans', sans-serif; color: #f2efe7; letter-spacing: 3px; transition: transform 0.3s, text-shadow 0.3s;"
                                onmouseover="this.style.transform='scale(1.1)'; this.style.textShadow='0px 0px 5px #f2efe7';"
                                onmouseout="this.style.transform='scale(1)'; this.style.textShadow='none';">KIRIM</button>
                        </form>
                    </div>
                </div>

                <!-- CSS untuk detail ruangan -->
                <style>
                    /* Gaya untuk detail ruangan */
                    .room-details-grid {
                        display: grid;
                        grid-template-columns: 1fr 1fr;
                        gap: 15px;
                        margin-bottom: 15px;
                    }

                    .detail-item {
                        display: flex;
                        align-items: flex-start;
                        font-size: 13px;
                        color: #3e3f5b;
                    }

                    .detail-label {
                        font-weight: 600;
                        font-size: 11px;
                        letter-spacing: 1px;
                        color: #66897e;
                        text-transform: uppercase;
                        margin-bottom: 3px;
                    }

                    .detail-value {
                        font-weight: 500;
                        font-size: 13px;
                        color: #3e3f5b;
                        word-break: break-word;
                    }

                    .description-box {
                        background-color: rgba(255, 255, 255, 0.7);
                        border-left: 4px solid #8ab2a6;
                        padding: 10px 12px;
                        border-radius: 0 8px 8px 0;
                        font-size: 13px;
                        line-height: 1.5;
                        color: #3e3f5b;
                        max-height: 100px;
                        overflow-y: auto;
                    }

                    /* Scrollbar styling */
                    .description-box::-webkit-scrollbar {
                        width: 4px;
                    }

                    .description-box::-webkit-scrollbar-track {
                        background: rgba(242, 239, 231, 0.5);
                        border-radius: 10px;
                    }

                    .description-box::-webkit-scrollbar-thumb {
                        background-color: #8ab2a6;
                        border-radius: 10px;
                    }
                </style>
            </div>

            <!-- Bagian Bawah: Tabel Daftar Peminjaman dengan jarak yang cukup -->
            <div class="container pt-3 pb-5">
                <div class="row">
                    <div class="col-12">
                        <h3 class="mb-4 text-center" style="font-family: 'Cal Sans', sans-serif; color: #3e3f5b;">Daftar
                            Peminjaman</h3>
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
                                                <tr
                                                    style="
                                                @if ($rent->status == 'dipinjam') background-color: #66897e; color: #f2efe7;
                                                @elseif($rent->status == 'selesai') background-color: #acd3a8; color: #3e3f5b;
                                                @elseif($rent->status == 'ditolak') background-color: #8ab2a6; color: #3e3f5b;
                                                @else background-color: #f2efe7; color: #3e3f5b; @endif
                                            ">
                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                    <td class="text-center">{{ $rent->user->name }}</td>
                                                    <td class="text-center">{{ $rent->time_start_use }}</td>
                                                    <td class="text-center">{{ $rent->time_end_use }}</td>
                                                    <td class="text-center">{{ $rent->purpose }}</td>
                                                    <td class="text-center">{{ $rent->transaction_start }}</td>
                                                    <td class="text-center">
                                                        <span
                                                            class="badge
                                                        @if ($rent->status == 'dipinjam') bg-primary
                                                        @elseif ($rent->status == 'selesai') style='background-color: #acd3a8; color: #3e3f5b;'
                                                        @elseif ($rent->status == 'ditolak') style='background-color: #8ab2a6; color: #3e3f5b;'
                                                        @else bg-secondary @endif
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