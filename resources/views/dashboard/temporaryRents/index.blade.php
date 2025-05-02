@extends('dashboard.layouts.main')

@section('container')
<div class="col-md-10 p-0">
    <div class="card-body text-end">
        <div class="d-flex">
            <div class="table-responsive" style="width: 100%; margin-right: -75px;">
                <table class="fl-table table align-middle table-hover"
                    style="width: 100%; table-layout: auto;">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center align-middle" style="width: 5%;">No.</th>
                            <th class="text-center align-middle" style="width: 15%;">Kode Ruangan</th>
                            <th class="text-center align-middle" style="width: 15%;">Nama Peminjam</th>
                            <th class="text-center align-middle" style="width: 15%;">Mulai Pinjam</th>
                            <th class="text-center align-middle" style="width: 15%;">Selesai Pinjam</th>
                            <th class="text-center align-middle" style="width: 15%;">Tujuan</th>
                            <th class="text-center align-middle" style="width: 15%;">Waktu Transaksi</th>
                            <th class="text-center align-middle" style="width: 15%;">Kembalikan</th>
                            <th class="text-center align-middle" style="width: 15%;">Status Pinjam</th>
                            <th class="text-center align-middle" style="width: 15%;">Action</th>
                        </tr>
                    </thead>
                <tbody>

                    @if ($rents->count() > 0)
                    @foreach ($rents as $rent)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th scope="row">
                        <td><a href="/dashboard/rooms/{{ $rent->room->code }}"
                                class="text-decoration-none">{{ $rent->room->code }}</a></td>
                        <td>{{ $rent->user->name }}</td>
                        <td>{{ $rent->time_start_use }}</td>
                        <td>{{ $rent->time_end_use }}</td>
                        <td>{{ $rent->purpose }}</td>
                        <td>{{ $rent->transaction_start }}</td>
                        <td>{{ $rent->status }}</td>

                        @if (auth()->user()->role_id === 1)
                        <td>
                            <a href="/dashboard/temporaryRents/{{ $rent->id }}/acceptRents"
                                class="btn btn-success mb-2" style="padding: 2px 10px"><i
                                    class="bi bi-check-lg"></i></a>
                            <a href="/dashboard/temporaryRents/{{ $rent->id }}/declineRents"
                                class="btn btn-danger mb-2" style="padding: 2px 10px"><i
                                    class="bi bi-x-lg"></i></a>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="9" class="text-center">
                            -- Belum Ada Daftar Peminjam --
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection