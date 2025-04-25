<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.admin.index', [
            'title' => "Daftar Admin",
            'admins' => User::where('role_id', 1)->get(),
            // Fetch users (role_id = 2) instead of users with role < 2
            'users' => User::where('role_id', 2)->get(),
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
            'email' => 'required|email',
            'password' => 'required|min:4'
        ]);

        $validatedData['role_id'] = 1;

        $validatedData['password'] = bcrypt($validatedData['password']);

        User::create($validatedData);

        return redirect('/dashboard/admin')->with('adminSuccess', 'Data admin berhasil ditambahkan');
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
    public function update(Request $request, User $admin)
    {
        $rules = [
            'name' => 'required|max:100',
            'email' => 'required|email',
        ];

        // If the provided nomor_induk is different from the original one, add validation rule
        if ($request->nomor_induk != $admin->nomor_induk) {
            $rules['nomor_induk'] = 'required|min:8|unique:users,nomor_induk';
        }

        $validatedData = $request->validate($rules);
        $validatedData['role_id'] = 1; // Ensure role is admin

        // Update the admin data
        $admin->update($validatedData);

        return redirect('/dashboard/admin')->with('adminSuccess', 'Data Admin berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $admin)
    {
        $admin->delete();
        return redirect('/dashboard/admin')->with('deleteAdmin', 'Hapus data admin berhasil');
    }


    public function demoteToUser($id) // Renamed from removeAdmin
    {
        $userData = [
            'role_id' => 2 // Change role_id to 2 (User)
        ];

        User::where('id', $id)->update($userData);

        // Changed success message
        return redirect('/dashboard/admin')->with('adminSuccess', 'Role admin berhasil diubah menjadi user');
    }
}
