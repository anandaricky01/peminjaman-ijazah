<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'employees';

    public $timestamps = false;
    protected $primarykey = 'id';
    protected $guarded = ['id'];
    protected $fillable = [
        'nip',
        'nama_pegawai',
        'email',
    ];
    
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
