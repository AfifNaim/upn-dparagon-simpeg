<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function landingpage()
    {
        return view('landingpage');
    }

    public function index()
    {
        if (auth()->user()->role == 'Staff')
            return redirect('/Staff');
        elseif (auth()->user()->role == 'HRD')
            return redirect('/HRD');
        elseif (auth()->user()->role == 'Admin')
            return redirect('/Admin');
        else
            abort(403);
    }
}
