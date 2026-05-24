@extends('layouts.admin', ['title' => 'Edit Partner'])

@section('content')
<header class="mb-10">
    <h1 class="text-3xl font-black text-slate-800">Edit Partner</h1>
    <p class="text-slate-500 font-medium">
        Memperbarui data partner <span class="text-indigo-600">"{{ $partner->name }}"</span>
    </p>
</header>

<div class="bg-white rounded-[2.5rem] border border-slate-100 p-10 shadow-sm max-w-2xl">
    <form action="{{ route('admin.partners.update', $partner->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
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
            <label class="block text-sm font-bold text-slate-700 mb-2">Nama Partner</label>
            <input
                type="text"
                name="name"
                value="{{ old('name', $partner->name) }}"
                class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none transition"
                required
            >
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Logo Partner</label>
            <div class="flex items-start gap-6 p-4 border border-dashed border-slate-200 rounded-2xl bg-slate-50/50">
                <div class="shrink-0 text-center">
                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Logo Saat Ini</p>
                    <img
                        src="{{ asset('storage/' . $partner->logo_url) }}"
                        alt="{{ $partner->name }}"
                        class="w-24 h-24 rounded-xl object-contain bg-white shadow-md border-2 border-white p-1"
                    >
                </div>
                <div class="flex-1">
                    <p class="text-xs text-slate-500 mb-3 leading-relaxed">
                        Pilih file baru jika ingin mengganti logo. Kosongkan jika tidak ingin mengubah gambar.
                    </p>
                    <input
                        type="file"
                        name="logo"
                        accept="image/*"
                        class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"
                    >
                </div>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 py-4 px-5 bg-slate-50 rounded-xl text-sm text-slate-500">
            <div>
                <span class="font-bold block text-slate-400 text-xs uppercase tracking-wider mb-1">Dibuat</span>
                {{ $partner->created_at->format('d M Y, H:i') }}
            </div>
            <div>
                <span class="font-bold block text-slate-400 text-xs uppercase tracking-wider mb-1">Terakhir Diperbarui</span>
                {{ $partner->updated_at->format('d M Y, H:i') }}
            </div>
        </div>

        <div class="flex justify-end gap-4 pt-4 border-t border-slate-100">
            <a href="{{ route('admin.partners.index') }}"
                class="px-6 py-3 font-bold text-slate-400 hover:text-slate-600 transition">
                Batal
            </a>
            <button type="submit"
                class="px-10 py-3 bg-indigo-600 text-white rounded-2xl font-bold shadow-lg shadow-indigo-100 hover:bg-indigo-700 transition">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection