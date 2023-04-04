<?php

namespace App\Http\Controllers;

use App\Models\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rule = Rule::latest()->first();

        if(!empty($rule)){
            return view('rule.index', compact('rule'));
        }
        return view('rule.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rule.create');
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
            'time_in'                       => 'required',
            'time_out'                      => 'required',
            'total_yearly_leave'            => 'required',
            'total_big_leave'               => 'required',
            'total_important_leave'         => 'required',
            'total_sick_leave'              => 'required',
            'total_mass_leave'              => 'required',
            'total_maternity_leave'         => 'required',
            'monthly_leave_year_conditions' => 'required',
            'big_month_leave_conditions'    => 'required'
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
            'time_in'                       => $request->time_in,
            'time_out'                      => $request->time_out,
            'total_yearly_leave'            => $request->total_yearly_leave,
            'total_big_leave'               => $request->total_big_leave,
            'total_important_leave'         => $request->total_important_leave,
            'total_sick_leave'              => $request->total_sick_leave,
            'total_mass_leave'              => $request->total_mass_leave,
            'total_maternity_leave'         => $request->total_maternity_leave,
            'monthly_leave_year_conditions' => $request->monthly_leave_year_conditions,
            'big_month_leave_conditions'    => $request->big_month_leave_conditions
        );

        $data =  Rule::updateOrCreate($dataArray);
        
        return redirect()->route(Auth::user()->role.'.rule.index')->with('success', 'Data Berhasil di Tambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rule  $rule
     * @return \Illuminate\Http\Response
     */
    public function show(Rule $rule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rule  $rule
     * @return \Illuminate\Http\Response
     */
    public function edit(Rule $rule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rule  $rule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rule $rule)
    {
        $validator = Validator::make($request->all(), [
            'time_in'                       => 'required',
            'time_out'                      => 'required',
            'total_yearly_leave'            => 'required',
            'total_big_leave'               => 'required',
            'total_important_leave'         => 'required',
            'total_sick_leave'              => 'required',
            'total_mass_leave'              => 'required',
            'total_maternity_leave'         => 'required',
            'monthly_leave_year_conditions' => 'required',
            'big_month_leave_conditions'    => 'required'
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
            'time_in'                       => $request->time_in,
            'time_out'                      => $request->time_out,
            'total_yearly_leave'            => $request->total_yearly_leave,
            'total_big_leave'               => $request->total_big_leave,
            'total_important_leave'         => $request->total_important_leave,
            'total_sick_leave'              => $request->total_sick_leave,
            'total_mass_leave'              => $request->total_mass_leave,
            'total_maternity_leave'         => $request->total_maternity_leave,
            'monthly_leave_year_conditions' => $request->monthly_leave_year_conditions,
            'big_month_leave_conditions'    => $request->big_month_leave_conditions
        );

        $rule->update($dataArray);

        return redirect()->route(Auth::user()->role.'.rule.index')->with('success', 'Data Berhasil di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rule  $rule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rule $rule)
    {
        //
    }
}
