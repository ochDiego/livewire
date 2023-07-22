<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Storage::deleteDirectory('empleados');
        Storage::makeDirectory('empleados');

        \App\Models\Empleado::factory(30)->create();

        $this->call(RoleSeeder::class);

        \App\Models\User::factory()->create([
            'name' => 'Diego Ochoa',
            'email' => 'diego@gmail.com',
        ])->assignRole('admin');

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ])->assignRole('usuario');
    }
}
