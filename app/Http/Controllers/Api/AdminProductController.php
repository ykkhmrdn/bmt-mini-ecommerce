<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminProductController extends Controller
{
    public function index()
    {
        try {
            $products = Product::orderBy('created_at', 'desc')->get();

            return response()->json([
                'success' => true,
                'products' => $products
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data produk'
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|string|max:500'
        ], [
            'name.required' => 'Nama produk wajib diisi',
            'price.required' => 'Harga produk wajib diisi',
            'price.numeric' => 'Harga harus berupa angka',
            'price.min' => 'Harga tidak boleh kurang dari 0',
            'stock.required' => 'Stok produk wajib diisi',
            'stock.integer' => 'Stok harus berupa angka',
            'stock.min' => 'Stok tidak boleh kurang dari 0',
            'description.max' => 'Deskripsi maksimal 1000 karakter',
            'image.max' => 'URL gambar maksimal 500 karakter'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $product = Product::create([
                'name' => $request->name,
                'price' => $request->price,
                'stock' => $request->stock,
                'description' => $request->description,
                'image' => $request->image
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil ditambahkan',
                'product' => $product
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan produk'
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $product = Product::findOrFail($id);

            return response()->json([
                'success' => true,
                'product' => $product
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Produk tidak ditemukan'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|string|max:500'
        ], [
            'name.required' => 'Nama produk wajib diisi',
            'price.required' => 'Harga produk wajib diisi',
            'price.numeric' => 'Harga harus berupa angka',
            'price.min' => 'Harga tidak boleh kurang dari 0',
            'stock.required' => 'Stok produk wajib diisi',
            'stock.integer' => 'Stok harus berupa angka',
            'stock.min' => 'Stok tidak boleh kurang dari 0',
            'description.max' => 'Deskripsi maksimal 1000 karakter',
            'image.max' => 'URL gambar maksimal 500 karakter'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $product = Product::findOrFail($id);

            $product->update([
                'name' => $request->name,
                'price' => $request->price,
                'stock' => $request->stock,
                'description' => $request->description,
                'image' => $request->image
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil diperbarui',
                'product' => $product
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui produk'
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();

            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil dihapus'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus produk'
            ], 500);
        }
    }
}