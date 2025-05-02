@extends('dashboard.layouts.main')

@section('container')
    <div class="col-md-10 p-0">
        <div class="card-body text-end">
            @if (session()->has('userSuccess'))
                <div class="col-md-16 mx-auto alert alert-success text-center  alert-success alert-dismissible fade show"
                    style="margin-top: 50px" role="alert">
                    {{ session('userSuccess') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session()->has('deleteUser'))
                <div class="col-md-16 mx-auto alert alert-success text-center  alert-dismissible fade show"
                    style="margin-top: 50px" role="alert">
                    {{ session('deleteUser') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (auth()->user()->role_id === 1)
                <button type="button" class="mb-3 btn button btn-primary" data-bs-toggle="modal" data-bs-target="#addUser">
                    Tambah Mahasiswa
                </button>
            @endif
            <div class="table-responsive">
                <div class="d-flex justify-content-start">
                    {{ $users->links() }}
                </div>
                {{-- Tombol Import CSV --}}
@if (auth()->user()->role_id === 1)
    <form action="{{ route('users.import') }}" method="POST" enctype="multipart/form-data" class="mb-4 mt-2 text-start">
        @csrf
        <label for="csv_file" class="form-label">Import Data Mahasiswa</label>
        <div class="input-group">
            <input type="file" name="csv_file" id="csv_file" class="form-control" required>
            <button type="submit" class="btn btn-success">Import CSV</button>
        </div>
    </form>
@endif

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
                                        <th class="text-center align-middle" style="width: 15%;">Role</th>
                                        <th class="text-center align-middle" style="width: 15%;">Action</th>
                                    </tr>
                                </thead>
                    <tbody>

                        @if ($users->count() > 0)
                            @foreach ($users as $user)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }} </th>
                                    <td>{{ $user->name }} </td>
                                    <td>{{ $user->nomor_induk }} </td>
                                    <td>{{ $user->email }} </td>
                                    <td>{{ $user->role->name }} </td>
                                    @if (auth()->user()->role_id === 1)
                                        <td style="font-size: 22px;">
                                             <a href="/dashboard/users/{{ $user->id }}/edit" class="edituser"
                                                id="edituser" data-id="{{ $user->id }}" data-bs-toggle="modal"
                                                data-bs-target="#edituser"><i
                                                    class="bi bi-pencil-square text-warning"></i></a>&nbsp; 
                                            <a href="/dashboard/users/{{ $user->id }}/makeAdmin" class="makeadmin"
                                                id="makeadmin"><i class="bi bi-person-plus-fill"></i></a>&nbsp;
                                            <form action="/dashboard/users/{{ $user->id }}" method="post"
                                                class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="bi bi-trash-fill text-danger border-0"
                                                    onclick="return confirm('Hapus data mahasiswa?')"></button>
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center">
                                    -- Belum Ada Peminjaman --
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    @extends('dashboard.partials.addUserModal')
    @extends('dashboard.partials.editUserModal')
@endsection
