<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Ijazah;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Person;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class MasterController extends Controller
{
    public function index(Request $request)
    {
        $studentData = '';

        try {

            if(isset($request->search)){
                $studentData = Student::where('nim', $request->search)->get()[0];
                if(Ijazah::where('student_id', $studentData->id)->count() < 1){
                    return redirect()->route('home')->with('danger', 'Ijazah sedang tidak tersedia! Silahkan hubungi admin!');
                }

            }

            return view('user.master', [
                'studentData' => $studentData
            ]);

        } catch (\Throwable $th) {
            return redirect()->route('home')->with('danger', 'Data Mahasiswa Tidak tercatat!');
        }
    }

    public function firstStepPost(Request $request){

        // validasi data terlebih dahulu
        $validated = $request->validate([
            'nim' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'fakultas' => 'required',
            'prodi' => 'required',
            'student_id' => 'required',
            'no_ijazah' => 'required',
        ]);

        $checkIjazah = Ijazah::where('no_ijazah', $validated['no_ijazah'])->get()[0];
        if($checkIjazah->status_ijazah == 'unavailable'){
            return redirect()->back()->with('danger', 'Ijazah sedang tidak tersedia/dipinjam/sudah diambil. Silahkan hubungi admin!<br>081234567890');
        }

        // simpan data mahasiswa dalam session dengan key 'data'
        $request->session()->put('data', $validated);

        // redirect ke halaman ke dua
        return redirect()->route('second');
    }

    public function secondPage(Request $request)
    {
        if(empty($request->session()->get('data'))){
            return redirect()->route('home')->with('danger', 'Cari NIM Mahasiswa dahulu!');
        }

        return view('user.second');
    }

    public function secondStepPost(Request $request){

        // validasi data terlebih dahulu
        $validated = $request->validate([
            'nama_peminjam' => 'required',
            'no_telp' => 'required',
            'hubungan' => 'required',
            'keperluan' => 'required',
        ]);

        // check apakah surat kuasa dicentang
        if(isset($request->surat_kuasa)){
            $validated['surat_kuasa'] = 1;
        } else {
            $validated['surat_kuasa'] = 0;
        }

        // ambil data dari session
        $data = $request->session()->get('data');

        // masukan data peminjam ke dalam variabel data
        foreach ($validated as $key => $dataPeminjam) {
            $data[$key] = $dataPeminjam;
        }

        // simpan data yang telah diupdate dalam session dengan key 'data'
        $request->session()->put('data', $data);

        // redirect ke halaman ke ketiga
        return redirect()->route('third');
    }

    public function third(Request $request){
        if(empty($request->session()->get('data'))){
            return redirect()->route('home')->with('danger', 'Cari NIM Mahasiswa dahulu!');
        }

        return view('user.third');
    }

    public function thirdStepPost(Request $request)
    {
        // data tersimpan dalam session dimasukan pada variabel $data
        $data = $request->session()->get('data');

        // ambil data foto dari request
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
            'student_id' => $data['student_id'],
            'nama_peminjam' => $data['nama_peminjam'],
            'no_telp' => $data['no_telp'],
            'hubungan' => $data['hubungan'],
            'surat_kuasa' => $data['surat_kuasa'],
            'tgl_pinjam' => Carbon::now()->format('Y-m-d'),
            'tgl_kembali' => NULL,
            'ket' => '',
            'image' => $file,
            'status' => 'Pending',
            'keperluan' => $data['keperluan'],
        ]);

        // cata riwayat
        app('App\Http\Controllers\RiwayatPeminjamanController')
            ->catat_riwayat([
                'nama_mahasiswa' => $data['nama'],
                'nim' => $data['nim'],
                'no_ijazah' => $data['no_ijazah'],
                'nama_peminjam' => $data['nama_peminjam'],
                'no_telp' => $data['no_telp'],
                'hubungan' => $data['hubungan'],
                'surat_kuasa' => $data['surat_kuasa'],
                'tgl_pinjam' => Carbon::now()->format('Y-m-d'),
                'tgl_kembali' => NULL,
                'ket' => '',
                'status' => 'Pending',
                'keperluan' => $data['keperluan'],
            ]);

        return redirect()->route('selesai');
    }

    public function selesai(Request $request){
        $request->session()->forget('data');

        return view('user.selesai');
    }

    public function test(Request $request){
        // dd($request->all());
        // dd(isset($request->surat_kuasa));
    }
}
