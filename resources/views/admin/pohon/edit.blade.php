@extends('admin.layout')

@section('header', 'Edit Pohon')

@section('content')
    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('admin.pohon.update', $pohon->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="nama_pohon">
                    Nama Pohon
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nama_pohon" type="text" name="nama_pohon" value="{{ $pohon->nama_pohon }}" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="deskripsi">
                    Deskripsi
                </label>
                <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="deskripsi" name="deskripsi" rows="3" required>{{ $pohon->deskripsi }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="harga">
                    Harga (Rp)
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="harga" type="number" name="harga" value="{{ $pohon->harga }}" required>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="gambar">
                    Gambar Pohon (Biarkan kosong jika tidak diubah)
                </label>
                @if($pohon->gambar)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $pohon->gambar) }}" class="w-20 h-20 object-cover rounded">
                    </div>
                @endif
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="gambar" type="file" name="gambar" accept="image/*">
            </div>

            <div class="flex items-center justify-between">
                <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Update
                </button>
                <a class="inline-block align-baseline font-bold text-sm text-gray-600 hover:text-gray-800" href="{{ route('admin.pohon.index') }}">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection
