<?php

namespace App\Http\Controllers;

use App\Models\PaidLeave;
use App\Models\User;
use App\Models\WarningLetter;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $paidLeave      = PaidLeave::latest()->take(5)->get();
        $warningletter  = WarningLetter::latest()->take(5)->get();
        $employee       = User::latest()->take(5)->get();

        return view('dashboard.admin', compact('paidLeave','warningletter','employee'));
    }
}
