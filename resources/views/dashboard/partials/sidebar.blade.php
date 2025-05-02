<div class="sidebar-hover-zone"></div>
<aside id="sidebar" class="sidebar">
    <button id="toggleSidebar" class="sidebar-toggle-btn" style="position: absolute; width: 0; height: 0; opacity: 0; overflow: hidden;">☰</button>
    <a href="#" class="sidebar-logo">
        <div class="d-flex justify-content-start align-items-center">
            <img src="{{ asset('assets/images/Logo_UNTIRTA.png') }}" style="width: 50px" alt="">
            <span>Sipirang UNTIRTA</span>
        </div>
    </a> 

    <h5 class="sidebar-title">Menu</h5>

    @if (auth()->user()->role_id === 1)
    <a href="/dashboard/admin" class="sidebar-item {{ Request::is('dashboard/admin') ? 'active' : '' }}"
        onclick="toggleActive(this)">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M23 21V19C22.9993 18.1137 22.7044 17.2528 22.1614 16.5523C21.6184 15.8519 20.8581 15.3516 20 15.13"
                stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            <path
                d="M17 21V19C17 17.9391 16.5786 16.9217 15.8284 16.1716C15.0783 15.4214 14.0609 15 13 15H5C3.93913 15 2.92172 15.4214 2.17157 16.1716C1.42143 16.9217 1 17.9391 1 19V21"
                stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            <path
                d="M16 3.13C16.8604 3.35031 17.623 3.85071 18.1676 4.55232C18.7122 5.25392 19.0078 6.11683 19.0078 7.005C19.0078 7.89318 18.7122 8.75608 18.1676 9.45769C17.623 10.1593 16.8604 10.6597 16 10.88"
                stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            <path
                d="M9 11C11.2091 11 13 9.20914 13 7C13 4.79086 11.2091 3 9 3C6.79086 3 5 4.79086 5 7C5 9.20914 6.79086 11 9 11Z"
                stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>

        <span>Daftar Admin</span>
    </a>

    <a href="/dashboard/users" class="sidebar-item {{ Request::is('dashboard/users') ? 'active' : '' }}"
        onclick="toggleActive(this)">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M23 21V19C22.9993 18.1137 22.7044 17.2528 22.1614 16.5523C21.6184 15.8519 20.8581 15.3516 20 15.13"
                stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            <path
                d="M17 21V19C17 17.9391 16.5786 16.9217 15.8284 16.1716C15.0783 15.4214 14.0609 15 13 15H5C3.93913 15 2.92172 15.4214 2.17157 16.1716C1.42143 16.9217 1 17.9391 1 19V21"
                stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            <path
                d="M16 3.13C16.8604 3.35031 17.623 3.85071 18.1676 4.55232C18.7122 5.25392 19.0078 6.11683 19.0078 7.005C19.0078 7.89318 18.7122 8.75608 18.1676 9.45769C17.623 10.1593 16.8604 10.6597 16 10.88"
                stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            <path
                d="M9 11C11.2091 11 13 9.20914 13 7C13 4.79086 11.2091 3 9 3C6.79086 3 5 4.79086 5 7C5 9.20914 6.79086 11 9 11Z"
                stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        <span>Daftar Mahasiswa</span>
    </a>

    <a href="/dashboard/rooms" class="sidebar-item {{ Request::is('dashboard/rooms') ? 'active' : '' }}"
        onclick="toggleActive(this)">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M3 9L12 2L21 9V20C21 20.5304 20.7893 21.0391 20.4142 21.4142C20.0391 21.7893 19.5304 22 19 22H5C4.46957 22 3.96086 21.7893 3.58579 21.4142C3.21071 21.0391 3 20.5304 3 20V9Z"
                stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M9 22V12H15V22" stroke="#ABB3C4" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" />
        </svg>

        <span>Daftar Ruangan</span>
    </a>

    <a href="/dashboard/rents" class="sidebar-item {{ Request::is('dashboard/rents') ? 'active' : '' }}"
        onclick="toggleActive(this)">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path
                d="M21 16V8C20.9996 7.64927 20.9071 7.30481 20.7315 7.00116C20.556 6.69751 20.3037 6.44536 20 6.27L13 2.27C12.696 2.09446 12.3511 2.00205 12 2.00205C11.6489 2.00205 11.304 2.09446 11 2.27L4 6.27C3.69626 6.44536 3.44398 6.69751 3.26846 7.00116C3.09294 7.30481 3.00036 7.64927 3 8V16C3.00036 16.3507 3.09294 16.6952 3.26846 16.9988C3.44398 17.3025 3.69626 17.5546 4 17.73L11 21.73C11.304 21.9055 11.6489 21.9979 12 21.9979C12.3511 21.9979 12.696 21.9055 13 21.73L20 17.73C20.3037 17.5546 20.556 17.3025 20.7315 16.9988C20.9071 16.6952 20.9996 16.3507 21 16Z"
                stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M3.27002 6.96L12 12.01L20.73 6.96" stroke="#ABB3C4" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" />
            <path d="M12 22.08V12" stroke="#ABB3C4" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" />
        </svg>

        <span>Daftar Peminjaman</span>
    </a>

    <a href="/dashboard/temporaryRents"
        class="sidebar-item {{ Request::is('dashboard/temporaryRents') ? 'active' : '' }}"
        onclick="toggleActive(this)">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M21 16V8C20.9996 7.64927 20.9071 7.30481 20.7315 7.00116C20.556 6.69751 20.3037 6.44536 20 6.27L13 2.27C12.696 2.09446 12.3511 2.00205 12 2.00205C11.6489 2.00205 11.304 2.09446 11 2.27L4 6.27C3.69626 6.44536 3.44398 6.69751 3.26846 7.00116C3.09294 7.30481 3.00036 7.64927 3 8V16C3.00036 16.3507 3.09294 16.6952 3.26846 16.9988C3.44398 17.3025 3.69626 17.5546 4 17.73L11 21.73C11.304 21.9055 11.6489 21.998 12 21.998C12.3511 21.998 12.696 21.9055 13 21.73L20 17.73C20.3037 17.5546 20.556 17.3025 20.7315 16.9988C20.9071 16.6952 20.9996 16.3507 21 16Z"
                stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M3.27002 6.96L12 12.01L20.73 6.96" stroke="#ABB3C4" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" />
            <path d="M12 22.08V12" stroke="#ABB3C4" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" />
        </svg>

        <span>Konfirmasi Peminjaman</span>
    </a>

    @endif

    <h5 class="sidebar-title">Others</h5>

    @auth
    <form action="/logout" method="post">
        @csrf
        <button class="sidebar-logout" type="submit">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path d="M16 17L21 12L16 7" stroke="#ABB3C4" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
                <path d="M21 12H9" stroke="#ABB3C4" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
                <path
                    d="M9 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H9"
                    stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <span>Logout</span>
        </button>
    </form>
    @else
    <a href="/login" class="sidebar-item" onclick="toggleActive(this)">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M16 17L21 12L16 7" stroke="#ABB3C4" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" />
            <path d="M21 12H9" stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            <path
                d="M9 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H9"
                stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>

        <span>Login</span>
    </a>
    @endauth
