<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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

            if (!$image || !$image->isValid()) {
                return response()->json([
                    'success' => false,
                    'message' => 'File upload tidak valid'
                ], 400);
            }

            // Generate unique filename
            $filename = Str::random(40) . '.' . $image->getClientOriginalExtension();

            // Store image in products directory dengan disk 'public'
            $stored = Storage::disk('public')->putFileAs('products', $image, $filename);

            // Verify file was actually stored
            if (!$stored || !Storage::disk('public')->exists('products/' . $filename)) {
                Log::error('File upload failed', [
                    'filename' => $filename,
                    'stored_path' => $stored,
                    'exists' => Storage::disk('public')->exists('products/' . $filename)
                ]);

                return response()->json([
                    'success' => false,
                    'message' => 'File gagal disimpan ke storage. Path: ' . ($stored ?: 'null')
                ], 500);
            }

            // Build full URL
            $fullUrl = asset('storage/products/' . $filename);

            return response()->json([
                'success' => true,
                'message' => 'Gambar berhasil diupload',
                'data' => [
                    'filename' => $filename,
                    'path' => 'products/' . $filename,
                    'url' => '/storage/products/' . $filename,
                    'full_url' => $fullUrl
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Upload exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupload gambar: ' . $e->getMessage()
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