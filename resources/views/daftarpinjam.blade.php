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
<section id="blog" class="blog-area pt-170 pb-140">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-7">
                <div class="section-title">
                    <h2 class="wow fadeInUp" data-wow-delay=".2s">{{ $title }}</h2>
                    <p class="wow fadeInUp" data-wow-delay=".4s">Pemitahuan dari admin akan muncul di daftar
                        peminjaman ini. Silahkan tunggu sampai dapat persetujuan dari admin.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 p-0">
                <div class="card-body text-end">
                    @if (session()->has('rentSuccess'))
                    <div class="col-md-16 mx-auto alert alert-success text-center alert-success alert-dismissible fade show"
                        style="margin-top: 50px" role="alert">
                        {{ session('rentSuccess') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                    @endif
                    <div class="table-responsive justify-content-center">
                        <div class="d-flex justify-content-end">
                            {{ $userRents->links() }}
                        </div>

                        <table class="fl-table">
                            <thead>
                                <tr>
                                    <th scope="row">No.</th>
                                    <th scope="row">Kode Ruangan</th>
                                    <th scope="row">Nama Peminjam</th>
                                    <th scope="row">Mulai Pinjam</th>
                                    <th scope="row">Selesai Pinjam</th>
                                    <th scope="row">Tujuan</th>
                                    <th scope="row">Waktu Transaksi</th>
                                    <th scope="row">Kembalikan</th>
                                    <th scope="row">Status Pinjam</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($userRents->count() > 0)
                                @foreach ($userRents as $index => $rent)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td><a href="/showruang/{{ $rent->room->code }}"
                                            class="text-decoration-none"
                                            role="button">{{ $rent->room->code }}</a>
                                    </td>
                                    @if (auth()->user()->role_id <= 2)
                                        <td>{{ $rent->user->name }}</td>
                                    @endif
                                    <td>{{ $rent->time_start_use }}</td>
                                    <td>{{ $rent->time_end_use }}</td>
                                    <td>{{ $rent->purpose }}</td>
                                    <td>{{ $rent->transaction_start }}</td>
                                    @if ($rent->status == 'dipinjam')
                                        <td>-</td>
                                    @else
                                        @if (!is_null($rent->transaction_end))
                                        <td>{{ $rent->transaction_end }}</td>
                                        @else
                                        <td>-</td>
                                        @endif
                                    @endif
                                    <td>{{ $rent->status }}</td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="9" class="text-center">
                                        -- Belum Ada Peminjaman --
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Kalender Peminjaman -->
            <div class="col-md-10 mt-4">
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
    .fc-daygrid-week-number {
        font-size: 0.9rem;
    }
    .fc-event {
        padding: 3px 6px;
        font-size: 0.9rem;
        border: none;
    }
    .fc-daygrid-day-top {
        padding: 3px;
    }
    .fc-today-button {
        background-color: #ffcc00 !important;
        color: #333 !important;
        border: none !important;
        border-radius: 4px;
    }
    .fc-prev-button, .fc-next-button {
        background-color: #3788d8 !important;
        color: white !important;
        border: none !important;
        border-radius: 4px;
    }
    .fc-daygrid-day {
        background: #f9f9f9;
    }
    .fc-day-today {
        background: #fff3cd !important;
    }
    .fc-col-header-cell-cushion {
        font-size: 1rem;
        color: #333;
        padding: 5px;
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
                @foreach($calendarEvents as $rent)
                {
                    title: '{{ $rent->room->code }} - {{ $rent->user->name }}',
                    start: '{{ $rent->time_start_use }}',
                    end: '{{ $rent->time_end_use }}',
                    color: @if($rent->status == 'dipinjam' && $rent->user_id != auth()->user()->id && $rent->status == 'pending')
                              '#ffc107' // Kuning untuk status dipinjam orang lain tapi masih pending
                           @elseif($rent->status == 'dipinjam')
                              '#dc3545' // Merah untuk status dipinjam
                           @elseif($rent->status == 'selesai')
                              '#28a745' // Hijau untuk status selesai
                           @else
                              '#ffc107' // Kuning untuk status lainnya (termasuk pending)
                           @endif,
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
                
                // Tampilkan detail peminjaman
                alert(
                    'Ruangan: ' + eventObj.title + '\n' +
                    'Status: ' + eventObj.extendedProps.status + '\n' +
                    'Tujuan: ' + eventObj.extendedProps.purpose + '\n' +
                    'Mulai: ' + eventObj.start.toLocaleString() + '\n' +
                    'Selesai: ' + (eventObj.end ? eventObj.end.toLocaleString() : 'Tidak ditentukan')
                );
            }
        });
        
        calendar.render();
    });
</script>
@endsection