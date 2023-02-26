<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;

class PersonController extends Controller
{
    public function index()
    {
        $data = Person::with('student')->get();
        return view('validasi.edit', ['listpeminjam' => $data]);
    }
}
