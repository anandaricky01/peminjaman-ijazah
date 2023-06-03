<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $table = 'persons';
    protected $fillable = [
        'nama_peminjam',
        'student_id',
        'no_telp',
        'hubungan',
        'tgl_pinjam',
        'tgl_kembali',
        'image',
        'status',
        'ket',
        'keperluan',
        'surat_kuasa'
    ];
    protected $primarykey = 'id';

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
