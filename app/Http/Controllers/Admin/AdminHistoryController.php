<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation;
use App\Models\Pohon;

class AdminHistoryController extends Controller
{
    public function index()
    {
        // Load donations with relationships
        $donations = Donation::with(['user', 'treeType'])->latest()->paginate(10);
        return view('admin.history.index', compact('donations'));
    }

    public function edit($id)
    {
        $donation = Donation::findOrFail($id);
        $pohons = Pohon::all(); // For changing tree type if needed, or just display name
        return view('admin.history.edit', compact('donation', 'pohons'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'location' => 'required|string',
            'location_detail' => 'nullable|string',
            'quantity' => 'required|integer|min:1',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        $donation = Donation::findOrFail($id);
        
        $donation->update([
            'location' => $request->location,
            'location_detail' => $request->location_detail,
            'quantity' => $request->quantity,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return redirect()->route('admin.donations.index')
                        ->with('success', 'Data donasi berhasil diperbarui');
    }
}
