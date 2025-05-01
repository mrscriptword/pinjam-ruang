<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="{{ asset('assets/css/sidebar.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
    <link href="{{ asset('assets/css/table.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <title>{{ $title }} | Sipirang UNTIRTA </title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/Logo_UNTIRTA') }}">
</head>

<body>

    <div class="screen-cover d-none d-xl-none"></div>

    <div class="row">
        <div class="col-12 col-lg-3 col-navbar d-none d-xl-block">

            @include('dashboard.partials.sidebar')

        </div>


        <div class="col-12 col-xl-9">
            @include('dashboard.partials.navbar')

            @yield('container')

        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <script>
        const navbar = document.querySelector('.col-navbar')
        const cover = document.querySelector('.screen-cover')

        const sidebar_items = document.querySelectorAll('.sidebar-item')

        function toggleNavbar() {
            navbar.classList.toggle('d-none')
            cover.classList.toggle('d-none')
        }

        function toggleActive(e) {
            sidebar_items.forEach(function(v, k) {
                v.classList.remove('active')
            })
            e.closest('.sidebar-item').classList.add('active')

        }

        // Enhanced search functionality with AJAX
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const searchButton = document.getElementById('searchButton');
            const clearSearchButton = document.getElementById('clearSearchButton');

            // Define path to detect if we're on the rooms page
            const currentPath = window.location.pathname;
            const isRoomsPage = currentPath.includes('/dashboard/rooms');

            if (searchButton && searchInput) {
                // Search button click handler
                searchButton.addEventListener('click', function() {
                    performSearch();
                });

                // Enter key press handler
                searchInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        performSearch();
                    }
                });

                // Input change handler to show/hide clear button
                searchInput.addEventListener('input', function() {
                    // Show clear button when there's text
                    clearSearchButton.style.display = searchInput.value ? 'block' : 'none';

                    // If input is empty, clear the search results
                    if (!searchInput.value.trim()) {
                        clearSearch();
                    }
                });

                // Clear button click handler
                clearSearchButton.addEventListener('click', function() {
                    searchInput.value = '';
                    clearSearch();
                    clearSearchButton.style.display = 'none';
                });
            }

            // Function to perform search
            function performSearch() {
                const searchTerm = searchInput.value.toLowerCase().trim();

                // If search term is empty, clear search
                if (!searchTerm) {
                    clearSearch();
                    return;
                }

                // Show clear button
                if (clearSearchButton) {
                    clearSearchButton.style.display = 'block';
                }

                // If we're on the rooms page, use AJAX search
                if (isRoomsPage) {
                    // Show loading indicator
                    const tableContainer = document.querySelector('.table-responsive');
                    if (tableContainer) {
                        tableContainer.innerHTML = '<div class="text-center my-4"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div><p class="mt-2">Mencari data...</p></div>';
                    }

                    // Make AJAX request to search rooms
                    fetch(`/dashboard/search-rooms?query=${encodeURIComponent(searchTerm)}`)
                        .then(response => response.json())
                        .then(data => {
                            updateTableWithResults(data.rooms, searchTerm);
                        })
                        .catch(error => {
                            console.error('Search error:', error);
                            if (tableContainer) {
                                tableContainer.innerHTML = '<div class="alert alert-danger">Terjadi kesalahan saat mencari data.</div>';
                            }
                        });
                } else {
                    // For other pages, use the existing client-side search
                    performClientSideSearch(searchTerm);
                }
            }

            // Function to update table with AJAX search results
            function updateTableWithResults(rooms, searchTerm) {
                const tableContainer = document.querySelector('.table-responsive');
                if (!tableContainer) return;

                // If no rooms found
                if (rooms.length === 0) {
                    tableContainer.innerHTML = `
                        <div class="alert alert-info">
                            Tidak ada hasil untuk '${searchTerm}'
                            <button class="btn btn-sm btn-outline-secondary ms-2" onclick="window.location.reload()">
                                Tampilkan Semua
                            </button>
                        </div>`;

                    // Hide pagination when using search with no results
                    const paginationContainer = document.querySelector('.d-flex.justify-content-end');
                    if (paginationContainer) {
                        paginationContainer.style.display = 'none';
                    }
                    return;
                }

                // Create new table with results
                let tableHTML = `
                    <table class="table table-hover table-stripped table-bordered text-center dt-head-center">
                        <thead class="table-info">
                            <tr>
                                <th class="text-center" scope="row">No.</th>
                                <th class="text-center" scope="row">Kode Ruangan</th>
                                <th class="text-center" scope="row">Nama Ruangan</th>
                                <th class="text-center" scope="row">Kapasitas</th>
                                <th class="text-center" scope="row">Action</th>
                            </tr>
                        </thead>
                        <tbody>`;

                // Add each room to the table
                rooms.forEach((room, index) => {
                    const isAdmin = document.querySelector('[data-admin-check]')?.getAttribute('data-admin-check') === '1';

                    tableHTML += `
                        <tr>
                            <th>${index + 1}</th>
                            <td>${room.code}</td>
                            <td><a href="/dashboard/rooms/${room.code}" class="text-decoration-none" role="button">${room.name}</a></td>
                            <td>${room.capacity} Kursi</td>`;

                    // Only add action buttons if user is admin
                    if (isAdmin || document.querySelector('form[action^="/dashboard/rooms/"]')) {
                        tableHTML += `
                            <td style="font-size: 22px;">
                                <a href="/dashboard/rooms/${room.code}/edit" class="bi bi-pencil-square text-warning border-0 editroom" id="editroom" data-id="${room.id}" data-code="${room.code}" data-bs-toggle="modal" data-bs-target="#editRoom"></a>
                                &nbsp;
                                <form action="/dashboard/rooms/${room.code}" method="post" class="d-inline">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
                                    <button type="submit" class="bi bi-trash-fill text-danger border-0" onclick="return confirm('Hapus data ruangan?')"></button>
                                </form>
                            </td>`;
                    } else {
                        tableHTML += `<td>-</td>`;
                    }

                    tableHTML += `</tr>`;
                });

                tableHTML += `
                        </tbody>
                    </table>
                    <div class="alert alert-success mt-3">
                        Ditemukan ${rooms.length} hasil untuk pencarian '${searchTerm}'
                        <button class="btn btn-sm btn-outline-secondary ms-2" onclick="window.location.reload()">
                            Tampilkan Semua
                        </button>
                    </div>`;

                tableContainer.innerHTML = tableHTML;

                // Hide pagination when using search
                const paginationContainer = document.querySelector('.d-flex.justify-content-end');
                if (paginationContainer) {
                    paginationContainer.style.display = 'none';
                }
            }

            // Client-side search function for non-room pages
            function performClientSideSearch(searchTerm) {
                // Find table in the current page
                const table = document.querySelector('table');
                if (table) {
                    // Remove any previous no-results message
                    const existingNoResults = document.querySelector('.no-search-results');
                    if (existingNoResults) {
                        existingNoResults.remove();
                    }

                    const rows = table.querySelectorAll('tbody tr');
                    let foundMatch = false;

                    // Search each row
                    rows.forEach(row => {
                        const text = row.textContent.toLowerCase();
                        if (text.includes(searchTerm)) {
                            row.style.display = '';
                            row.classList.add('search-highlight');
                            foundMatch = true;
                        } else {
                            row.style.display = 'none';
                        }
                    });

                    // Show "no results" message if no matches found
                    if (!foundMatch) {
                        const tbody = table.querySelector('tbody');
                        const colCount = table.querySelector('thead tr').children.length;

                        const noResultsRow = document.createElement('tr');
                        noResultsRow.className = 'no-search-results';

                        const noResultsCell = document.createElement('td');
                        noResultsCell.colSpan = colCount;
                        noResultsCell.textContent = `Tidak ada hasil untuk '${searchTerm}'`;
                        noResultsCell.className = 'text-center';

                        noResultsRow.appendChild(noResultsCell);
                        tbody.appendChild(noResultsRow);
                    }

                    // Remove highlight effect after a delay
                    setTimeout(() => {
                        document.querySelectorAll('.search-highlight').forEach(row => {
                            row.classList.remove('search-highlight');
                        });
                    }, 2000);
                }
            }

            // Function to clear search results
            function clearSearch() {
                // If we're on the rooms page, reload the page to restore pagination
                if (isRoomsPage) {
                    window.location.reload();
                    return;
                }

                // For other pages, use client-side clearing
                // Remove any no results message
                const noResultsRow = document.querySelector('.no-search-results');
                if (noResultsRow) {
                    noResultsRow.remove();
                }

                // Show all table rows
                const tableRows = document.querySelectorAll('table tbody tr');
                tableRows.forEach(row => {
                    row.style.display = '';
                });

                // Hide clear button
                if (clearSearchButton) {
                    clearSearchButton.style.display = 'none';
                }
            }
        });
    </script>

    <style>
        .search-highlight {
            background-color: rgba(255, 243, 205, 0.5) !important;
            transition: background-color 1s;
        }

        .btn-nav-clear {
            position: absolute;
            right: 60px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #ABB3C4;
            z-index: 10;
            padding: 0;
        }

        .btn-nav-clear:hover {
            color: #6c757d;
        }

        .nav-input-group {
            position: relative;
        }
    </style>
</body>

</html>