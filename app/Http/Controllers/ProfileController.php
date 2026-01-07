<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Donation;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $donations = Donation::where('user_id', $user->id)
                            ->orderBy('created_at', 'desc')
                            ->get();
        
        
        $totalTrees = $donations->sum('quantity');

        $co2Absorbed = 0;
        foreach ($donations as $donation) {
            $plantDate = $donation->plant_date ?? $donation->created_at;
            if ($plantDate) {
                $yearsSincePlanted = $plantDate->diffInYears(now());
                if ($yearsSincePlanted >= 1) {
                    $co2Absorbed += $donation->quantity * $yearsSincePlanted * 40;
                }
            }
        }

        
        $contributionMonths = 0;
        $firstDonation = $donations->last(); 
        if ($firstDonation) {
            $plantDate = $firstDonation->plant_date ?? $firstDonation->created_at;
            
            if ($plantDate) {
                $contributionMonths = (int) $plantDate->diffInMonths(now());
            }
        }

        $totalTrees = (int) $totalTrees;
        $co2Absorbed = (int) $co2Absorbed;
        $contributionMonths = (int) $contributionMonths;

        return view('profile', compact('user', 'donations', 'totalTrees', 'co2Absorbed', 'contributionMonths'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string|max:500',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // max 5MB
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $user = Auth::user();

        $user->name = $request->name;
        $user->bio = $request->bio;

        if ($request->hasFile('profile_image')) {
            if ($user->profile_image && Storage::disk('public')->exists($user->profile_image)) {
                Storage::disk('public')->delete($user->profile_image);
            }

            $path = $request->file('profile_image')->store('profile_images', 'public');
            $user->profile_image = $path;
        }

        if ($request->hasFile('background_image')) {
            if ($user->background_image && Storage::disk('public')->exists($user->background_image)) {
                Storage::disk('public')->delete($user->background_image);
            }

            $path = $request->file('background_image')->store('background_images', 'public');
            $user->background_image = $path;
        }

        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Profil berhasil diperbarui!',
            'data' => [
                'name' => $user->name,
                'bio' => $user->bio,
                'profile_image_url' => $user->profile_image_url,
                'background_image_url' => $user->background_image_url,
            ]
        ]);
    }
}