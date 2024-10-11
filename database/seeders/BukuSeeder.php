<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menambahkan data buku
        DB::table('bukus')->insert([
            [
                'title' => 'Buku Fiksi Pertama',
                'author' => 'Penulis Fiksi 1',
                'publisher' => 'Penerbit Fiksi 1',
                'year_published' => 2020,
                'isbn' => '1234567890123',
                'category_id' => 1, // ID kategori Fiksi
            ],
            [
                'title' => 'Buku Non-Fiksi Pertama',
                'author' => 'Penulis Non-Fiksi 1',
                'publisher' => 'Penerbit Non-Fiksi 1',
                'year_published' => 2019,
                'isbn' => '9876543210123',
                'category_id' => 2, // ID kategori Non-Fiksi
                
            ],
            [
                'title' => 'Buku Pendidikan',
                'author' => 'Penulis Pendidikan',
                'publisher' => 'Penerbit Pendidikan',
                'year_published' => 2021,
                'isbn' => '4567891234567',
                'category_id' => 3, // ID kategori Pendidikan
            ],
            // Tambahkan buku lainnya sesuai kebutuhan
        ]);
    }
}
