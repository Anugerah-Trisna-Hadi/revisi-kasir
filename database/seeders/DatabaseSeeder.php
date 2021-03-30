<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        DB::table('produks')->insert([
            'nama' => 'Citato',
            'harga' => 10000,
            'stok' => 50
        ]);

        DB::table('produks')->insert([
            'nama' => 'Pepsodent',
            'harga' => 11000,
            'stok' => 50
        ]);

        DB::table('produks')->insert([
            'nama' => 'Coca Cola',
            'harga' => 5000,
            'stok' => 50
        ]);
    }
}
