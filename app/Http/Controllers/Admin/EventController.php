<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $query = Event::with('category');

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('search')) {
            $query->where('title', 'LIKE', '%' . $request->search . '%');
        }

        $events = $query->latest()->get();

        return view('admin.events.index', compact('events', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.events.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'date' => 'required',
            'description' => 'required',
            'location' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'poster' => 'required|image',
        ]);

        // AMBIL DATA TANPA FILE POSTER
        $data = $request->only([
            'title',
            'category_id',
            'date',
            'description',
            'location',
            'price',
            'stock'
        ]);

        // HANDLE UPLOAD POSTER
        if ($request->hasFile('poster')) {
            $data['poster_path'] = $request->file('poster')->store('posters', 'public');
        }

        Event::create($data);

        return redirect()->route('admin.events.index')
            ->with('success', 'Event berhasil ditambahkan');
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        $categories = Category::all();

        return view('admin.events.edit', compact('event', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'date' => 'required',
            'description' => 'required',
            'location' => 'required',
            'price' => 'required',
            'stock' => 'required',
        ]);

        // AMBIL DATA TANPA FILE POSTER
        $data = $request->only([
            'title',
            'category_id',
            'date',
            'description',
            'location',
            'price',
            'stock'
        ]);

        // JIKA ADA POSTER BARU
        if ($request->hasFile('poster')) {

            if ($event->poster_path) {
                Storage::disk('public')->delete($event->poster_path);
            }

            $data['poster_path'] = $request->file('poster')->store('posters', 'public');
        }

        $event->update($data);

        return redirect()->route('admin.events.index')
            ->with('success', 'Event berhasil diupdate');
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        if ($event->poster_path) {
            Storage::disk('public')->delete($event->poster_path);
        }

        $event->delete();

        return redirect()->route('admin.events.index')
            ->with('success', 'Event berhasil dihapus');
    }
}