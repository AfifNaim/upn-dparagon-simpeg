<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\PaidLeave;
use Illuminate\Http\Request;
use DateTime;
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
        $from       = date("Y-m-d");
        $to         = date("Y-m-d");
        $paidLeave  = PaidLeave::where('date_send', date("Y-m-d"))->paginate(20);

        return view('paidleave.index', compact('from','to','paidLeave'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employee   = Employee::all();

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
            'date_accept_manager'   => NULL,
            'date_accept_hrd'       => NULL,
            'date_decline_manager'  => NULL,
            'date_decline_hrd'      => NULL,
        );

        $paidLeave = PaidLeave::create($paidLeaveArray);

        return redirect()->route('paidleave.index')->with('success','Data Berhasil di Tambah');
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
        $employee = Employee::all();

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
            'employee'      => 'required',
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
            'date_accept_manager'   => $request->date_accept_manager,
            'date_accept_hrd'       => $request->date_accept_hrd,
            'date_decline_manager'  => $request->date_decline_manager,
            'date_decline_hrd'      => $request->date_decline_hrd
        );

        $paidleave->update($paidLeaveArray);

        return redirect()->route('paidleave.index')->with('success','Data Berhasil di Ubah');
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

        return redirect()->route('paidleave.index')->with('error','Data Berhasil di Hapus');
    }

    public function bigLeave()
    {
        $employee = Employee::pluck('name', 'id');
        return view('admin.paidleave.bigleave', compact('employee'));
    }


    public function storeBigLeave(Request $request)
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

        $employee = Employee::all();

        foreach ($$employee as $key => $data) {
            // dd($p->id);
            PaidLeave::create([
                'employee_id'           => $p->id,
                'type'                  => "Big",
                'date_send'             => date("Y-m-d"),
                'date_start'            => $request->tgl_mulai,
                'date_end'              => $request->tgl_selesai,
                'description'           => $request->ket,
                'status'                => "Onprosess",
                'date_accept_manager'   => NULL,
                'date_accept_hrd'       => NULL,
                'date_decline_manager'  => NULL,
                'date_decline_hrd'      => NULL,

            ]);
        }

        return redirect()->route('paidleave.index')->with('success','Data Berhasil di Tambah');
    }
}
