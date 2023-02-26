<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class RegisterController extends Controller
{
    public function index()
    {
        $data['title'] = 'Register';
        return view('admin.register', $data);
    }
    
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'nip'           => 'required|max:20',
            'nama_pegawai'  => 'required|max:100',
            'email'         => 'required|email|unique:employees',
            'password'      => ['required', 'min:5', 'max:255']
        ]);

        $validatedData = [
            'nip'           => $request->nip,
            'nama_pegawai'  => $request->nama_pegawai,
            'email'         => $request->email,
            'password'      => bcrypt($request->password),
        ];

        Employee::create($validatedData);

        if($validatedData){
            Session::flash('status', 'success');
            Session::flash('message', 'Registrasi anda telah berhasil. Silahkan masuk!');
        }
        return redirect('login');
    }
}
