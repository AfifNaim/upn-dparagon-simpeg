<?php

namespace App\Http\Controllers;

use App\Models\PaidLeave;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PaidLeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paidLeave  = PaidLeave::latest()->paginate(10);

        return view('paidleave.index', compact('paidLeave'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employee   = User::where('role', '!=' ,"Admin")->get();

        return view('paidleave.create', compact('employee'));
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
            'employee'   => 'required',
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

        $paidLeaveArray = array(
            'employee_id'           => $request->employee,
            'type'                  => $request->type,
            'date_send'             => date("Y-m-d"),
            'date_start'            => $request->date_start,
            'date_end'              => $request->date_end,
            'description'           => $request->description,
            'status'                => "Dalam Proses",
            'date_accept_hrd'       => NULL,
            'date_decline_hrd'      => NULL,
        );

        $paidLeave = PaidLeave::create($paidLeaveArray);

        return redirect()->route(Auth::user()->role.'.paidleave.index')->with('success','Data Berhasil di Tambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaidLeave  $paidLeave
     * @return \Illuminate\Http\Response
     */
    public function show(PaidLeave $paidleave)
    {
        @$date_in    = $paidleave->Employee->date_in;
        $date       = date("Y-m-d");

        $date1 = new DateTime($date_in);
        $date2 = new DateTime($date);

        $interval = $date1->diff($date2);

        return view('paidleave.show', compact('paidleave', 'interval'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaidLeave  $paidLeave
     * @return \Illuminate\Http\Response
     */
    public function edit(PaidLeave $paidleave)
    {
        $employee = User::where('role', '!=' ,"Admin")->get();

        return view('paidleave.edit', compact('paidleave', 'employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaidLeave  $paidLeave
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaidLeave $paidleave)
    {
        $validator = Validator::make($request->all(), [
            'employee'   => 'required',
            'type'          => 'required',
            'date_send'     => 'required',
            'date_start'    => 'required',
            'date_end'      => 'required',
            'description'   => 'required',
            'status'        => 'required'
        ]);

        if ($validator->fails()) {
            return $request->ajax()
                ? response()->json(['errors'  => $validator->errors()], 400)
                : back()
                    ->withInput()
                    ->withErrors($validator->errors())
                    ->with('error',"Gagal menyimpan data. Cek kembali data inputan Anda.");
        }

        $paidLeaveArray = array(
            'employee_id'           => $request->employee,
            'type'                  => $request->type,
            'date_send'             => $request->date_send,
            'date_start'            => $request->date_start,
            'date_end'              => $request->date_end,
            'description'           => $request->description,
            'status'                => $request->status,
            'date_accept_hrd'       => $request->date_accept_hrd,
            'date_decline_hrd'      => $request->date_decline_hrd
        );

        $paidleave->update($paidLeaveArray);

        return redirect()->route(Auth::user()->role.'.paidleave.index')->with('success','Data Berhasil di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaidLeave  $paidLeave
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaidLeave $paidleave)
    {
        $paidleave->delete();

        return redirect()->route(Auth::user()->role.'.paidleave.index')->with('error','Data Berhasil di Hapus');
    }

    public function massLeave()
    {
        $employee = User::pluck('name', 'employee_id');

        return view('paidleave.massleave', compact('employee'));
    }

    public function storeMassLeave(Request $request)
    {
        $validator = Validator::make($request->all(), [
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

        $employee = User::where('role', '!=' , "Admin")->get();

        foreach ($employee as $key => $data) {

            PaidLeave::create([
                'employee_id'           => $data->employee_id,
                'type'                  => "Besar",
                'date_send'             => date("Y-m-d"),
                'date_start'            => $request->date_start,
                'date_end'              => $request->date_end,
                'description'           => $request->description,
                'status'                => "Diterima HRD",
                'date_accept_hrd'       => Carbon::now()->format('Y-m-d H:i:s'),
                'date_decline_hrd'      => NULL,

            ]);
        }

        return redirect()->route(Auth::user()->role.'.paidleave.index')->with('success','Data Berhasil di Tambah');
    }

    public function approval($id)
    {
        $paidleave = PaidLeave::find($id);
        $paidleave->status = "Diterima HRD";
        $paidleave->date_accept_hrd = date('Y-m-d');
        $paidleave->save();

        return redirect()->route(Auth::user()->role.'.paidleave.index')->with('success','Izin Berhasil di Proses');
    }

    public function disapprove($id)
    {
        $paidleave = PaidLeave::find($id);
        $paidleave->status = "Ditolak HRD";
        $paidleave->date_decline_hrd = date('Y-m-d');
        $paidleave->save();

        return redirect()->route(Auth::user()->role.'.paidleave.index')->with('success','Izin Berhasil di Proses');
    }
}
