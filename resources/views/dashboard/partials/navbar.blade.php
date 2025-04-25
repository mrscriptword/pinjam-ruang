<div class="nav">
    <div class="d-flex justify-content-between align-items-center w-100 mb-3 mb-md-0">
        <div class="d-flex justify-content-start align-items-center">
            <button id="toggle-navbar" onclick="toggleNavbar()">
                <img src="/assets/burger.svg" class="mb-2" alt="">
            </button>
            <h2 class="nav-title">{{ $title }}</h2>
        </div>
    </div>
    {{-- @auth
        <li class="main_nav_item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                <span class="text-dark">{{ auth()->user()->name }} &#9660;</span>
    </a>
    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
        <li><a class="dropdown-item" href="/dashboard/rooms"><i class="bi bi-layout-text-sidebar-reverse"></i> My
                Dashboard</a></li>
        <li>
            <hr class="dropdown-divider">
        </li>
        <li>
            <form action="/logout" method="post">
                @csrf
                <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"></i>
                    Logout</button>
            </form>
    </ul>
    </li>
    @else
    <li class="main_nav_item {{ Request::is('login') ? 'active' : '' }}">
        <a href="/login">Login</a>
    </li>
    @endauth --}}

    <div class="d-flex justify-content-between align-items-center nav-input-container">
        <div class="nav-input-group">
            <input type="text" id="searchInput" class="nav-input" placeholder="Search...">
            <button class="btn-nav-input" id="searchButton"><img src="/assets/search.svg" alt=""></button>
            <button class="btn-nav-clear" id="clearSearchButton" style="display: none;"><i class="bi bi-x-lg"></i></button>
        </div>

        @if (auth()->user()->role_id === 1)
        <div class="dropdown">
            <button class="btn-notif d-none d-md-block position-relative" type="button" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="/assets/bell.svg" alt="">
                @php
                $pendingRentals = \App\Models\Rent::where('status', 'pending')->count();
                @endphp
                @if ($pendingRentals > 0)
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ $pendingRentals }}
                </span>
                @endif
            </button>
            <ul class="dropdown-menu dropdown-menu-end notification-dropdown" aria-labelledby="notificationDropdown" style="width: 300px; max-height: 400px; overflow-y: auto;">
                <li>
                    <h6 class="dropdown-header">Pemberitahuan</h6>
                </li>
                @php
                $pendingRentals = \App\Models\Rent::with(['room', 'user'])->where('status', 'pending')->latest()->get();
                @endphp

                @if ($pendingRentals->count() > 0)
                @foreach ($pendingRentals as $rent)
                <li>
                    <a class="dropdown-item notification-item" href="/dashboard/temporaryRents">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0 fw-bold">{{ $rent->user->name }}</p>
                                <p class="mb-0">{{ $rent->room->name }} ({{ $rent->room->code }})</p>
                                <small class="text-muted">{{ $rent->purpose }}</small>
                            </div>
                            <small class="text-muted">{{ \Carbon\Carbon::parse($rent->transaction_start)->diffForHumans() }}</small>
                        </div>
                    </a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                @endforeach
                <li><a class="dropdown-item text-center" href="/dashboard/temporaryRents">Lihat Semua</a></li>
                @else
                <li><span class="dropdown-item">Tidak ada pemberitahuan</span></li>
                @endif
            </ul>
        </div>
        @else
        <button class="btn-notif d-none d-md-block"><img src="/assets/bell.svg" alt=""></button>
        @endif
    </div>
</div>

<style>
    .notification-item:hover {
        background-color: #f8f9fa;
    }

    .badge {
        font-size: 0.6rem;
    }
</style>