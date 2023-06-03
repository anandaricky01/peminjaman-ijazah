<?php

namespace App\Http\Controllers;

use App\Models\Ijazah;
use Illuminate\Http\Request;
use App\Models\Person;
use Illuminate\Support\Facades\Storage;

class PersonController extends Controller
{
    public function index()
    {
        $persons = Person::with('student')->get();
        return view('admin.peminjam.index', [
            'persons' => $persons
        ]);
    }

    public function edit($id){
        $person = Person::where('id', $id)->get()[0];
        // dd($person);
        return view('admin.peminjam.edit', [
            'person' => $person //id adalah data person
        ]);
    }

    public function update($id, Request $request){

        // validasi data
        $validated = $request->validate([
            'student_id' => 'required',
            'nama_peminjam' => 'required',
            'no_telp' => 'required',
            'hubungan' => 'required',
            'tgl_pinjam' => 'required',
            'tgl_kembali' => 'nullable',
            'status' => 'required',
            'ket' => 'nullable',
            'surat_kuasa' => 'nullable',
            'keperluan' => 'required'
        ]);

        // data pengambil/peminjam lama
        // Mengatur nilai 'surat_kuasa' menggunakan metode has() pada request
        $validated['surat_kuasa'] = $request->has('surat_kuasa');
        // dd($validated);
        // dd($validated);
        $person_lama = Person::where('id', $id)->get()[0];

        // periksa apakah terdapat foto yang diupload
        if($request->image){
            // ambil data foto dari request
            $img = $request->file('image');
            $folderPath = "public/uploads/images";
            $fileNameImage = time() . '_photo_peminjam_pengambil_'  . $img->getClientOriginalName();
            Storage::delete($person_lama->image);
            $validated['image'] = $img->storeAs($folderPath, $fileNameImage);
        }

        $person_lama->update($validated);
        // $person_lama->update(['surat_kuasa' => $validated['surat_kuasa']]);

        if($validated['status'] == 'Tervalidasi'){
            Ijazah::where('student_id', $validated['student_id'])
                ->get()[0]
                ->update([
                    'status_ijazah' => 'unavailable'
                ]);
        }

        if($person_lama->keperluan != 'Pending'){
            app('App\Http\Controllers\RiwayatPeminjamanController')
                ->catat_riwayat([
                    'nama_mahasiswa' => $person_lama->student->nama,
                    'nim' => $person_lama->student->nim,
                    'no_ijazah' => $person_lama->student->ijazah->no_ijazah,
                    'nama_peminjam' => $person_lama->nama_peminjam,
                    'no_telp' => $person_lama->no_telp,
                    'hubungan' => $person_lama->hubungan,
                    'surat_kuasa' => $person_lama->surat_kuasa,
                    'tgl_pinjam' => $person_lama->tgl_pinjam,
                    'tgl_kembali' => $person_lama->tgl_kembali ?? NULL,
                    'ket' => $person_lama->ket ?? NULL,
                    'status' => $person_lama->status,
                    'keperluan' => $person_lama->keperluan,
                ]);
        }

        return redirect()->route('dashboard.person.index')->with('success', 'Data Peminjam berhasil diubah!');

    }

    public function destroy($id){
        try {
            $person = Person::where('id', $id)->get()[0];
            Storage::delete($person->image);
            $person->delete();

            return redirect()->route('dashboard.person.index')->with('success', 'Data Telah dihapus!');
        } catch (\Throwable $th) {
            return redirect()->route('dashboard.person.index')->with('Danger', 'Terjadi kesalahan dalam proses penghapusan');
        }
    }
}
