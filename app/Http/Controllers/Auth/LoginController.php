<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash; 
use Session;

class LoginController extends Controller
{
    public function login()
    {
            return view('auth.login');
      
    }

    public function actionlogin(Request $request)
    {
        
        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        if (Auth::attempt($data)) {
            return redirect('/report');
        }else{
            return redirect('/login')->with('error', 'Password Atau Username Salah: ');
            
        }
    }

    public function editprofile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');


        $user->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui');
        return redirect()->back()->with('error', 'Profil Gagal diperbarui');
    }

    public function actionlogout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function register()
    {
        return view('auth.register'); // Ganti 'auth.register' dengan nama tampilan Anda
    }

        
    public function actionregister(Request $request)
    {
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        return redirect()->route('login')->with('success', 'Register Berhasil.');
        return redirect()->route('register')->with('error', 'Register Gagal ');
    }


}
