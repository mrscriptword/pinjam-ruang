@extends('layouts.main')
@section('content')
    <h1 class="mt" style="font-family: 'Cal Sans'; color: #3e3f5b !important;">Daftar Ruangan</h1>
    <h6 style="width: 40%; color: #3e3f5b;">Temukan ruangan yang sempurna
        untuk kebutuhan Anda, mulai dari ruang rapat yang nyaman hingga
        ruang acara yang luas, dan pilih dari daftar yang tersedia untuk
        pengalaman terbaik!</h6>

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-10">
                <div class="row g-4">
                    @foreach ($rooms as $room)
                        <div class="col-md-4">
                            <div class="card text-white rounded-4 p-2 h-100" style="background-color: #222232;">
                                <img src="{{ $room->img && Storage::exists('public/' . $room->img) ? asset('storage/' . $room->img) : $room->img ?? '/assets/images/exmpRUANGAN.jpg' }}"
                                    class="card-img-top rounded-top-4" alt="Ruangan"
                                    style="width: 100%; height: 200px; object-fit: cover; overflow: hidden;">
                                <div class="card-body d-flex flex-column justify-content-between"
                                    style="min-height: 200px;">
                                    <div>
                                        <h5 class="card-title fw-bold" style="color: #f6f1de;">{{ $room->name }}</h5>
                                        <p class="card-text text-white-50">Gedung {{ $room->building->name }} -
                                            {{ $room->code }}</p>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mt-auto">
                                        <small><i class="bi bi-people"></i> {{ $room->capacity }} seats -
                                            {{ $room->facilities ?? 'AC' }}</small>
                                        <a href="/showruang/{{ $room->code }}"
                                            class="btn btn-sm rounded-pill px-3 btn-hover"
                                            style="background-color: #A9D6C1; color: black;">PINJAM</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div style="display: none;">
                    {{ $rooms->links() }}
                </div>
            </div>


            <div class="col-md-2 d-flex flex-column align-items-end justify-content-center gap-2">
                @php
                    $currentPage = $rooms->currentPage();
                    $lastPage = $rooms->lastPage();
                    $start = max($currentPage - 1, 1);
                    $end = min($start + 2, $lastPage);

                    if ($end - $start < 2) {
                        $start = max($end - 2, 1);
                    }
                @endphp

                @if ($currentPage > 1)
                    <a href="{{ $rooms->url($currentPage - 1) }}" class="btn btn-outline-secondary p-2 fs-5"
                        style="width: 50px;">↑</a>
                @else
                    <button class="btn btn-outline-secondary p-2 fs-5" style="width: 50px;" disabled>↑</button>
                @endif

                @for ($i = $start; $i <= $end; $i++)
                    @if ($i == $currentPage)
                        <button class="btn btn-secondary p-2 fs-5" style="width: 50px;">{{ $i }}</button>
                    @else
                        <a href="{{ $rooms->url($i) }}" class="btn btn-outline-secondary p-2 fs-5"
                            style="width: 50px;">{{ $i }}</a>
                    @endif
                @endfor

                @if ($currentPage < $lastPage)
                    <a href="{{ $rooms->url($currentPage + 1) }}" class="btn btn-outline-secondary p-2 fs-5"
                        style="width: 50px;">↓</a>
                @else
                    <button class="btn btn-outline-secondary p-2 fs-5" style="width: 50px;" disabled>↓</button>
                @endif
            </div>
        </div>
    </div>

    <style>
        .btn-hover:hover {
            color: #f6f1de !important;
        }
    </style>
@endsection
