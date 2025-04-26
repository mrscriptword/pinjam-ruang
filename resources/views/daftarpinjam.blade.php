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
                    <h1 class="mt" style="font-family: 'Cal Sans'; color: #3e3f5b !important;">Daftar Peminjaman</h1>
                    <h6 style="width: 100%; color: #3e3f5b;">
                        Lihat daftar peminjaman ruangan Anda, mulai dari informasi peminjam hingga status peminjaman,
                        untuk memastikan pengalaman yang lancar dan terorganisir!
                    </h6>
                    <p class="wow fadeInUp" data-wow-delay=".4s">
                        Pemitahuan dari admin akan muncul di daftar peminjaman ini. Silahkan tunggu sampai dapat persetujuan dari admin.
                    </p>
                </div>
            </div>
        </div>

        {{-- ... lanjutkan dengan bagian tabel dan kalender seperti di file asli, tanpa bagian konflik ... --}}
    </div>
</section>

<!-- Tambahkan FullCalendar CSS & JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
<style>
    /* Gabungan style dari kedua versi */
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
</style>

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales-all.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');
        if (!calendarEl) return;

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
                              '#ffc107'
                           @elseif($rent->status == 'dipinjam')
                              '#dc3545'
                           @elseif($rent->status == 'selesai')
                              '#28a745'
                           @else
                              '#ffc107'
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