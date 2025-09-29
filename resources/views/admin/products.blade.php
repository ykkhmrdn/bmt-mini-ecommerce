@extends('layouts.app')

@section('title', 'Kelola Produk - Admin BMT Mini E-Commerce')

@section('content')
    <div class="max-w-screen-xl mx-auto p-4">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Kelola Produk</h1>
                <nav class="text-sm text-gray-600">
                    <a href="{{ route('admin.index') }}" class="hover:text-green-600">Admin</a>
                    <span class="mx-2">/</span>
                    <span>Produk</span>
                </nav>
            </div>
            <button onclick="openAddProductModal()"
                class="bg-green-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-green-700 transition-colors flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                    </path>
                </svg>
                Tambah Produk
            </button>
        </div>

        <!-- Products Table -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-gray-800">Daftar Produk</h2>
                    <div class="flex items-center gap-4">
                        <input type="text" id="search-products" placeholder="Cari produk..."
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                        <button onclick="refreshProducts()" class="text-gray-600 hover:text-gray-800">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Produk</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stok
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody id="products-table-body" class="bg-white divide-y divide-gray-200">
                        <!-- Products will be loaded here -->
                    </tbody>
                </table>
            </div>

            <div id="products-loading" class="p-8 text-center text-gray-500">
                <svg class="animate-spin w-8 h-8 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                    </circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
                Memuat produk...
            </div>

            <div id="products-empty" class="p-8 text-center text-gray-500 hidden">
                <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"></path>
                </svg>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada produk</h3>
                <p class="text-gray-600 mb-4">Mulai dengan menambahkan produk pertama Anda</p>
                <button onclick="openAddProductModal()"
                    class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition-colors">
                    Tambah Produk
                </button>
            </div>
        </div>
    </div>

    <!-- Product Form Modal -->
    <div id="product-modal" class="fixed inset-0 z-50 hidden">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-50 transition-opacity" onclick="closeProductModal()"></div>
        <div class="fixed inset-0 flex items-center justify-center p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full max-h-screen overflow-y-auto">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 id="modal-title" class="text-lg font-semibold text-gray-900">Tambah Produk</h3>
                        <button onclick="closeProductModal()" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <form id="product-form" class="space-y-6">
                        <input type="hidden" id="product-id" name="id">

                        <div>
                            <label for="product-name" class="block text-sm font-medium text-gray-700">Nama Produk</label>
                            <input type="text" id="product-name" name="name" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                            <div id="name-error" class="hidden mt-1 text-sm text-red-600"></div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="product-price" class="block text-sm font-medium text-gray-700">Harga
                                    (Rp)</label>
                                <input type="number" id="product-price" name="price" required min="0"
                                    step="0.01"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                                <div id="price-error" class="hidden mt-1 text-sm text-red-600"></div>
                            </div>

                            <div>
                                <label for="product-stock" class="block text-sm font-medium text-gray-700">Stok</label>
                                <input type="number" id="product-stock" name="stock" required min="0"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                                <div id="stock-error" class="hidden mt-1 text-sm text-red-600"></div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Gambar Produk</label>

                            <!-- Image Upload Section -->
                            <div class="mt-1 space-y-4">
                                <!-- Current Image Preview -->
                                <div id="current-image-preview" class="hidden">
                                    <div class="flex items-center gap-4">
                                        <img id="current-image" src="" alt="Current product image"
                                            class="w-20 h-20 rounded-lg object-cover">
                                        <div>
                                            <p class="text-sm font-medium text-gray-700">Gambar saat ini</p>
                                            <button type="button" onclick="removeCurrentImage()"
                                                class="text-sm text-red-600 hover:text-red-700">
                                                Hapus gambar
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Upload new image -->
                                <div id="upload-section">
                                    <div class="flex items-center justify-center w-full">
                                        <label for="image-upload"
                                            class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 20 16">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                                </svg>
                                                <p class="mb-2 text-sm text-gray-500">
                                                    <span class="font-semibold">Klik untuk upload</span> atau drag and drop
                                                </p>
                                                <p class="text-xs text-gray-500">PNG, JPG, GIF hingga 2MB</p>
                                            </div>
                                            <input id="image-upload" type="file" class="hidden" accept="image/*"
                                                onchange="handleImageUpload(this)">
                                        </label>
                                    </div>
                                </div>

                                <!-- Upload progress -->
                                <div id="upload-progress" class="hidden">
                                    <div class="bg-gray-200 rounded-full h-2.5">
                                        <div id="upload-progress-bar"
                                            class="bg-green-600 h-2.5 rounded-full transition-all duration-300"
                                            style="width: 0%"></div>
                                    </div>
                                    <p class="text-sm text-gray-600 mt-1">Mengupload gambar...</p>
                                </div>

                                <!-- Alternative: URL input -->
                                <div class="border-t pt-4">
                                    <label for="product-image-url" class="block text-sm font-medium text-gray-700">Atau
                                        masukkan URL gambar</label>
                                    <input type="url" id="product-image-url" name="image"
                                        placeholder="https://example.com/image.jpg"
                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                                    <div id="image-error" class="hidden mt-1 text-sm text-red-600"></div>
                                    <p class="mt-1 text-sm text-gray-500">URL gambar akan digunakan jika tidak ada file
                                        yang diupload</p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="product-description"
                                class="block text-sm font-medium text-gray-700">Deskripsi</label>
                            <textarea id="product-description" name="description" rows="4" placeholder="Deskripsi produk..."
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500"></textarea>
                            <div id="description-error" class="hidden mt-1 text-sm text-red-600"></div>
                        </div>

                        <div class="flex gap-3 justify-end pt-6">
                            <button type="button" onclick="closeProductModal()"
                                class="px-4 py-2 text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                                Batal
                            </button>
                            <button type="submit" id="submit-btn"
                                class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                                <span id="submit-text">Simpan</span>
                                <span id="submit-loading" class="hidden ml-2">
                                    <svg class="animate-spin h-4 w-4 text-white inline" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                            stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                        </path>
                                    </svg>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Check authentication
            const token = localStorage.getItem('auth_token');
            if (!token) {
                showToast('Akses ditolak. Silakan login terlebih dahulu.', 'error');
                setTimeout(() => {
                    window.location.href = '/login';
                }, 2000);
            }

            let products = [];
            let isEditing = false;
            let editingProductId = null;
            let uploadedImageUrl = null;
            let currentImageFilename = null;

            // Load products
            async function loadProducts() {
                const loadingElement = document.getElementById('products-loading');
                const emptyElement = document.getElementById('products-empty');
                const tableBody = document.getElementById('products-table-body');

                loadingElement.classList.remove('hidden');
                emptyElement.classList.add('hidden');

                try {
                    const response = await fetch('/api/admin/products', {
                        headers: {
                            'Authorization': `Bearer ${token}`,
                            'Accept': 'application/json'
                        }
                    });

                    if (!response.ok) {
                        throw new Error('Failed to load products');
                    }

                    const data = await response.json();

                    if (data.success) {
                        products = data.products;
                        renderProducts(products);
                    } else {
                        throw new Error(data.message || 'Failed to load products');
                    }
                } catch (error) {
                    console.error('Error loading products:', error);
                    showToast('Gagal memuat produk', 'error');
                    emptyElement.classList.remove('hidden');
                } finally {
                    loadingElement.classList.add('hidden');
                }
            }

            function renderProducts(productsToRender) {
                const tableBody = document.getElementById('products-table-body');
                const emptyElement = document.getElementById('products-empty');

                if (productsToRender.length === 0) {
                    tableBody.innerHTML = '';
                    emptyElement.classList.remove('hidden');
                    return;
                }

                emptyElement.classList.add('hidden');

                tableBody.innerHTML = productsToRender.map(product => `
        <tr>
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                        ${product.image ?
                            `<img src="${product.image}" alt="${product.name}" class="w-full h-full object-cover">` :
                            `<div class="w-full h-full flex items-center justify-center text-gray-400">
                                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                                </svg>
                                                            </div>`
                        }
                    </div>
                    <div class="ml-4">
                        <div class="text-sm font-medium text-gray-900">${product.name}</div>
                        <div class="text-sm text-gray-500">${product.description ? product.description.substring(0, 50) + (product.description.length > 50 ? '...' : '') : 'Tidak ada deskripsi'}</div>
                    </div>
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm font-medium text-gray-900">Rp ${new Intl.NumberFormat('id-ID').format(product.price)}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full ${
                    product.stock > 10 ? 'bg-green-100 text-green-800' :
                    product.stock > 0 ? 'bg-yellow-100 text-yellow-800' :
                    'bg-red-100 text-red-800'
                }">
                    ${product.stock} unit
                </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                ${new Date(product.created_at).toLocaleDateString('id-ID')}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                <button onclick="editProduct(${product.id})" class="text-green-600 hover:text-green-900 mr-3">
                    Edit
                </button>
                <button onclick="deleteProduct(${product.id})" class="text-red-600 hover:text-red-900">
                    Hapus
                </button>
            </td>
        </tr>
    `).join('');
            }

            // Modal functions
            function openAddProductModal() {
                isEditing = false;
                editingProductId = null;
                document.getElementById('modal-title').textContent = 'Tambah Produk';
                document.getElementById('submit-text').textContent = 'Simpan';
                document.getElementById('product-form').reset();
                clearErrors();
                document.getElementById('product-modal').classList.remove('hidden');
            }

            function editProduct(productId) {
                const product = products.find(p => p.id === productId);
                if (!product) return;

                isEditing = true;
                editingProductId = productId;
                document.getElementById('modal-title').textContent = 'Edit Produk';
                document.getElementById('submit-text').textContent = 'Perbarui';

                // Fill form with product data
                document.getElementById('product-id').value = product.id;
                document.getElementById('product-name').value = product.name;
                document.getElementById('product-price').value = product.price;
                document.getElementById('product-stock').value = product.stock;
                document.getElementById('product-image-url').value = product.image || '';
                document.getElementById('product-description').value = product.description || '';

                // Show existing image if available
                if (product.image) {
                    showUploadedImage(product.image);
                    uploadedImageUrl = product.image;
                    // Don't set currentImageFilename for existing images (they might be URLs)
                }

                clearErrors();
                document.getElementById('product-modal').classList.remove('hidden');
            }

            function closeProductModal() {
                document.getElementById('product-modal').classList.add('hidden');
                document.getElementById('product-form').reset();
                clearErrors();
                isEditing = false;
                editingProductId = null;
                uploadedImageUrl = null;
                currentImageFilename = null;
                resetImageUploadSection();
            }

            // Form submission
            document.getElementById('product-form').addEventListener('submit', async function(e) {
                e.preventDefault();

                const submitBtn = document.getElementById('submit-btn');
                const submitText = document.getElementById('submit-text');
                const submitLoading = document.getElementById('submit-loading');

                clearErrors();

                // Show loading state
                submitBtn.disabled = true;
                submitText.classList.add('hidden');
                submitLoading.classList.remove('hidden');

                const formData = new FormData(this);
                const data = {
                    name: formData.get('name'),
                    price: parseFloat(formData.get('price')),
                    stock: parseInt(formData.get('stock')),
                    description: formData.get('description'),
                    image: uploadedImageUrl || formData.get('image') || null
                };

                try {
                    const url = isEditing ? `/api/admin/products/${editingProductId}` : '/api/admin/products';
                    const method = isEditing ? 'PUT' : 'POST';

                    const response = await fetch(url, {
                        method: method,
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'Authorization': `Bearer ${token}`,
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        },
                        body: JSON.stringify(data)
                    });

                    const result = await response.json();

                    if (result.success) {
                        showToast(result.message, 'success');
                        closeProductModal();
                        loadProducts();
                    } else {
                        if (result.errors) {
                            showValidationErrors(result.errors);
                        } else {
                            showToast(result.message || 'Terjadi kesalahan', 'error');
                        }
                    }
                } catch (error) {
                    console.error('Error:', error);
                    showToast('Terjadi kesalahan saat menyimpan produk', 'error');
                } finally {
                    submitBtn.disabled = false;
                    submitText.classList.remove('hidden');
                    submitLoading.classList.add('hidden');
                }
            });

            // Delete product
            async function deleteProduct(productId) {
                const product = products.find(p => p.id === productId);
                if (!product) return;

                showModal(
                    'Konfirmasi Hapus',
                    `Apakah Anda yakin ingin menghapus produk "${product.name}"? Tindakan ini tidak dapat dibatalkan.`,
                    'Ya, Hapus',
                    'Batal',
                    async function() {
                        try {
                            const response = await fetch(`/api/admin/products/${productId}`, {
                                method: 'DELETE',
                                headers: {
                                    'Accept': 'application/json',
                                    'Authorization': `Bearer ${token}`,
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                        .getAttribute('content')
                                }
                            });

                            const result = await response.json();

                            if (result.success) {
                                showToast(result.message, 'success');
                                loadProducts();
                            } else {
                                showToast(result.message || 'Gagal menghapus produk', 'error');
                            }
                        } catch (error) {
                            console.error('Error:', error);
                            showToast('Terjadi kesalahan saat menghapus produk', 'error');
                        }
                    }
                );
            }

            // Search products
            document.getElementById('search-products').addEventListener('input', function(e) {
                const searchTerm = e.target.value.toLowerCase();
                const filteredProducts = products.filter(product =>
                    product.name.toLowerCase().includes(searchTerm) ||
                    (product.description && product.description.toLowerCase().includes(searchTerm))
                );
                renderProducts(filteredProducts);
            });

            // Refresh products
            function refreshProducts() {
                loadProducts();
            }

            // Utility functions
            function clearErrors() {
                const errorElements = document.querySelectorAll('[id$="-error"]');
                errorElements.forEach(element => {
                    element.classList.add('hidden');
                    element.textContent = '';
                });

                const inputElements = document.querySelectorAll('#product-form input, #product-form textarea');
                inputElements.forEach(input => {
                    input.classList.remove('border-red-300', 'focus:border-red-500', 'focus:ring-red-500');
                    input.classList.add('border-gray-300', 'focus:border-green-500', 'focus:ring-green-500');
                });
            }

            function showValidationErrors(errors) {
                Object.keys(errors).forEach(field => {
                    const errorElement = document.getElementById(`${field}-error`);
                    const inputElement = document.getElementById(`product-${field}`);

                    if (errorElement && inputElement) {
                        errorElement.textContent = errors[field][0];
                        errorElement.classList.remove('hidden');

                        inputElement.classList.remove('border-gray-300', 'focus:border-green-500',
                            'focus:ring-green-500');
                        inputElement.classList.add('border-red-300', 'focus:border-red-500', 'focus:ring-red-500');
                    }
                });
            }

            // Image upload functions
            async function handleImageUpload(input) {
                const file = input.files[0];
                if (!file) return;

                // Validate file size (2MB)
                if (file.size > 2 * 1024 * 1024) {
                    showToast('Ukuran file terlalu besar. Maksimal 2MB.', 'error');
                    input.value = '';
                    return;
                }

                // Validate file type
                const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp'];
                if (!allowedTypes.includes(file.type)) {
                    showToast('Format file tidak didukung. Gunakan JPEG, PNG, JPG, GIF, atau WebP.', 'error');
                    input.value = '';
                    return;
                }

                // Show upload progress
                showUploadProgress();

                try {
                    const formData = new FormData();
                    formData.append('image', file);

                    const response = await fetch('/api/upload/product-image', {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'Authorization': `Bearer ${token}`,
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        },
                        body: formData
                    });

                    const result = await response.json();

                    if (result.success) {
                        uploadedImageUrl = result.data.full_url;
                        currentImageFilename = result.data.filename;
                        showUploadedImage(result.data.full_url);
                        showToast('Gambar berhasil diupload', 'success');
                    } else {
                        throw new Error(result.message || 'Upload failed');
                    }
                } catch (error) {
                    console.error('Upload error:', error);
                    showToast('Gagal mengupload gambar', 'error');
                    input.value = '';
                } finally {
                    hideUploadProgress();
                }
            }

            function showUploadProgress() {
                document.getElementById('upload-section').classList.add('hidden');
                document.getElementById('upload-progress').classList.remove('hidden');

                // Simulate progress
                let progress = 0;
                const progressBar = document.getElementById('upload-progress-bar');
                const interval = setInterval(() => {
                    progress += 10;
                    progressBar.style.width = `${progress}%`;
                    if (progress >= 90) {
                        clearInterval(interval);
                    }
                }, 100);
            }

            function hideUploadProgress() {
                setTimeout(() => {
                    document.getElementById('upload-progress').classList.add('hidden');
                    document.getElementById('upload-progress-bar').style.width = '0%';
                }, 500);
            }

            function showUploadedImage(imageUrl) {
                const currentImagePreview = document.getElementById('current-image-preview');
                const currentImage = document.getElementById('current-image');

                currentImage.src = imageUrl;
                currentImagePreview.classList.remove('hidden');

                // Clear URL input since we're using uploaded image
                document.getElementById('product-image-url').value = '';
            }

            function removeCurrentImage() {
                if (currentImageFilename) {
                    // Delete uploaded file
                    fetch('/api/upload/product-image', {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'Authorization': `Bearer ${token}`,
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                filename: currentImageFilename
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                showToast('Gambar berhasil dihapus', 'success');
                            }
                        })
                        .catch(error => {
                            console.error('Delete error:', error);
                        });
                }

                uploadedImageUrl = null;
                currentImageFilename = null;
                document.getElementById('current-image-preview').classList.add('hidden');
                document.getElementById('upload-section').classList.remove('hidden');
                document.getElementById('image-upload').value = '';
            }

            function resetImageUploadSection() {
                document.getElementById('current-image-preview').classList.add('hidden');
                document.getElementById('upload-section').classList.remove('hidden');
                document.getElementById('upload-progress').classList.add('hidden');
                document.getElementById('image-upload').value = '';
                document.getElementById('product-image-url').value = '';
            }

            // Initialize
            document.addEventListener('DOMContentLoaded', function() {
                loadProducts();
            });
        </script>
    @endpush
@endsection
