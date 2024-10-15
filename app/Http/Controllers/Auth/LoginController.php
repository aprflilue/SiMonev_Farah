<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login',[
            "title" => "Login",
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            // 'email' => 'required|email:dns',
            'email' => 'required',
            'password'  => 'required'
        ]);

        $isRememberMe = $request->post('remember-me') ? true : false;
        if (Auth::attempt($credentials, $isRememberMe)) {
            $request->session()->regenerate();
            
            return redirect()->intended('/dashboard');
        }

        Alert::error('Login Gagal!', 'Silahkan masukan kembali email dan password dengan benar');
        return redirect()->back();
        // return back()->with('loginError', 'Login Failed! Try Again');
    }

    public function logout()
    {
        auth()->logout();

        request()->session()->regenerate();
        request()->session()->regenerateToken();

        Alert::success('Logout Sukses!', 'Silahkan login kembali untuk mendapatkan akses anda');
        return redirect()->to('/');
        // return redirect()->to('/login')->with('success', 'Log out successfully!');
    }
}
