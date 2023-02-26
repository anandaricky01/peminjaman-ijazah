<?php

namespace Database\Factories;

use App\Models\Prodi;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProdiFactory extends Factory
{
    protected $model = Prodi::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'prodi' =>  $this ->faker->text(10),
            'id_fakultas' => mt_rand(1,20)
        ];
    }
}
