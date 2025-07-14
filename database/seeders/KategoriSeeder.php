<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run()
    {
        $categories = ['Elektronik', 'Pakaian', 'Makanan', 'Buku'];

        foreach ($categories as $cat) {
            Kategori::create(['name' => $cat]);
        }
    }
}

