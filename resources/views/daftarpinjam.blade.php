@extends('layouts.main')

@section('content')
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
                        <h1 class="mt" style="font-family: 'Cal Sans'; color: #3e3f5b !important;">Daftar Peminjaman
                        </h1>
                        <h6 style="width: 100%; color: #3e3f5b;">
                            Lihat daftar peminjaman ruangan Anda, mulai dari informasi peminjam hingga status peminjaman,
                            untuk memastikan pengalaman yang lancar dan terorganisir!
                        </h6>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-12 p-0">
                    <div class="card-body">
                        @if (session()->has('rentSuccess'))
                            <div class="alert alert-success text-center alert-dismissible fade show mx-auto"
                                style="margin-top: 50px;" role="alert">
                                {{ session('rentSuccess') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        @php
                            $currentPage = $userRents->currentPage();
                            $lastPage = $userRents->lastPage();
                            $start = max($currentPage - 1, 1);
                            $end = min($start + 2, $lastPage);
                            if ($end - $start < 2) {
                                $start = max($end - 2, 1);
                            }
                        @endphp

                        <div class="d-flex">
                            <div class="table-responsive" style="width: 100%; margin-right: -75px;">
                                <table class="table align-middle table-hover table-dark"
                                    style="width: 100%; color: #f8f9fa; table-layout: auto;">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th class="text-center align-middle" style="width: 5%;">#</th>
                                            <th class="text-center align-middle" style="width: 15%;">Kode Ruangan</th>
                                            <th class="text-center align-middle" style="width: 15%;">Nama Peminjam</th>
                                            <th class="text-center align-middle" style="width: 15%;">Mulai Pinjam</th>
                                            <th class="text-center align-middle" style="width: 15%;">Selesai Pinjam</th>
                                            <th class="text-center align-middle" style="width: 15%;">Tujuan</th>
                                            <th class="text-center align-middle" style="width: 15%;">Waktu Transaksi</th>
                                            <th class="text-center align-middle" style="width: 10%;">Kembalikan</th>
                                            <th class="text-center align-middle" style="width: 10%;">Status Pinjam</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($userRents as $index => $rent)
                                            <tr
                                                class="
                                            @if ($rent->status == 'dipinjam') table-info
                                            @elseif($rent->status == 'selesai') table-success
                                            @elseif($rent->status == 'ditolak') table-danger
                                            @else table-light @endif
                                        ">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <a href="/showruang/{{ $rent->room->code }}"
                                                        class="text-decoration-none"
                                                        style="color: #000000;">{{ $rent->room->code }}</a>
                                                </td>
                                                @if (auth()->check() && auth()->user()->role_id <= 2)
                                                    <td>{{ $rent->user->name }}</td>
                                                @endif
                                                <td>{{ $rent->time_start_use }}</td>
                                                <td>{{ $rent->time_end_use }}</td>
                                                <td>{{ $rent->purpose }}</td>
                                                <td>{{ $rent->transaction_start }}</td>
                                                <td>
                                                    @if ($rent->status == 'dipinjam')
                                                        <span class="badge bg-warning text-dark">Belum Kembali</span>
                                                    @else
                                                        {{ $rent->transaction_end ?? '-' }}
                                                    @endif
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge 
                                                    @if ($rent->status == 'dipinjam') bg-primary
                                                    @elseif ($rent->status == 'selesai') bg-success
                                                    @elseif ($rent->status == 'ditolak') bg-danger
                                                    @else bg-secondary @endif
                                                ">
                                                        {{ ucfirst($rent->status) }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" class="text-center">-- Belum Ada Peminjaman --</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <!-- DESKTOP: Vertikal pagination kanan -->
                            <div class="d-none d-md-flex flex-column align-items-end justify-content-center gap-2"
                                style="width: 15%;">
                                @if ($currentPage > 1)
                                    <a href="{{ $userRents->url($currentPage - 1) }}"
                                        class="btn btn-outline-secondary p-2 fs-5" style="width: 50px;">↑</a>
                                @else
                                    <button class="btn btn-outline-secondary p-2 fs-5" style="width: 50px;"
                                        disabled>↑</button>
                                @endif

                                @for ($i = $start; $i <= $end; $i++)
                                    @if ($i == $currentPage)
                                        <button class="btn btn-secondary p-2 fs-5"
                                            style="width: 50px;">{{ $i }}</button>
                                    @else
                                        <a href="{{ $userRents->url($i) }}" class="btn btn-outline-secondary p-2 fs-5"
                                            style="width: 50px;">{{ $i }}</a>
                                    @endif
                                @endfor

                                @if ($currentPage < $lastPage)
                                    <a href="{{ $userRents->url($currentPage + 1) }}"
                                        class="btn btn-outline-secondary p-2 fs-5" style="width: 50px;">↓</a>
                                @else
                                    <button class="btn btn-outline-secondary p-2 fs-5" style="width: 50px;"
                                        disabled>↓</button>
                                @endif
                            </div>
                        </div>

                        <div class="d-flex d-md-none justify-content-end mt-3 w-100">
                            <div class="btn-group" role="group" aria-label="Pagination">
                                @if ($currentPage > 1)
                                    <a href="{{ $userRents->url($currentPage - 1) }}"
                                        class="btn btn-outline-secondary">←</a>
                                @else
                                    <button class="btn btn-outline-secondary" disabled>←</button>
                                @endif

                                @for ($i = $start; $i <= $end; $i++)
                                    @if ($i == $currentPage)
                                        <button class="btn btn-secondary">{{ $i }}</button>
                                    @else
                                        <a href="{{ $userRents->url($i) }}"
                                            class="btn btn-outline-secondary">{{ $i }}</a>
                                    @endif
                                @endfor

                                @if ($currentPage < $lastPage)
                                    <a href="{{ $userRents->url($currentPage + 1) }}"
                                        class="btn btn-outline-secondary">→</a>
                                @else
                                    <button class="btn btn-outline-secondary" disabled>→</button>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>


            <div class="col-md-12 mt-5" style="margin-top: 150px !important;">
                <div class="card">
                    <div class="card-header">
                        <h5>Kalender Peminjaman Ruangan</h5>
                    </div>
                    <div class="card-body">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- CSS dan JS untuk FullCalendar -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
    <style>
        #calendar {
            max-width: 100%;
            margin: 0 auto;
            font-family: Arial, sans-serif;
            background: #fff;
            border-radius: 8px;
            padding: 10px;
        }

        .fc-toolbar {
            font-size: 1rem;
            margin-bottom: 15px;
        }

        .fc-daygrid-event {
            font-size: 0.9rem;
            padding: 3px 6px;
            border-radius: 4px;
            white-space: normal !important;
            word-wrap: break-word;
        }

        .fc-daygrid-day-number {
            font-size: 1rem;
            color: #333;
        }

        .fc-day-today {
            background: #fff3cd !important;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales-all.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            if (!calendarEl) {
                console.error('Calendar element not found!');
                return;
            }

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'id',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: [
                    @foreach ($calendarEvents as $rent)
                        {
                            title: '{{ $rent->room->code }} - {{ $rent->user->name }}',
                            start: '{{ $rent->time_start_use }}',
                            end: '{{ $rent->time_end_use }}',
                            color: @if ($rent->status == 'dipinjam')
                                '#dc3545'
                            @elseif ($rent->status == 'selesai')
                                '#28a745'
                            @else
                                '#ffc107'
                            @endif ,
                            extendedProps: {
                                purpose: '{{ $rent->purpose }}',
                                status: '{{ $rent->status }}',
                                peminjam: '{{ $rent->user->name }}'
                            }
                        },
                    @endforeach
                ],
                eventClick: function(info) {
                    var eventObj = info.event;
                    alert(
                        'Ruangan: ' + eventObj.title + '\n' +
                        'Status: ' + eventObj.extendedProps.status + '\n' +
                        'Tujuan: ' + eventObj.extendedProps.purpose + '\n' +
                        'Mulai: ' + eventObj.start.toLocaleString() + '\n' +
                        'Selesai: ' + (eventObj.end ? eventObj.end.toLocaleString() :
                            'Tidak ditentukan')
                    );
                }
            });

            calendar.render();
        });
    </script>
@endsection
