<?php

namespace App\Http\Controllers;

use App\Models\Ijazah;
use App\Models\Student;
use Illuminate\Http\Request;

class IjazahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ijazah = Ijazah::latest()->get();
        return view('admin.ijazah.index',[
            'ijazah' => $ijazah,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $students = Student::all();
        return view('admin.ijazah.create', [
            'students' => $students
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => ['required', 'unique:ijazahs,student_id'],
            'no_ijazah' => ['required', 'unique:ijazahs,no_ijazah'],
            'status_ijazah' => ['required'],
        ]);

        $check_ijazah = Ijazah::where('student_id', $validated['student_id'])->get();

        if($check_ijazah->count() > 0){
            $pesan = 'Ijazah dengan nama ' . $check_ijazah[0]->student->nama . ' Sudah ada!';
            return redirect()->back()->with('danger', $pesan);
        }
        Ijazah::create($validated);

        return redirect()->route('dashboard.ijazah.index')->with('success', 'Ijazah berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ijazah = Ijazah::where('id', $id)->get()[0];
        return view('admin.ijazah.edit', [
            'ijazah' => $ijazah,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $validated = $request->validate([
            'student_id' => 'required',
            'no_ijazah' => 'required',
            'status_ijazah' => 'required',
        ]);

        $ijazah_lama = Ijazah::where('id', $id)->get()[0];

        if($validated['no_ijazah'] != $ijazah_lama->no_ijazah){
            $check_ijazah = Ijazah::where('no_ijazah', $validated['no_ijazah'])->where('id', '!=', $ijazah_lama->id)->count();
            if($check_ijazah > 0){
                return redirect()->back()->with('danger', 'No Ijazah Sudah digunakan!');
            }
        }

        $ijazah_lama->update($validated);

        return redirect()->route('dashboard.ijazah.index')->with('success', 'Ijazah telah diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $ijazah = Ijazah::where('id', $id)->get()[0];
            $ijazah->delete();

            return redirect()->route('dashboard.ijazah.index')->with('success', 'Data Telah dihapus!');
        } catch (\Throwable $th) {
            return redirect()->route('dashboard.ijazah.index')->with('Danger', 'Terjadi kesalahan dalam proses penghapusan');
        }
    }
}
