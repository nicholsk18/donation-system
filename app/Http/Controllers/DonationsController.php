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
        $donations = new Donations([ 'user' => $request->user() ]);
        $org_donations = $donations->getOrgDonations();

        return view('donations.view', [
            'user' => $request->user(),
            'donations' => $org_donations
        ]);
    }
}
