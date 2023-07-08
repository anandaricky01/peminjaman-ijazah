<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'id',
        'nim',
        'nama',
        'id_fakultas',
        'id_prodi',
        'gender',
        'alamat',
    ];

    public function scopeFilterNim($query, array $searchTerm)
    {
        $query->when($searchTerm['search'] ?? false, function ($query, $searchTerm) {
            $query->where(function ($query) use ($searchTerm) {
                $query->where('nim', '=', $searchTerm);
            });
        });
    }

    public function person()
    {
        return $this->hasOne(Person::class);
    }

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class, 'id_fakultas', 'id');
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'id_prodi', 'id');
    }

    public function ijazah(){
        return $this->hasOne(Ijazah::class);
    }
}

