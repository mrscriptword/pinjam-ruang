@extends('dashboard.layouts.main')

@section('container')
<div class="col-md-10 p-0">
    <div class="card-body text-end">
        @if (session()->has('adminSuccess'))
        <div class="col-md-16 mx-auto alert alert-success text-center  alert-success alert-dismissible fade show"
            style="margin-top: 50px" role="alert">
            {{ session('adminSuccess') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if (session()->has('deleteAdmin'))
        <div class="col-md-16 mx-auto alert alert-success text-center  alert-dismissible fade show"
            style="margin-top: 50px" role="alert">
            {{ session('deleteAdmin') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if (auth()->user()->role_id === 1)
        <button type="button" class="mb-3 btn button btn-primary" data-bs-toggle="modal"
            data-bs-target="#addAdmin">
            Tambah Admin Baru
        </button>
        @endif
        </div>
        <div class="d-flex">
            <div class="table-responsive" style="width: 100%; margin-right: -75px;">
                <table class="fl-table table align-middle table-hover"
                    style="width: 100%; table-layout: auto;">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center align-middle" style="width: 5%;">No.</th>
                            <th class="text-center align-middle" style="width: 15%;">Username</th>
                            <th class="text-center align-middle" style="width: 15%;">Nomor Induk</th>
                            <th class="text-center align-middle" style="width: 15%;">Email</th>
                            <th class="text-center align-middle" style="width: 15%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($admins->count() > 0)
                        @foreach ($admins as $admin)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $admin->name }}</td>
                            <td>{{ $admin->nomor_induk }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>
                                {{-- ... other actions like edit ... --}}

                                {{-- Update the href to use the route name 'admin.demote' --}}
                                <a href="{{ route('admin.demote', ['id' => $admin->id]) }}" class="badge bg-warning border-0" onclick="return confirm('Ubah role admin {{ $admin->name }} menjadi user?')">
                                    <i class="bi bi-arrow-down-square"></i> Jadikan User
                                </a>

                                {{-- Form for deleting the admin entirely (if exists) --}}
                                <form action="/dashboard/admin/{{ $admin->id }}" method="POST" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button class="badge bg-danger border-0" onclick="return confirm('Hapus admin {{ $admin->name }}?')">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="5" class="text-center">
                                -- Belum Ada Daftar Admin --
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
</div>
@endsection

@extends('dashboard.partials.addAdminModal')
@extends('dashboard.partials.editAdminModal')
{{-- @extends('dashboard.partials.chooseAdminModal') --}}

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleButton = document.getElementById('toggleSidebar'); // ← sesuaikan dengan ID yang kamu pakai
        toggleButton?.addEventListener('click', function () {
            document.body.classList.toggle('sidebar-collapsed');
        });
    });
</script>


