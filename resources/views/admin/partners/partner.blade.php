@extends('layouts.admin', ['title' => 'Tambah Partner'])

@section('content')
<header class="mb-10">
    <h1 class="text-3xl font-black">Tambah Partner</h1>
    <p class="text-slate-500 font-medium">Daftarkan partner baru yang mendukung platform ini.</p>
</header>

<div class="bg-white rounded-[2.5rem] border border-slate-100 p-10 shadow-sm max-w-2xl">
    <form action="{{ route('admin.partners.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-xl">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Nama Partner</label>
            <input
                type="text"
                name="name"
                value="{{ old('name') }}"
                placeholder="Contoh: Google, Telkom, BNI..."
                class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none transition"
                required
            >
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Logo Partner</label>
            <input
                type="file"
                name="logo"
                accept="image/*"
                class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"
                required
            >
            <p class="mt-1.5 text-xs text-slate-400">Format: JPG, PNG, SVG, WebP. Maks. 2MB.</p>
        </div>

        <div class="flex justify-end gap-4 pt-4 border-t border-slate-100">
            <a href="{{ route('admin.partners.index') }}"
                class="px-6 py-3 font-bold text-slate-400 hover:text-slate-600 transition">
                Batal
            </a>
            <button type="submit"
                class="px-8 py-3 bg-indigo-600 text-white rounded-2xl font-bold shadow-lg shadow-indigo-100 hover:bg-indigo-700 transition">
                Simpan Partner
            </button>
        </div>
    </form>
</div>
@endsection