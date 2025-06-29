<?php

namespace App\Http\Controllers;

use App\Models\Donation; // Add this import statement for the Donation model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource with optional filtering by claim status.
     */
    public function index(Request $request)
    {
        $query = Donation::where('user_id', auth()->id());

        // Filter by claim status if provided
        if ($request->has('claim_status')) {
            if ($request->claim_status == 'claimed') {
                $query->whereNotNull('claimed_by');
            } elseif ($request->claim_status == 'not_claimed') {
                $query->whereNull('claimed_by');
            }
        }

        // Fetch the donations
        $donations = $query->get();

        return view('donations.index', compact('donations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('donations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'allergy_alert' => 'nullable|string|max:255',
            'expiry_date' => 'required|date',
            'pickup_instruction' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('donation_photos', 'public');
        }

        Donation::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'allergy_alert' => $request->allergy_alert,
            'expiry_date' => $request->expiry_date,
            'pickup_instruction' => $request->pickup_instruction,
            'photo_path' => $photoPath,
        ]);

        return redirect()->route('donations.index')->with('success', 'Donation posted successfully!');
    }

    /**
     * Show the form for editing a donation.
     */
    public function edit(Donation $donation)
    {
        // Only allow the user to edit their own donations
        if ($donation->user_id !== auth()->id()) {
            return redirect()->route('donations.index')->with('error', 'You cannot edit this donation.');
        }

        return view('donations.edit', compact('donation'));
    }

    /**
     * Delete a donation.
     */
    public function destroy(Donation $donation)
    {
        // Only allow the user to delete their own donations
        if ($donation->user_id !== auth()->id()) {
            return redirect()->route('donations.index')->with('error', 'You cannot delete this donation.');
        }

        // Delete photo if exists
        if ($donation->photo_path) {
            Storage::disk('public')->delete($donation->photo_path);
        }

        $donation->delete();
        return redirect()->route('donations.index')->with('success', 'Donation deleted successfully!');
    }

    /**
     * Update a donation.
     */
    public function update(Request $request, Donation $donation)
    {
        // Authorization check
        if ($donation->user_id !== auth()->id()) {
            return redirect()->route('donations.index')->with('error', 'Unauthorized action.');
        }

        // Validation
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'allergy_alert' => 'nullable|string|max:255',
            'expiry_date' => 'required|date',
            'pickup_instruction' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($donation->photo_path) {
                Storage::disk('public')->delete($donation->photo_path);
            }
            $validated['photo_path'] = $request->file('photo')->store('donation_photos', 'public');
        }

        // Update donation
        $donation->update($validated);

        return redirect()->route('donations.index')
                         ->with('success', 'Donation updated successfully!');
    }

    /**
     * Display available donations (unclaimed and not expired).
     */
    public function available()
    {
        // Fetch donations that are available (not claimed, not expired)
        $donations = Donation::whereNull('claimed_by')  // Assuming there's a 'claimed_by' field to indicate if the donation is claimed
                             ->where('expiry_date', '>=', now()) // Filter out expired donations
                             ->get();

        return view('donations.available', compact('donations'));
    }

    /**
     * Claim a donation.
     */
    public function claim(Donation $donation)
    {
        // Prevent double-claiming
        if ($donation->claimed_by) {
            return redirect()->back()->with('error', 'This donation has already been claimed.');
        }

        // Update claimed_by with the currently authenticated user
        $donation->claimed_by = auth()->id();
        $donation->claimed_at = now();
        $donation->save();

        return redirect()->route('donations.my_claims')
                                 ->with('success', 'You have successfully claimed this donation.');
    }

    public function myClaims()
    {
    $donations = Donation::where('claimed_by', auth()->id())->get();

    return view('donations.my_claims', compact('donations'));
    }

    public function show(Donation $donation)
    {
        return view('donations.show', compact('donation'));
    }
}
