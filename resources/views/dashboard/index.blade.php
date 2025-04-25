@extends('dashboard.layouts.main')

@section('container')
    <div class="col-md-10 p-0">
        <h2 class="content-title text-center">Daft {{ $title }}</h2>
        <div class="card-body text-end">
            
            {{-- Pesan sukses --}}
            @if (session()->has('roomSuccess'))
                <div class="col-md-16 mx-auto alert alert-success text-center alert-dismissible fade show"
                    style="margin-top: 50px" role="alert">
                    {{ session('roomSuccess') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session()->has('userSuccess'))
                <div class="col-md-16 mx-auto alert alert-success text-center alert-dismissible fade show"
                    style="margin-top: 20px" role="alert">
                    {{ session('userSuccess') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Tombol aksi --}}
            <button type="button" class="mb-3 btn button btn-primary" data-bs-toggle="modal" data-bs-target="#pinjamRuangan">
                Pinjam
            </button>
            <button type="button" class="mb-3 btn button btn-primary" data-bs-toggle="modal" data-bs-target="#addRoom">
                Tambah Ruangan
            </button>

            {{-- Tombol Import CSV --}}
            <form action="{{ route('users.import') }}" method="POST" enctype="multipart/form-data" class="d-inline-block text-start mt-2">
                @csrf
                <div class="input-group">
                    <input type="file" name="csv_file" class="form-control" required>
                    <button type="submit" class="btn btn-success">Import CSV Mahasiswa</button>
                </div>
            </form>

            {{-- Tabel --}}
            <div class="table-responsive mt-4">
                <table class="table table-hover table-stripped table-bordered text-center dt-head-center" id="datatable">
                    <thead class="table-info">
                        <tr>
                            <th scope="row">No.</th>
                            <th scope="row">Nama Ruangan</th>
                            <th scope="row">Kode Ruangan</th>
                            <th scope="row">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rooms as $room)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $room->name }}</td>
                                <td>{{ $room->code }}</td>
                                <td style="font-size: 22px;">
                                    <a href="#"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;
                                    <a href="#"><i class="bi bi-trash-fill text-danger"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    @extends('dashboard.partials.rentModal')
    @extends('dashboard.partials.addRoomModal')
@endsection
