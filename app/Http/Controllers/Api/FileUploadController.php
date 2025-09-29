<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class FileUploadController extends Controller
{
    public function uploadProductImage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ], [
            'image.required' => 'Gambar wajib diupload',
            'image.image' => 'File harus berupa gambar',
            'image.mimes' => 'Format gambar harus jpeg, png, jpg, gif, atau webp',
            'image.max' => 'Ukuran gambar maksimal 2MB'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $image = $request->file('image');

            // Generate unique filename
            $filename = Str::random(40) . '.' . $image->getClientOriginalExtension();

            // Store image in products directory
            $path = $image->storeAs('public/products', $filename);

            // Get the public URL
            $url = Storage::url('products/' . $filename);

            return response()->json([
                'success' => true,
                'message' => 'Gambar berhasil diupload',
                'data' => [
                    'filename' => $filename,
                    'path' => $path,
                    'url' => $url,
                    'full_url' => asset('storage/products/' . $filename)
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupload gambar'
            ], 500);
        }
    }

    public function deleteProductImage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'filename' => 'required|string'
        ], [
            'filename.required' => 'Nama file wajib diisi'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $filename = $request->filename;
            $filePath = 'public/products/' . $filename;

            if (Storage::exists($filePath)) {
                Storage::delete($filePath);

                return response()->json([
                    'success' => true,
                    'message' => 'Gambar berhasil dihapus'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'File tidak ditemukan'
                ], 404);
            }

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus gambar'
            ], 500);
        }
    }
}