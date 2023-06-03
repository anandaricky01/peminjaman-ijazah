<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use App\Models\Person;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Person>
 */
class PersonFactory extends Factory
{
    protected $model = Person::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nama_peminjam' => $this -> faker->name(),
            'student_id' => $this -> faker->numberBetween(1,10),
            'no_telp' => $this -> faker->phoneNumber(),
            'hubungan' => Arr::random(['Yang Bersangkutan', 'Anggota keluarga / Teman']),
            'status' => Arr::random(['Tervalidasi', 'Pending', 'Tidak Tervalidasi']),
            'tgl_pinjam' => $this -> faker->date($format='Y-m-d', $max='now'),
            'tgl_kembali' => $this -> faker->date($format='Y-m-d', $max='now'),
            'ket' =>  $this -> faker->text(100)
        ];
    }
}
