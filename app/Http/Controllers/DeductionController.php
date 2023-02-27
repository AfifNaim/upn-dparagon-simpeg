<?php

namespace App\Http\Controllers;

use App\Models\Deduction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DeductionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deduction = Deduction::all();

        return view('admin.deduction.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.deduction.create');
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
            'name'      => 'required',
            'amount'    => 'required',
        ]);

        if ($validator->fails()) {
            return $request->ajax()
                ? response()->json(['errors'  => $validator->errors()], 400)
                : back()
                    ->withInput()
                    ->withErrors($validator->errors())
                    ->with('error',"Gagal menyimpan data. Cek kembali data inputan Anda.");
        }

        $rupiah_string = $request->amount;
        $amount_string = preg_replace("/[^0-9]/", "", $rupiah_string);
        $amount = (int) $amount_string;

        $dataArray = array(
            'name'      => $request->name,
            'amount'    => $amount
        );

        $data = Deduction::create($dataArray);

        return redirect()->route('deduction.index')->with('success','Data Berhasil di Tambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Deduction  $deduction
     * @return \Illuminate\Http\Response
     */
    public function show(Deduction $deduction)
    {
        return view('admin.deduction.show', compact('deduction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Deduction  $deduction
     * @return \Illuminate\Http\Response
     */
    public function edit(Deduction $deduction)
    {
        return view('admin.deduction.edit', compact('deduction'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Deduction  $deduction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Deduction $deduction)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'amount'    => 'required',
        ]);

        if ($validator->fails()) {
            return $request->ajax()
                ? response()->json(['errors'  => $validator->errors()], 400)
                : back()
                    ->withInput()
                    ->withErrors($validator->errors())
                    ->with('error',"Gagal menyimpan data. Cek kembali data inputan Anda.");
        }

        $rupiah_string = $request->amount;
        $amount_string = preg_replace("/[^0-9]/", "", $rupiah_string);
        $amount = (int) $amount_string;

        $dataArray = array(
            'name'      => $request->name,
            'amount'    => $amount
        );

        $deduction->update($dataArray);

        return redirect()->route('deduction.index')->with('success','Data Berhasil di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Deduction  $deduction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deduction $deduction)
    {
        $deduction->delete();

        return redirect()->route('deduction')->with('error', 'Data Berhasil di Hapus');
    }

    public function isActive(Request $request, Deduction $deduction)
    {
        $deduction->is_active = $request->is_active;
        $deduction->save();

        return redirect()->route('deduction')->with('success', 'Data'.$deduction->name.'Berhasil di Aktifkan');
    }
    
    public function isShown(Request $request, Deduction $deduction)
    {
        $deduction->is_shown = $request->is_shown;
        $deduction->save();

        return redirect()->route('deduction')->with('success', 'Data'.$deduction->name.'Berhasil di Tampilkan');
    }
}
