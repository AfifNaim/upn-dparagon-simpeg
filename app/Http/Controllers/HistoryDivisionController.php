<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\HistoryDivision;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HistoryDivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = User::all();

        return view('admin.historydivision.index', compact('employee'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function createData(User $employee)
    {
        $division     = Division::pluck('name', 'id');

        return view('admin.historydivision.create', compact('employee','division'));
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
            'employee_id'   => 'required',
            'division_id'   => 'required',
            'date_start'    => 'required'
        ]);

        if ($validator->fails()) {
            return $request->ajax()
                ? response()->json(['errors'  => $validator->errors()], 400)
                : back()
                    ->withInput()
                    ->withErrors($validator->errors())
                    ->with('error',"Gagal menyimpan data. Cek kembali data inputan Anda.");
        }

        $dataArray = array(
            'division_id'   => $request->division_id,
            'employee_id'   => $request->employee_id,
            'date_start'    => $request->date_start
        );

        $data = HistoryDivision::create($dataArray);

        return redirect()->route('historydivision.index')->with('success','Data Berhasil di Tambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HistoryDivision  $historyDivision
     * @return \Illuminate\Http\Response
     */
    public function show(HistoryDivision $historyDivision)
    {
        //
    }

    public function showData(User $employee)
    {
        $employee->with('HistoryDivision')->get();

        return view('admin.historydivision.show', compact('employee'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HistoryDivision  $historyDivision
     * @return \Illuminate\Http\Response
     */
    public function edit(HistoryDivision $historyDivision)
    {
        return view('admin.historydivision.index', compact('historyDivision'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HistoryDivision  $historyDivision
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HistoryDivision $historyDivision)
    {
        $validator = Validator::make($request->all(), [
            'employee_id'   => 'required',
            'division_id'   => 'required',
            'date_start'    => 'required'
        ]);

        if ($validator->fails()) {
            return $request->ajax()
                ? response()->json(['errors'  => $validator->errors()], 400)
                : back()
                    ->withInput()
                    ->withErrors($validator->errors())
                    ->with('error',"Gagal menyimpan data. Cek kembali data inputan Anda.");
        }

        $dataArray = array(
            'division_id'   => $request->division_id,
            'employee_id'   => $request->employee_id,
            'date_start'    => $request->date_start
        );

        $historyDivision->update($dataArray);

        return redirect()->route('historydivision.index')->with('success','Data Berhasil di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HistoryDivision  $historyDivision
     * @return \Illuminate\Http\Response
     */
    public function destroy(HistoryDivision $historyDivision)
    {
        $historyDivision->delete();
        $data = $historyDivision->employee_id;

        return redirect()->route('historydivision.show', $data)->with('error','Data Berhasil di Hapus');
    }
}
