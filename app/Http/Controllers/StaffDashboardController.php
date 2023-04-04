<?php

namespace App\Http\Controllers;

use App\Models\PaidLeave;
use App\Models\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffDashboardController extends Controller
{
    public function index()
    {
        $employee   = Auth::user();
        $month      = date('m');
        $year       = date('Y');
        $day        = cal_days_in_month(CAL_GREGORIAN, $month, date('Y'));

        $rule_id = Rule::latest('id')->pluck('id')->first();

        $rule           = Rule::find($rule_id);
        $limitYearly    = $rule->total_yearly_leave;
        $limitMass      = $rule->total_mass_leave;
        $limitImportant = $rule->total_important_leave;
        $limitBig       = $rule->total_big_leave;
        $limitSick      = $rule->total_sick_leave;
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
            $Yearly[$i] = PaidLeave::where('employee_id', $employee->employee_id)
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
            $Mass[$i] = PaidLeave::where('employee_id', $employee->employee_id)
                ->whereYear('date_start', date("Y"))
                ->whereMonth('date_start', $i)
                ->where('type', 'Bersama')
                ->where('status', 'Diterima HRD')
                ->count();
        }

        $JanImportant = 0;
        $FebImportant = 0;
        $MarImportant = 0;
        $AprImportant = 0;
        $MayImportant = 0;
        $JunImportant = 0;
        $JulImportant = 0;
        $AugImportant = 0;
        $SepImportant = 0;
        $OctImportant = 0;
        $NovImportant = 0;
        $DecImportant = 0;

        $Important = [
            '',
            $JanImportant, $FebImportant, $MarImportant, $AprImportant,
            $MayImportant, $JunImportant, $JulImportant, $AugImportant,
            $SepImportant, $OctImportant, $NovImportant, $DecImportant
        ];

        for ($i = 1; $i <= 12; $i++) {
            $Important[$i] = PaidLeave::where('employee_id', $employee->employee_id)
                ->whereYear('date_start', date("Y"))
                ->whereMonth('date_start', $i)
                ->where('type', 'Penting')
                ->where('status', 'Diterima HRD')
                ->count();
        }

        $JanBig = 0;
        $FebBig = 0;
        $MarBig = 0;
        $AprBig = 0;
        $MayBig = 0;
        $JunBig = 0;
        $JulBig = 0;
        $AugBig = 0;
        $SepBig = 0;
        $OctBig = 0;
        $NovBig = 0;
        $DecBig = 0;

        $Big = [
            '',
            $JanBig, $FebBig, $MarBig, $AprBig,
            $MayBig, $JunBig, $JulBig, $AugBig,
            $SepBig, $OctBig, $NovBig, $DecBig
        ];

        for ($i = 1; $i <= 12; $i++) {
            $Big[$i] = PaidLeave::where('employee_id', $employee->employee_id)
                ->whereYear('date_start', date("Y"))
                ->whereMonth('date_start', $i)
                ->where('type', 'Besar')
                ->where('status', 'Diterima HRD')
                ->count();
        }

        $JanSick = 0;
        $FebSick = 0;
        $MarSick = 0;
        $AprSick = 0;
        $MaySick = 0;
        $JunSick = 0;
        $JulSick = 0;
        $AugSick = 0;
        $SepSick = 0;
        $OctSick = 0;
        $NovSick = 0;
        $DecSick = 0;

        $Sick = [
            '',
            $JanSick, $FebSick, $MarSick, $AprSick,
            $MaySick, $JunSick, $JulSick, $AugSick,
            $SepSick, $OctSick, $NovSick, $DecSick
        ];

        for ($i = 1; $i <= 12; $i++) {
            $Sick[$i] = PaidLeave::where('employee_id', $employee->employee_id)
                ->whereYear('date_start', date("Y"))
                ->whereMonth('date_start', $i)
                ->where('type', 'Sakit')
                ->where('status', 'Diterima HRD')
                ->count();
        }
        $JanMaternity = 0;
        $FebMaternity = 0;
        $MarMaternity = 0;
        $AprMaternity = 0;
        $MayMaternity = 0;
        $JunMaternity = 0;
        $JulMaternity = 0;
        $AugMaternity = 0;
        $SepMaternity = 0;
        $OctMaternity = 0;
        $NovMaternity = 0;
        $DecMaternity = 0;

        $Maternity = [
            '',
            $JanMaternity, $FebMaternity, $MarMaternity, $AprMaternity,
            $MayMaternity, $JunMaternity, $JulMaternity, $AugMaternity,
            $SepMaternity, $OctMaternity, $NovMaternity, $DecMaternity
        ];

        for ($i = 1; $i <= 12; $i++) {
            $Maternity[$i] = PaidLeave::where('employee_id', $employee->employee_id)
                ->whereYear('date_start', date("Y"))
                ->whereMonth('date_start', $i)
                ->where('type', 'Hamil')
                ->where('status', 'Diterima HRD')
                ->count();
        }

        $restYearly     = $limitYearly - ($Yearly[1] + $Yearly[2] + $Yearly[3] + $Yearly[4] + $Yearly[5] + $Yearly[6] + $Yearly[7] + $Yearly[8] + $Yearly[9] + $Yearly[10] + $Yearly[11] + $Yearly[12]);
        $restMass       = $limitMass - ($Mass[1] + $Mass[2] + $Mass[3] + $Mass[4] + $Mass[5] + $Mass[6] + $Mass[7] + $Mass[8] + $Mass[9] + $Mass[10] + $Mass[11] + $Mass[12]);
        $restImportant  = $limitImportant - ($Important[1] + $Important[2] + $Important[3] + $Important[4] + $Important[5] + $Important[6] + $Important[7] + $Important[8] + $Important[9] + $Important[10] + $Important[11] + $Important[12]);
        $restBig        = $limitBig - ($Big[1] + $Big[2] + $Big[3] + $Big[4] + $Big[5] + $Big[6] + $Big[7] + $Big[8] + $Big[9] + $Big[10] + $Big[11] + $Big[12]);
        $restSick       = $limitSick - ($Sick[1] + $Sick[2] + $Sick[3] + $Sick[4] + $Sick[5] + $Sick[6] + $Sick[7] + $Sick[8] + $Sick[9] + $Sick[10] + $Sick[11] + $Sick[12]);
        $restMaternity  = $limitMaternity - ($Maternity[1] + $Maternity[2] + $Maternity[3] + $Maternity[4] + $Maternity[5] + $Maternity[6] + $Maternity[7] + $Maternity[8] + $Maternity[9] + $Maternity[10] + $Maternity[11] + $Maternity[12]);

        $paidLeave = PaidLeave::where('employee_id', $employee->employee_id)->orderBy('id', 'desc')->first();

        $thisMonth = $month;

        /* Lama Kerja */
        $date_in    = $employee->tgl_masuk;
        $now        = date("Y-m-d");

        $ts1 = strtotime($date_in);
        $ts2 = strtotime($now);

        $year1 = date('Y', $ts1);
        $year2 = date('Y', $ts2);

        $month1 = date('m', $ts1);
        $month2 = date('m', $ts2);

        $durationWork                   = (($year2 - $year1) * 12) + ($month2 - $month1);

        $monthly_leave_year_conditions  = $rule->monthly_leave_year_conditions;

        $big_month_leave_conditions     = $rule->big_month_leave_conditions;

        return view('dashboard.staff', [
            'employee'                  => $employee,
            'paidLeave'                 => $paidLeave,
            'thisMonth'                 => $thisMonth,
            'thisYear'                  => $year,
            'rule'                      => $rule,
            'restYearly'                => $restYearly,
            'restMass'                  => $restMass,
            'restImportant'             => $restImportant,
            'restBig'                   => $restBig,
            'restSick'                  => $restSick,
            'restMaternity'             => $restMaternity,
            'durationWork'              => $durationWork,
            'monthly_leave_year_conditions' => $monthly_leave_year_conditions,
            'big_month_leave_conditions'    => $big_month_leave_conditions,
        ]);
    }
}
