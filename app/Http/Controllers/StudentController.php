<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentCreateRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Person;
use Exception;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function dashboard()
    {
        $jumlah_peminjam = Student::all()->count();
        $jumlah_tervalidasi = Person::where('status', 'Tervalidasi')->count();
        $jumlah_pending = Person::where('status', 'Pending')->count();
        $jumlah_tak_tervalidasi = Person::where('status', 'Tidak Tervalidasi')->count();
        $mahasiswa = Student::orderBy('id', 'asc')->with('person', 'fakultas', 'prodi')->get();
        return view('admin.index', compact('mahasiswa', 'jumlah_peminjam', 'jumlah_tervalidasi', 'jumlah_pending', 'jumlah_tak_tervalidasi'));
    }
    public function index()
    {
        $student = Student::orderBy('id', 'asc')->with('person', 'fakultas', 'prodi')->get();
        return view('admin.student', compact('student'));
    }
    public function edit($id)
    {
        $student = Student::where('id', $id)->first();
        return view('admin.edit', compact('student'));
    }
    public function create(Request $request)
    {
        $item = Student::with('person', 'fakultas', 'prodi')->get();
        return view('admin.add', compact('item'));
    }
    public function store(StudentCreateRequest $request)
    {
        if ($request->has('image')) {
            $image = $request->file('image');
            $image_name = time() . '.jpg';
            Storage::putFileAs('public/uploads/images/', $image, $image_name);

            $person = Person::create([
                'nama_peminjam' => $request->nama_peminjam,
                'no_telp'       => $request->no_telp,
                'status'        => $request->status,
                'hubungan'      => $request->hubungan,
                'tgl_pinjam'    => $request->tgl_pinjam,
                'tgl_kembali'   => $request->tgl_kembali,
                'image'         => $image_name,
                'ket'           => $request->ket,
            ]);

            Student::create([
                'nim'           => $request->nim,
                'nama'          => $request->nama,
                'id_fakultas'   => $request->id_fakultas,
                'id_prodi'      => $request->id_prodi,
                'id_person'     => $person->id,
                'gender'        => $request->gender,
                'alamat'        => $request->alamat,
            ]);
        } else {
            $person = Person::create([
                'nama_peminjam' => $request->nama_peminjam,
                'no_telp'       => $request->no_telp,
                'status'        => $request->status,
                'hubungan'      => $request->hubungan,
                'tgl_pinjam'    => $request->tgl_pinjam,
                'tgl_kembali'   => $request->tgl_kembali,
                'image'         => $request->image,
                'ket'           => $request->ket,
            ]);

            Student::create([
                'nim'           => $request->nim,
                'nama'          => $request->nama,
                'id_fakultas'   => $request->id_fakultas,
                'id_prodi'      => $request->id_prodi,
                'id_person'     => $person->id,
                'gender'        => $request->gender,
                'alamat'        => $request->alamat,
            ]);
        }

        try {
            if ($person) {
                Session::flash('status', 'success');
                Session::flash('message', 'Data Berhasil Disimpan');
            }
            return redirect('/student');
        } catch (Exception $e) {
            return $this->error('Terjadi Kesalahan');
        }

        // return redirect('/student');
    }

    public function update($id, StudentCreateRequest $request)
    {
        try {
            $student = Student::findOrFail($id);

            if ($request->has('image')) {
                if (Storage::disk('local')->exists('public/uploads/images/' . $student->image)) {
                    Storage::delete('public/uploads/images/' . $student->image);
                }

                $image = $request->file('image');
                $image_name = time() . '.jpg';
                Storage::putFileAs('public/uploads/images/', $image, $image_name);
                Student::where('id', $student->id)
                    ->update([
                        'id_fakultas'   => $request->id_fakultas,
                        'id_prodi'      => $request->id_prodi,
                        'gender'        => $request->gender,
                        'nama'          => $request->nama,
                        'alamat'        => $request->alamat
                    ]);

                Person::where('id', $student->id_person)
                    ->update([
                        'nama_peminjam' => $request->nama_peminjam,
                        'no_telp'       => $request->no_telp,
                        'ket'           => $request->ket,
                        'tgl_pinjam'    => $request->tgl_pinjam,
                        'tgl_kembali'   => $request->tgl_kembali,
                        'image'         => $image_name,
                        'status'        => $request->status,
                    ]);
            } else {
                Student::where('id', $student->id)
                    ->update([
                        'id_fakultas'   => $request->id_fakultas,
                        'id_prodi'      => $request->id_prodi,
                        'gender'        => $request->gender,
                        'nama'          => $request->nama,
                        'alamat'        => $request->alamat
                    ]);

                Person::where('id', $student->id_person)
                    ->update([
                        'nama_peminjam' => $request->nama_peminjam,
                        'no_telp'       => $request->no_telp,
                        'ket'           => $request->ket,
                        'tgl_pinjam'    => $request->tgl_pinjam,
                        'tgl_kembali'   => $request->tgl_kembali,
                        'status'        => $request->status,
                    ]);
            }

            if ($student) {
                Session::flash('status', 'success');
                Session::flash('message', 'Data Berhasil Diupdate');
            }

            return redirect('/student');
        } catch (Exception $e) {
            DB::rollback();
            return $this->error('Terjadi Kesalahan');
        }
    }

    public function destroy($id)
    {
        try {
            // $deleteStudent = Student::findOrFail($id);
            $deleteStudent = Student::where('id', $id)->first();
            $idPerson      = Person::where('id', $deleteStudent->id_person)->first();
            if (Storage::disk('local')->exists('public/image/' . $idPerson->image)) {
                Storage::delete('public/image/' . $idPerson->image);
            }
            $deletePerson  = Person::destroy($idPerson);
            $deleteStudent->delete();

            DB::commit();

            if ($deletePerson) {
                Session::flash('status', 'success');
                Session::flash('message', 'Hapus Data Berhasil');
            }
            return redirect('/student');
        } catch (Exception $e) {
            DB::rollback();
            return $this->error('Terjadi Kesalahan');
        }
    }
}

// admin

// user
// foto
