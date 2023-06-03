<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Faker\Factory as faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{

    protected $model = Student::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition()
    {
        // $faker = Factory::create();
        return [
            'nim' => mt_rand(000000000000001, 999999999999999),
            'nama' => $this->faker->name(),
            'gender' => Arr::random(['L', 'P']),
            'id_fakultas' => mt_rand(1,20),
            'id_prodi' => mt_rand(1,20),
            // 'id_person' => $this->faker->unique()->numberBetween($min = 1, $max = 20),
            'alamat' => $this -> faker->address()
        ];
    }
}
