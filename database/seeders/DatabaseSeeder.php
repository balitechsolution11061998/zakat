<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $userId = DB::table('users')->insertGetId([
            'nama_masjid' => 'Administrator',
            'kota' => 'Sidoarjo',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        // Insert into jumlah_zakat with the user_id
        DB::table('jumlah_zakat')->insert([
            'user_id' => $userId, // Set the user_id to the ID of the inserted user
            'jumlah_uang' => 0,
            'total_uang' => 0,
            'total_distribusi' => 0,
        ]);



    }
}
