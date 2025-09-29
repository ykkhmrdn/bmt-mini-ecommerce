@extends('layouts.app')

@section('title', 'Admin Dashboard - BMT Mini E-Commerce')

@section('content')
<div class="max-w-screen-xl mx-auto p-4">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Admin Dashboard</h1>
        <p class="text-gray-600">Kelola toko online Anda</p>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-blue-100 rounded-md flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Total Produk</p>
                    <p class="text-2xl font-semibold text-gray-900" id="total-products">-</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-green-100 rounded-md flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Total Transaksi</p>
                    <p class="text-2xl font-semibold text-gray-900" id="total-transactions">-</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-yellow-100 rounded-md flex items-center justify-center">
                        <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Total Pendapatan</p>
                    <p class="text-2xl font-semibold text-gray-900" id="total-revenue">-</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-purple-100 rounded-md flex items-center justify-center">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Item di Keranjang</p>
                    <p class="text-2xl font-semibold text-gray-900" id="total-cart-items">-</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Aksi Cepat</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <a href="{{ route('admin.products') }}" class="bg-blue-50 border border-blue-200 rounded-lg p-4 text-center hover:bg-blue-100 transition-colors">
                <div class="w-8 h-8 bg-blue-600 rounded-md flex items-center justify-center mx-auto mb-2">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"></path>
                    </svg>
                </div>
                <h3 class="font-medium text-gray-900">Kelola Produk</h3>
                <p class="text-sm text-gray-600">Tambah, edit, atau hapus produk</p>
            </a>

            <button onclick="openAddProductModal()" class="bg-green-50 border border-green-200 rounded-lg p-4 text-center hover:bg-green-100 transition-colors">
                <div class="w-8 h-8 bg-green-600 rounded-md flex items-center justify-center mx-auto mb-2">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </div>
                <h3 class="font-medium text-gray-900">Tambah Produk</h3>
                <p class="text-sm text-gray-600">Tambah produk baru</p>
            </button>

            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 text-center">
                <div class="w-8 h-8 bg-gray-400 rounded-md flex items-center justify-center mx-auto mb-2">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v4"></path>
                    </svg>
                </div>
                <h3 class="font-medium text-gray-400">Laporan</h3>
                <p class="text-sm text-gray-400">Coming soon</p>
            </div>

            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 text-center">
                <div class="w-8 h-8 bg-gray-400 rounded-md flex items-center justify-center mx-auto mb-2">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <h3 class="font-medium text-gray-400">Pengaturan</h3>
                <p class="text-sm text-gray-400">Coming soon</p>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Check if user is authenticated and authorized
const token = localStorage.getItem('auth_token');
if (!token) {
    showToast('Akses ditolak. Silakan login terlebih dahulu.', 'error');
    setTimeout(() => {
        window.location.href = '/login';
    }, 2000);
}

// Load dashboard statistics
async function loadDashboardStats() {
    try {
        // Load statistics (you can expand this with actual API calls)
        document.getElementById('total-products').textContent = '0';
        document.getElementById('total-transactions').textContent = '0';
        document.getElementById('total-revenue').textContent = 'Rp 0';
        document.getElementById('total-cart-items').textContent = '0';

        // Load actual product count
        const response = await fetch('/api/admin/products', {
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json'
            }
        });

        if (response.ok) {
            const data = await response.json();
            if (data.success) {
                document.getElementById('total-products').textContent = data.products.length;
            }
        }
    } catch (error) {
        console.error('Error loading dashboard stats:', error);
    }
}

function openAddProductModal() {
    window.location.href = '/admin/products';
}

// Initialize dashboard
document.addEventListener('DOMContentLoaded', function() {
    loadDashboardStats();
});
</script>
@endpush
@endsection