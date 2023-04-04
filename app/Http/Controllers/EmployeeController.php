<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\HistoryDivision;
use App\Models\HistoryPosition;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Auth;
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
        if(Auth::user()->role != "Admin")
        {
            $employee   = User::where('role', '!=' ,"Admin")->paginate(10);

            return view('user.index', compact('employee'));
        } else {
            $employee   = User::paginate(10);

            return view('user.index', compact('employee'));
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $position       = Position::all();
        $division       = Division::all();

        return view('user.create', compact('position','division'));
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
            'email'             => 'required|unique:users,email',
            'nik'               => 'required|unique:users,nik',
            'name'              => 'required|unique:users,name',
            'gender'            => 'required',
            'religion'          => 'required',
            'birth_place'       => 'required',
            'birth_date'        => 'required',
            'address'           => 'required',
            'residence_address' => 'required',
            'status'            => 'required',
            'child'             => 'nullable',
            'phone'             => 'required',
            'position_id'       => 'required',
            'division_id'       => 'required',
            'date_in'           => 'required'
        ]);

        if ($validator->fails()) {
            return $request->ajax()
                ? response()->json(['errors'  => $validator->errors()], 400)
                : back()
                    ->withInput()
                    ->withErrors($validator->errors())
                    ->with('error',"Gagal menyimpan data. Cek kembali data inputan Anda.");
        }

        $id                 = IdGenerator::generate(['table' => 'users', 'length' => 8, 'prefix' => date('ym')]);
        $password           = bcrypt("$request->nik");

        $historyPosition    = HistoryPosition::where('employee_id', $id)
            ->where('position_id', $request->position_id)
            ->count();

        $historyDivision    = HistoryDivision::where('employee_id', $id)
            ->where('division_id', $request->division_id)
            ->count();

        $employeeArray = array(
            'employee_id'       => $id,
            'email'             => $request->email,
            'password'          => bcrypt($request->nik),
            'role'              => $request->role,
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
            'date_in'           => $request->date_in
        );

        $employee = User::create($employeeArray);

        if ($historyPosition == 0) {

            HistoryPosition::create([
                'employee_id'   => $id,
                'position_id'   => $request->position_id,
                'date_start'    => $request->date_in
            ]);
        }
        if ($historyDivision == 0) {

            HistoryDivision::create([
                'employee_id'   => $id,
                'division_id'   => $request->position_id,
                'date_start'    => $request->date_in,
            ]);
        }

        return redirect()->route(Auth::user()->role.'.employee.index')->with('success', 'Data Berhasil di Tambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(User $employee)
    {
        $historyPosition = HistoryPosition::where('employee_id', $employee->employee_id)
            ->orderBy('id')
            ->get();
        $historyDivision = HistoryDivision::where('employee_id', $employee->employee_id)
            ->orderBy('id')
            ->get();

        return view('user.show', compact('employee','historyPosition','historyDivision'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(User $employee)
    {
        $position   = Position::all();
        $division   = Division::all();

        return view('user.edit', compact('employee','position','division'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $employee)
    {
        $historyPosition = HistoryPosition::where('employee_id', $employee->employee_id)
            ->where('position_id', $request->position_id)
            ->count();

        $historyDivision = HistoryDivision::where('employee_id', $employee->employee_id)
            ->where('division_id', $request->devision_id)
            ->count();

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
            'date_in'           => 'required'
        ]);

        if ($validator->fails()) {
            return $request->ajax()
                ? response()->json(['errors'  => $validator->errors()], 400)
                : back()
                    ->withInput()
                    ->withErrors($validator->errors())
                    ->with('error',"Gagal menyimpan data. Cek kembali data inputan Anda.");
        }

            $employeeArray = array(
                'role'             => $request->role,
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

            if ($historyPosition == 0) {

                HistoryPosition::create([
                    'employee_id'   => $employee->employee_id,
                    'position_id'   => $request->position_id,
                    'date_start'    => date("Y-m-d"),
                ]);
            }
            if ($historyDivision == 0) {

                HistoryDivision::create([
                    'employee_id'   => $employee->employee_id,
                    'division_id'   => $request->division_id,
                    'date_start'    => date("Y-m-d"),
                ]);
            }
        return redirect()->route(Auth::user()->role.'.employee.index')->with('success', 'Data Berhasil di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $employee)
    {
        $employee->delete();

        return redirect()->route(Auth::user()->role.'.employee.index')->with('error', 'Data Berhasil di Hapus');
    }

    public function profile()
    {
        $employee = Auth::user();

        return view('user.profile', compact('employee'));
    }

    public function saveProfile(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
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
        ]);

        if ($validator->fails()) {
            return $request->ajax()
                ? response()->json(['errors'  => $validator->errors()], 400)
                : back()
                    ->withInput()
                    ->withErrors($validator->errors())
                    ->with('error',"Gagal menyimpan data. Cek kembali data inputan Anda.");
        }

        $employee = User::find($id);

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
        );

            $employee->update($employeeArray);

        return view('user.profile', compact('employee'));
    }

    public function reset(User $user)
    {
        $user->password = bcrypt('123456');
        $user->save();

        return redirect()->route(Auth::user()->role.'.employee.index')->with('success', 'Password Berhasil di Reset');
    }
}
