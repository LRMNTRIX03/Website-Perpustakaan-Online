<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
   
    public function run(): void
    {
        // Menambahkan data kategori
        DB::table('kategoris')->insert([
            ['name' => 'Fiksi'],
            ['name' => 'Non-Fiksi'],
            ['name' => 'Pendidikan'],
            ['name' => 'Sains'],
            ['name' => 'Sejarah'],
            ['name' => 'Biografi'],
            ['name' => 'Fantasi'],
            ['name' => 'Kisah Nyata'],
        ]);
    }
}
