<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\PaidLeave;
use App\Models\User;
use PDF;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StaffPaidLeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee   = Auth::user();

        $paidLeave  = PaidLeave::where('employee_id', Auth::user()->employee_id)->latest()->paginate(10);

        return view('staffpaidleave.index', compact('paidLeave'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('staffpaidleave.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type'          => 'required',
            'date_start'    => 'required',
            'date_end'      => 'required',
            'description'   => 'required',
        ]);

        if ($validator->fails()) {
            return $request->ajax()
                ? response()->json(['errors'  => $validator->errors()], 400)
                : back()
                    ->withInput()
                    ->withErrors($validator->errors())
                    ->with('error',"Gagal menyimpan data. Cek kembali data inputan Anda.");
        }

        $employee   = Auth::user();

        $paidLeaveArray = array(
            'employee_id'           => $employee->employee_id,
            'type'                  => $request->type,
            'date_send'             => date("Y-m-d"),
            'date_start'            => $request->date_start,
            'date_end'              => $request->date_end,
            'description'           => $request->description,
            'status'                => "Dalam Proses",
            'date_accept_manager'   => NULL,
            'date_accept_hrd'       => NULL,
            'date_decline_manager'  => NULL,
            'date_decline_hrd'      => NULL,
        );

        $paidLeave = PaidLeave::create($paidLeaveArray);

        return redirect()->route(Auth::user()->role.'.staffpaidleave.index')->with('success','Data Berhasil di Tambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paidleave = PaidLeave::find($id);

        $date_in    = $paidleave->Employee->date_in;
        $date       = date("Y-m-d");

        $date1 = new DateTime($date_in);
        $date2 = new DateTime($date);

        $interval = $date1->diff($date2);

        return view('staffpaidleave.show', compact('paidleave', 'interval'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paidleave = PaidLeave::find($id);

        return view('staffpaidleave.edit', compact('paidleave'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'type'          => 'required',
            'date_start'    => 'required',
            'date_end'      => 'required',
            'description'   => 'required',
        ]);

        if ($validator->fails()) {
            return $request->ajax()
                ? response()->json(['errors'  => $validator->errors()], 400)
                : back()
                    ->withInput()
                    ->withErrors($validator->errors())
                    ->with('error',"Gagal menyimpan data. Cek kembali data inputan Anda.");
        }

        $paidleave = PaidLeave::find($id);

        $paidLeaveArray = array(
            'type'                  => $request->type,
            'date_send'             => Carbon::now()->format('Y-m-d'),
            'date_start'            => $request->date_start,
            'date_end'              => $request->date_end,
            'description'           => $request->description
        );

        $paidleave->update($paidLeaveArray);

        return redirect()->route(Auth::user()->role.'.staffpaidleave.index')->with('success','Data Berhasil di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paidleave = PaidLeave::find($id);
        $paidleave->delete();

        return redirect()->route(Auth::user()->role.'.staffpaidleave.index')->with('error','Data Berhasil di Hapus');
    }

    public function pdf(PaidLeave $paidleave)
    {

        function numberToRomanRepresentation($number)
        {
            $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
            $returnValue = '';
            while ($number > 0) {
                foreach ($map as $roman => $int) {
                    if ($number >= $int) {
                        $number -= $int;
                        $returnValue .= $roman;
                        break;
                    }
                }
            }
            return $returnValue;
        }

        $employee_id    = $paidleave->employee_id;

        $employee       = User::where('employee_id', $employee_id)->first();
        $month          = numberToRomanRepresentation(date('m', strtotime($paidleave->date_start)));
        $year           = date('Y', strtotime($paidleave->date_start));
        $lastIncreament = substr($paidleave->id, -3);
        $letter_id      = str_pad($lastIncreament, 3, 0, STR_PAD_LEFT);
        $company        = Company::orderBy('id', 'desc')->first();

        $data = [
            'paidleave' => $paidleave,
            'employee'  => $employee,
            'date'      => date('Y-m-d', strtotime($paidleave->date_start)),
            'month'     => $month,
            'year'      => $year,
            'letter_id' => $letter_id,
            'company'   => $company,

        ];
            
        $pdf = PDF::loadView('staffpaidleave.pdf', $data)->setPaper('a4', 'potrait');;

        return $pdf->stream('pdf_file.pdf', array('Attachment' => 0));
    }

}
