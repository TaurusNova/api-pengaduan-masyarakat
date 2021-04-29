<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('officers')->insert([
            'nama_petugas' => 'admin',
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'telp' => '08121211',
            'level' => 'admin'
        ]);
    }
}
