<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentCreateRequest;
use App\Models\Fakultas;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Person;
use App\Models\Prodi;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index()
    {
        $student = Student::orderBy('id', 'asc')->with('person', 'fakultas', 'prodi')->get();
        return view('admin.student.index', compact('student'));
    }

    public function create()
    {
        $fakultas = Fakultas::all();
        $prodi = Prodi::all();
        return view('admin.student.create', [
            'fakultas' => $fakultas,
            'prodi' => $prodi
        ]);
    }

    public function store(Request $request)
    {
        try {
            //code...
            $validated = $request->validate([
                'nim' => ['required', 'unique:students,nim'],
                'nama' => 'required',
                'id_fakultas' => 'required',
                'id_prodi' => 'required',
                'gender' => 'required',
                'alamat' => 'required',
            ]);

            Student::create($validated);

            return redirect()->route('dashboard.student.index')->with('success', 'Data Mahasiswa berhasil dibuat!');
        } catch (QueryException $e) {
            return redirect()->back()->with('danger', $e->errorInfo);
        }
    }

    public function edit($id)
    {
        $student = Student::where('id', $id)->first();
        $fakultas = Fakultas::all();
        $prodi = Prodi::all();
        return view('admin.student.edit', [
            'student' => $student,
            'fakultas' => $fakultas,
            'prodi' => $prodi,
        ]);
    }

    // public function update($id, StudentCreateRequest $request)
    public function update($id, Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'nim' => 'required',
            'id_fakultas' => 'required',
            'id_prodi' => 'required',
            'gender' => 'required',
            'alamat' => 'required',
        ]);

        $student_lama = Student::where('id', $id)->first();
        if($request->nim != $student_lama->nim){
            $check_student = Student::where('nim', $validated['nim'])->where('id', '!=', $student_lama->id)->count();
            if($check_student > 0){
                return redirect()->back()->with('danger', 'Nim Telah Digunakan!');
            }
        }

        $student_lama->update($validated);

        return redirect()->route('dashboard.student.index')->with('success', 'Data berhasil dirubah');
    }

    public function destroy($id)
    {
        try {
            $student = Student::where('id', $id)->get()[0];
            $student->delete();

            return redirect()->route('dashboard.ijazah.index')->with('success', 'Data Telah dihapus!');
        } catch (\Throwable $th) {
            return redirect()->route('dashboard.ijazah.index')->with('Danger', 'Terjadi kesalahan dalam proses penghapusan');
        }
    }
}

// admin

// user
// foto
