<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;

class StudentsImport implements ToModel
{
    public function model(array $row)
    {
        return new Student([
            'nim' => $row[0],
            'nama' => $row[1],
            'id_fakultas' => $row[2],
            'id_prodi' => $row[3],
            'gender' => $row[4],
            'alamat' => $row[5],
        ]);
    }
}

