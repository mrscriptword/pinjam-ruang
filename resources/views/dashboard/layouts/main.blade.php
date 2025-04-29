<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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

        // Search functionality
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const searchButton = document.getElementById('searchButton');
            const clearSearchButton = document.getElementById('clearSearchButton');

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
                });

                clearSearchButton.addEventListener('click', function() {
                    searchInput.value = '';
                    clearSearch();
                    clearSearchButton.style.display = 'none';
                });
            }

            function performSearch() {
                const searchTerm = searchInput.value.toLowerCase().trim();
                if (!searchTerm) {
                    clearSearch();
                    return;
                }

                // Show clear button when search is performed
                if (clearSearchButton) {
                    clearSearchButton.style.display = 'block';
                }

                // Determine current page and search within the appropriate table
                let currentPath = window.location.pathname;
                let tableRows;

                if (currentPath.includes('/dashboard/admin')) {
                    // Search in admin table
                    tableRows = document.querySelectorAll('table tbody tr');
                    searchInTable(tableRows, searchTerm, [1]); // Search in name column
                } else if (currentPath.includes('/dashboard/users')) {
                    // Search in users table
                    tableRows = document.querySelectorAll('table tbody tr');
                    searchInTable(tableRows, searchTerm, [1, 2]); // Search in name and email columns
                } else if (currentPath.includes('/dashboard/rooms')) {
                    // Search in rooms table
                    tableRows = document.querySelectorAll('table tbody tr');
                    searchInTable(tableRows, searchTerm, [1, 2]); // Search in code and name columns
                } else if (currentPath.includes('/dashboard/temporaryRents')) {
                    // Search in temporary rents table
                    tableRows = document.querySelectorAll('table tbody tr');
                    searchInTable(tableRows, searchTerm, [1, 2, 5]); // Search in room code, user name, and purpose columns
                } else if (currentPath.includes('/dashboard/rents')) {
                    // Search in rents table
                    tableRows = document.querySelectorAll('table tbody tr');
                    searchInTable(tableRows, searchTerm, [1, 2, 5]); // Search in room code, user name, and purpose columns
                }
            }

            function searchInTable(rows, searchTerm, columnIndexes) {
                let matchCount = 0;

                rows.forEach(row => {
                    let found = false;

                    columnIndexes.forEach(index => {
                        const cell = row.cells[index];
                        if (cell && cell.textContent.toLowerCase().includes(searchTerm)) {
                            found = true;
                        }
                    });

                    if (found) {
                        row.style.display = '';
                        row.classList.add('search-highlight');
                        setTimeout(() => {
                            row.classList.remove('search-highlight');
                        }, 2000);
                        matchCount++;
                    } else {
                        row.style.display = 'none';
                    }
                });

                // Show/hide "no results" message
                const noResultsRow = document.querySelector('.no-search-results');
                if (noResultsRow) {
                    noResultsRow.remove();
                }

                if (matchCount === 0 && rows.length > 0) {
                    const table = rows[0].closest('table');
                    const tbody = table.querySelector('tbody');
                    const colCount = table.querySelector('tr').cells.length;

                    const noResultsRow = document.createElement('tr');
                    noResultsRow.className = 'no-search-results';

                    const noResultsCell = document.createElement('td');
                    noResultsCell.colSpan = colCount;
                    noResultsCell.textContent = `Tidak ada hasil untuk '${searchTerm}'`;
                    noResultsCell.className = 'text-center';

                    noResultsRow.appendChild(noResultsCell);
                    tbody.appendChild(noResultsRow);
                }
            }

            function clearSearch() {
                const rows = document.querySelectorAll('table tbody tr');
                rows.forEach(row => {
                    row.style.display = '';
                });

                // Hide clear button when search is cleared
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