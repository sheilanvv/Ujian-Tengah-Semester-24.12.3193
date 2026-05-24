<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // User Admin
        \App\Models\User::create([
            'name' => 'Admin Amikom',
            'email' => 'admin@amikom.ac.id',
            'password' => bcrypt('password'),
        ]);

        // Kategori
        $kategori1 = \App\Models\Category::create([
            'name' => 'Seminar IT',
            'slug' => 'Seminar-it',
        ]);

        $kategori2 = \App\Models\Category::create([
            'name' => 'Entertainment',
            'slug' => 'entertainment',
        ]);

        $kategori3 = \App\Models\Category::create([
            'name' => 'Bisnis',
            'slug' => 'bisnis',
        ]);

        // Event (6 data)
        \App\Models\Event::create([
            'category_id' => $kategori1->id,
            'title' => 'AI & Cyber Security Summit',
            'description' => 'Pelajari perkembangan Artificial Intelligence dan keamanan siber bersama praktisi IT.',
            'date' => '2026-06-10 09:00:00',
            'location' => 'Ruang Cinema',
            'price' => 75000,
            'stock' => 150,
            'poster_path' => 'posters/event-1.png',
        ]);

        \App\Models\Event::create([
            'category_id' => $kategori1->id,
            'title' => 'Fullstack Web Developer Workshop',
            'description' => 'Workshop intensif membuat website modern menggunakan Laravel dan React.',
            'date' => '2026-06-12 10:00:00',
            'location' => 'Lab Ruang 7.5.3',
            'price' => 60000,
            'stock' => 120,
            'poster_path' => 'posters/event-2.png',
        ]);

        \App\Models\Event::create([
            'category_id' => $kategori2->id,
            'title' => 'Mobile Legends Championship',
            'description' => 'Kompetisi e-sport terbesar antar mahasiswa se-Yogyakarta.',
            'date' => '2026-06-15 13:00:00',
            'location' => 'Dekat Ruang ABP',
            'price' => 40000,
            'stock' => 300,
            'poster_path' => 'posters/event-3.png',
        ]);

        \App\Models\Event::create([
            'category_id' => $kategori2->id,
            'title' => 'Amikom Music Fest',
            'description' => 'Festival musik dengan penampilan band indie dan guest star nasional.',
            'date' => '2026-06-18 19:00:00',
            'location' => 'Lapangan Depan Gedung 7',
            'price' => 85000,
            'stock' => 500,
            'poster_path' => 'posters/event-4.png',
        ]);

        \App\Models\Event::create([
            'category_id' => $kategori3->id,
            'title' => 'Digital Business Conference',
            'description' => 'Belajar strategi bisnis digital dan branding di era modern.',
            'date' => '2026-06-20 09:00:00',
            'location' => 'Convention Hall',
            'price' => 70000,
            'stock' => 200,
            'poster_path' => 'posters/event-5.png',
        ]);

        \App\Models\Event::create([
            'category_id' => $kategori3->id,
            'title' => 'Startup Innovation Expo',
            'description' => 'Pameran startup kreatif dan sesi pitching bersama investor.',
            'date' => '2026-06-22 14:00:00',
            'location' => 'Ruang Cinema',
            'price' => 50000,
            'stock' => 180,
            'poster_path' => 'posters/event-6.png',
        ]);
    }
}
