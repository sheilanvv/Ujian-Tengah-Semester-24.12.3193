<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    // 1. TAMPILKAN SEMUA PARTNER + FITUR SEARCH
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Cari partner berdasarkan nama 
        $partners = Partner::when($search, function ($query) use ($search) {
            $query->where('name', 'LIKE', '%' . $search . '%');
        })->latest()->get();

        return view('admin.partners.index', compact('partners', 'search'));
    }

    // 2. HALAMAN TAMBAH PARTNER
    public function create()
    {
        return view('admin.partners.create');
    }

    // 3. PROSES SIMPAN PARTNER BARU 
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048', 
        ]);

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('partners', 'public');
        }

        Partner::create([
            'name' => $request->name,
            'logo_url' => $logoPath,
        ]);

        return redirect()->route('admin.partners.index')
            ->with('success', 'Partner berhasil ditambahkan.');
    }

    // 4. HALAMAN EDIT PARTNER
    public function edit(Partner $partner)
    {
        return view('admin.partners.edit', compact('partner'));
    }

    // 5. PROSES UPDATE PARTNER & UBAH LOGO
    public function update(Request $request, Partner $partner)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        $logoPath = $partner->logo_url;
        
        if ($request->hasFile('logo')) {
            if ($partner->logo_url && Storage::disk('public')->exists($partner->logo_url)) {
                Storage::disk('public')->delete($partner->logo_url);
            }
            $logoPath = $request->file('logo')->store('partners', 'public');
        }

        $partner->update([
            'name' => $request->name,
            'logo_url' => $logoPath,
        ]);

        return redirect()->route('admin.partners.index')
            ->with('success', 'Data partner berhasil diperbarui.');
    }

    // 6. PROSES HAPUS PARTNER
    public function destroy(Partner $partner)
    {
        // Hapus file gambar 
        if ($partner->logo_url && Storage::disk('public')->exists($partner->logo_url)) {
            Storage::disk('public')->delete($partner->logo_url);
        }

        $partner->delete();

        return redirect()->route('admin.partners.index')
            ->with('success', 'Partner berhasil dihapus.');
    }
}