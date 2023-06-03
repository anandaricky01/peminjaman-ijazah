<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $jumlah_peminjam = Person::all()->count();
        $jumlah_tervalidasi = Person::where('status', 'Tervalidasi')->count();
        $jumlah_pending = Person::where('status', 'Pending')->count();
        $jumlah_tak_tervalidasi = Person::where('status', 'Tidak Tervalidasi')->count();
        $peminjam = Person::orderBy('id', 'asc')->with('student')->get();
        return view('admin.index', compact('peminjam', 'jumlah_peminjam', 'jumlah_tervalidasi', 'jumlah_pending', 'jumlah_tak_tervalidasi'));
    }
}
