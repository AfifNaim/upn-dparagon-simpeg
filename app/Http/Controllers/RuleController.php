<?php

namespace App\Http\Controllers;

use App\Models\Rule;
use Illuminate\Http\Request;
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
        $id = Rule::latest('id')->pluck('id')->first();
        $rule = Rule::find($id);
        $all = Rule::orderBy('id', 'desc')->get();

        return view('admin.rule.index', compact('rule', 'all'));
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'time_in'                   => 'required',
            'time_out'                  => 'required',
            'total_yearly_leave'        => 'required',
            'total_big_leave'           => 'required',
            'total_important_leave'     => 'required',
            'total_sick_leave'          => 'required',
            'total_mass_leave'          => 'required',
            'total_maternity_leave'     => 'required',
            'monthly_leave_year_condition'  => 'required',
            'big_leave_year_condition'      => 'required'
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
            'time_in'                   => $request->time_in,
            'time_out'                  => $request->time_out,
            'total_yearly_leave'        => $request->total_yearly_leave,
            'total_big_leave'           => $request->total_big_leave,
            'total_important_leave'     => $request->total_important_leave,
            'total_sick_leave'          => $request->total_sick_leave,
            'total_mass_leave'          => $request->total_mass_leave,
            'total_maternity_leave'     => $request->total_maternity_leave,
            'monthly_leave_year_condition'  => $request->monthly_leave_year_condition,
            'big_leave_year_condition'      => $request->big_leave_year_condition
        );

        $data =  Rule::create($dataArray);

        return redirect()->route('rule.index')->with('success', 'Data Berhasil di Tambah');
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
        //
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

    public function timeIn(Request $request, Rule $rule)
    {
        $rule->time_in = $request->time_in;
        $rule->save();

        return redirect()->route('rule.index')->with('success', 'Data Berhasil di Ubah');
    }


    public function timeOut(Request $request, Rule $rule)
    {
        $rule->time_out = $request->time_out;
        $rule->save();

        return redirect()->route('rule.index')->with('success', 'Data Berhasil di Ubah');
    }


    public function yearlyLeave(Request $request, Rule $rule)
    {
        $rule->total_yearly_leave = $request->total_yearly_leave;
        $rule->save();

        return redirect()->route('rule.index')->with('success', 'Data Berhasil di Ubah');
    }



    public function bigLeave(Request $request, Rule $rule)
    {
        $rule->total_big_leave = $request->total_big_leave;
        $rule->save();

        return redirect()->route('rule.index')->with('success', 'Data Berhasil di Ubah');
    }


    public function importantLeave(Request $request, Rule $rule)
    {
        $rule->total_important_leave = $request->total_important_leave;
        $rule->save();

        return redirect()->route('rule.index')->with('success', 'Data Berhasil di Ubah');
    }


    public function sickLeave(Request $request, Rule $rule)
    {
        $rule->total_sick_leave = $request->total_sick_leave;
        $rule->save();

        return redirect()->route('rule.index')->with('success', 'Data Berhasil di Ubah');
    }


    public function massLeave(Request $request, Rule $rule)
    {
        $rule->total_mass_leave = $request->total_mass_leave;
        $rule->save();

        return redirect()->route('rule.index')->with('success', 'Data Berhasil di Ubah');
    }


    public function maternityLeave(Request $request, Rule $rule)
    {
        $rule->total_maternity_leave = $request->total_maternity_leave;
        $rule->save();

        return redirect()->route('rule.index')->with('success', 'Data Berhasil di Ubah');
    }

    public function yearlyCondition(Request $request, Rule $rule)
    {
        $rule->big_leave_year_condition = $request->big_leave_year_condition;
        $rule->save();

        return redirect()->route('rule.index')->with('success', 'Data Berhasil di Ubah');
    }


    public function monthlyCondition(Request $request, Rule $rule)
    {
        $rule->monthly_leave_year_condition = $request->monthly_leave_year_condition;
        $rule->save();

        return redirect()->route('rule.index')->with('success', 'Data Berhasil di Ubah');
    }
}
