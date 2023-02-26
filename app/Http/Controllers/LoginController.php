<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        $data['title'] = 'Login';
        return view('admin.login', $data);
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'nip'      => ['required'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/index');
        }

        return back()->with('loginError', 'NIP atau password yang anda masukkan salah');
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

//     public function login(Request $request)
//     {
//         $request->validate([
//             'nip'       => 'required',
//             'password'  => 'required',
//         ]);
//         if (Auth::attempt(['nip' => $request->nip, 'password' => $request->password])) {
//             $request->session()->regenerate();
//             return redirect()->intended('/index');
//         }

//         return back()->withErrors([
//             'password' => 'NIP atau password yang anda masukkan salah',
//         ]);
//     }

//     public function logout(Request $request)
//     {
//         Auth::logout();
//         $request->session()->invalidate();
//         $request->session()->regenerateToken();
//         return redirect('/login');
//     }
}
