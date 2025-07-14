<?php

namespace App\Http\Controllers;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    //ke halaman utama produk
    public function index()
    {
        $products = Produk::with('category')->get();
        return view('products.index', compact('products'));
    }

    //fungsi untuk menampilkan form tambah produk
    public function create()
    {
        $categories = Kategori::all();
        return view('products.create', compact('categories'));
    }

    //fungsi untuk menyimpan produk baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'price' => 'required|numeric',
        ]);

        Produk::create([
            'name' => $request->name,
            'kategori_id' => $request->kategori_id,
            'price' => $request->price,
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    //fungsi untuk menampilkan form edit produk
    public function edit($id)
    {
        $products = Produk::findOrFail($id);
        $categories = Kategori::all();
        return view('products.edit', compact('categories', 'products'));
    }

    //fungsi untuk mengupdate produk
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'price' => 'required|numeric',
        ]);

        $product = Produk::findOrFail($id);
        $product->update([
            'name' => $request->name,
            'kategori_id' => $request->kategori_id,
            'price' => $request->price,
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diupdate.');
    }
    public function destroy($id)
    {
        $produk = \App\Models\Produk::findOrFail($id);
        $produk->delete();

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }

}
