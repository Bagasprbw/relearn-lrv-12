<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'kategori_id', 'price', 'image'];

    public function category()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}
