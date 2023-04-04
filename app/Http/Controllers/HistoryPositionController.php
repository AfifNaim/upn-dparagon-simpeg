<?php

namespace App\Http\Controllers;

use App\Models\HistoryPosition;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HistoryPositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = User::all();

        return view('admin.historyPosition.index', with('employee'));
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
        $position     = Position::pluck('name', 'id');

        return view('admin.historyposition.create', compact('employee','position'));
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
            'position_id'   => 'required',
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
            'position_id'   => $request->position_id,
            'employee_id'   => $request->employee_id,
            'date_start'    => $request->date_start
        );

        $data = HistoryPosition::create($dataArray);

        return redirect()->route('historyposition.index')->with('success','Data Berhasil di Tambah');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HistoryPosition  $historyPosition
     * @return \Illuminate\Http\Response
     */
    public function show(HistoryPosition $historyPosition)
    {
        //
    }

    public function showData(User $employee)
    {
        $employee->with('HistoryPosition')->get();

        return view('admin.historyposition.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HistoryPosition  $historyPosition
     * @return \Illuminate\Http\Response
     */
    public function edit(HistoryPosition $historyPosition)
    {
        return view('admin.historyposition.index', compact('historyPosition'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HistoryPosition  $historyPosition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HistoryPosition $historyPosition)
    {
        $validator = Validator::make($request->all(), [
            'employee_id'   => 'required',
            'position_id'   => 'required',
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
            'position_id'   => $request->position_id,
            'employee_id'   => $request->employee_id,
            'date_start'    => $request->date_start
        );

        $historyPosition->update($dataArray);

        return redirect()->route('historyposition.index')->with('success','Data Berhasil di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HistoryPosition  $historyPosition
     * @return \Illuminate\Http\Response
     */
    public function destroy(HistoryPosition $historyPosition)
    {
        $historyPosition->delete();
        $data = $historyPosition->employee_id;

        return redirect()->route('historyposition.show', $data)->with('error','Data Berhasil di Hapus');
    }
}
