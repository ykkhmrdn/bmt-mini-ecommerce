@extends('layouts.app')

@section('title', 'Daftar - BMT Mini E-Commerce')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
                <h2 class="mt-6 text-center text-3xl font-bold text-gray-900">
                    Buat Akun Baru
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    Atau
                    <a href="{{ route('login') }}" class="font-medium text-green-600 hover:text-green-500">
                        masuk ke akun yang sudah ada
                    </a>
                </p>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8">
                <form id="registerForm" class="space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">
                            Nama Lengkap
                        </label>
                        <div class="mt-1">
                            <input id="name" name="name" type="text" autocomplete="name" required
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                        </div>
                        <div id="name-error" class="hidden mt-1 text-sm text-red-600"></div>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">
                            Email
                        </label>
                        <div class="mt-1">
                            <input id="email" name="email" type="email" autocomplete="email" required
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                        </div>
                        <div id="email-error" class="hidden mt-1 text-sm text-red-600"></div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">
                            Password
                        </label>
                        <div class="mt-1">
                            <input id="password" name="password" type="password" autocomplete="new-password" required
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                        </div>
                        <div id="password-error" class="hidden mt-1 text-sm text-red-600"></div>
                        <p class="mt-1 text-sm text-gray-500">Minimal 8 karakter</p>
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                            Konfirmasi Password
                        </label>
                        <div class="mt-1">
                            <input id="password_confirmation" name="password_confirmation" type="password"
                                autocomplete="new-password" required
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                        </div>
                        <div id="password_confirmation-error" class="hidden mt-1 text-sm text-red-600"></div>
                    </div>

                    <div>
                        <button type="submit" id="submitBtn"
                            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 disabled:opacity-50 disabled:cursor-not-allowed">
                            <span id="submitText">Daftar</span>
                            <span id="loadingSpinner" class="hidden ml-2">
                                <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4"></circle>
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

    @push('scripts')
        <script>
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            document.getElementById('registerForm').addEventListener('submit', async function(e) {
                e.preventDefault();

                const submitBtn = document.getElementById('submitBtn');
                const submitText = document.getElementById('submitText');
                const loadingSpinner = document.getElementById('loadingSpinner');

                // Clear previous errors
                clearErrors();

                // Show loading state
                submitBtn.disabled = true;
                submitText.textContent = 'Memproses...';
                loadingSpinner.classList.remove('hidden');

                const formData = new FormData(this);
                const data = {
                    name: formData.get('name'),
                    email: formData.get('email'),
                    password: formData.get('password'),
                    password_confirmation: formData.get('password_confirmation')
                };

                try {
                    const response = await fetch('/api/auth/register', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify(data)
                    });

                    const result = await response.json();

                    if (result.success) {
                        // Store token in localStorage
                        localStorage.setItem('auth_token', result.token);
                        localStorage.setItem('user', JSON.stringify(result.user));

                        showToast(result.message, 'success');

                        // Update navigation
                        updateAuthNavigation(result.user);

                        // Redirect to home page
                        setTimeout(() => {
                            window.location.href = '/';
                        }, 1500);
                    } else {
                        // Handle validation errors
                        if (result.errors) {
                            showValidationErrors(result.errors);
                        } else {
                            showToast(result.message, 'error');
                        }
                    }
                } catch (error) {
                    console.error('Error:', error);
                    showToast('Terjadi kesalahan saat mendaftar', 'error');
                } finally {
                    // Reset button state
                    submitBtn.disabled = false;
                    submitText.textContent = 'Daftar';
                    loadingSpinner.classList.add('hidden');
                }
            });

            function clearErrors() {
                const errorElements = document.querySelectorAll('[id$="-error"]');
                errorElements.forEach(element => {
                    element.classList.add('hidden');
                    element.textContent = '';
                });

                const inputElements = document.querySelectorAll('input');
                inputElements.forEach(input => {
                    input.classList.remove('border-red-300', 'focus:border-red-500', 'focus:ring-red-500');
                    input.classList.add('border-gray-300', 'focus:border-green-500', 'focus:ring-green-500');
                });
            }

            function showValidationErrors(errors) {
                Object.keys(errors).forEach(field => {
                    const errorElement = document.getElementById(`${field}-error`);
                    const inputElement = document.getElementById(field);

                    if (errorElement && inputElement) {
                        errorElement.textContent = errors[field][0];
                        errorElement.classList.remove('hidden');

                        inputElement.classList.remove('border-gray-300', 'focus:border-green-500',
                            'focus:ring-green-500');
                        inputElement.classList.add('border-red-300', 'focus:border-red-500', 'focus:ring-red-500');
                    }
                });
            }

            function updateAuthNavigation(user) {
                // This will be implemented when we update the navigation
                updateCartCount();
            }
        </script>
    @endpush
@endsection
