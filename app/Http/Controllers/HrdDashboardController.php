<?php

namespace App\Http\Controllers;

use App\Models\PaidLeave;
use App\Models\WarningLetter;

class HrdDashboardController extends Controller
{
    public function index()
    {
        $paidLeave      = PaidLeave::latest()->where('status', 'Dalam Proses')->take(5)->latest()->get();
        $warningletter  = WarningLetter::latest()->take(5)->get();

        return view('dashboard.hrd', compact('paidLeave','warningletter'));
    }
}
