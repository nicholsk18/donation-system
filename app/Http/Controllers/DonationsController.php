<?php

namespace App\Http\Controllers;

use App\Models\Donations;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DonationsController extends Controller
{
    /**
     * Display all donations.
     */
    public function view(Request $request): View
    {
        $user = $request->user();
        $donations_class = new Donations();
        $donations = $donations_class->get_donations_by_user($user);

        return view('donations.view', [
            'user' => $user,
            'donations' => $donations
        ]);
    }
}
