<?php

namespace App\Http\Controllers;

use App\Models\Donations;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display all dashboard widgets.
     */
    public function view(Request $request): View {
        $user = $request->user();
        $donations_class = new Donations();
        $latest_donations = $donations_class->get_donations($user, 0, 10);
        $donations_ytd = $donations_class->donations_ytd($user);
        $donations_month = $donations_class->donations_month($user);

        return view('dashboard', [
            'title' => 'Dashboard',
            'user' => $request->user(),
            'donations_ytd' => $donations_ytd,
            'donations_month' => $donations_month,
            'latest_donations' => $latest_donations
        ]);
    }
}
