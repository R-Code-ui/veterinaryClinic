<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Complex Query 1: Top 3 pet breeds with most completed appointments in last 30 days
        $topBreeds = DB::table('appointments')
            ->join('pets', 'appointments.pet_id', '=', 'pets.id')
            ->select('pets.breed', DB::raw('COUNT(*) as total'))
            ->where('appointments.status', 'completed')
            ->where('appointments.appointment_date', '>=', now()->subDays(30))
            ->whereNotNull('pets.breed')
            ->groupBy('pets.breed')
            ->orderBy('total', 'DESC')
            ->limit(3)
            ->get();

        // Complex Query 2: Number of appointments per vet, grouped by month (last 6 months)
        $appointmentsPerVet = DB::table('appointments')
            ->join('users', 'appointments.vet_id', '=', 'users.id')
            ->select(
                'users.name as vet_name',
                DB::raw("strftime('%Y-%m', appointments.appointment_date) as month"),
                DB::raw('COUNT(*) as total')
            )
            ->where('appointments.appointment_date', '>=', now()->subMonths(6))
            ->groupBy('users.id', 'month')
            ->orderBy('month', 'DESC')
            ->orderBy('total', 'DESC')
            ->get();

        return view('admin.dashboard', compact('topBreeds', 'appointmentsPerVet'));
    }
}
