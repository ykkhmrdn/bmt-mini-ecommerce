@extends('layouts.app')

@section('title', 'Beranda - BMT Mini E-Commerce')

@section('content')
    <div class="max-w-screen-xl mx-auto p-4">
        <!-- Hero Section -->
        <div class="bg-blue-50 rounded-lg p-8 mb-8">
            <div class="text-center">
                <h1 class="text-4xl font-bold mb-4 text-gray-800">Selamat Datang di BMT Store</h1>
                <p class="text-xl mb-6 text-gray-600">Temukan produk berkualitas dengan harga terbaik</p>
                <a href="{{ route('products.index') }}"
                    class="bg-blue-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700 transition-colors">
                    Belanja Sekarang
                </a>
            </div>
        </div>

        <!-- Features Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 text-center">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 8h14M5 8a2 2 0 110-4h1.586a1 1 0 01.707.293l1.414 1.414a1 1 0 00.707.293H19a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4">
                        </path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold mb-2">Produk Berkualitas</h3>
                <p class="text-gray-600">Produk berkualitas tinggi yang dipilih khusus untuk Anda</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 text-center">
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1">
                        </path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold mb-2">Harga Terbaik</h3>
                <p class="text-gray-600">Harga kompetitif dengan nilai terbaik untuk uang Anda</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 text-center">
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold mb-2">Pengiriman Cepat</h3>
                <p class="text-gray-600">Pengiriman cepat dan aman langsung ke rumah Anda</p>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="bg-white p-8 rounded-lg shadow-sm border border-gray-200 text-center">
            <h2 class="text-2xl font-bold mb-4">Ready to Start Shopping?</h2>
            <p class="text-gray-600 mb-6">Browse our collection of amazing products and find what you need</p>
            <a href="{{ route('products.index') }}"
                class="bg-blue-600 text-white px-8 py-3 rounded-lg font-medium hover:bg-blue-700 transition-colors">
                View All Products
            </a>
        </div>
    </div>
@endsection
