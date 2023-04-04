<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = Company::orderBy('id')->first();

        if (empty($company)){

            return view('company.create');    
        } else {
            return view('company.index', compact('company'));
        }

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
            'name'          => 'required',
            'address'       => 'required',
            'city'          => 'required',
            'phone'         => 'required',
            'public_email'  => 'required',
            'path_logo'     => 'required|mimes:jpeg,png,jpg,gif,svg|file|max:5000'
        ]);

        if ($validator->fails()) {
            return $request->ajax()
                ? response()->json(['errors'  => $validator->errors()], 400)
                : back()
                    ->withInput()
                    ->withErrors($validator->errors())
                    ->with('error',"Gagal menyimpan data. Cek kembali data inputan Anda.");
        }

        $extension = $request->file('path_logo')->extension();
        $imgname = 'logo_' . date('dmyHi') . '.' . $extension;
        $path = Storage::putFileAs('public/images', $request->file('path_logo'), $imgname);

        $arrayData = array(
            'name'          => $request->name,
            'address'       => $request->address,
            'city'          => $request->city,
            'phone'         => $request->phone,
            'public_email'  => $request->public_email,
            'path_logo'     => $imgname
        );

        $data = Company::create($arrayData);

        return redirect()->route('home')->with('success','Data Berhasil di Tambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        if ($request->hasFile('path_logo')) {

            $extension  = $request->file('path_logo')->extension();
            $imgname    = 'logo_' . date('dmyHi') . '.' . $extension;

            $path   = Storage::putFileAs('public/images', $request->file('path_logo'), $imgname);
            $delete = Storage::delete('public/images/' . $request->old_logo);

            $arrayData = array(
                'name'          => $request->name,
                'address'       => $request->address,
                'city'          => $request->city,
                'phone'         => $request->phone,
                'public_email'  => $request->public_email,
                'path_logo'     => $imgname
            );

            $company->update($arrayData);

            return redirect()->route(Auth::user()->role.'.company.index')->with('success','Data Berhasil di Ubah');

        } else {

            $arrayData = array(
                'name'          => $request->name,
                'address'       => $request->address,
                'city'          => $request->city,
                'phone'         => $request->phone,
                'public_email'  => $request->public_email,
            );

            $company->update($arrayData);

            return redirect()->route(Auth::user()->role.'.company.index')->with('success','Data Berhasil di Ubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        //
    }
}
