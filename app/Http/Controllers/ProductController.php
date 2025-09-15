<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Tampilkan list produk.
     */
    public function index(): View
    {
        $products = Product::latest()->paginate(10);
        return view('products.index', compact('products'));
    }

    /**
     * Form tambah produk.
     */
    public function create(): View
    {
        return view('products.create');
    }

    /**
     * Simpan produk baru.
     */
    public function store(Request $request): RedirectResponse
    {
        // validasi
        $request->validate([
            'image'       => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'title'       => 'required|min:5',
            'description' => 'required|min:10',
            'price'       => 'required|numeric',
            'stock'       => 'required|numeric',
        ]);

        // upload gambar ke storage/app/public/products
        $image = $request->file('image');
        $image->storeAs('public/products', $image->hashName());

        // simpan DB
        Product::create([
            'image'       => $image->hashName(),
            'title'       => $request->title,
            'description' => $request->description,
            'price'       => $request->price,
            'stock'       => $request->stock,
        ]);

        return redirect()->route('products.index')->with('success', 'Data Berhasil Disimpan!');
    }

    /**
     * Form edit produk.
     */
    public function edit(string $id): View
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    /**
     * Update produk.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        // validasi
        $request->validate([
            'image'       => 'image|mimes:jpeg,jpg,png|max:2048', // opsional saat edit
            'title'       => 'required|min:5',
            'description' => 'required|min:10',
            'price'       => 'required|numeric',
            'stock'       => 'required|numeric',
        ]);

        $product = Product::findOrFail($id);

        // jika ada gambar baru
        if ($request->hasFile('image')) {
            // hapus gambar lama
            Storage::delete('public/products/'.$product->image);

            // upload gambar baru
            $image = $request->file('image');
            $image->storeAs('public/products', $image->hashName());

            // update dengan gambar baru
            $product->update([
                'image'       => $image->hashName(),
                'title'       => $request->title,
                'description' => $request->description,
                'price'       => $request->price,
                'stock'       => $request->stock,
            ]);
        } else {
            // update tanpa ganti gambar
            $product->update([
                'title'       => $request->title,
                'description' => $request->description,
                'price'       => $request->price,
                'stock'       => $request->stock,
            ]);
        }

        return redirect()->route('products.index')->with('success', 'Data Berhasil Diubah!');
    }
}