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
                        $start=max($end - 2, 1);
                        }
                        @endphp

                        <div class="d-flex d-md-none justify-content-end mt-3 w-100">
                        <div class="btn-group" role="group" aria-label="Pagination">
                            @if ($currentPage > 1)
                            <a href="{{ $userRents->url($currentPage - 1) }}"
                                class="btn btn-outline-secondary">←</a>
                            @else
                            <button class="btn btn-outline-secondary" disabled>←</button>
                            @endif

                            @for ($i = $start; $i <= $end; $i++)
                                @if ($i==$currentPage)
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
                            @if ($i==$currentPage)
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
            </div>
        </div>


        <div class="col-md-12 mt-5" style="margin-top: 150px !important;">
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Kalender Peminjaman Ruangan</h5>
                </div>
                <div class="card-body">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Event Details Modal -->
<div class="modal fade" id="eventDetailsModal" tabindex="-1" aria-labelledby="eventDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventDetailsModalLabel">Detail Peminjaman</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="event-status-badge mb-3"></div>
                <div class="row mb-2">
                    <div class="col-md-4 fw-bold">Ruangan</div>
                    <div class="col-md-8 event-room"></div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4 fw-bold">Peminjam</div>
                    <div class="col-md-8 event-user"></div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4 fw-bold">Tujuan</div>
                    <div class="col-md-8 event-purpose"></div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4 fw-bold">Mulai</div>
                    <div class="col-md-8 event-start"></div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4 fw-bold">Selesai</div>
                    <div class="col-md-8 event-end"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

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

    /* Make all calendar sections background white */
    .fc-view-harness, 
    .fc-scrollgrid, 
    .fc-scrollgrid-sync-table,
    .fc-day {
        background: #fff !important;
    }
    
    /* But show them in day view */
    .fc-timeGridDay-view .fc-timegrid-slot-label {
        display: table !important;
    }
    .fc-timeGridDay-view .fc-timegrid-slot-label-frame {
        display: table-cell !important;
        vertical-align: middle !important;
    }
    
    .fc-timeGridDay-view .fc-timegrid-slot-label-cushion {
        display: block !important;
        padding: 0 4px !important;
    }

    /* Fix width of columns in time grid */
    .fc .fc-timegrid-col.fc-day {
        width: auto !important;
        min-width: 120px !important;
    }
    
    /* Fix day header display */
    .fc-col-header-cell {
        padding: 8px 0;
        text-align: center !important;
    }

    /* Fix time slots in week view to be more compact */
    .fc-timeGridWeek-view .fc-timegrid-slot {
        height: 2em !important;
    }

    /* Adjust day view slot height */
    .fc-timeGridDay-view .fc-timegrid-slot {
        height: 3em !important;
    }

    .fc-toolbar {
        font-size: 1rem;
        margin-bottom: 15px;
        display: flex;
        flex-wrap: wrap;
    }

    .fc-toolbar-chunk {
        margin-bottom: 5px;
    }

    .fc-toolbar-title {
        font-weight: 600 !important;
        color: #3e3f5b;
    }

    .fc-daygrid-event {
        font-size: 0.9rem;
        padding: 3px 6px;
        border-radius: 4px;
        white-space: normal !important;
        word-wrap: break-word;
        cursor: pointer;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .fc-daygrid-event:hover {
        transform: scale(1.02);
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }

    .fc-daygrid-day-number {
        font-size: 1rem;
        font-weight: 500;
        color: #333;
    }

    /* Improve week and day view */
    .fc-timegrid-event {
        border-radius: 4px;
        cursor: pointer;
        transition: transform 0.2s;
        padding: 2px 4px;
    }

    .fc-timegrid-event:hover {
        transform: scale(1.02);
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }

    .fc-timegrid-slot {
        height: 3em !important;
    }

    /* Hide "all-day" row in the header */
    .fc .fc-timegrid-axis-cushion {
        display: none !important;
    }

    /* Hide "all-day" row */
    .fc .fc-timegrid-axis-frame,
    .fc .fc-non-business {
        display: none;
    }

    /* Make event title more readable */
    .fc-event-title {
        font-weight: 500;
        white-space: normal;
    }

    /* Improve button styling */
    .fc-button-primary {
        background-color: #0d6efd !important;
        border-color: #0d6efd !important;
        transition: all 0.2s;
    }

    .fc-button-primary:hover {
        background-color: #0b5ed7 !important;
        border-color: #0a58ca !important;
        transform: translateY(-1px);
    }

    .fc-button-active {
        background-color: #0a58ca !important;
        border-color: #0a58ca !important;
    }

    /* Style for status badges in modal */
    .status-badge {
        display: inline-block;
        padding: 0.25em 0.75em;
        font-weight: 500;
        border-radius: 1rem;
        font-size: 0.875rem;
        text-transform: uppercase;
    }

    /* Responsive styling for mobile */
    @media (max-width: 767px) {
        .fc-toolbar {
            flex-direction: column;
            align-items: center;
        }

        .fc-toolbar-chunk {
            margin-bottom: 0.5rem;
        }

        .fc-header-toolbar.fc-toolbar {
            margin-bottom: 1.5em;
        }

        .fc-daygrid-event {
            font-size: 0.75rem;
            padding: 2px 4px;
        }
    }

    /* Improve modal styling */
    #eventDetailsModal .modal-content {
        border-radius: 0.5rem;
        border: none;
    }

    #eventDetailsModal .modal-header {
        border-bottom: none;
        padding-bottom: 0.5rem;
    }

    #eventDetailsModal .modal-footer {
        border-top: none;
        padding-top: 0.5rem;
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
            views: {
                timeGridWeek: {
                    slotDuration: '01:00:00',
                    slotLabelFormat: {
                        hour: '2-digit',
                        minute: '2-digit',
                        hour12: false
                    },
                    allDaySlot: false // Remove "all day" row in week view
                },
                timeGridDay: {
                    slotDuration: '01:00:00',
                    slotLabelFormat: {
                        hour: '2-digit',
                        minute: '2-digit',
                        hour12: false
                    },
                    allDaySlot: false // Remove "all day" row in day view
                }
            },
            eventTimeFormat: {
                hour: '2-digit',
                minute: '2-digit',
                hour12: false
            },
            slotLabelFormat: {
                hour: '2-digit',
                minute: '2-digit',
                hour12: false
            },
            eventDisplay: 'block',
            dayMaxEvents: 3, // Limit number of events per day in month view
            buttonText: {
                today: 'Hari Ini',
                month: 'Bulan',
                week: 'Minggu',
                day: 'Hari'
            },
            events: [
                @foreach($calendarEvents as $rent) {
                    title: '{{ $rent->room->code }} - {{ $rent->user->name }}',
                    start: '{{ $rent->time_start_use }}',
                    end: '{{ $rent->time_end_use }}',
                    color: @if($rent->status == 'dipinjam')
                    '#198754' // Green for accepted/borrowed
                    @elseif($rent->status == 'selesai')
                    '#0d6efd' // Blue for completed
                    @elseif($rent->status == 'pending')
                    '#ffc107' // Yellow for pending
                    @else 
                    '#dc3545' // Red for rejected
                    @endif,
                    extendedProps: {
                        purpose: '{{ $rent->purpose }}',
                        status: '{{ $rent->status }}',
                        peminjam: '{{ $rent->user->name }}',
                        roomName: '{{ $rent->room->code }} - {{ $rent->room->name }}'
                    }
                },
                @endforeach
            ],
            eventClick: function(info) {
                const eventObj = info.event;

                // Set the modal content
                let statusBadgeClass = '';
                let statusText = '';

                if (eventObj.extendedProps.status == 'dipinjam') {
                    statusBadgeClass = 'bg-primary';
                    statusText = 'Dipinjam';
                } else if (eventObj.extendedProps.status == 'selesai') {
                    statusBadgeClass = 'bg-success';
                    statusText = 'Selesai';
                } else if (eventObj.extendedProps.status == 'ditolak') {
                    statusBadgeClass = 'bg-danger';
                    statusText = 'Ditolak';
                } else {
                    statusBadgeClass = 'bg-warning';
                    statusText = 'Pending';
                }

                // Format dates
                const startDate = new Date(eventObj.start);
                const endDate = eventObj.end ? new Date(eventObj.end) : null;

                const formattedStart = startDate.toLocaleString('id-ID', {
                    weekday: 'long',
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });

                const formattedEnd = endDate ? endDate.toLocaleString('id-ID', {
                    weekday: 'long',
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                }) : 'Tidak ditentukan';

                // Update modal content
                document.querySelector('.event-status-badge').innerHTML = '<span class="status-badge ' + statusBadgeClass + '">' + statusText + '</span>';
                document.querySelector('.event-room').textContent = eventObj.extendedProps.roomName;
                document.querySelector('.event-user').textContent = eventObj.extendedProps.peminjam;
                document.querySelector('.event-purpose').textContent = eventObj.extendedProps.purpose;
                document.querySelector('.event-start').textContent = formattedStart;
                document.querySelector('.event-end').textContent = formattedEnd;

                // Show the modal - using vanilla JS for better compatibility
                const eventModal = new bootstrap.Modal(document.getElementById('eventDetailsModal'));
                eventModal.show();

                // Prevent default action
                return false;
            },
            // Make calendar more interactive
            dateClick: function(info) {
                // Just highlight the clicked date
                info.dayEl.style.backgroundColor = 'rgba(13, 110, 253, 0.1)';
                setTimeout(function() {
                    info.dayEl.style.backgroundColor = '';
                }, 1000);
            }
        });

        calendar.render();
    });
</script>
@endsection