<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'nama' => 'Admin',
            'username' => 'admin',
            'password' => Hash::make('password'),
            'email' => 'ikbal.malik26@gmail.com',
            'no_telp' => '082120999606',
            'alamat' => 'angkrek',
        ]);
    }
}
