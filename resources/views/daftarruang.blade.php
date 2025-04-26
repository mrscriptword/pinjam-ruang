@extends('layouts.main')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h1 class="mt" style="font-family: 'Cal Sans'; color: #3e3f5b !important;">Daftar Ruangan</h1>
        <h6 style="width: 95%; color: #3e3f5b;">Temukan ruangan yang sempurna
            untuk kebutuhan Anda, mulai dari ruang rapat yang nyaman hingga
            ruang acara yang luas, dan pilih dari daftar yang tersedia untuk
            pengalaman terbaik!</h6>
    </div>
    <div class="nav-input-group position-relative" style="max-width: 300px;">
        <input type="text" id="searchInput" class="form-control rounded-pill ps-3 pe-5" placeholder="Search rooms..." style="border: 2px solid #A9D6C1; background-color: transparent;">
        <button class="btn position-absolute end-0 top-50 translate-middle-y me-1" id="searchButton" style="background: none; border: none;">
            <i class="bi bi-search text-secondary"></i>
        </button>
        <button class="btn position-absolute end-0 top-50 translate-middle-y me-4" id="clearSearchButton" style="background: none; border: none; display: none;">
            <i class="bi bi-x-lg text-secondary"></i>
        </button>
    </div>
</div>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-10">
            <div class="row g-4" id="roomsContainer">
                @foreach ($rooms as $room)
                <div class="col-md-4 room-card">
                    <div class="card text-white rounded-4 p-2 h-100" style="background-color: #222232;">
                        <img src="{{ $room->img && Storage::exists('public/' . $room->img) ? asset('storage/' . $room->img) : $room->img ?? '/assets/images/exmpRUANGAN.jpg' }}"
                            class="card-img-top rounded-top-4" alt="Ruangan"
                            style="width: 100%; height: 200px; object-fit: cover; overflow: hidden;">
                        <div class="card-body d-flex flex-column justify-content-between"
                            style="min-height: 200px;">
                            <div>
                                <h5 class="card-title fw-bold" style="color: #f6f1de;">{{ $room->name }}</h5>
                                <p class="card-text text-white-50">Gedung {{ $room->building->name }} -
                                    {{ $room->code }}
                                </p>
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
            <div id="noResultsMessage" class="text-center mt-4 d-none">
                <p class="fs-5">No rooms found matching your search.</p>
            </div>
        </div>

        <!-- Rest of the pagination code remains unchanged -->
        <div class="col-md-2 d-flex flex-column align-items-end justify-content-center gap-2">
            @php
            $currentPage = $rooms->currentPage();
            $lastPage = $rooms->lastPage();
            $start = max($currentPage - 1, 1);
            $end = min($start + 2, $lastPage);

            if ($end - $start < 2) {
                $start=max($end - 2, 1);
                }
                @endphp

                @if ($currentPage> 1)
                <a href="{{ $rooms->url($currentPage - 1) }}" class="btn btn-outline-secondary p-2 fs-5"
                    style="width: 50px;">↑</a>
                @else
                <button class="btn btn-outline-secondary p-2 fs-5" style="width: 50px;" disabled>↑</button>
                @endif

                @for ($i = $start; $i <= $end; $i++)
                    @if ($i==$currentPage)
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

    .search-highlight {
        background-color: rgba(169, 214, 193, 0.3) !important;
        transition: background-color 1s;
    }

    #searchInput:focus {
        box-shadow: 0 0 0 0.25rem rgb(169 214 193 / 25%);
        border-color: #A9D6C1;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const searchButton = document.getElementById('searchButton');
        const clearSearchButton = document.getElementById('clearSearchButton');
        const roomCards = document.querySelectorAll('.room-card');
        const noResultsMessage = document.getElementById('noResultsMessage');

        // Search function
        function performSearch() {
            const searchTerm = searchInput.value.toLowerCase().trim();
            if (!searchTerm) {
                clearSearch();
                return;
            }

            // Show clear button when search is performed
            clearSearchButton.style.display = 'block';

            let matchCount = 0;

            roomCards.forEach(card => {
                const roomName = card.querySelector('.card-title').textContent.toLowerCase();
                const roomCode = card.querySelector('.card-text').textContent.toLowerCase();
                const roomFacilities = card.querySelector('small').textContent.toLowerCase();

                if (roomName.includes(searchTerm) || roomCode.includes(searchTerm) || roomFacilities.includes(searchTerm)) {
                    card.style.display = '';
                    card.classList.add('search-highlight');
                    setTimeout(() => {
                        card.classList.remove('search-highlight');
                    }, 2000);
                    matchCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            // Show/hide "no results" message
            if (matchCount === 0) {
                noResultsMessage.classList.remove('d-none');
            } else {
                noResultsMessage.classList.add('d-none');
            }
        }

        // Clear search function
        function clearSearch() {
            searchInput.value = '';
            roomCards.forEach(card => {
                card.style.display = '';
                card.classList.remove('search-highlight');
            });
            clearSearchButton.style.display = 'none';
            noResultsMessage.classList.add('d-none');
        }

        // Event listeners
        if (searchButton && searchInput) {
            searchButton.addEventListener('click', function() {
                performSearch();
            });

            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    performSearch();
                }
            });

            searchInput.addEventListener('input', function() {
                // Show the clear button when there's text
                clearSearchButton.style.display = searchInput.value ? 'block' : 'none';

                // If input is empty, restore all cards
                if (!searchInput.value) {
                    clearSearch();
                }
            });

            clearSearchButton.addEventListener('click', function() {
                clearSearch();
            });
        }
    });
</script>
@endsection