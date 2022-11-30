<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Kategori;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Kategori::create([
            'nama' => 'Pendidikan',
        ]);
        Kategori::create([
            'nama' => 'Kesehatan',
        ]);
        Kategori::create([
            'nama' => 'Politik',
        ]);
        Kategori::create([
            'nama' => 'Petualangan',
        ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
