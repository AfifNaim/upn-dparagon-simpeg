<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Employee;
use App\Models\HistoryDivision;
use App\Models\HistoryPosition;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = Employee::all();

        return view('admin.employee.index', compact('employee'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $position       = Position::pluck('name', 'id');
        $division       = Division::pluck('name', 'id');
        $employee       = Employee::pluck('name', 'id');

        return view('admin.pegawai.create', compact('position','division','employee'));
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
            'role'              => 'required',
            'nik'               => 'required',
            'name'              => 'required',
            'gender'            => 'required',
            'religion'          => 'required',
            'birth_place'       => 'required',
            'birth_date'        => 'required',
            'address'           => 'required',
            'residence_address' => 'required',
            'status'            => 'required',
            'child'             => 'required',
            'phone'             => 'required',
            'position_id'       => 'required',
            'division_id'       => 'required',
            'date_in'           => 'required',
            'image'             => 'required|mimes:jpeg,png,jpg,gif,svg|file|max:5000'
        ]);

        if ($validator->fails()) {
            return $request->ajax()
                ? response()->json(['errors'  => $validator->errors()], 400)
                : back()
                    ->withInput()
                    ->withErrors($validator->errors())
                    ->with('error',"Gagal menyimpan data. Cek kembali data inputan Anda.");
        }
        
        DB::beginTransaction();
        try {

        $extension          = $request->file('image')->extension();
        $imgname            = $request->nik . '_' . date('dmyHi') . '.' . $extension;
        $path               = Storage::putFileAs('public/images', $request->file('imgupload'), $imgname);
        $id                 = IdGenerator::generate(['table' => 'employee', 'length' => 8, 'prefix' => date('ym')]);
        $password           = bcrypt("$request->nik");
        $historyPosition    = HistoryPosition::where('employee_id', $id)
            ->where('position_id', $request->position_id)
            ->count();

        $historyDivision    = HistoryDivision::where('employee_id', $id)
            ->where('division_id', $request->division_id)
            ->count();

        $employeeArray = array(
            'id'                => $id,
            'nik'               => $request->nik,
            'name'              => $request->name,
            'gender'            => $request->gender,
            'religion'          => $request->religion,
            'birth_place'       => $request->birth_place,
            'birth_date'        => $request->birth_date,
            'address'           => $request->address,
            'residence_address' => $request->residence_address,
            'status'            => $request->status,
            'child'             => $request->child,
            'phone'             => $request->phone,
            'position_id'       => $request->position_id,
            'division_id'       => $request->division_id,
            'date_in'           => $request->date_in,
            'path'              => $path
        );

        $employee = Employee::create($employeeArray);

        $userArray = array(
            'email'            => $request->email,
            'name'             => $request->name,
            'password'         => $password,
            'role'             => $request->role
        );

        $user = User::create($userArray);

        if ($historyPosition == 0) {

            HistoryPosition::create([
                'employee_id'   => $id,
                'position_id'   => $request->position_id,
                'date_start'    => $request->date_start
            ]);
        }
        if ($historyPosition == 0) {

            HistoryDivision::create([
                'employee_id'   => $id,
                'division_id'   => $request->position_id,
                'date_start'    => $request->date_start,
            ]);
        }

        DB::commit();
        return redirect()->route('admin.employee.index')->with('success', 'Data Berhasil di Tambah');
    
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
            return redirect()->route('admin.employee.index')->with('error', 'Data Gagal di Tambah');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {

        $historyPosition = HistoryPosition::where('id_pegawai', $employee->id)
            ->orderBy('id')
            ->get();
        $historyDivision = HistoryDivision::where('id_pegawai', $employee->id)
            ->orderBy('id')
            ->get();

        return view('admin.employee.show', compact('employee','historyPosition','historyDivision'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $position   = Position::pluck('nm_jabatan', 'id');
        $division   = Division::pluck('nm_divisi', 'id');
        $manager    = Employee::pluck('nama', 'id');

        return view('admin.employee.edit', compact('employee','position','division'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $user = User::where('employee_id', $employee->id)->first();

        $historyPosition = HistoryPosition::where('employee_id', $employee->id)
            ->where('position_id', $request->position_id)
            ->count();

        $historyDivision = HistoryDivision::where('employee_id', $employee->id)
            ->where('division_id', $request->devision_id)
            ->count();

        if ($request->hasFile('image')) {

            $extension  = $request->file('image')->extension();
            $imgname    = $request->nik . '_' . date('dmyHi') . '.' . $extension;
            $validator = Validator::make($request->all(), [
                'role'              => 'required',
                'nik'               => 'required',
                'name'              => 'required',
                'gender'            => 'required',
                'religion'          => 'required',
                'birth_place'       => 'required',
                'birth_date'        => 'required',
                'address'           => 'required',
                'residence_address' => 'required',
                'status'            => 'required',
                'child'             => 'required',
                'phone'             => 'required',
                'position_id'       => 'required',
                'division_id'       => 'required',
                'date_in'           => 'required',
                'image'             => 'required|mimes:jpeg,png,jpg,gif,svg|file|max:5000'
            ]);

            if ($validator->fails()) {
                return $request->ajax()
                    ? response()->json(['errors'  => $validator->errors()], 400)
                    : back()
                        ->withInput()
                        ->withErrors($validator->errors())
                        ->with('error',"Gagal menyimpan data. Cek kembali data inputan Anda.");
            }

                DB::beginTransaction();
                try {

                    $path = Storage::putFileAs('public/images', $request->file('image'), $imgname);

                    $employeeArray = array(
                        'nik'               => $request->nik,
                        'name'              => $request->name,
                        'gender'            => $request->gender,
                        'religion'          => $request->religion,
                        'birth_place'       => $request->birth_place,
                        'birth_date'        => $request->birth_date,
                        'address'           => $request->address,
                        'residence_address' => $request->residence_address,
                        'status'            => $request->status,
                        'child'             => $request->child,
                        'phone'             => $request->phone,
                        'position_id'       => $request->position_id,
                        'division_id'       => $request->division_id,
                        'date_in'           => $request->date_in,
                        'path'              => $path
                    );
            
                    $employee->update($employeeArray);
            
                    $userArray = array(
                        'email'            => $request->email,
                        'name'             => $request->name,
                        'role'             => $request->role
                    );
            
                    $user->update($userArray);

                    if ($historyPosition == 0) {

                        HistoryPosition::create([
                            'employee_id'   => $employee->id,
                            'position_id'   => $request->position_id,
                            'date_start'    => date("Y-m-d"),
                        ]);
                    }
                    if ($historyDivision == 0) {

                        HistoryPosition::create([
                            'employee_id'   => $emplotee->id,
                            'division_id'   => $request->division_id,
                            'date_start'    => date("Y-m-d"),
                        ]);
                    }

                    DB::commit();
                    return redirect()->route('admin.employee.index')->with('success', 'Data Berhasil di Ubah');
                
                } catch (\Throwable $th) {
                    DB::rollBack();
                    throw $th;
                    return redirect()->route('admin.employee.index')->with('error', 'Data Gagal di Ubah');
                }

            } else {

                $validator = Validator::make($request->all(), [
                    'role'              => 'required',
                    'nik'               => 'required',
                    'name'              => 'required',
                    'gender'            => 'required',
                    'religion'          => 'required',
                    'birth_place'       => 'required',
                    'birth_date'        => 'required',
                    'address'           => 'required',
                    'residence_address' => 'required',
                    'status'            => 'required',
                    'child'             => 'required',
                    'phone'             => 'required',
                    'position_id'       => 'required',
                    'division_id'       => 'required',
                    'date_in'           => 'required',
                    'image'             => 'required|mimes:jpeg,png,jpg,gif,svg|file|max:5000'
                ]);

                DB::beginTransaction();
                try {
                    $employeeArray = array(
                        'nik'               => $request->nik,
                        'name'              => $request->name,
                        'gender'            => $request->gender,
                        'religion'          => $request->religion,
                        'birth_place'       => $request->birth_place,
                        'birth_date'        => $request->birth_date,
                        'address'           => $request->address,
                        'residence_address' => $request->residence_address,
                        'status'            => $request->status,
                        'child'             => $request->child,
                        'phone'             => $request->phone,
                        'position_id'       => $request->position_id,
                        'division_id'       => $request->division_id,
                        'date_in'           => $request->date_in,
                    );
            
                    $employee->update($employeeArray);
            
                    $userArray = array(
                        'email'            => $request->email,
                        'name'             => $request->name,
                        'role'             => $request->role
                    );
            
                    $user->update($userArray);

                    if ($historyPosition == 0) {

                        HistoryPosition::create([
                            'employee_id'   => $employee->id,
                            'position_id'   => $request->position_id,
                            'date_start'    => date("Y-m-d"),
                        ]);
                    }
                    if ($historyDivision == 0) {

                        HistoryPosition::create([
                            'employee_id'   => $emplotee->id,
                            'division_id'   => $request->division_id,
                            'date_start'    => date("Y-m-d"),
                        ]);
                    }

                    DB::commit();
                    return redirect()->route('admin.employee.index')->with('success', 'Data Berhasil di Ubah');
                
                } catch (\Throwable $th) {
                    DB::rollBack();
                    throw $th;
                    return redirect()->route('admin.employee.index')->with('error', 'Data Gagal di Ubah');
                }

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('admin.employee.index')->with('error', 'Data Berhasil di Hapus');
    }

    public function trash()
    {
        $employee = Employee::onlyTrashed()->get();

        return view('admin.employee.resigned', compact('emoloyee'));
    }

    public function restore(Employee $employee)
    {
        $pegawai->restore();

        return redirect()->route('admin.employee.trash')->with('success', 'Data Berhasil di Ubah');
    }

    public function destroyPermanent(Employee $employee)
    {
        $pegawai->forceDelete();

        return redirect()->route('admin.employee.trash')->with('error', 'Data Berhasil di Hapus');
    }
}
