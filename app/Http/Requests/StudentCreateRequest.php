<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'id_fakultas' => 'required',
            'id_prodi' => 'required',
            'gender' => 'required',
            'tgl_pinjam' => 'required',
            'tgl_kembali' => 'required',
            'status' => 'required'
        ];
        
        if ($this->isMethod('post')) {
            $rules['nim'] = 'required|unique:students|max:15';
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
            return $rules;
        }
        return $rules;
    }

    public function attributes()
    {
        return [
            'prodi' => 'program studi'
        ];
    }

    public function messages()
    {
        return [
            'nim.required' => 'NIM wajib diisi',
            'nim.max' => 'NIM maksimal :max karakter',
            'id_fakultas.required' => 'Fakultas wajib diisi',
            'id_prodi.required' => 'Prodi wajib diisi',
            'gender.required' => 'Gender wajib diisi',
            'tgl_pinjam.required' => 'Tanggal Pinjam wajib diisi',
            'tgl_kembali.required' => 'Tanggal Kembali wajib diisi',
            'status.required' => 'Status wajib diisi',
            'image.required' => 'Tidak dapat memuat file',
            'image.max' => 'Upload gambar maksimal 2MB'
        ];
    }
}
