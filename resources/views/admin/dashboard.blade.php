@extends('admin.layout')

@section('header', 'Dashboard Overview')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <!-- Card 1 -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                    <i class="fas fa-tree text-2xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Total Jenis Pohon</p>
                    <p class="text-lg font-semibold text-gray-700">{{ \App\Models\Pohon::count() }}</p>
                </div>
            </div>
        </div>

         <!-- Card 2 -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                    <i class="fas fa-users text-2xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Total Users</p>
                    <p class="text-lg font-semibold text-gray-700">{{ \App\Models\User::count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Selamat Datang, Admin!</h3>
        <p class="text-gray-600">Ini adalah panel admin untuk mengelola konten website GrowEarth.</p>
    </div>
@endsection
