<?php

namespace App\Http\Controllers;

use App\Models\RiwayatPeminjaman;
use Illuminate\Http\Request;

class RiwayatPeminjamanController extends Controller
{
    public function catat_riwayat(Array $riwayat){
        RiwayatPeminjaman::create($riwayat);
    }

    public function index(){
        $riwayat_peminjaman = RiwayatPeminjaman::latest()->get();
        return view('admin.riwayat_peminjaman.index',[
            'riwayat_peminjaman' => $riwayat_peminjaman,
        ]);
    }

    public function show($id){
        $riwayat_peminjaman = RiwayatPeminjaman::where('id', $id)->get()->first();
        return view('admin.riwayat_peminjaman.show',[
            'riwayat_peminjaman' => $riwayat_peminjaman,
        ]);
    }
}
