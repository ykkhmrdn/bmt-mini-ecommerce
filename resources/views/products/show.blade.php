@extends('layouts.app')

@section('title', $product->name . ' - BMT Mini E-Commerce')

@section('content')
    <div class="max-w-screen-xl mx-auto p-4">
        <!-- Breadcrumb -->
        <nav class="flex mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-green-600">
                        Beranda
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-gray-400 mx-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <a href="{{ route('products.index') }}" class="text-gray-600 hover:text-green-600">
                            Produk
                        </a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-gray-400 mx-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-gray-500">{{ $product->name }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Product Detail -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Product Image -->
            <div class="aspect-square bg-gray-100 rounded-lg overflow-hidden">
                @if ($product->image)
                    <img src="{{ filter_var($product->image, FILTER_VALIDATE_URL) ? $product->image : asset('storage/products/' . $product->image) }}"
                        alt="{{ $product->name }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center text-gray-400">
                        <div class="text-center">
                            <svg class="w-24 h-24 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            <span class="text-lg">Tidak ada gambar</span>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Product Info -->
            <div class="space-y-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $product->name }}</h1>
                    <div class="flex items-center gap-4">
                        <span class="text-3xl font-bold text-green-600">{{ $product->formatted_price }}</span>
                        @if ($product->stock > 0)
                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                                Stok: {{ $product->stock }}
                            </span>
                        @else
                            <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-medium">
                                Stok Habis
                            </span>
                        @endif
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Deskripsi Produk</h3>
                    <p class="text-gray-600 leading-relaxed">{{ $product->description }}</p>
                </div>

                <!-- Add to Cart Section -->
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="space-y-4">
                        <div class="flex items-center gap-4">
                            <label for="quantity" class="text-sm font-medium text-gray-700">Jumlah:</label>
                            <div class="flex items-center border border-gray-300 rounded-lg">
                                <button type="button" onclick="decreaseQuantity()"
                                    class="px-3 py-2 text-gray-600 hover:text-gray-800">
                                    -
                                </button>
                                <input type="number" id="quantity" value="1" min="1"
                                    max="{{ $product->stock }}" class="w-16 text-center border-0 focus:ring-0" readonly>
                                <button type="button" onclick="increaseQuantity()"
                                    class="px-3 py-2 text-gray-600 hover:text-gray-800">
                                    +
                                </button>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            @if ($product->stock > 0)
                                <button onclick="addToCart({{ $product->id }})"
                                    class="flex-1 bg-green-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-green-700 transition-colors">
                                    Tambah ke Keranjang
                                </button>
                                <button onclick="buyNow({{ $product->id }})"
                                    class="flex-1 bg-gray-800 text-white px-6 py-3 rounded-lg font-medium hover:bg-gray-900 transition-colors">
                                    Beli Sekarang
                                </button>
                            @else
                                <button disabled
                                    class="w-full bg-gray-300 text-gray-500 px-6 py-3 rounded-lg font-medium cursor-not-allowed">
                                    Produk Tidak Tersedia
                                </button>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Product Info -->
                <div class="border-t pt-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Produk</h3>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-gray-600">ID Produk:</span>
                            <span class="font-medium">#{{ $product->id }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Status:</span>
                            <span class="font-medium">
                                {{ $product->stock > 0 ? 'Tersedia' : 'Stok Habis' }}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Ditambahkan:</span>
                            <span class="font-medium">{{ $product->created_at->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Back Button -->
        <div class="mt-8">
            <a href="{{ route('products.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Produk
            </a>
        </div>
    </div>

    @push('scripts')
        <script>
            // Get CSRF token from meta tag
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            function increaseQuantity() {
                const quantityInput = document.getElementById('quantity');
                const currentValue = parseInt(quantityInput.value);
                const maxValue = parseInt(quantityInput.getAttribute('max'));

                if (currentValue < maxValue) {
                    quantityInput.value = currentValue + 1;
                }
            }

            function decreaseQuantity() {
                const quantityInput = document.getElementById('quantity');
                const currentValue = parseInt(quantityInput.value);
                const minValue = parseInt(quantityInput.getAttribute('min'));

                if (currentValue > minValue) {
                    quantityInput.value = currentValue - 1;
                }
            }

            function addToCart(productId) {
                const quantity = parseInt(document.getElementById('quantity').value);

                fetch('/api/cart/add', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({
                            product_id: productId,
                            quantity: quantity
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            showToast(data.message, 'success');
                            // Update cart count in navigation
                            updateCartCount();
                        } else {
                            showToast(data.message || 'Gagal menambahkan produk ke keranjang', 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showToast('Terjadi kesalahan saat menambahkan produk ke keranjang', 'error');
                    });
            }

            function buyNow(productId) {
                const quantity = document.getElementById('quantity').value;
                // Buy now functionality akan dikembangkan nanti
                alert(`Beli sekarang ${quantity} produk. Fitur akan segera tersedia!`);
            }
        </script>
    @endpush
@endsection
