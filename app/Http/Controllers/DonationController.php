<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donation;
use App\Models\Pohon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DonationController extends Controller
{
    // Fungsi store() yang sudah ada tetap seperti sebelumnya
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'tree_type' => 'required|exists:pohons,id',
                'quantity' => 'required|integer|min:1|max:1000',
                'price_per_tree' => 'required|numeric',
                'total_price' => 'required|numeric',
                'donor_name' => 'required|string|max:255',
                'donor_email' => 'required|email',
            ]);

            $userId = Auth::id();

            if (!$userId) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda harus login terlebih dahulu'
                ], 401);
            }

            // Generate tracking code
            $latestCode = Donation::orderBy('id', 'desc')->first();
            $nextNumber = $latestCode ? (intval(substr($latestCode->tracking_code, 3)) + 1) : 1;
            $code = 'TR-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
            
            $donation = Donation::create([
                'tracking_code' => $code,
                'user_id' => $userId,
                'location' => 'Indonesia',
                'location_detail' => null,
                'program' => 'Donasi Umum',
                'tree_type_id' => $validated['tree_type'],
                'quantity' => $validated['quantity'],
                'amount' => $validated['price_per_tree'],
                'donor_name' => $validated['donor_name'],
                'donor_email' => $validated['donor_email'],
                'plant_date' => now(),
                'latitude' => -2.5,
                'longitude' => 118.0,
                'health_status' => 'Sangat Baik',
                'growth_progress' => 0,
                'status' => 'pending',
            ]);

            return response()->json([
                'success' => true,
                'tracking_code' => $code,
                'message' => 'Donasi berhasil dibuat'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * FUNGSI BARU: API Create donation from modal form
     */
    public function createDonation(Request $request)
    {
        $validated = $request->validate([
            'tree_type_id' => 'required|exists:pohons,id',
            'quantity' => 'required|integer|min:1|max:1000',
            'donor_name' => 'required|string|max:100',
            'donor_email' => 'required|email|max:100',
            'location' => 'required|string',
            'program' => 'required|string',
            'total_amount' => 'required|numeric|min:0'
        ]);

        $trackingCodes = [];
        
        // Koordinat untuk setiap lokasi
        $locationCoordinates = [
            'Kalimantan' => [
                ['lat' => -0.9500, 'lng' => 116.8000, 'detail' => 'Hutan Lindung Wehea'],
                ['lat' => -1.2000, 'lng' => 116.5000, 'detail' => 'Taman Nasional Kutai'],
                ['lat' => -0.5000, 'lng' => 117.1500, 'detail' => 'Hutan Berau']
            ],
            'Sumatra' => [
                ['lat' => 2.3500, 'lng' => 99.1500, 'detail' => 'Hutan Mangrove Langkat'],
                ['lat' => 3.5952, 'lng' => 98.6722, 'detail' => 'Pesisir Medan'],
                ['lat' => 0.5333, 'lng' => 101.4500, 'detail' => 'Taman Nasional Tesso Nilo']
            ],
            'Jakarta' => [
                ['lat' => -6.2088, 'lng' => 106.8456, 'detail' => 'Taman Menteng'],
                ['lat' => -6.1751, 'lng' => 106.8650, 'detail' => 'Taman Suropati'],
                ['lat' => -6.3000, 'lng' => 106.8167, 'detail' => 'Taman Mini Indonesia Indah']
            ]
        ];

        $locations = $locationCoordinates[$validated['location']] ?? [
            ['lat' => -2.5, 'lng' => 118.0, 'detail' => 'Indonesia']
        ];

        DB::beginTransaction();
        
        try {
            for ($i = 0; $i < $validated['quantity']; $i++) {
                // Generate kode tracking unik
                $latestCode = Donation::orderBy('id', 'desc')->lockForUpdate()->first();
                $nextNumber = $latestCode ? (intval(substr($latestCode->tracking_code, 3)) + 1) : 1;
                $code = 'TR-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
                
                // Random lokasi
                $location = $locations[array_rand($locations)];
                
                // Simpan donation
                Donation::create([
                    'tracking_code' => $code,
                    'user_id' => Auth::id(),
                    'donor_name' => $validated['donor_name'],
                    'donor_email' => $validated['donor_email'],
                    'tree_type_id' => $validated['tree_type_id'],
                    'location' => $validated['location'],
                    'location_detail' => $location['detail'],
                    'program' => $validated['program'],
                    'quantity' => 1, // 1 pohon per record
                    'plant_date' => now(),
                    'latitude' => $location['lat'],
                    'longitude' => $location['lng'],
                    'health_status' => 'Sangat Baik',
                    'growth_progress' => 0,
                    'amount' => $validated['total_amount'] / $validated['quantity'],
                    'status' => 'success'
                ]);
                
                $trackingCodes[] = $code;
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'tracking_codes' => $trackingCodes,
                'message' => 'Donasi berhasil diproses'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * FUNGSI BARU: Success page after donation
     */
    public function success(Request $request)
    {
        $codes = explode(',', $request->query('codes', ''));
        
        if (empty($codes) || $codes[0] === '') {
            return redirect()->route('donasi')->with('error', 'Kode tracking tidak valid');
        }

        $donations = Donation::whereIn('tracking_code', $codes)
                            ->with('treeType')
                            ->get();

        return view('donasiSukses', compact('donations', 'codes'));
    }

    /**
     * FUNGSI BARU: API Get tree data by tracking code (untuk monitoring)
     */
    public function getTreeData($code)
    {
        $tree = Donation::where('tracking_code', strtoupper($code))
                       ->with('treeType')
                       ->first();
        
        if (!$tree) {
            return response()->json(['error' => 'Pohon tidak ditemukan'], 404);
        }

        // Calculate age
        $plantDate = $tree->plant_date;
        $now = now();
        $diffInMonths = $plantDate->diffInMonths($now);
        $years = floor($diffInMonths / 12);
        $months = $diffInMonths % 12;

        return response()->json([
            'lat' => (float) $tree->latitude,
            'lng' => (float) $tree->longitude,
            'type' => $tree->treeType->nama_pohon,
            'date' => $tree->plant_date->format('d/m/Y'),
            'location' => $tree->location_detail ?? $tree->location,
            'health' => $tree->health_status,
            'progress' => $tree->growth_progress . '%',
            'age_years' => $years,
            'age_months' => $months
        ]);
    }



}