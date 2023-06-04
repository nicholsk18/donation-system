<?php

namespace App\Http\Controllers;

use App\Models\Organization;
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
            'title' => 'Organization',
            'users' => $request->user(),
        ]);
    }

    /**
     * Display organization users.
     */
    public function users(Request $request): View
    {
        $user = $request->user();
        $org = new Organization();
        $user = $org->get_org_users($user->org_id);

        return view('organization.users', [
            'title' => 'Organizations users',
            'user' => $request->user()
        ]);
    }
}
