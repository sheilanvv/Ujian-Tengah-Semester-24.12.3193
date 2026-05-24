<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AmikomEventHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-50 text-slate-800">

    {{-- NAVBAR --}}
    <nav class="bg-white border-b border-slate-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <span class="text-xl font-black text-indigo-600">AmikomEventHub</span>
            <div class="flex gap-6 text-sm font-semibold text-slate-500">
                <a href="/" class="hover:text-indigo-600 transition">Beranda</a>
                <a href="#events" class="hover:text-indigo-600 transition">Event</a>
                <a href="#partners" class="hover:text-indigo-600 transition">Partner</a>
            </div>
        </div>
    </nav>

    {{-- HERO --}}
    <section class="bg-gradient-to-br from-indigo-600 to-indigo-800 text-white py-20 px-6">
        <div class="max-w-7xl mx-auto text-center">
            <h1 class="text-5xl font-black mb-4 leading-tight">
                Temukan Event Seru<br>di Amikom Yogyakarta
            </h1>
            <p class="text-indigo-200 text-lg max-w-xl mx-auto">
                Seminar, workshop, hiburan, dan bisnis — semua ada di sini.
            </p>
        </div>
    </section>

    {{-- KATEGORI --}}
    <section class="max-w-7xl mx-auto px-6 py-12">
        <div class="mb-6">
            <h2 class="text-2xl font-black text-slate-800">Jelajahi Kategori</h2>
            <p class="text-slate-500">Temukan event berdasarkan kategori favoritmu.</p>
        </div>

        <div class="flex flex-wrap gap-3">
            <a href="/"
                class="px-5 py-2.5 rounded-xl font-bold text-sm shadow transition {{ !request('category') ? 'bg-indigo-600 text-white hover:bg-indigo-700' : 'bg-white border border-slate-200 text-slate-700 hover:border-indigo-400 hover:text-indigo-600' }}">
                Semua Event
            </a>

            @foreach($categories as $category)
            <a href="/?category={{ $category->id }}"
                class="px-5 py-2.5 rounded-xl font-semibold text-sm transition border shadow-sm {{ request('category') == $category->id ? 'bg-indigo-600 text-white border-indigo-600 font-bold' : 'bg-white border-slate-200 text-slate-700 hover:border-indigo-400 hover:text-indigo-600' }}">
                {{ $category->name }}
                @if($category->events_count > 0)
                <span class="ml-1 text-xs {{ request('category') == $category->id ? 'text-indigo-200' : 'text-slate-400' }}">
                    ({{ $category->events_count }})
                </span>
                @endif
            </a>
            @endforeach
        </div>
    </section>

    {{-- EVENT GRID --}}
    <section id="events" class="max-w-7xl mx-auto px-6 pb-16">
        <div class="mb-8">
            <h2 class="text-2xl font-black text-slate-800">Event Terbaru</h2>
            <p class="text-slate-500">Jangan sampai ketinggalan acara pilihan.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($events as $event)
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden hover:shadow-md transition group flex flex-col justify-between">
                <div>
                    <div class="relative">
                        <img
                            src="{{ asset('storage/' . $event->poster_path) }}"
                            alt="{{ $event->title }}"
                            class="w-full h-48 object-cover group-hover:scale-105 transition duration-300">
                        <span class="absolute top-3 left-3 px-3 py-1 bg-indigo-600 text-white text-xs font-bold rounded-lg shadow-sm">
                            {{ $event->category->name ?? 'Uncategorized' }}
                        </span>
                    </div>
                    <div class="p-6 pb-0">
                        <p class="text-xs text-slate-400 mb-1">
                            {{ \Carbon\Carbon::parse($event->date)->format('d M Y, H:i') }}
                        </p>
                        <h3 class="font-black text-slate-800 text-lg mb-1 group-hover:text-indigo-600 transition">{{ $event->title }}</h3>
                        <p class="text-sm text-slate-500 mb-4">📍 {{ $event->location }}</p>
                    </div>
                </div>
                <div class="p-6 pt-0 mt-4">
                    <div class="flex justify-between items-center pt-4 border-t border-slate-50">
                        <span class="font-black text-indigo-600 text-lg">
                            {{ $event->price > 0 ? 'Rp ' . number_format($event->price, 0, ',', '.') : 'Gratis' }}
                        </span>
                        <a href="#" class="px-4 py-2 bg-indigo-600 text-white text-sm rounded-xl font-bold hover:bg-indigo-700 transition shadow-sm">
                            Beli Tiket
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-16 text-slate-400 font-medium">
                <div class="w-16 h-16 bg-slate-100 text-slate-300 rounded-2xl flex items-center justify-center mx-auto mb-3">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <p class="text-slate-700 font-bold">Belum Ada Event Tersedia</p>
                <p class="text-xs text-slate-400 mt-1">Tidak ditemukan event aktif pada kategori yang Anda pilih.</p>
            </div>
            @endforelse
        </div>
    </section>

    {{-- PARTNER --}}
    <section id="partners" class="bg-white border-t border-slate-100 py-16 px-6">
        <div class="max-w-7xl mx-auto">

            <div class="text-center mb-10">
                <h2 class="text-2xl font-black text-slate-800">
                    Partner Kami
                </h2>

                <p class="text-slate-500 mt-1">
                    Didukung oleh berbagai institusi dan perusahaan terpercaya.
                </p>
            </div>

            @if($partners->count() > 0)

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">

                @foreach($partners as $partner)

                <div class="flex flex-col items-center justify-center p-8 bg-indigo-50 rounded-3xl border border-indigo-100 hover:border-indigo-300 hover:bg-indigo-100 transition group min-h-[220px] shadow-sm">

                    <img
                        src="{{ asset('storage/' . $partner->logo_url) }}"
                        alt="{{ $partner->name }}"
                        class="h-24 w-auto object-contain">

                    <p class="mt-5 text-lg font-black text-indigo-700 text-center leading-snug">
                        {{ $partner->name }}
                    </p>

                </div>

                @endforeach

            </div>

            @else

            <p class="text-center text-slate-400">
                Belum ada partner yang terdaftar.
            </p>

            @endif

        </div>
    </section>

    {{-- FOOTER --}}
    <footer class="bg-indigo-900 text-indigo-200 text-center py-8 text-sm">
        <p class="font-bold text-white mb-1">
            AmikomEventHub
        </p>

        <p>
            Universitas Amikom Yogyakarta &copy; {{ date('Y') }}
        </p>
    </footer>