<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Laptop Gaming',
            'price' => 15000000,
            'stock' => 10,
            'description' => 'Laptop gaming dengan spesifikasi tinggi untuk kebutuhan gaming dan kerja',
            'image' => 'https://picsum.photos/400/400?random=1'
        ]);

        Product::create([
            'name' => 'Smartphone Android',
            'price' => 3500000,
            'stock' => 25,
            'description' => 'Smartphone Android dengan kamera berkualitas tinggi dan performa cepat',
            'image' => 'https://picsum.photos/400/400?random=2'
        ]);

        Product::create([
            'name' => 'Headset Wireless',
            'price' => 750000,
            'stock' => 15,
            'description' => 'Headset wireless dengan noise cancelling dan battery tahan lama',
            'image' => 'https://picsum.photos/400/400?random=3'
        ]);

        Product::create([
            'name' => 'Mouse Gaming',
            'price' => 450000,
            'stock' => 30,
            'description' => 'Mouse gaming dengan sensor presisi tinggi dan RGB lighting',
            'image' => 'https://picsum.photos/400/400?random=4'
        ]);

        Product::create([
            'name' => 'Keyboard Mechanical',
            'price' => 850000,
            'stock' => 20,
            'description' => 'Keyboard mechanical dengan switch blue dan backlight RGB',
            'image' => 'https://picsum.photos/400/400?random=5'
        ]);
    }
}