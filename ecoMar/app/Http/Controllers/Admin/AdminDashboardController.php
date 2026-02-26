<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Donation;
use App\Models\Event;
use App\Models\EventSuggestion;
use App\Models\Newsletter;
use App\Models\User;
use App\Models\Testimony;


class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'users' => User::count(),
            'events' => Event::count(),
            'event_suggestions' => EventSuggestion::count(),
            'newsletters' => Newsletter::count(),
            'donations_total' => (float) Donation::sum('num_donated'),
            'campaigns_active' => Campaign::whereDate('date_end', '>=', now()->toDateString())
                ->orWhereNull('date_end')
                ->count(),
            'testimonies' => Testimony::count(),
            'testimonies_pending' => Testimony::where('is_approved', false)->count(),
        ];

        $donationsByMonth = Donation::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, SUM(num_donated) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $eventsByMonth = Event::selectRaw('DATE_FORMAT(event_date, "%Y-%m") as month, COUNT(*) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return view('_admin.dashboard', [
            'stats' => $stats,
            'donationsChart' => [
                'labels' => $donationsByMonth->pluck('month'),
                'data' => $donationsByMonth->pluck('total'),
            ],
            'eventsChart' => [
                'labels' => $eventsByMonth->pluck('month'),
                'data' => $eventsByMonth->pluck('total'),
            ],
        ]);
    }
}
