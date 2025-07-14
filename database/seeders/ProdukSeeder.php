<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produk;
use App\Models\Kategori;

class ProdukSeeder extends Seeder
{
    public function run()
    {
        $kategoris = Kategori::all();

        foreach ($kategoris as $kategori) {
            Produk::create([
                'name' => 'Produk ' . $kategori->name,
                'kategori_id' => $kategori->id,
                'price' => rand(10000, 100000),
            ]);
        }
    }
}

