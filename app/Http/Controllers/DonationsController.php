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
//        $donations = new Donations([ 'org_id' => 1 ]);
//        $user_donations = $donations->getAll();
//        foreach($user_donations as $donation) {
//            var_dump($donation->first_name);
//            var_dump($donation->amount);
//            var_dump($donation->note);
//        }
        return view('donations.view', [
            'user' => $request->user(),
        ]);
    }
}
