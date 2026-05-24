@extends('layouts.admin', ['title' => 'Edit Kategori'])

@section('content')
<header class="mb-10">
    <h1 class="text-3xl font-black text-slate-800">Edit Kategori</h1>
    <p class="text-slate-500 font-medium">
        Memperbarui kategori <span class="text-indigo-600">"{{ $category->name }}"</span>
    </p>
</header>

<div class="bg-white rounded-[2.5rem] border border-slate-100 p-10 shadow-sm max-w-2xl">
    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

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
            <label class="block text-sm font-bold text-slate-700 mb-2">Nama Kategori</label>
            <input
                type="text"
                name="name"
                value="{{ old('name', $category->name) }}"
                class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none transition"
                required
            >
        </div>

        <div class="grid grid-cols-2 gap-4 py-4 px-5 bg-slate-50 rounded-xl text-sm text-slate-500">
            <div>
                <span class="font-bold block text-slate-400 text-xs uppercase tracking-wider mb-1">Dibuat</span>
                {{ $category->created_at->format('d M Y, H:i') }}
            </div>
            <div>
                <span class="font-bold block text-slate-400 text-xs uppercase tracking-wider mb-1">Terakhir Diperbarui</span>
                {{ $category->updated_at->format('d M Y, H:i') }}
            </div>
        </div>

        <div class="flex justify-end gap-4 pt-4 border-t border-slate-100">
            <a href="{{ route('admin.categories.index') }}"
                class="px-6 py-3 font-bold text-slate-400 hover:text-slate-600 transition">
                Batal
            </a>
            <button type="submit"
                class="px-8 py-3 bg-indigo-600 text-white rounded-2xl font-bold shadow-lg shadow-indigo-100 hover:bg-indigo-700 transition">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection