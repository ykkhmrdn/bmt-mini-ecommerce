<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'BMT Mini E-Commerce')</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Flowbite CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />

    <!-- Custom CSS -->
    <style>
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white border-gray-200 shadow-sm">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="{{ route('home') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
                <span class="self-center text-2xl font-semibold whitespace-nowrap text-green-600">BMT Store</span>
            </a>

            <div class="flex items-center space-x-6">
                <div class="hidden w-full md:block md:w-auto">
                    <ul
                        class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white">
                        <li>
                            <a href="{{ route('home') }}"
                                class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-green-700 md:p-0">Beranda</a>
                        </li>
                        <li>
                            <a href="{{ route('products.index') }}"
                                class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-green-700 md:p-0">Produk</a>
                        </li>
                        <li>
                            <a href="{{ route('cart.index') }}"
                                class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-green-700 md:p-0 relative">
                                Keranjang
                                <span id="cart-count"
                                    class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center hidden">0</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Auth Navigation -->
                <div id="auth-nav" class="flex items-center space-x-4">
                    <!-- Guest Navigation -->
                    <div id="guest-nav" class="flex items-center space-x-4">
                        <a href="{{ route('login') }}"
                            class="text-gray-700 hover:text-green-600 px-3 py-2 rounded-md text-sm font-medium">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}"
                            class="bg-green-600 text-white hover:bg-green-700 px-4 py-2 rounded-md text-sm font-medium">
                            Daftar
                        </a>
                    </div>

                    <!-- Authenticated Navigation -->
                    <div id="authenticated-nav" class="hidden flex items-center space-x-4">
                        <a href="{{ route('admin.index') }}"
                            class="text-gray-700 hover:text-green-600 px-3 py-2 rounded-md text-sm font-medium">
                            Admin
                        </a>
                        <span id="user-name" class="text-gray-700 text-sm font-medium"></span>
                        <button onclick="logout()"
                            class="text-gray-700 hover:text-red-600 px-3 py-2 rounded-md text-sm font-medium">
                            Logout
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-8">
        <div class="max-w-screen-xl mx-auto p-4">
            <div class="text-center text-gray-600">
                <p>&copy; {{ date('Y') }} BMT Mini E-Commerce. Made with ❤️ for case study.</p>
            </div>
        </div>
    </footer>

    <!-- Flowbite JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

    <!-- Toast Container -->
    <div id="toast-container" class="fixed top-4 right-4 z-50 space-y-2"></div>

    <!-- Modal Container -->
    <div id="modal-container" class="fixed inset-0 z-50 hidden">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-50 transition-opacity" onclick="closeModal()"></div>
        <div class="fixed inset-0 flex items-center justify-center p-4">
            <div id="modal-content" class="bg-white rounded-lg shadow-xl max-w-md w-full transform transition-all">
                <!-- Modal content will be dynamically inserted here -->
            </div>
        </div>
    </div>

    <!-- Custom JavaScript -->
    <script>
        // Update cart count in navigation
        function updateCartCount() {
            fetch('/api/cart/count')
                .then(response => response.json())
                .then(data => {
                    const cartCount = document.getElementById('cart-count');
                    if (data.count > 0) {
                        cartCount.textContent = data.count;
                        cartCount.classList.remove('hidden');
                    } else {
                        cartCount.classList.add('hidden');
                    }
                })
                .catch(error => console.error('Error updating cart count:', error));
        }

        // Toast notification function
        function showToast(message, type = 'success') {
            const toastContainer = document.getElementById('toast-container');
            const toastId = Date.now();

            const bgColor = type === 'success' ? 'bg-green-500' :
                type === 'error' ? 'bg-red-500' :
                type === 'warning' ? 'bg-yellow-500' : 'bg-green-500';

            const toast = document.createElement('div');
            toast.id = `toast-${toastId}`;
            toast.className =
                `${bgColor} text-white px-6 py-4 rounded-lg shadow-lg transform transition-all duration-300 ease-in-out max-w-sm`;
            toast.innerHTML = `
                <div class="flex items-center justify-between">
                    <span class="text-sm font-medium">${message}</span>
                    <button onclick="removeToast('${toastId}')" class="ml-4 text-white hover:text-gray-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            `;

            toastContainer.appendChild(toast);

            // Auto remove after 3 seconds
            setTimeout(() => {
                removeToast(toastId);
            }, 3000);
        }

        function removeToast(toastId) {
            const toast = document.getElementById(`toast-${toastId}`);
            if (toast) {
                toast.style.transform = 'translateX(100%)';
                toast.style.opacity = '0';
                setTimeout(() => {
                    toast.remove();
                }, 300);
            }
        }

        // Modal functions
        function showModal(title, message, confirmText = 'Ya', cancelText = 'Batal', onConfirm = null) {
            const modalContainer = document.getElementById('modal-container');
            const modalContent = document.getElementById('modal-content');

            modalContent.innerHTML = `
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">${title}</h3>
                        <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="mb-6">
                        <p class="text-gray-600">${message}</p>
                    </div>
                    <div class="flex gap-3 justify-end">
                        <button onclick="closeModal()" class="px-4 py-2 text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                            ${cancelText}
                        </button>
                        <button onclick="handleModalConfirm()" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                            ${confirmText}
                        </button>
                    </div>
                </div>
            `;

            modalContainer.classList.remove('hidden');
            window.modalConfirmCallback = onConfirm;
        }

        function closeModal() {
            const modalContainer = document.getElementById('modal-container');
            modalContainer.classList.add('hidden');
            window.modalConfirmCallback = null;
        }

        function handleModalConfirm() {
            if (window.modalConfirmCallback) {
                window.modalConfirmCallback();
            }
            closeModal();
        }

        // Authentication functions
        function checkAuthStatus() {
            const token = localStorage.getItem('auth_token');
            const user = localStorage.getItem('user');

            if (token && user) {
                const userData = JSON.parse(user);
                showAuthenticatedNav(userData);
            } else {
                showGuestNav();
            }
        }

        function showGuestNav() {
            document.getElementById('guest-nav').classList.remove('hidden');
            document.getElementById('authenticated-nav').classList.add('hidden');
        }

        function showAuthenticatedNav(user) {
            document.getElementById('guest-nav').classList.add('hidden');
            document.getElementById('authenticated-nav').classList.remove('hidden');
            document.getElementById('user-name').textContent = `Halo, ${user.name}`;
        }

        function logout() {
            const token = localStorage.getItem('auth_token');

            if (token) {
                fetch('/api/auth/logout', {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'Authorization': `Bearer ${token}`,
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            showToast(data.message, 'success');
                        }
                    })
                    .catch(error => {
                        console.error('Logout error:', error);
                    })
                    .finally(() => {
                        // Clear local storage regardless of API call result
                        localStorage.removeItem('auth_token');
                        localStorage.removeItem('user');
                        showGuestNav();
                        updateCartCount();

                        // Redirect to home if on protected page
                        if (window.location.pathname.includes('/admin')) {
                            window.location.href = '/';
                        }
                    });
            }
        }

        // Initialize cart count and auth status on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateCartCount();
            checkAuthStatus();
        });
    </script>

    @stack('scripts')
</body>

</html>
