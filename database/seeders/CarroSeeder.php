<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Carro;
use App\Models\User;

class CarroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $usuarios = User::all()->pluck('id')->toArray(); // Obtiene todos los IDs de usuarios

        Carro::factory()->count(100)->make()->each(function ($carro) use ($usuarios) {
            $carro->user_id = collect($usuarios)->random();
            $carro->save();
        });
    }
}
