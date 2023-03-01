<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function landingpage()
    {
        return view('landingpage');
    }
    
    public function index()
    {
        if (auth()->user()->role == 'Admin')
            return self::dashboardAdmin();
        elseif (auth()->user()->role == 'HRD')
            return self::dashboardHRD();
        elseif (auth()->user()->role == 'Staff')
            return self::dashboardStaff();
        else
            abort(403);
    }

    public function dashboardAdmin()
    {
        return view('dashboard.admin');
    }

    public function dashboardHRD()
    {
        return view('dashboard.admin');
    }

    public function dashboardStaff()
    {
        return view('dashboard.admin');
    }

}
