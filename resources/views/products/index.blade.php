@extends('layouts.app')

@section('title', 'Produk - BMT Mini E-Commerce')

@section('content')
<div class="max-w-screen-xl mx-auto p-4">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Semua Produk</h1>
        <p class="text-gray-600">Temukan produk berkualitas dengan harga terjangkau</p>
    </div>

    <!-- Filters and Search -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Search -->
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Cari Produk</label>
                <input type="text" id="search" placeholder="Nama produk..."
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Sort By -->
            <div>
                <label for="sort-by" class="block text-sm font-medium text-gray-700 mb-2">Urutkan</label>
                <select id="sort-by" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="created_at">Terbaru</option>
                    <option value="name">Nama A-Z</option>
                    <option value="price">Harga Terendah</option>
                    <option value="stock">Stok Terbanyak</option>
                </select>
            </div>

            <!-- Sort Order -->
            <div>
                <label for="sort-order" class="block text-sm font-medium text-gray-700 mb-2">Urutan</label>
                <select id="sort-order" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="desc">Menurun</option>
                    <option value="asc">Menaik</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Loading State -->
    <div id="products-loading" class="text-center py-12">
        <svg class="animate-spin w-8 h-8 mx-auto mb-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        <p class="text-gray-600">Memuat produk...</p>
    </div>

    <!-- Products Grid -->
    <div id="products-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 hidden">
        <!-- Products will be loaded here -->
    </div>

    <!-- Empty State -->
    <div id="products-empty" class="text-center py-12 hidden">
        <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
        </svg>
        <h3 class="text-lg font-medium text-gray-800 mb-2">Tidak Ada Produk</h3>
        <p class="text-gray-600">Belum ada produk yang tersedia saat ini.</p>
    </div>

    <!-- Pagination -->
    <div id="pagination-container" class="mt-8 flex justify-center hidden">
        <nav class="flex items-center space-x-2">
            <!-- Pagination will be loaded here -->
        </nav>
    </div>

    <!-- Products Info -->
    <div id="products-info" class="mt-6 text-center text-gray-600 text-sm hidden">
        <!-- Product count info will be displayed here -->
    </div>
</div>

@push('scripts')
<script>
// Get CSRF token from meta tag
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

let currentPage = 1;
let currentSearch = '';
let currentSortBy = 'created_at';
let currentSortOrder = 'desc';
let isLoading = false;

// Load products with pagination
async function loadProducts(page = 1, search = '', sortBy = 'created_at', sortOrder = 'desc') {
    if (isLoading) return;

    isLoading = true;
    showLoading();

    try {
        const params = new URLSearchParams({
            page: page,
            per_page: 12,
            search: search,
            sort_by: sortBy,
            sort_order: sortOrder
        });

        const response = await fetch(`/api/products?${params}`);
        const data = await response.json();

        if (data.success) {
            renderProducts(data.data);
            renderPagination(data.pagination);
            renderProductsInfo(data.pagination);

            currentPage = page;
            currentSearch = search;
            currentSortBy = sortBy;
            currentSortOrder = sortOrder;
        } else {
            throw new Error(data.message || 'Failed to load products');
        }
    } catch (error) {
        console.error('Error loading products:', error);
        showToast('Gagal memuat produk', 'error');
        showEmpty();
    } finally {
        isLoading = false;
        hideLoading();
    }
}

function showLoading() {
    document.getElementById('products-loading').classList.remove('hidden');
    document.getElementById('products-grid').classList.add('hidden');
    document.getElementById('products-empty').classList.add('hidden');
    document.getElementById('pagination-container').classList.add('hidden');
    document.getElementById('products-info').classList.add('hidden');
}

function hideLoading() {
    document.getElementById('products-loading').classList.add('hidden');
}

function showEmpty() {
    document.getElementById('products-grid').classList.add('hidden');
    document.getElementById('products-empty').classList.remove('hidden');
    document.getElementById('pagination-container').classList.add('hidden');
    document.getElementById('products-info').classList.add('hidden');
}

