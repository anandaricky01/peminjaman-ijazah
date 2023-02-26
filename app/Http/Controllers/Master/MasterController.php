<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Person;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class MasterController extends Controller
{
    public function index()
    {
        $studentData = '';
        return view('user.master', compact('studentData'));
    }

    public function secondPage(Request $request)
    {
        $request->session()->put('nim', $request['nim']);
        $request->session()->put('nama', $request['nama']);
        $request->session()->put('alamat', $request['alamat']);
        $request->session()->put('fakultas', $request['fakultas']);
        $request->session()->put('prodi', $request['prodi']);
        return view('user.second');
    }

    public function checkNim(Request $request)
    {
        $studentData = Student::where('nim', $request->nim)->first();
        return view('user.master', compact('studentData'));
    }

    public function afterCheckNIM(Request $request)
    {
        return view('user.second');
    }

    public function dataPeminjam(Request $request)
    {
        $request->session()->put('nama_peminjam', $request['nama_peminjam']);
        $request->session()->put('no_telp', $request['no_telp']);
        $request->session()->put('hubungan', $request['hubungan']);
        $request->session()->put('surat_kuasa', $request['surat_kuasa']);
        return view('user.tri');
    }

    public function store(Request $request)
    {
        // $id_prodi = Prodi::where('prodi', request()->session()->get('prodi'))->first()->id;
        // $id_fakultas = Fakultas::where('fakultas', request()->session()->get('fakultas'))->first()->id;
        // dd($id_prodi);
        $img = $request->image;
        $folderPath = "public/uploads/images/";

        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];

        $image_base64 = base64_decode($image_parts[1]);
        $fileName = time() . '.jpg';

        $file = $folderPath . $fileName;
        Storage::put($file, $image_base64);
        // untuk lihat gambar, cek peminjaman-ijazah-main/storage/app/uploads
        $person = Person::create([
            'nama_peminjam' => request()->session()->get('nama_peminjam'),
            'no_telp' => request()->session()->get('no_telp'),
            'hubungan' => request()->session()->get('hubungan'),
            'surat_kuasa' => request()->session()->get('surat_kuasa'),
            'tgl_pinjam' => Carbon::now()->format('Y-m-d'),
            'tgl_kembali' => NULL,
            'ket' => '',
            'image' => $fileName,
            'status' => 'Pending'
        ]);

        Student::where('nim',request()->session()->get('nim'))->update(['id_person' => $person->id]);

        dd('Image uploaded successfully: ' . $fileName);
    }
}
