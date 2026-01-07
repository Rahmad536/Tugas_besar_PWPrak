@extends('admin.layout')

@section('header', 'Edit Donasi')

@section('content')
    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('admin.donations.update', $donation->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="col-span-1 md:col-span-2 bg-gray-50 p-4 rounded mb-4">
                    <h4 class="font-bold text-gray-700 mb-2">Informasi Donatur</h4>
                    <p><span class="font-semibold">Nama:</span> {{ $donation->donor_name }}</p>
                    <p><span class="font-semibold">Email:</span> {{ $donation->donor_email }}</p>
                    <p><span class="font-semibold">Tipe Pohon:</span> {{ $donation->treeType->nama_pohon ?? '-' }}</p>
                    <p><span class="font-semibold">Kode Tracking:</span> {{ $donation->tracking_code }}</p>
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="quantity">
                        Jumlah Pohon (Quantity)
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="quantity" type="number" name="quantity" value="{{ $donation->quantity }}" required min="1">
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="location">
                        Lokasi (Wilayah)
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="location" type="text" name="location" value="{{ $donation->location }}" required>
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="location_detail">
                        Detail Lokasi (Nama Tempat)
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="location_detail" type="text" name="location_detail" value="{{ $donation->location_detail }}">
                </div>

                <div class="md:col-span-2">
                    <h4 class="font-bold text-gray-700 mb-2 mt-4">Koordinat Peta</h4>
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="latitude">
                        Latitude
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="latitude" type="text" name="latitude" value="{{ $donation->latitude }}">
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="longitude">
                        Longitude
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="longitude" type="text" name="longitude" value="{{ $donation->longitude }}">
                </div>

            </div>

            <div class="flex items-center justify-between mt-6">
                <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Simpan Perubahan
                </button>
                <a class="inline-block align-baseline font-bold text-sm text-gray-600 hover:text-gray-800" href="{{ route('admin.donations.index') }}">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection
