<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partner;
use App\Models\Category;
use App\Models\Event;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Partner
        $partners = Partner::all();

        // Kategori
        $categories = Category::withCount('events')->get();

        // Query event
        $eventQuery = Event::with('category');

        // Filter kategori
        if ($request->has('category') && $request->category != '') {

            $categoryId = $request->category;

            $eventQuery->where('category_id', $categoryId);
        }

        // Ambil semua event terbaru
        $events = $eventQuery->latest()->get();

        // Kirim ke view
        return view('welcome', compact(
            'partners',
            'categories',
            'events'
        ));
    }
}