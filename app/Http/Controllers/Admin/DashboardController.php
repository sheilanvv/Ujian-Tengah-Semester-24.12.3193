<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Event;
use App\Models\Category;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Query event
        $query = Event::with('category');

        // Search event
        if ($request->filled('search')) {
            $query->where('title', 'LIKE', '%' . $request->search . '%');
        }

        // Filter kategori
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Ambil semua event
        $events = $query->latest()->get();

        // Ambil semua kategori
        $categories = Category::all();

        // Kirim ke view
        return view('admin.dashboard', compact('events', 'categories'));
    }

    public function transactions(Request $request)
    {
        $query = Transaction::query();

        // Search transaksi
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where('buyer_name', 'LIKE', "%{$search}%")
                  ->orWhere('order_id', 'LIKE', "%{$search}%");
        }

        // Ambil transaksi terbaru
        $transactions = $query->latest()->get();

        return view('admin.transactions', compact('transactions'));
    }
}