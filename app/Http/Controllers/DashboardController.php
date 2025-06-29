<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Donation;
use App\Models\ForumPost;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $usertype = Auth::user()->usertype;

            if ($usertype == 'donor') {
                $userId = Auth::id();

                // Get claimed donations per month by donor
                $claimedPerMonth = Donation::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                    ->where('user_id', $userId)
                    ->whereNotNull('claimed_by')
                    ->groupBy('month')
                    ->orderBy('month')
                    ->pluck('count', 'month');

                // Get unclaimed donations per month by donor
                $unclaimedPerMonth = Donation::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                    ->where('user_id', $userId)
                    ->whereNull('claimed_by')
                    ->groupBy('month')
                    ->orderBy('month')
                    ->pluck('count', 'month');

                // Fill all 12 months
                $months = collect(range(1, 12))->mapWithKeys(function ($month) use ($claimedPerMonth, $unclaimedPerMonth) {
                    return [
                        $month => [
                            'claimed' => $claimedPerMonth[$month] ?? 0,
                            'unclaimed' => $unclaimedPerMonth[$month] ?? 0,
                        ]
                    ];
                });

                // Prepare labels and datasets
                $donationChartLabels = $months->keys()->map(fn($m) => date("M", mktime(0, 0, 0, $m, 10)))->values()->all();
                $claimedDonationData = $months->map(fn($data) => $data['claimed'])->values()->all();
                $unclaimedDonationData = $months->map(fn($data) => $data['unclaimed'])->values()->all();

                return view('donor.donordashboard', compact(
                    'donationChartLabels',
                    'claimedDonationData',
                    'unclaimedDonationData'
                ));
            } 
            else if ($usertype == 'admin') {
                // Admin dashboard metrics
                $totalUsers = User::count();
                $activeDonations = Donation::where('expiry_date', '>=', now())->count();
                $availableDonations = Donation::where('expiry_date', '>=', now())
                    ->whereNull('claimed_by')
                    ->count();
                $forumPosts = ForumPost::count();

                // Monthly claimed donations (all users)
                $claimedPerMonth = Donation::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                    ->whereNotNull('claimed_by')
                    ->groupBy('month')
                    ->orderBy('month')
                    ->pluck('count', 'month');

                // Monthly unclaimed donations (all users)
                $unclaimedPerMonth = Donation::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                    ->whereNull('claimed_by')
                    ->groupBy('month')
                    ->orderBy('month')
                    ->pluck('count', 'month');

                // Fill all 12 months
                $months = collect(range(1, 12))->mapWithKeys(function ($month) use ($claimedPerMonth, $unclaimedPerMonth) {
                    return [
                        $month => [
                            'claimed' => $claimedPerMonth[$month] ?? 0,
                            'unclaimed' => $unclaimedPerMonth[$month] ?? 0,
                        ]
                    ];
                });

                // Prepare labels and datasets
                $labels = $months->keys()->map(fn($m) => date("M", mktime(0, 0, 0, $m, 10)));
                $claimedData = $months->map(fn($data) => $data['claimed'])->values()->all();
                $unclaimedData = $months->map(fn($data) => $data['unclaimed'])->values()->all();

                return view('admin.index', [
                    'totalUsers' => $totalUsers,
                    'activeDonations' => $activeDonations,
                    'availableDonations' => $availableDonations,
                    'forumPosts' => $forumPosts,
                    'donationChartLabels' => $labels,
                    'claimedDonationData' => $claimedData,
                    'unclaimedDonationData' => $unclaimedData,
                ]);
            } 
            else if ($usertype == 'receiver') {
                return $this->receiverDashboard(); // Call method directly
            } 
            else {
                return redirect()->back();
            }
        }

        return redirect('/login');
    }

    public function receiverDashboard()
    {
        $userId = Auth::id();

        // Get claimed donations per month by receiver
        $claimedPerMonth = Donation::selectRaw('MONTH(claimed_at) as month, COUNT(*) as count')
            ->where('claimed_by', $userId)
            ->whereNotNull('claimed_at')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month');

        // Fill all months (1–12)
        $months = collect(range(1, 12))->mapWithKeys(function ($month) use ($claimedPerMonth) {
            return [$month => $claimedPerMonth[$month] ?? 0];
        });

        // Chart labels and data
        $donationChartLabels = $months->keys()->map(fn($m) => date("M", mktime(0, 0, 0, $m, 10)))->values()->all();
        $claimedDonationData = $months->values()->all();

        return view('receiver.receiverdashboard', compact('donationChartLabels', 'claimedDonationData'));
    }

    public function homepage()
    {
        return view('home.homepage');
    }
}
