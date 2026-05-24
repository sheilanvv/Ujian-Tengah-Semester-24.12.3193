<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Dashboard' }} - AmikomEventHub</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-900 flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-indigo-900 text-slate-300 flex flex-col p-6 sticky top-0 h-screen shadow-xl z-20">

        <!-- LOGO -->
        <div class="flex items-center gap-3 px-2 mb-8">

            <div class="w-9 h-9 bg-white rounded-xl flex items-center justify-center text-indigo-900 font-black text-lg shadow-sm">
                AH
            </div>

            <span class="text-lg font-black text-white tracking-tight">
                AmikomEventHub
            </span>

        </div>

        <!-- MENU -->
        <nav class="flex-1 space-y-2">

            <p class="text-[10px] font-black uppercase tracking-widest text-indigo-300 mb-3 px-3">
                Main Menu
            </p>

            <!-- DASHBOARD -->
            <a href="/admin"
                class="flex items-center gap-3 px-4 py-3 rounded-2xl font-bold text-sm transition
                {{ request()->is('admin')
                    ? 'bg-indigo-700 text-white shadow-lg'
                    : 'text-indigo-200 hover:bg-indigo-800 hover:text-white' }}">
                Dashboard
            </a>

            <!-- EVENT -->
            <a href="/admin/events"
                class="flex items-center gap-3 px-4 py-3 rounded-2xl font-bold text-sm transition
                {{ request()->is('admin/events*')
                    ? 'bg-indigo-700 text-white shadow-lg'
                    : 'text-indigo-200 hover:bg-indigo-800 hover:text-white' }}">
                Kelola Event
            </a>

            <!-- KATEGORI -->
            <a href="/admin/categories"
                class="flex items-center gap-3 px-4 py-3 rounded-2xl font-bold text-sm transition
                {{ request()->is('admin/categories*')
                    ? 'bg-indigo-700 text-white shadow-lg'
                    : 'text-indigo-200 hover:bg-indigo-800 hover:text-white' }}">
                Kelola Kategori
            </a>

            <!-- PARTNER -->
            <a href="/admin/partners"
                class="flex items-center gap-3 px-4 py-3 rounded-2xl font-bold text-sm transition
                {{ request()->is('admin/partners*')
                    ? 'bg-indigo-700 text-white shadow-lg'
                    : 'text-indigo-200 hover:bg-indigo-800 hover:text-white' }}">
                Kelola Partner
            </a>

            <!-- TRANSAKSI -->
            <a href="/admin/transactions"
                class="flex items-center gap-3 px-4 py-3 rounded-2xl font-bold text-sm transition
                {{ request()->is('admin/transactions*')
                    ? 'bg-indigo-700 text-white shadow-lg'
                    : 'text-indigo-200 hover:bg-indigo-800 hover:text-white' }}">
                Transaksi
            </a>

        </nav>

        <!-- LOGOUT -->
        <div class="pt-4 border-t border-indigo-800 mt-6">

            <a href="/"
                class="flex items-center gap-3 px-4 py-3 rounded-2xl font-bold text-sm text-indigo-200 hover:bg-indigo-800 hover:text-white transition">
                Keluar
            </a>

        </div>

    </aside>

    <!-- CONTENT -->
    <main class="flex-1 p-10 overflow-y-auto">
        @yield('content')
    </main>

</body>

</html>