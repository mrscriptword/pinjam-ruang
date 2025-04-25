<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class DashboardUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.users.index', [
            'title' => 'Daftar User', // Changed from 'Daftar Mahasiswa'
            'roles' => Role::all(),
            'users' => User::where('role_id', 2)->paginate(10), // Fetches users with role_id 2
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
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'nomor_induk' => 'required|min:8|unique:users,nomor_induk',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4',
            'role_id' => 'required' // Ensure role_id is provided, should be 2 for user
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);

        try {
            User::create($validatedData);
            // Changed success message
            return redirect('/dashboard/users')->with('userSuccess', 'Data user berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect('/dashboard/users')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return json_encode($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'required|max:100',
            'email' => 'required|email',
            'role_id' => 'required', // Should be 2 for user
        ];

        // If the provided nomor_induk is different from the original one, add validation rule
        if ($request->nomor_induk != $user->nomor_induk) {
            $rules['nomor_induk'] = 'required|min:8|unique:users,nomor_induk';
        }

        $validatedData = $request->validate($rules);

        // Update the user data
        $user->update($validatedData);

        // Changed success message
        return redirect('/dashboard/users')->with('userSuccess', 'Data user berhasil diubah');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        User::destroy($user->id);
        // Changed success message
        return redirect('/dashboard/users')->with('deleteUser', 'Hapus data user berhasil');
    }

    public function makeAdmin($id)
    {
        $userData = [
            'role_id' => 1,
        ];

        User::where('id', $id)->update($userData);

        // Redirect back to the users list or admin list as appropriate
        // Changed success message slightly for clarity
        return redirect('/dashboard/users')->with('userSuccess', 'User berhasil dijadikan admin');
    }

    public function import(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt'
        ]);
    
        $file = $request->file('csv_file');
        $data = array_map('str_getcsv', file($file));
    
        $imported = 0;
        foreach ($data as $index => $row) {
            if ($index === 0) continue; // Lewati baris header
    
            // Cek apakah email atau nomor induk sudah ada
            if (User::where('email', $row[2])->exists() || User::where('nomor_induk', $row[1])->exists()) {
                continue; // Lewati data duplikat
            }
    
            User::create([
                'name'         => $row[0],
                'nomor_induk'  => $row[1],
                'email'        => $row[2],
                'password'     => Hash::make($row[3] ?? 'password123'), // default jika tidak ada
                'role_id'      => 2, // role mahasiswa
            ]);
    
            $imported++;
        }
    
        return redirect('/dashboard/users')->with('userSuccess', "Import selesai. $imported data berhasil ditambahkan.");
    }
    

}
