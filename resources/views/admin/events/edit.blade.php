@extends('layouts.admin', ['title' => 'Edit Event'])

@section('content')

<div class="max-w-3xl">

    <h1 class="text-3xl font-black text-slate-800 mb-6">
        Edit Event
    </h1>
    
    <form 
        action="{{ route('admin.events.update', $event->id) }}"
        method="POST"
        enctype="multipart/form-data"
        class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm space-y-5"
    >
        @csrf
        @method('PUT')

        {{-- Nama Event --}}
        <div>
            <label class="font-bold block mb-2">
                Nama Event
            </label>

            <input
                type="text"
                name="title"
                value="{{ old('title', $event->title) }}"
                required
                class="w-full border border-slate-200 p-3 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none"
            >
        </div>

        {{-- Kategori --}}
        <div>
            <label class="font-bold block mb-2">
                Kategori
            </label>

            <select
                name="category_id"
                class="w-full border border-slate-200 p-3 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none"
                required
            >
                @foreach($categories as $category)
                    <option 
                        value="{{ $category->id }}"
                        {{ $event->category_id == $category->id ? 'selected' : '' }}
                    >
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Lokasi --}}
        <div>
            <label class="font-bold block mb-2">
                Lokasi
            </label>

            <input
                type="text"
                name="location"
                value="{{ old('location', $event->location) }}"
                required
                class="w-full border border-slate-200 p-3 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none"
            >
        </div>

        {{-- Tanggal --}}
        <div>
            <label class="font-bold block mb-2">
                Tanggal Event
            </label>

            <input
                type="datetime-local"
                name="date"
                value="{{ \Carbon\Carbon::parse($event->date)->format('Y-m-d\TH:i') }}"
                required
                class="w-full border border-slate-200 p-3 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none"
            >
        </div>

        {{-- Harga --}}
        <div>
            <label class="font-bold block mb-2">
                Harga Tiket
            </label>

            <input
                type="number"
                name="price"
                value="{{ old('price', $event->price) }}"
                required
                class="w-full border border-slate-200 p-3 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none"
            >
        </div>

        {{-- Stok --}}
        <div>
            <label class="font-bold block mb-2">
                Stok Tiket
            </label>

            <input
                type="number"
                name="stock"
                value="{{ old('stock', $event->stock) }}"
                required
                class="w-full border border-slate-200 p-3 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none"
            >
        </div>

        {{-- Deskripsi --}}
        <div>
            <label class="font-bold block mb-2">
                Deskripsi
            </label>

            <textarea
                name="description"
                rows="5"
                required
                class="w-full border border-slate-200 p-3 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none"
            >{{ old('description', $event->description) }}</textarea>
        </div>

        {{-- Upload Poster --}}
        <div>
            <label class="font-bold block mb-2">
                Poster Event
            </label>

            <input
                type="file"
                name="poster"
                accept="image/*"
                class="w-full border border-slate-200 p-3 rounded-xl bg-white"
            >

            {{-- Preview Poster --}}
            @if($event->poster_path)
                <div class="mt-4">
                    <p class="text-sm text-slate-500 mb-2">
                        Poster Saat Ini
                    </p>

                    <img
                        src="{{ asset('storage/' . $event->poster_path) }}"
                        alt="Poster Event"
                        class="w-48 rounded-2xl border shadow-sm"
                    >
                </div>
            @endif
        </div>

        {{-- Submit --}}
        <div class="pt-4">
            <button
                type="submit"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-2xl font-bold transition"
            >
                Simpan Perubahan
            </button>
        </div>

    </form>

</div>

@endsection