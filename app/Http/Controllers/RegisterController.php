<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function index(){
        return view('auth.register',[
            'title' => 'Register',
            'active' => 'register'
        ]);
    }

    public function register(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'nomor_induk' => 'required|min:8|unique:users,nomor_induk',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4', 
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['role_id'] = 2;

        try {
            User::create($validatedData);
            return redirect('/login')->with('regisSuccess', 'Berhasil Register, Silahkan Login');
        } catch (\Exception $e) {
            return redirect('/register')->with('regiserror', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

}