function renderProducts(products) {
    const grid = document.getElementById('products-grid');

    if (products.length === 0) {
        showEmpty();
        return;
    }

    grid.innerHTML = products.map(product => `
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow">
            <!-- Product Image -->
            <div class="aspect-square bg-gray-100 flex items-center justify-center">
                ${product.image ?
                    `<img src="${product.image}" alt="${product.name}" class="w-full h-full object-cover">` :
                    `<div class="text-gray-400 text-center">
                        <svg class="w-16 h-16 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span class="text-sm">Tidak ada gambar</span>
                    </div>`
                }
            </div>

            <!-- Product Info -->
            <div class="p-4">
                <h3 class="font-semibold text-gray-800 mb-2 line-clamp-2">${product.name}</h3>
                <p class="text-gray-600 text-sm mb-3 line-clamp-2">${product.description || ''}</p>

                <div class="flex items-center justify-between mb-3">
                    <span class="text-2xl font-bold text-blue-600">Rp ${new Intl.NumberFormat('id-ID').format(product.price)}</span>
                    <span class="text-sm text-gray-500">Stok: ${product.stock}</span>
                </div>

                <div class="flex gap-2">
                    <a href="/products/${product.id}" class="flex-1 bg-gray-100 text-gray-700 px-4 py-2 rounded-lg text-center text-sm font-medium hover:bg-gray-200 transition-colors">
                        Detail
                    </a>

                    ${product.stock > 0 ?
                        `<button onclick="addToCart(${product.id})" class="flex-1 bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
                            + Keranjang
                        </button>` :
                        `<button disabled class="flex-1 bg-gray-300 text-gray-500 px-4 py-2 rounded-lg text-sm font-medium cursor-not-allowed">
                            Stok Habis
                        </button>`
                    }
                </div>
            </div>
        </div>
    `).join('');

    grid.classList.remove('hidden');
}

function renderPagination(pagination) {
    const container = document.getElementById('pagination-container');
    const nav = container.querySelector('nav');

    if (pagination.last_page <= 1) {
        container.classList.add('hidden');
        return;
    }

    const buttons = [];

    // Previous button
    if (pagination.current_page > 1) {
        buttons.push(`
            <button onclick="loadProducts(${pagination.current_page - 1}, currentSearch, currentSortBy, currentSortOrder)"
                    class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-l-md hover:bg-gray-50">
                Sebelumnya
            </button>
        `);
    }

    // Page numbers
    const startPage = Math.max(1, pagination.current_page - 2);
    const endPage = Math.min(pagination.last_page, pagination.current_page + 2);

    if (startPage > 1) {
        buttons.push(`
            <button onclick="loadProducts(1, currentSearch, currentSortBy, currentSortOrder)"
                    class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border-t border-b border-gray-300 hover:bg-gray-50">
                1
            </button>
        `);

        if (startPage > 2) {
            buttons.push('<span class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border-t border-b border-gray-300">...</span>');
        }
    }

    for (let i = startPage; i <= endPage; i++) {
        const isActive = i === pagination.current_page;
        buttons.push(`
            <button onclick="loadProducts(${i}, currentSearch, currentSortBy, currentSortOrder)"
                    class="px-3 py-2 text-sm font-medium ${isActive ? 'text-blue-600 bg-blue-50 border-blue-500' : 'text-gray-500 bg-white hover:bg-gray-50'} border-t border-b border-gray-300">
                ${i}
            </button>
        `);
    }

    if (endPage < pagination.last_page) {
        if (endPage < pagination.last_page - 1) {
            buttons.push('<span class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border-t border-b border-gray-300">...</span>');
        }

        buttons.push(`
            <button onclick="loadProducts(${pagination.last_page}, currentSearch, currentSortBy, currentSortOrder)"
                    class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border-t border-b border-gray-300 hover:bg-gray-50">
                ${pagination.last_page}
            </button>
        `);
    }

    // Next button
    if (pagination.current_page < pagination.last_page) {
        buttons.push(`
            <button onclick="loadProducts(${pagination.current_page + 1}, currentSearch, currentSortBy, currentSortOrder)"
                    class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-md hover:bg-gray-50">
                Selanjutnya
            </button>
        `);
    }

    nav.innerHTML = buttons.join('');
    container.classList.remove('hidden');
}

function renderProductsInfo(pagination) {
    const info = document.getElementById('products-info');
    info.innerHTML = `Menampilkan ${pagination.from || 0} - ${pagination.to || 0} dari ${pagination.total} produk`;
    info.classList.remove('hidden');
}

function addToCart(productId) {
    fetch('/api/cart/add', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({
            product_id: productId,
            quantity: 1
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast(data.message, 'success');
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

// Event listeners
document.getElementById('search').addEventListener('input', function(e) {
    const searchValue = e.target.value;

    clearTimeout(window.searchTimeout);
    window.searchTimeout = setTimeout(() => {
        loadProducts(1, searchValue, currentSortBy, currentSortOrder);
    }, 500);
});

document.getElementById('sort-by').addEventListener('change', function(e) {
    loadProducts(1, currentSearch, e.target.value, currentSortOrder);
});

document.getElementById('sort-order').addEventListener('change', function(e) {
    loadProducts(1, currentSearch, currentSortBy, e.target.value);
});

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    loadProducts();
});
</script>
@endpush
@endsection