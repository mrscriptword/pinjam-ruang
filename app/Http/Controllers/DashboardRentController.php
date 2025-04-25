<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use App\Models\Room;
use Illuminate\Http\Request;

class DashboardRentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.rents.index', [
            'adminRents' => Rent::latest()->paginate(10),
            'userRents' => Rent::where('user_id', auth()->user()->id)->get(),
            'title' => "Peminjaman",
            'rooms' => Room::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'room_id' => 'required',
    //         'time_start_use' => 'required',
    //         'time_end_use' => 'required',
    //         'purpose' => 'required|max:250',
    //     ]);
    //     $validatedData['user_id'] = auth()->user()->id;
    //     $validatedData['transaction_start'] = now();
    //     $validatedData['status'] = 'pending';
    //     $validatedData['transaction_end'] = null;

    //     Rent::create($validatedData);

    //     return redirect('/dashboard/rents')->with('rentSuccess', 'Peminjaman diajukan. Harap tunggu konfirmasi admin.');
    // }
    public function store(Request $request)
    {
        $now = now();

        $validatedData = $request->validate([
            'room_id' => 'required',
            'time_start_use' => 'required|date|after_or_equal:' . $now->format('Y-m-d H:i:s'),
            'time_end_use' => 'required|date|after:time_start_use',
            'purpose' => 'required|max:250',
        ], [
            'time_start_use.after_or_equal' => 'Tanggal peminjaman harus sama dengan atau setelah waktu sekarang.',
            'time_end_use.after' => 'Waktu selesai peminjaman harus setelah waktu mulai peminjaman.'
        ]);

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['transaction_start'] = $now;
        $validatedData['status'] = 'pending';
        $validatedData['transaction_end'] = null;

        Rent::create($validatedData);

        // Periksa peran pengguna
        if (auth()->user()->role_id === 1) {
            // Admin
            return redirect('/dashboard/rents')->with('rentSuccess', 'Peminjaman diajukan. Harap tunggu konfirmasi admin.');
        } elseif (auth()->user()->role_id === 2) { // Represents 'user' role
            // User
            return redirect('/daftarpinjam')->with('rentSuccess', 'Peminjaman diajukan. Harap tunggu konfirmasi admin.');
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rent  $rent
     * @return \Illuminate\Http\Response
     */
    public function show(Rent $rent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rent  $rent
     * @return \Illuminate\Http\Response
     */
    public function edit(Rent $rent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rent  $rent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rent $rent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rent  $rent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rent $rent)
    {
        Rent::destroy($rent->id);
        return redirect('/dashboard/rents')->with('deleteRent', 'Data peminjaman berhasil dihapus');
    }

    /**
     * Export the rents listing to CSV.
     *
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function export()
    {
        $filename = 'peminjaman_ruangan_' . date('Y-m-d_H-i-s') . '.csv';

        $rents = Rent::with(['room', 'user'])->latest()->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($rents) {
            $file = fopen('php://output', 'w');

            // Add CSV header
            fputcsv($file, [
                'No.',
                'Kode Ruangan',
                'Nama Peminjam',
                'Mulai Pinjam',
                'Selesai Pinjam',
                'Tujuan',
                'Waktu Transaksi',
                'Waktu Pengembalian',
                'Status Pinjam'
            ]);

            // Add data rows
            foreach ($rents as $index => $rent) {
                fputcsv($file, [
                    $index + 1,
                    $rent->room->code,
                    $rent->user->name,
                    $rent->time_start_use,
                    $rent->time_end_use,
                    $rent->purpose,
                    $rent->transaction_start,
                    $rent->transaction_end ?? '-',
                    $rent->status
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rent  $rent
     * @return \Illuminate\Http\Response
     */
    public function endTransaction($id)
    {
        $transaction = [
            'transaction_end' => now(),
            'status' => 'selesai',
        ];

        Rent::where('id', $id)->update($transaction);

        return redirect('/dashboard/rents');
    }
}
