<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
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
    public function showLinkRequestForm()
    {
        return view('auth.pass');
    }
    
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
    
        $status = Password::sendResetLink(
            $request->only('email')
        );
    
        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }
    public function showResetForm (Request $request,$token)
    {
        return view('auth.reset', ['token' => $token, 'email' => $request->email]);    
    }

    public function resetpass(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required', 
        ]);
     
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
     
                $user->save();
     
                event(new PasswordReset($user));
            }
        );
     
        return $status === Password::PASSWORD_RESET
        ? redirect()->route('login')->with('success', __($status))
        : back()->withErrors(['email' => [__($status)]]);
    }
}
