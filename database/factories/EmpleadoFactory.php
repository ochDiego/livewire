<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Empleado>
 */
class EmpleadoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->unique()->word(40),
            'apellido' => $this->faker->unique()->word(40),
            'email' => $this->faker->unique()->safeEmail(),
            'fecha_contratacion' => $this->faker->date(),
            'cargo' => $this->faker->unique()->word(50),
            'imagen' => 'empleados/' .  $this->faker->image('public/storage/empleados',640,480,null,false)
        ];
    }
}
