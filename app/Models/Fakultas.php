<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fakultas extends Model
{
    use HasFactory;

    protected $table = 'fakultas';
    public $timestamps = false;
    protected $fillable = ['fakultas'];

    public function prodi()
    {
        return $this->hasMany(Prodi::class, 'id', 'id_fakultas');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'id', 'id_fakultas');
    }
}
