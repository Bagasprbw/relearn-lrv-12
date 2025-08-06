<?php

namespace App\Http\Controllers;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

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
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            //$request->image->storeAs('public/products', $imageName);
            $request->image->storeAs('products', $imageName, 'public');

            //dd(Storage::files('public/products'));
        }

        Produk::create([
            'name' => $request->name,
            'kategori_id' => $request->kategori_id,
            'price' => $request->price,
            'image' => $imageName,
        ]);

        return redirect()->route('dashboard.products.index')->with('success', 'Produk berhasil ditambahkan.');
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
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $product = Produk::findOrFail($id);
        $imageName = $product->image;

        if ($request->hasFile('image')) { //cek apakah ada file gambar yang diupload
            // Hapus gambar lama jika ada
            if ($product->image && Storage::disk('public')->exists('products/' . $product->image)) {
                Storage::disk('public')->delete('products/' . $product->image);
            }


            // Simpan gambar baru
            $imageName = time() . '.' . $request->image->extension();
            //$request->image->storeAs('public/products', $imageName);
            $request->image->storeAs('products', $imageName, 'public');
        }

        $product->update([
            'name' => $request->name,
            'kategori_id' => $request->kategori_id,
            'price' => $request->price,
            'image' => $imageName,
        ]);

        return redirect()->route('dashboard.products.index')->with('success', 'Produk berhasil diupdate.');
    }
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        // Hapus gambar dari storage
        if ($produk->image && Storage::disk('public')->exists('products/' . $produk->image)) {
            Storage::disk('public')->delete('products/' . $produk->image);
        }

        $produk->delete();

        return redirect()->route('dashboard.products.index')->with('success', 'Produk berhasil dihapus.');
    }

    //fungsi untuk mencari produk dengan integrasi AI
    public function search(Request $request)
    {
        $query = $request->input('q');

        // Kirim ke Gemini API
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'x-goog-api-key' => env('GEMINI_API_KEY'),
        ])->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent', [
            'contents' => [[
                'parts' => [[
                    'text' => "Ubah input pencarian berikut menjadi kata kunci produk singkat dan jelas: \"$query\". Jawabanmu hanya keyword-nya saja."
                ]]
            ]]
        ]);

        $processedQuery = $response->json()['candidates'][0]['content']['parts'][0]['text'] ?? $query;


        if (empty(trim($processedQuery))) {
            return view('index', ['products' => collect()]);
        }

        // Cari produk berdasarkan keyword yang dibantu AI
        $keywords = explode(' ', strtolower($processedQuery)); // ubah ke lowercase dan potong per kata

        $products = Produk::with('category')
            ->where(function ($query) use ($keywords) {
                foreach ($keywords as $word) {
                    $query->orWhere('name', 'like', '%' . $word . '%')
                          ->orWhereHas('category', function ($q) use ($word) {
                              $q->where('name', 'like', '%' . $word . '%');
                          });
                }
            })
            ->get();


        return view('index', compact('products'));
    }

}
