<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pohon;
use Illuminate\Support\Facades\Storage;

class AdminPohonController extends Controller
{
    public function index()
    {
        $pohons = Pohon::latest()->get();
        return view('admin.pohon.index', compact('pohons'));
    }

    public function create()
    {
        return view('admin.pohon.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pohon' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $input = $request->all();

        if ($image = $request->file('gambar')) {
            $destinationPath = 'pohon_images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->storeAs($destinationPath, $profileImage, 'public');
            $input['gambar'] = "$destinationPath$profileImage";
        }

        Pohon::create($input);

        return redirect()->route('admin.pohon.index')
                        ->with('success','Pohon berhasil ditambahkan.');
    }

    public function edit(Pohon $pohon)
    {
        return view('admin.pohon.edit', compact('pohon'));
    }

    public function update(Request $request, Pohon $pohon)
    {
        $request->validate([
            'nama_pohon' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
        ]);

        $input = $request->all();

        if ($image = $request->file('gambar')) {
             // Hapus gambar lama jika ada
            if ($pohon->gambar && Storage::disk('public')->exists($pohon->gambar)) {
                Storage::disk('public')->delete($pohon->gambar);
            }

            $destinationPath = 'pohon_images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->storeAs($destinationPath, $profileImage, 'public');
            $input['gambar'] = "$destinationPath$profileImage";
        } else {
            unset($input['gambar']);
        }

        $pohon->update($input);

        return redirect()->route('admin.pohon.index')
                        ->with('success','Pohon berhasil diperbarui');
    }

    public function destroy(Pohon $pohon)
    {
        if ($pohon->gambar && Storage::disk('public')->exists($pohon->gambar)) {
            Storage::disk('public')->delete($pohon->gambar);
        }
        
        $pohon->delete();

        return redirect()->route('admin.pohon.index')
                        ->with('success','Pohon berhasil dihapus');
    }
}
