@extends('layouts.app')

@section('title', 'Keranjang Belanja - BMT Mini E-Commerce')

@section('content')
<div class="max-w-screen-xl mx-auto p-4">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Keranjang Belanja</h1>
        <p class="text-gray-600">Kelola produk yang akan Anda beli</p>
    </div>

    @if($cartItems->count() > 0)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Cart Items -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="p-6">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Produk dalam Keranjang</h2>

                        <div class="space-y-4">
                            @foreach($cartItems as $item)
                                <div class="flex items-center gap-4 p-4 border border-gray-100 rounded-lg" data-cart-id="{{ $item->id }}">
                                    <!-- Product Image -->
                                    <div class="w-20 h-20 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                                        @if($item->product->image)
                                            <img src="{{ filter_var($item->product->image, FILTER_VALIDATE_URL) ? $item->product->image : asset('storage/products/' . $item->product->image) }}"
                                                 alt="{{ $item->product->name }}"
                                                 class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Product Info -->
                                    <div class="flex-1">
                                        <h3 class="font-semibold text-gray-800 mb-1">{{ $item->product->name }}</h3>
                                        <p class="text-gray-600 text-sm mb-2">{{ $item->product->formatted_price }}</p>
                                        <div class="flex items-center gap-2">
                                            <span class="text-sm text-gray-500">Qty:</span>
                                            <span class="font-medium">{{ $item->quantity }}</span>
                                        </div>
                                    </div>

                                    <!-- Subtotal & Actions -->
                                    <div class="text-right">
                                        <p class="font-semibold text-gray-800 mb-2">{{ $item->formatted_subtotal }}</p>
                                        <button onclick="removeFromCart({{ $item->id }})"
                                                class="text-red-600 hover:text-red-700 text-sm font-medium">
                                            Hapus
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="p-6">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Ringkasan Pesanan</h2>

                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Subtotal</span>
                                <span class="font-medium" id="cart-subtotal">Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Ongkos Kirim</span>
                                <span class="font-medium">Gratis</span>
                            </div>
                            <hr>
                            <div class="flex justify-between text-lg font-semibold">
                                <span>Total</span>
                                <span class="text-blue-600" id="cart-total">Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <button onclick="checkout()"
                                class="w-full bg-blue-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700 transition-colors">
                            Checkout
                        </button>

                        <a href="{{ route('products.index') }}"
                           class="block w-full text-center mt-3 text-gray-600 hover:text-gray-800 transition-colors">
                            Lanjut Belanja
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Empty Cart -->
        <div class="text-center py-16">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8">
                <svg class="w-24 h-24 mx-auto text-gray-400 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5-1.5M7 13l-1.5 1.5m0 0L8 16h8m-8-3v3m8-3v3m-8 0h8"></path>
                </svg>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Keranjang Kosong</h2>
                <p class="text-gray-600 mb-6">Belum ada produk dalam keranjang belanja Anda</p>
                <a href="{{ route('products.index') }}"
                   class="inline-block bg-blue-600 text-white px-8 py-3 rounded-lg font-medium hover:bg-blue-700 transition-colors">
                    Mulai Berbelanja
                </a>
            </div>
        </div>
    @endif
</div>

@push('scripts')
<script>
// Get CSRF token from meta tag
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

function removeFromCart(cartId) {
    if (!confirm('Apakah Anda yakin ingin menghapus produk ini dari keranjang?')) {
        return;
    }

    fetch(`/api/cart/${cartId}`, {
        method: 'DELETE',
        headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Remove the cart item from UI
            const cartItem = document.querySelector(`[data-cart-id="${cartId}"]`);
            if (cartItem) {
                cartItem.remove();
            }

            // Update cart count in navigation
            updateCartCount();

            // Reload page if cart is empty
            location.reload();
        } else {
            showToast(data.message || 'Gagal menghapus produk dari keranjang', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('Terjadi kesalahan saat menghapus produk dari keranjang', 'error');
    });
}

function checkout() {
    showModal(
        'Konfirmasi Checkout',
        'Apakah Anda yakin ingin melanjutkan checkout? Pesanan akan langsung diproses.',
        'Ya, Checkout',
        'Batal',
        function() {
            processCheckout();
        }
    );
}

function processCheckout() {
    fetch('/api/checkout', {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast(data.message, 'success');
            // Update cart count in navigation
            updateCartCount();
            // Redirect to success page or reload
            setTimeout(() => {
                window.location.href = '/';
            }, 2000);
        } else {
            showToast(data.message || 'Gagal melakukan checkout', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('Terjadi kesalahan saat melakukan checkout', 'error');
    });
}
</script>
@endpush
@endsection