<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard', [
            'metrics' => config('hisabi.reports'),
            'hasData' => (bool) Transaction::count()
        ]);
    }
}
