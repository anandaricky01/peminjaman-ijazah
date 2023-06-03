<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPeminjaman extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_mahasiswa',
        'nim',
        'nama_peminjam',
        'no_telp',
        'keperluan',
        'hubungan',
        'tgl_pinjam',
        'tgl_kembali',
        'ket',
        'surat_kuasa',
        'status',
        'no_ijazah'
    ];

    // $table->string('nama_mahasiswa');
    // $table->string('nim');
    // $table->string('nama_peminjam', 150);
    // $table->string('no_telp', 50);
    // $table->string('hubungan', 50);
    // $table->date('tgl_pinjam')->nullable();
    // $table->date('tgl_kembali')->nullable();
    // $table->string('ket', 250)->nullable();
    // $table->boolean('surat_kuasa')->nullable();
    // $table->enum('status', ['Tervalidasi', 'Pending', 'Tidak Tervalidasi']);
}
