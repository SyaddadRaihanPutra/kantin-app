<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin User',
                'email' => 'admin@kantin.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pemilik Kantin',
                'email' => 'owner@kantin.com',
                'password' => Hash::make('password'),
                'role' => 'pemilik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pembeli User',
                'email' => 'pembeli@kantin.com',
                'password' => Hash::make('password'),
                'role' => 'pembeli',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
