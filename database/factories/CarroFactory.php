<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Carro>
 */
class CarroFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $marcasModelos = [
            ['marca' => 'Toyota', 'modelo' => 'Corolla'],
            ['marca' => 'Toyota', 'modelo' => 'Yaris'],
            ['marca' => 'Ford', 'modelo' => 'Focus'],
            ['marca' => 'Ford', 'modelo' => 'Fiesta'],
            ['marca' => 'Chevrolet', 'modelo' => 'Aveo'],
            ['marca' => 'Chevrolet', 'modelo' => 'Onix'],
            ['marca' => 'Honda', 'modelo' => 'Civic'],
            ['marca' => 'Honda', 'modelo' => 'Fit'],
            ['marca' => 'Nissan', 'modelo' => 'Versa'],
            ['marca' => 'Nissan', 'modelo' => 'Sentra'],
            ['marca' => 'Mazda', 'modelo' => '3'],
            ['marca' => 'Mazda', 'modelo' => '2'],
            ['marca' => 'Volkswagen', 'modelo' => 'Gol'],
            ['marca' => 'Volkswagen', 'modelo' => 'Jetta'],
            ['marca' => 'Kia', 'modelo' => 'Rio'],
            ['marca' => 'Kia', 'modelo' => 'Cerato'],
            ['marca' => 'Hyundai', 'modelo' => 'Accent'],
            ['marca' => 'Hyundai', 'modelo' => 'Elantra'],
            ['marca' => 'Renault', 'modelo' => 'Logan'],
            ['marca' => 'Renault', 'modelo' => 'Sandero'],
        ];

        $car = $this->faker->randomElement($marcasModelos);

        return [
            'marca' => $car['marca'],
            'modelo' => $car['modelo'],
            'año' => $this->faker->numberBetween(2000, date('Y')),
            'color' => $this->faker->safeColorName(),
            'precio' => $this->faker->randomFloat(2, 5000, 50000),
            'kilometraje' => $this->faker->numberBetween(0, 200000),
            // 'user_id' se asignará en el seeder
        ];
    }
}
