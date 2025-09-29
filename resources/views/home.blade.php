@extends('layouts.app')

@section('title', 'Beranda - BMT Mini E-Commerce')

@section('content')
    <!-- Hero Section -->
    <div class="bg-gradient-to-br from-green-50 via-white to-green-100 py-16">
        <div class="max-w-screen-xl mx-auto px-4">
            <div class="text-center">
                <h1 class="text-5xl font-bold mb-6 text-gray-800 leading-tight">
                    Belanja Mudah, <span class="text-green-600">Berkualitas</span>
                    <br>di BMT Store
                </h1>
                <p class="text-xl mb-8 text-gray-600 max-w-2xl mx-auto leading-relaxed">
                    Platform belanja online terpercaya dengan ribuan produk berkualitas tinggi dan harga terjangkau untuk
                    kebutuhan sehari-hari Anda
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('products.index') }}"
                        class="bg-green-600 text-white px-8 py-4 rounded-xl font-semibold text-lg hover:bg-green-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                        <i class="fas fa-shopping-bag mr-2"></i>
                        Mulai Belanja
                    </a>
                    <a href="#features"
                        class="bg-white text-green-600 border-2 border-green-600 px-8 py-4 rounded-xl font-semibold text-lg hover:bg-green-50 transition-all duration-300">
                        <i class="fas fa-info-circle mr-2"></i>
                        Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Section -->
    <div class="bg-white py-12 border-b">
        <div class="max-w-screen-xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
                <div class="group">
                    <div
                        class="text-3xl font-bold text-green-600 mb-2 group-hover:scale-110 transition-transform duration-300">
                        10,000+</div>
                    <div class="text-gray-600 font-medium">Produk Tersedia</div>
                </div>
                <div class="group">
                    <div
                        class="text-3xl font-bold text-green-600 mb-2 group-hover:scale-110 transition-transform duration-300">
                        50,000+</div>
                    <div class="text-gray-600 font-medium">Pelanggan Puas</div>
                </div>
                <div class="group">
                    <div
                        class="text-3xl font-bold text-green-600 mb-2 group-hover:scale-110 transition-transform duration-300">
                        100+</div>
                    <div class="text-gray-600 font-medium">Kota Terjangkau</div>
                </div>
                <div class="group">
                    <div
                        class="text-3xl font-bold text-green-600 mb-2 group-hover:scale-110 transition-transform duration-300">
                        24/7</div>
                    <div class="text-gray-600 font-medium">Layanan Pelanggan</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div id="features" class="py-16 bg-gray-50">
        <div class="max-w-screen-xl mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Mengapa Memilih BMT Store?</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Kami berkomitmen memberikan pengalaman belanja online
                    terbaik dengan layanan berkualitas tinggi</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div
                    class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 text-center group hover:-translate-y-2">
                    <div
                        class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-green-200 transition-colors">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-4 text-gray-800">Produk Berkualitas Premium</h3>
                    <p class="text-gray-600 leading-relaxed">Setiap produk dipilih dengan teliti untuk memastikan kualitas
                        terbaik dan kepuasan pelanggan maksimal</p>
                </div>

                <div
                    class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 text-center group hover:-translate-y-2">
                    <div
                        class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-green-200 transition-colors">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-4 text-gray-800">Harga Terjangkau</h3>
                    <p class="text-gray-600 leading-relaxed">Dapatkan produk berkualitas dengan harga yang kompetitif dan
                        berbagai promo menarik setiap harinya</p>
                </div>

                <div
                    class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 text-center group hover:-translate-y-2">
                    <div
                        class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-green-200 transition-colors">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-4 text-gray-800">Pengiriman Express</h3>
                    <p class="text-gray-600 leading-relaxed">Nikmati pengiriman super cepat ke seluruh Indonesia dengan
                        kemasan aman dan tracking real-time</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Popular Categories -->
    <div class="py-16 bg-white">
        <div class="max-w-screen-xl mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Kategori Populer</h2>
                <p class="text-lg text-gray-600">Jelajahi berbagai kategori produk pilihan terbaik kami</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="group cursor-pointer">
                    <div
                        class="bg-gradient-to-br from-green-100 to-green-200 rounded-2xl p-6 text-center hover:from-green-200 hover:to-green-300 transition-all duration-300 group-hover:scale-105">
                        <div class="text-4xl mb-3">📱</div>
                        <h3 class="font-semibold text-gray-800">Elektronik</h3>
                    </div>
                </div>
                <div class="group cursor-pointer">
                    <div
                        class="bg-gradient-to-br from-green-100 to-green-200 rounded-2xl p-6 text-center hover:from-green-200 hover:to-green-300 transition-all duration-300 group-hover:scale-105">
                        <div class="text-4xl mb-3">👕</div>
                        <h3 class="font-semibold text-gray-800">Fashion</h3>
                    </div>
                </div>
                <div class="group cursor-pointer">
                    <div
                        class="bg-gradient-to-br from-green-100 to-green-200 rounded-2xl p-6 text-center hover:from-green-200 hover:to-green-300 transition-all duration-300 group-hover:scale-105">
                        <div class="text-4xl mb-3">🏠</div>
                        <h3 class="font-semibold text-gray-800">Rumah Tangga</h3>
                    </div>
                </div>
                <div class="group cursor-pointer">
                    <div
                        class="bg-gradient-to-br from-green-100 to-green-200 rounded-2xl p-6 text-center hover:from-green-200 hover:to-green-300 transition-all duration-300 group-hover:scale-105">
                        <div class="text-4xl mb-3">💄</div>
                        <h3 class="font-semibold text-gray-800">Kecantikan</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimonials -->
    <div class="py-16 bg-green-50">
        <div class="max-w-screen-xl mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Apa Kata Pelanggan Kami?</h2>
                <p class="text-lg text-gray-600">Kepuasan pelanggan adalah prioritas utama kami</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-2xl shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4">
                            <span class="text-green-600 font-bold">A</span>
                        </div>
                        <div>
                            <h4 class="font-semibold">Ahmad Rizki</h4>
                            <div class="text-yellow-500 text-sm">★★★★★</div>
                        </div>
                    </div>
                    <p class="text-gray-600 italic">"Pelayanan sangat memuaskan! Barang sampai dengan cepat dan sesuai
                        dengan deskripsi. Pasti akan belanja lagi di sini."</p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4">
                            <span class="text-green-600 font-bold">S</span>
                        </div>
                        <div>
                            <h4 class="font-semibold">Siti Nurhaliza</h4>
                            <div class="text-yellow-500 text-sm">★★★★★</div>
                        </div>
                    </div>
                    <p class="text-gray-600 italic">"Website yang mudah digunakan dan produknya lengkap. Harga juga sangat
                        kompetitif. Recommended banget!"</p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4">
                            <span class="text-green-600 font-bold">B</span>
                        </div>
                        <div>
                            <h4 class="font-semibold">Budi Santoso</h4>
                            <div class="text-yellow-500 text-sm">★★★★★</div>
                        </div>
                    </div>
                    <p class="text-gray-600 italic">"Kualitas produk sangat bagus dan customer service nya responsif.
                        Pengalaman belanja yang menyenangkan!"</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="py-16 bg-gradient-to-r from-green-600 to-green-700">
        <div class="max-w-screen-xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-4 text-green-600">Siap Memulai Belanja Sekarang?</h2>
            <p class="text-xl text-black mb-8 max-w-2xl mx-auto">
                Bergabunglah dengan ribuan pelanggan yang telah merasakan kemudahan dan kepuasan berbelanja di BMT Store
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('products.index') }}"
                    class="bg-white text-green-600 px-8 py-4 rounded-xl font-semibold text-lg hover:bg-gray-100 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                    <i class="fas fa-shopping-cart mr-2"></i>
                    Lihat Semua Produk
                </a>
                <a href="#"
                    class="bg-transparent border-2 border-green-600 text-black px-8 py-4 rounded-xl font-semibold text-lg hover:bg-white hover:text-green-600 transition-all duration-300">
                    <i class="fas fa-phone mr-2"></i>
                    Hubungi Kami
                </a>
            </div>
        </div>
    </div>
@endsection
