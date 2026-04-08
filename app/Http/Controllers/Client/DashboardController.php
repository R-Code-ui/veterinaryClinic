<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();
        $pets = $user->pets; // only pets owned by the logged-in client
        return view('client.dashboard', compact('pets'));
    }
}
