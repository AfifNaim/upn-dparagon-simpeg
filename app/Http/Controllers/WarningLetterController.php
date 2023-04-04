<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use App\Models\WarningLetter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use PDF;

class WarningLetterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $warningLatter  = WarningLetter::latest()->paginate(10);

        return view('warningletter.index', compact('warningLatter'));
    }

    public function history()
    {
        $warningLatter  = WarningLetter::where('employee_id', Auth::user()->employee_id )->latest()->paginate(10);

        return view('warningletter.history', compact('warningLatter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employee = User::where('role', '!=' , "Admin")->get();

        return view('warningletter.create', compact('employee'));
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
            'warning'       => 'required'
        ]);

        if ($validator->fails()) {
            return $request->ajax()
                ? response()->json(['errors'  => $validator->errors()], 400)
                : back()
                    ->withInput()
                    ->withErrors($validator->errors())
                    ->with('error',"Gagal menyimpan data. Cek kembali data inputan Anda.");
        }

        function numberToRomanRepresentation($number)
        {
            $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
            $returnValue = '';
            while ($number > 0) {
                foreach ($map as $roman => $int) {
                    if ($number >= $int) {
                        $number -= $int;
                        $returnValue .= $roman;
                        break;
                    }
                }
            }
            return $returnValue;
        }


        $dataArray = array(
            'employee_id'   => $request->employee_id,
            'date'          => date('Y-m-d'),
            'warning'       => $request->warning,
            'level'         => $request->level
        );

        $data = WarningLetter::create($dataArray);

        $employee       = User::where('employee_id', $data->employee_id)->first();
        $month          = numberToRomanRepresentation(date('m'));
        $year           = date('Y');
        $lastIncreament = substr($data->id, -3);
        $letter_id      = str_pad($lastIncreament, 3, 0, STR_PAD_LEFT);
        $company        = Company::orderBy('id', 'desc')->first();
        $warning        = $request->warning;

        $letter = [
            'employee'  => $employee,
            'warning'   => $warning,
            'date'      => date('Y-m-d'),
            'month'     => $month,
            'year'      => $year,
            'letter_id' => $letter_id,
            'company'   => $company,
        ];

        if ($data->level == 'I') {
            $pdf = PDF::loadView('warningletter.letter_pdf', $letter)->setPaper('a4', 'potrait');;
        } elseif ($data->level == 'II') {
            $pdf = PDF::loadView('warningletter.letter2_pdf', $letter)->setPaper('a4', 'potrait');;
        } elseif ($data->level == 'III') {
            $pdf = PDF::loadView('warningletter.letter3_pdf', $letter)->setPaper('a4', 'potrait');;
        }

        $email["email"] = $employee->email;
        $email["title"] = 'SURAT PERINGATAN ';
        $email["body"] = 'PENERBITAN SURAT';
        $email["name"] = $employee->name;

        try {
            Mail::send('emails.sendWarningLetter', $email, function ($message) use ($email, $pdf, $employee) {
                $message->to($email["email"], $email["email"])
                    ->subject($email["title"])->attachData($pdf->output(), "Surat-Peringatan-" . $employee->name . ".pdf");
            });

            return redirect()->route(Auth::user()->role.'.warningletter.index')->with('success','Data Berhasil di Kirim');
        } catch (\Exception $ex) {

            $destoryletter = WarningLetter::find($data->id);
            $destoryletter->delete();
            return $ex;
            return redirect()->route(Auth::user()->role.'.warningletter.index')->with('error','Data Gagal di Kirim');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WarningLetter  $warningLetter
     * @return \Illuminate\Http\Response
     */
    public function show(WarningLetter $warningletter)
    {
        $warning        = $warningletter->warning;
        $employee_id    = $warningletter->employee_id;
        $level          = $warningletter->level;

        
        function numberToRomanRepresentation($number)
        {
            $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
            $returnValue = '';
            while ($number > 0) {
                foreach ($map as $roman => $int) {
                    if ($number >= $int) {
                        $number -= $int;
                        $returnValue .= $roman;
                        break;
                    }
                }
            }
            return $returnValue;
        }

        $employee       = User::where('employee_id', $employee_id)->first();
        $month          = numberToRomanRepresentation(date('m', strtotime($warningletter->date)));
        $year           = date('Y', strtotime($warningletter->date));
        $lastIncreament = substr($warningletter->id, -3);
        $letter_id      = str_pad($lastIncreament, 3, 0, STR_PAD_LEFT);
        $company        = Company::orderBy('id', 'desc')->first();

        $data = [
            'employee'  => $employee,
            'warning'   => $warning,
            'date'      => date('Y-m-d', strtotime($warningletter->date)),
            'month'     => $month,
            'year'      => $year,
            'letter_id' => $letter_id,
            'company'   => $company,

        ];

        if ($level == 'I') {
            $pdf = PDF::loadView('warningletter.letter_pdf', $data)->setPaper('a4', 'potrait');;
        } elseif ($level == 'II') {
            $pdf = PDF::loadView('warningletter.letter2_pdf', $data)->setPaper('a4', 'potrait');;
        } elseif ($level == 'III') {
            $pdf = PDF::loadView('warningletter.letter3_pdf', $data)->setPaper('a4', 'potrait');;
        }

        return $pdf->stream('pdf_file.pdf', array('Attachment' => 0));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WarningLetter  $warningLetter
     * @return \Illuminate\Http\Response
     */
    public function edit(WarningLetter $warningLetter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WarningLetter  $warningLetter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WarningLetter $warningLetter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WarningLetter  $warningLetter
     * @return \Illuminate\Http\Response
     */
    public function destroy(WarningLetter $warningletter)
    {
        $warningletter->delete();

        return redirect()->route(Auth::user()->role.'.warningletter.index')->with('success','Data Berhasil di Dihapus');
    }

}
