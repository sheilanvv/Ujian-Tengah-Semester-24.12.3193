@extends('layouts.admin', ['title' => 'Tambah Event'])

@section('content')

<header class="mb-10">
    <h1 class="text-3xl font-black text-slate-800">
        Tambah Event
    </h1>

    <p class="text-slate-500 font-medium">
        Tambahkan event baru ke platform.
    </p>
</header>

<div class="bg-white rounded-[2.5rem] border border-slate-100 p-10 shadow-sm max-w-3xl">

    <form 
        action="{{ route('admin.events.store') }}"
        method="POST"
        enctype="multipart/form-data"
        class="space-y-6"
    >
        @csrf

        {{-- Nama Event --}}
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">
                Nama Event
            </label>

            <input
                type="text"
                name="title"
                placeholder="Masukkan nama event"
                class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none"
                required
            >
        </div>

        {{-- Kategori --}}
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">
                Kategori
            </label>

            <select
                name="category_id"
                class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none"
                required
            >
                <option value="">
                    Pilih Kategori
                </option>

                @foreach($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Lokasi --}}
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">
                Lokasi
            </label>

            <input
                type="text"
                name="location"
                placeholder="Contoh: Auditorium"
                class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none"
                required
            >
        </div>

        {{-- Tanggal --}}
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">
                Tanggal Event
            </label>

            <input
                type="datetime-local"
                name="date"
                class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none"
                required
            >
        </div>

        {{-- Harga --}}
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">
                Harga Tiket
            </label>

            <input
                type="number"
                name="price"
                placeholder="50000"
                class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none"
                required
            >
        </div>

        {{-- Stok --}}
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">
                Stok Tiket
            </label>

            <input
                type="number"
                name="stock"
                placeholder="100"
                class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none"
                required
            >
        </div>

        {{-- Deskripsi --}}
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">
                Deskripsi
            </label>

            <textarea
                name="description"
                rows="5"
                placeholder="Deskripsi event..."
                class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none"
                required
            ></textarea>
        </div>

        {{-- Poster--}}
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">
                Poster Event
            </label>

            <input
                type="file"
                name="poster"
                accept="image/*"
                class="w-full text-sm text-slate-500
                file:mr-4
                file:py-2
                file:px-4
                file:rounded-full
                file:border-0
                file:text-sm
                file:font-semibold
                file:bg-indigo-50
                file:text-indigo-700
                hover:file:bg-indigo-100"
                required
            >
        </div>

        {{-- Submit --}}
        <div class="flex justify-end pt-4">
            <button
                type="submit"
                class="px-8 py-3 bg-indigo-600 text-white rounded-2xl font-bold hover:bg-indigo-700 transition"
            >
                Simpan Event
            </button>
        </div>

    </form>

</div>

@endsection