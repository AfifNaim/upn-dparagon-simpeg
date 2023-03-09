<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\PaidLeave;
use App\Models\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffDashboardController extends Controller
{
    public function index()
    {
        $user       = Auth::user();
        $employee   = Employee::where('id', $user->employee_id)->get();
        $id         = $user->id;
        $month      = date('m');
        $year       = date('Y');
        $day        = cal_days_in_month(CAL_GREGORIAN, $month, date('Y'));

        $rule_id = Rule::latest('id')->pluck('id')->first();

        $rule           = Rule::find($rule_id);
        $limitYearly    = $rule->total_yearly_leave;
        $limitMass      = $rule->total_mass_leave;
        $limitImportant = $rule->total_important_leave;
        $limitBig       = $rule->total_sick_leave;
        $limitSick      = $rule->total_maternity_leave;
        $limitMaternity = $rule->total_maternity_leave;

        $JanYearly = 0;
        $FebYearly = 0;
        $MarYearly = 0;
        $AprYearly = 0;
        $MayYearly = 0;
        $JunYearly = 0;
        $JulYearly = 0;
        $AugYearly = 0;
        $SepYearly = 0;
        $OctYearly = 0;
        $NovYearly = 0;
        $DecYearly = 0;

        $Yearly = [
            '',
            $JanYearly, $FebYearly, $MarYearly, $AprYearly,
            $MayYearly, $JunYearly, $JulYearly, $AugYearly,
            $SepYearly, $OctYearly, $NovYearly, $DecYearly
        ];

        for ($i = 1; $i <= 12; $i++) {
            $Yearly[$i] = PaidLeave::where('employee_id', $employee->id)
                ->whereYear('date_start', date("Y"))
                ->whereMonth('date_start', $i)
                ->where('type', 'Tahunan')
                ->where('status', 'Diterima HRD')
                ->count();
        }

        $JanMass = 0;
        $FebMass = 0;
        $MarMass = 0;
        $AprMass = 0;
        $MayMass = 0;
        $JunMass = 0;
        $JulMass = 0;
        $AugMass = 0;
        $SepMass = 0;
        $OctMass = 0;
        $NovMass = 0;
        $DecMass = 0;

        $Mass = [
            '',
            $JanMass, $FebMass, $MarMass, $AprMass,
            $MayMass, $JunMass, $JulMass, $AugMass,
            $SepMass, $OctMass, $NovMass, $DecMass
        ];

        for ($i = 1; $i <= 12; $i++) {
            $Mass[$i] = PaidLeave::where('employee_id', $employee->id)
                ->whereYear('date_start', date("Y"))
                ->whereMonth('date_start', $i)
                ->where('type', 'Bersama')
                ->where('status', 'Diterima HRD')
                ->count();
        }
    }
}
