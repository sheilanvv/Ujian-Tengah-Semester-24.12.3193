@extends('layouts.admin', ['title' => 'Kelola Event'])

@section('content')

<header class="flex justify-between items-center mb-10">

    <div>
        <h1 class="text-3xl font-black text-slate-800">
            Kelola Event
        </h1>

        <p class="text-slate-500 font-medium">
            Buat dan atur acara seru Anda di sini.
        </p>
    </div>

    <a href="{{ route('admin.events.create') }}"
        class="px-6 py-3 bg-indigo-600 text-white rounded-2xl font-bold shadow-lg hover:bg-indigo-700 transition">

        + Tambah Event Baru

    </a>

</header>

{{-- SUCCESS MESSAGE --}}
@if(session('success'))

<div class="mb-6 p-4 bg-green-100 text-green-700 rounded-2xl font-bold text-sm">
    {{ session('success') }}
</div>

@endif

{{-- FILTER --}}
<div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm mb-6">

    <form action="{{ route('admin.events.index') }}" method="GET">

        <div class="flex flex-wrap gap-4 items-center justify-between">

            {{-- SEARCH --}}
            <div class="flex-1 min-w-[300px] max-w-md flex gap-2">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari nama event..."
                    class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:outline-none focus:border-indigo-500 bg-slate-50 text-slate-900 font-medium text-sm transition">

                <button
                    type="submit"
                    class="px-6 py-3 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 transition text-sm shadow-sm">

                    Cari

                </button>

            </div>

            {{-- CATEGORY --}}
            <div>

                <select
                    name="category_id"
                    onchange="this.form.submit()"
                    class="px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold text-slate-700 focus:outline-none cursor-pointer hover:bg-slate-100 transition min-w-[180px]">

                    <option value="">Semua Kategori</option>

                    @foreach($categories as $cat)

                    <option
                        value="{{ $cat->id }}"
                        {{ request('category_id') == $cat->id ? 'selected' : '' }}>

                        {{ $cat->name }}

                    </option>

                    @endforeach

                </select>

            </div>

        </div>

    </form>

</div>

{{-- TABLE --}}
<div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">

    <table class="w-full text-left border-collapse">

        {{-- TABLE HEAD --}}
        <thead class="bg-slate-50 text-slate-400 uppercase text-[10px] font-black tracking-widest">

            <tr>

                <th class="px-8 py-4">No</th>
                <th class="px-8 py-4">Event</th>
                <th class="px-8 py-4">Harga / Stok</th>
                <th class="px-8 py-4">Aksi</th>

            </tr>

        </thead>

        {{-- TABLE BODY --}}
        <tbody class="divide-y border-t bg-white">

            @forelse($events as $index => $event)

            <tr class="hover:bg-slate-50/50 transition">

                {{-- NOMOR --}}
                <td class="px-8 py-6 font-bold text-slate-400">

                    {{ $index + 1 }}

                </td>

                {{-- EVENT --}}
                <td class="px-8 py-6">

                    <div class="flex items-center gap-4">

                        {{-- POSTER --}}
                        @if($event->poster_path)

                        <img
                            src="{{ asset('storage/' . $event->poster_path) }}"
                            alt="{{ $event->title }}"
                            class="w-28 h-20 object-cover rounded-2xl border border-slate-200 shadow-sm">

                        @else

                        <div class="w-28 h-20 bg-slate-200 rounded-2xl flex items-center justify-center text-slate-400 text-xs font-bold">

                            No Image

                        </div>

                        @endif

                        {{-- INFO --}}
                        <div>

                            <p class="font-black text-slate-800 text-base">

                                {{ $event->title }}

                            </p>

                            <p class="text-xs text-slate-400">

                                {{ $event->category->name ?? 'Uncategorized' }}

                            </p>

                            <p class="text-xs text-slate-400 mt-1">

                                {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}

                            </p>

                        </div>

                    </div>

                </td>

                {{-- HARGA --}}
                <td class="px-8 py-6">

                    <p class="font-bold text-indigo-600 whitespace-nowrap">

                        Rp {{ number_format($event->price, 0, ',', '.') }}

                    </p>

                    <p class="text-xs text-slate-400">

                        Stok: {{ $event->stock }}

                    </p>

                </td>

                {{-- AKSI --}}
                <td class="px-8 py-6">

                    <div class="flex gap-2">

                        {{-- EDIT --}}
                        <a href="{{ route('admin.events.edit', $event->id) }}"
                            class="px-4 py-2 bg-indigo-50 text-indigo-600 font-bold rounded-xl text-xs hover:bg-indigo-600 hover:text-white transition">

                            Edit

                        </a>

                        {{-- DELETE --}}
                        <form
                            action="{{ route('admin.events.destroy', $event->id) }}"
                            method="POST"
                            onsubmit="return confirm('Hapus event ini?')"
                            class="inline">

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="px-4 py-2 bg-rose-50 text-rose-600 font-bold rounded-xl text-xs hover:bg-rose-600 hover:text-white transition">

                                Hapus

                            </button>

                        </form>

                    </div>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="4" class="px-8 py-16 text-center text-slate-400 font-semibold">

                    Tidak ada data event.

                </td>

            </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection