<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;

class MasterController extends Controller
{
    public function index()
    {
        $studentData = '';
        return view('user.master', compact('studentData'));
    }

    public function secondPage(Request $request){
        $request->session()->put('nama', $request['nama']);
        $request->session()->put('alamat', $request['alamat']);
        $request->session()->put('fakultas', $request['fakultas']);
        $request->session()->put('prodi', $request['prodi']);
        return view('user.second');
    }

    public function checkNim(Request $request)
    {
        $studentData = Student::where('nim', $request->nim)->first();
        return view('user.master', compact('studentData'));
    }

    public function afterCheckNIM(Request $request)
    {
        return view('user.second');
    }

    public function dataPeminjam(Request $request)
    {
        $request->session()->put('nama_peminjam', $request['nama_peminjam']);
        $request->session()->put('no_telp', $request['no_telp']);
        $request->session()->put('hubungan', $request['hubungan']);
        $request->session()->put('surat_kuasa', $request['surat_kuasa']);
        return view('user.tri');
    }

    public function liatFoto(Request $request){
        return $_FILES['webcam'];
    }

    public function save(Request $request)
    {
        
    }
}

