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
        $products = [
            [
                'name' => 'Laptop Gaming ASUS ROG',
                'price' => 15000000,
                'stock' => 10,
                'description' => 'Laptop gaming dengan spesifikasi tinggi, processor Intel i7, RAM 16GB, GPU RTX 4060 untuk kebutuhan gaming dan kerja profesional',
                'image' => 'https://picsum.photos/400/400?random=1'
            ],
            [
                'name' => 'Smartphone Samsung Galaxy',
                'price' => 3500000,
                'stock' => 25,
                'description' => 'Smartphone Android dengan kamera 108MP, layar AMOLED 6.5 inci, dan performa cepat dengan chipset Snapdragon',
                'image' => 'https://picsum.photos/400/400?random=2'
            ],
            [
                'name' => 'Headset Sony WH-1000XM5',
                'price' => 750000,
                'stock' => 15,
                'description' => 'Headset wireless dengan Active Noise Cancelling terbaik di kelasnya dan battery life hingga 30 jam',
                'image' => 'https://picsum.photos/400/400?random=3'
            ],
            [
                'name' => 'Mouse Logitech G Pro X',
                'price' => 450000,
                'stock' => 30,
                'description' => 'Mouse gaming dengan sensor HERO 25K, berat hanya 63 gram, dan RGB lighting yang dapat dikustomisasi',
                'image' => 'https://picsum.photos/400/400?random=4'
            ],
            [
                'name' => 'Keyboard Keychron K2',
                'price' => 850000,
                'stock' => 20,
                'description' => 'Keyboard mechanical dengan switch Gateron Blue, wireless/wired dual mode, dan hot-swappable switches',
                'image' => 'https://picsum.photos/400/400?random=5'
            ],
            [
                'name' => 'Monitor LG UltraWide 34"',
                'price' => 6500000,
                'stock' => 8,
                'description' => 'Monitor curved 34 inci dengan resolusi 3440x1440, refresh rate 144Hz, ideal untuk gaming dan productivity',
                'image' => 'https://picsum.photos/400/400?random=6'
            ],
            [
                'name' => 'iPhone 15 Pro Max',
                'price' => 18500000,
                'stock' => 12,
                'description' => 'iPhone terbaru dengan chip A17 Pro, kamera 48MP dengan zoom 5x, dan layar Super Retina XDR 6.7 inci',
                'image' => 'https://picsum.photos/400/400?random=7'
            ],
            [
                'name' => 'Webcam Logitech C920',
                'price' => 1250000,
                'stock' => 18,
                'description' => 'Webcam Full HD 1080p dengan autofocus dan stereo microphone untuk streaming dan video conference',
                'image' => 'https://picsum.photos/400/400?random=8'
            ],
            [
                'name' => 'SSD Samsung 970 EVO 1TB',
                'price' => 1800000,
                'stock' => 22,
                'description' => 'SSD NVMe M.2 dengan kecepatan baca hingga 3500 MB/s dan teknologi V-NAND 3-bit MLC',
                'image' => 'https://picsum.photos/400/400?random=9'
            ],
            [
                'name' => 'Speaker JBL Charge 5',
                'price' => 2200000,
                'stock' => 16,
                'description' => 'Speaker portable waterproof dengan JBL Pro Sound, battery 20 jam, dan dapat digunakan sebagai power bank',
                'image' => 'https://picsum.photos/400/400?random=10'
            ],
            [
                'name' => 'Tablet iPad Air 5th Gen',
                'price' => 9500000,
                'stock' => 14,
                'description' => 'iPad Air dengan chip M1, layar Liquid Retina 10.9 inci, dan kompatibel dengan Apple Pencil generasi ke-2',
                'image' => 'https://picsum.photos/400/400?random=11'
            ],
            [
                'name' => 'Router WiFi 6 ASUS AX6000',
                'price' => 3200000,
                'stock' => 6,
                'description' => 'Router WiFi 6 dengan kecepatan hingga 6000 Mbps, 8 antena, dan teknologi AiMesh untuk coverage optimal',
                'image' => 'https://picsum.photos/400/400?random=12'
            ],
            [
                'name' => 'Power Bank Anker 20000mAh',
                'price' => 650000,
                'stock' => 35,
                'description' => 'Power bank dengan kapasitas 20000mAh, fast charging 22.5W, dan dapat mengisi 3 device sekaligus',
                'image' => 'https://picsum.photos/400/400?random=13'
            ],
            [
                'name' => 'Smartwatch Apple Watch Series 9',
                'price' => 6800000,
                'stock' => 11,
                'description' => 'Apple Watch dengan chip S9, layar Always-On Retina, GPS, dan berbagai fitur kesehatan advanced',
                'image' => 'https://picsum.photos/400/400?random=14'
            ],
            [
                'name' => 'Earbuds Sony WF-1000XM4',
                'price' => 3800000,
                'stock' => 19,
                'description' => 'True wireless earbuds dengan industry-leading noise canceling dan Hi-Res Audio Wireless',
                'image' => 'https://picsum.photos/400/400?random=15'
            ],
            [
                'name' => 'Gaming Chair SecretLab Titan',
                'price' => 7500000,
                'stock' => 5,
                'description' => 'Gaming chair premium dengan cold-cure foam, adjustable lumbar support, dan material PU leather',
                'image' => 'https://picsum.photos/400/400?random=16'
            ],
            [
                'name' => 'Microphone Blue Yeti',
                'price' => 2800000,
                'stock' => 13,
                'description' => 'USB microphone dengan 4 polar patterns, real-time headphone monitoring, dan plug & play setup',
                'image' => 'https://picsum.photos/400/400?random=17'
            ],
            [
                'name' => 'Graphics Card RTX 4070',
                'price' => 11500000,
                'stock' => 7,
                'description' => 'GPU NVIDIA RTX 4070 dengan arsitektur Ada Lovelace, DLSS 3, dan ray tracing generation terbaru',
                'image' => 'https://picsum.photos/400/400?random=18'
            ],
            [
                'name' => 'CPU Intel Core i7-13700K',
                'price' => 6200000,
                'stock' => 9,
                'description' => 'Processor Intel generasi ke-13 dengan 16 core, 24 thread, dan boost clock hingga 5.4 GHz',
                'image' => 'https://picsum.photos/400/400?random=19'
            ],
            [
                'name' => 'RAM Corsair Vengeance 32GB',
                'price' => 3400000,
                'stock' => 17,
                'description' => 'DDR5 RAM kit 32GB (2x16GB) dengan kecepatan 5600MHz dan heat spreader aluminum',
                'image' => 'https://picsum.photos/400/400?random=20'
            ],
            [
                'name' => 'Motherboard ASUS ROG Maximus',
                'price' => 8500000,
                'stock' => 4,
                'description' => 'Motherboard Z790 chipset dengan WiFi 6E, Thunderbolt 4, dan dukungan DDR5 & PCIe 5.0',
                'image' => 'https://picsum.photos/400/400?random=21'
            ],
            [
                'name' => 'Case Fractal Design Define',
                'price' => 2100000,
                'stock' => 21,
                'description' => 'PC case mid-tower dengan sound dampening panels dan excellent airflow design',
                'image' => 'https://picsum.photos/400/400?random=22'
            ],
            [
                'name' => 'PSU Seasonic Focus GX 850W',
                'price' => 2650000,
                'stock' => 15,
                'description' => 'Power supply 850W 80+ Gold certified dengan full modular cables dan 10 tahun warranty',
                'image' => 'https://picsum.photos/400/400?random=23'
            ],
            [
                'name' => 'Cooling AIO Corsair iCUE H150i',
                'price' => 3600000,
                'stock' => 8,
                'description' => 'All-in-one liquid cooler 360mm dengan RGB pump head dan magnetic levitation fans',
                'image' => 'https://picsum.photos/400/400?random=24'
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}