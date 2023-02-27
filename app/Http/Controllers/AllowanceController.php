<?php

namespace App\Http\Controllers;

use App\Models\Allowance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AllowanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allowance = Allowance::all();

        return view('admin.allowance', compact('allowance'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.allowance.create');
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

        $data = Allowance::create($dataArray);

        return redirect()->route('allowance.index')->with('success','Data Berhasil di Tambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Allowance  $allowance
     * @return \Illuminate\Http\Response
     */
    public function show(Allowance $allowance)
    {
        return view('admin.allowance.show', compact('allowance'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Allowance  $allowance
     * @return \Illuminate\Http\Response
     */
    public function edit(Allowance $allowance)
    {
        return view('admin.allowance.edit', compact('allowance'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Allowance  $allowance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Allowance $allowance)
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

        $allowance->update($dataArray);

        return redirect()->route('allowance.index')->with('success','Data Berhasil di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Allowance  $allowance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Allowance $allowance)
    {
        $allowance->delete();

        return redirect()->route('allowance.index')->with('error','Data Berhasil di Hapus');
    }

    public function isActive(Request $request, Allowance $allowance)
    {
        $allowance->is_active = $request->is_active;
        $allowance->save();

        return redirect()->route('allowance')->with('success', 'Data'.$allowance->name.'Berhasil di Aktifkan');
    }
    
    public function isShown(Request $request, Allowance $allowance)
    {
        $allowance->is_shown = $request->is_shown;
        $allowance->save();

        return redirect()->route('allowance')->with('success', 'Data'.$allowance->name.'Berhasil di Tampilkan');
    }
}
