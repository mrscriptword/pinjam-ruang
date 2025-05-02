@extends('dashboard.layouts.main')

@section('container')
<div class="col-md-10 p-0">
    <div class="card-body text-end">
        @if (session()->has('rentSuccess'))
        <div class="col-md-16 mx-auto alert alert-success text-center  alert-success alert-dismissible fade show"
            style="margin-top: 50px" role="alert">
            {{ session('rentSuccess') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if (session()->has('deleteRent'))
        <div class="col-md-16 mx-auto alert alert-success text-center  alert-dismissible fade show"
            style="margin-top: 50px" role="alert">
            {{ session('deleteRent') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if (auth()->user()->role_id === 1)
        <a href="{{ route('rents.export') }}" class="mb-3 btn button btn-success">
            <i class="bi bi-file-earmark-excel"></i> Export to CSV
        </a>
        @endif
                <div class="d-flex">
                    <div class="table-responsive" style="width: 100%; margin-right: -75px;">
                        <table class="fl-table table align-middle table-hover"
                            style="width: 100%; table-layout: auto;">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-center align-middle" style="width: 5%;">No.</th>
                                    <th class="text-center align-middle" style="width: 15%;">Kode Ruangan</th>
                                    @if (auth()->user()->role_id <= 2)
                                    <th class="text-center align-middle" style="width: 15%;">Nama Peminjam</th>
                                    @endif
                                    <th class="text-center align-middle" style="width: 15%;">Mulai Pinjam</th>
                                    <th class="text-center align-middle" style="width: 15%;">Selesai Pinjam</th>
                                    <th class="text-center align-middle" style="width: 15%;">Tujuan</th>
                                    <th class="text-center align-middle" style="width: 15%;">Waktu Transaksi</th>
                                    <th class="text-center align-middle" style="width: 15%;">Kembalikan</th>
                                    <th class="text-center align-middle" style="width: 15%;">Status Pinjam</th>
                                    @if (auth()->user()->role_id <= 2)
                                    <th class="text-center align-middle" style="width: 15%;">Action</th>
                                    @endif
                                </tr>
                            </thead>

                <tbody>
                    @if ($adminRents->count() > 0)
                    @foreach ($adminRents as $rent)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th scope="row">
                        <td><a href="/dashboard/rooms/{{ $rent->room->code }}" class="text-decoration-none"
                                role="button">{{ $rent->room->code }}</a></td>
                        <td>{{ $rent->user->name }}</td>
                        <td>{{ $rent->time_start_use }}</td>
                        <td>{{ $rent->time_end_use }}</td>
                        <td>{{ $rent->purpose }}</td>
                        <td>{{ $rent->transaction_start }}</td>
                        @if ($rent->status == 'dipinjam')
                        <td><a href="/dashboard/rents/{{ $rent->id }}/endTransaction"
                                class="btn btn-success" type="submit" style="padding: 2px 10px"><i
                                    class="bi bi-check fs-5"></i></a></td>
                        @else
                        @if (!is_null($rent->transaction_end))
                        <td>{{ $rent->transaction_end }}</td>
                        @else
                        <td>-</td>
                        @endif
                        @endif
                        <td>{{ $rent->status }}</td>

                        @if (auth()->user()->role_id === 1)
                        <td>
                            <form action="/dashboard/rents/{{ $rent->id }}" method="post"
                                class="d-inline">
                                @method('delete')
                                @csrf
                                <button type="submit" class="bi bi-trash-fill text-danger border-0"
                                    onclick="return confirm('Hapus data peminjaman?')"></button>
                            </form>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="10" class="text-center">
                            -- Belum Ada Daftar Peminjam --
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@extends('dashboard.partials.rentModal')
@endsection