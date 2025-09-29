@extends('layouts.app')

@section('title', 'Produk - BMT Mini E-Commerce')

@section('content')
<div class="max-w-screen-xl mx-auto p-4">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Semua Produk</h1>
        <p class="text-gray-600">Temukan produk berkualitas dengan harga terjangkau</p>
    </div>

    <!-- Products Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($products as $product)
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow">
                <!-- Product Image -->
                <div class="aspect-square bg-gray-100 flex items-center justify-center">
                    @if($product->image)
                        <img src="{{ asset('storage/products/' . $product->image) }}"
                             alt="{{ $product->name }}"
                             class="w-full h-full object-cover">
                    @else
                        <div class="text-gray-400 text-center">
                            <svg class="w-16 h-16 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span class="text-sm">Tidak ada gambar</span>
                        </div>
                    @endif
                </div>

                <!-- Product Info -->
                <div class="p-4">
                    <h3 class="font-semibold text-gray-800 mb-2 line-clamp-2">{{ $product->name }}</h3>

                    <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ $product->description }}</p>

                    <div class="flex items-center justify-between mb-3">
                        <span class="text-2xl font-bold text-blue-600">{{ $product->formatted_price }}</span>
                        <span class="text-sm text-gray-500">Stok: {{ $product->stock }}</span>
                    </div>

                    <div class="flex gap-2">
                        <a href="{{ route('products.show', $product->id) }}"
                           class="flex-1 bg-gray-100 text-gray-700 px-4 py-2 rounded-lg text-center text-sm font-medium hover:bg-gray-200 transition-colors">
                            Detail
                        </a>

                        @if($product->stock > 0)
                            <button onclick="addToCart({{ $product->id }})"
                                    class="flex-1 bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
                                + Keranjang
                            </button>
                        @else
                            <button disabled
                                    class="flex-1 bg-gray-300 text-gray-500 px-4 py-2 rounded-lg text-sm font-medium cursor-not-allowed">
                                Stok Habis
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                </svg>
                <h3 class="text-lg font-medium text-gray-800 mb-2">Tidak Ada Produk</h3>
                <p class="text-gray-600">Belum ada produk yang tersedia saat ini.</p>
            </div>
        @endforelse
    </div>
</div>

@push('scripts')
<script>
function addToCart(productId) {
    // Basic cart functionality - akan dikembangkan nanti
    alert('Fitur keranjang akan segera tersedia!');
}
</script>
@endpush
@endsection