<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class OrganizationController extends Controller
{
    /**
     * Display organization.
     */
    public function view(Request $request): View
    {
        return view('organization.view', [
            'user' => $request->user()
        ]);
    }

    /**
     * Display organization users.
     */
    public function users(Request $request): View
    {
        return view('organization.users', [
            'user' => $request->user()
        ]);
    }
}
