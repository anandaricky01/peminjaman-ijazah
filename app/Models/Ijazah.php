<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ijazah extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'no_ijazah',
        'status_ijazah'
    ];

    public function student(){
        return $this->belongsTo(Student::class);
    }
}
