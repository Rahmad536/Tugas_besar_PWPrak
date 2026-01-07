<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - GrowEarth</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="bg-gray-100">

    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 bg-green-800 text-white flex-shrink-0 hidden md:flex flex-col">
            <div class="p-6 text-center border-b border-green-700">
                <h1 class="text-2xl font-bold">GrowEarth Admin</h1>
            </div>
            <nav class="flex-1 p-4 space-y-2 overflow-y-auto">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 p-3 rounded hover:bg-green-700 {{ request()->routeIs('admin.dashboard') ? 'bg-green-700' : '' }}">
                    <i class="fas fa-tachometer-alt w-6"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.pohon.index') }}" class="flex items-center space-x-3 p-3 rounded hover:bg-green-700 {{ request()->routeIs('admin.pohon.*') ? 'bg-green-700' : '' }}">
                    <i class="fas fa-tree w-6"></i>
                    <span>Jenis Pohon</span>
                </a>
                <a href="{{ route('admin.donations.index') }}" class="flex items-center space-x-3 p-3 rounded hover:bg-green-700 {{ request()->routeIs('admin.donations.*') ? 'bg-green-700' : '' }}">
                    <i class="fas fa-history w-6"></i>
                    <span>Riwayat Donasi</span>
                </a>
                 <!-- Tambahkan menu lain di sini -->
            </nav>
            <div class="p-4 border-t border-green-700">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center space-x-3 text-red-300 hover:text-white w-full p-2">
                        <i class="fas fa-sign-out-alt w-6"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>


        <!-- Main Content -->
        <div class="flex-1 flex flex-col h-screen overflow-hidden">
            <!-- Navbar -->
            <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">
                    @yield('header', 'Dashboard')
                </h2>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600">{{ Auth::user()->name ?? Auth::user()->username }}</span>
                    <div class="w-8 h-8 rounded-full bg-green-600 flex items-center justify-center text-white">
                        <i class="fas fa-user-shield"></i>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                @if($errors->any())
                     <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

</body>
</html>
