# Panduan Instalasi BMT Mini E-Commerce

## Quick Setup Guide

### 1. Persiapan Environment
```bash
# Clone project
git clone <repository-url>
cd bmt-mini-ecommerce

# Install dependencies
composer install
```

### 2. Database Setup
```bash
# Buat database MySQL
mysql -u root -p
CREATE DATABASE bmt_mini_ecommerce;
exit

# Copy environment file
cp .env.example .env
php artisan key:generate
```

### 3. Konfigurasi .env
Edit file `.env` dengan konfigurasi berikut:
```env
APP_NAME="BMT Mini E-Commerce"
APP_ENV=local
APP_KEY=base64:xxx # akan di-generate otomatis
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bmt_mini_ecommerce
DB_USERNAME=root
DB_PASSWORD=zyxkoo
```

### 4. Database Migration & Seeding
```bash
# Run migrations dan seeders
php artisan migrate:fresh --seed

# Create storage link untuk file uploads
php artisan storage:link
```

### 5. Jalankan Aplikasi
```bash
php artisan serve
```

Aplikasi akan berjalan di: `http://localhost:8000`

## Login Credentials

### Default Test User
- **Email**: test@example.com
- **Password**: password

### Admin Access
- Setelah login, klik menu "Admin" di navigation bar
- Atau akses langsung ke: `http://localhost:8000/admin`

## Fitur yang Tersedia

### Frontend (Customer)
- ✅ Browse products dengan pagination
- ✅ Search dan filter products
- ✅ Add to cart (session-based untuk guest)
- ✅ Checkout dengan konfirmasi
- ✅ Register dan login user

### Backend (Admin)
- ✅ Dashboard dengan statistik
- ✅ CRUD products (Create, Read, Update, Delete)
- ✅ Upload gambar produk
- ✅ Search dan manage products

## API Testing

### Test Product API
```bash
curl -X GET "http://localhost:8000/api/products?page=1&per_page=5" \
  -H "Accept: application/json"
```

### Test Authentication API
```bash
# Register
curl -X POST http://localhost:8000/api/auth/register \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "name": "Test User",
    "email": "newuser@example.com",
    "password": "password123",
    "password_confirmation": "password123"
  }'

# Login
curl -X POST http://localhost:8000/api/auth/login \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "email": "test@example.com",
    "password": "password"
  }'
```

## Troubleshooting

### Database Connection Issues
- Pastikan MySQL service berjalan
- Periksa kredensial database di `.env`
- Pastikan database `bmt_mini_ecommerce` sudah dibuat

### Permission Issues
```bash
# Fix storage permissions
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

### Clear Cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
```

### Reset Database
```bash
# Reset database dengan data fresh
php artisan migrate:fresh --seed
```

## Development Notes

- Project menggunakan Laravel 12 dengan PHP 8.2+
- Frontend styling dengan Tailwind CSS + Flowbite
- Authentication menggunakan Laravel Sanctum
- File uploads disimpan di `storage/app/public/products`
- Session-based cart untuk guest users
- CSRF protection dengan API exclusion

## Sample Data

Database seeder menyediakan:
- 24 sample tech products
- 1 test user account
- Berbagai kategori produk (laptop, smartphone, peripherals, dll)

---

*Jika ada pertanyaan atau kendala, silakan hubungi developer.*