</aside>

<script>
        const sidebar = document.getElementById('sidebar');
        const savedState = sessionStorage.getItem('sidebarState') || 'collapsed';

        if (savedState === 'collapsed') {
        sidebar.classList.add('collapsed');
    document.documentElement.classList.add('sidebar-collapsed');
} else {
    sidebar.classList.remove('collapsed');
    document.documentElement.classList.remove('sidebar-collapsed');
}
    document.addEventListener('DOMContentLoaded', () => {
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('toggleSidebar');
        const hoverZone = document.querySelector('.sidebar-hover-zone');

        // Set default collapsed saat reload
        const isRefreshed = performance.navigation.type === performance.navigation.TYPE_RELOAD;
        if (isRefreshed) {
            sessionStorage.setItem('sidebarState', 'collapsed');
        }

        // Ambil status sebelumnya dari sessionStorage
        const savedState = sessionStorage.getItem('sidebarState') || 'collapsed';
        if (savedState === 'collapsed') {
            sidebar.classList.add('collapsed');
        } else {
            sidebar.classList.remove('collapsed');
        }

        // Toggle tombol manual
        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            sessionStorage.setItem('sidebarState', sidebar.classList.contains('collapsed') ? 'collapsed' : 'expanded');
        });

        // Toggle menu active state
        document.querySelectorAll('.sidebar-item').forEach(item => {
            item.addEventListener('click', () => {
                document.querySelectorAll('.sidebar-item').forEach(el => el.classList.remove('active'));
                item.classList.add('active');
            });
        });

        // Hover behavior — gunakan class hover-open agar tidak bentrok dengan collapsed
        hoverZone.addEventListener('mouseenter', () => {
            if (sidebar.classList.contains('collapsed')) {
                sidebar.classList.add('hover-open');
            }
        });

        sidebar.addEventListener('mouseleave', () => {
            sidebar.classList.remove('hover-open');
        });
    });
</script>


    
    
    
    
    