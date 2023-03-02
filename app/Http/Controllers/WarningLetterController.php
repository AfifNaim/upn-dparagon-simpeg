<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use App\Models\WarningLetter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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
        $from           = date("Y-01-01");
        $to             = date("Y-12-31");
        $warningLatter  = WarningLetter::orderBy('id', 'desc')->get();

        return view('admin.warningletter.index', compact('from','to','warningLatter'));
    }

    public function searchLatter(Request $request)
    {
        $from               = $request->dari;
        $to                 = $request->ke;
        $warningLatter      = WarningLetter::orderBy('id', 'desc')->get();

        return view('admin.warningletter.index', compact('from','to','warningLatter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employee = Employee::pluck('name','id');
        
        return view('admin.warningletter.index', compact('employee'));
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
            'warning'       => $request->warning,
            'level'         => $request->level
        );

        $data = WarningLetter::create($dataArray);

        $employee       = Employee::find($data->employee_id);
        $month          = numberToRomanRepresentation(date('m'));
        $year           = date('Y');
        $lastIncreament = substr($data->id, -3);
        $letter_id      = str_pad($lastIncreament, 3, 0, STR_PAD_LEFT);
        $company        = Company::orderBy('id', 'desc')->first();

        $letter = [
            'employee'  => $employee,
            'warning'   => $data->warning,
            'date'      => date('Y-m-d'),
            'month'     => $month,
            'year'      => $year,
            'letter_id' => $letter_id,
            'company'   => $company,
        ];

        if ($data->level == 'I') {
            $pdf = PDF::loadView('admin.warningletter.letter_pdf', $letter)->setPaper('a4', 'potrait');;
        } elseif ($data->level == 'II') {
            $pdf = PDF::loadView('admin.warningletter.letter2_pdf', $letter)->setPaper('a4', 'potrait');;
        } elseif ($data->level == 'III') {
            $pdf = PDF::loadView('admin.warningletter.letter3_pdf', $letter)->setPaper('a4', 'potrait');;
        }

        $email["email"] = $employee->email;
        $email["title"] = 'SURAT PERINGATAN ';
        $email["body"] = 'PENERBITAN SURAT';
        $email["nama"] = $employee->name;

        try {
            Mail::send('emails.sendWarningLetter', $email, function ($message) use ($email, $pdf, $employee) {
                $message->to($email["email"], $email["email"])
                    ->subject($email["title"])->attachData($pdf->output(), "Surat-Peringatan-" . $employee->name . ".pdf");
            });

            return redirect()->route('warningletter.index')->with('success','Data Berhasil di Kirim');
        } catch (\Exception $ex) {

            $destoryletter = WarningLetter::find($data->id);
            $destoryletter->delete();
            
            return redirect()->route('warningletter.index')->with('error','Data Gagal di Kirim');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WarningLetter  $warningLetter
     * @return \Illuminate\Http\Response
     */
    public function show(WarningLetter $warningLetter)
    {

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

        $warning        = $warningLetter->warning;
        $employee_id    = $warningLetter->employee_id;
        $level          = $warningLetter->level;


        $employee       = Employee::find($employee_id);
        $month          = numberToRomanRepresentation(date('m', strtotime($warningLetter->date)));
        $year           = date('Y', strtotime($warningLetter->tanggal));
        $lastIncreament = substr($warningLetter->id, -3);
        $letter_id      = str_pad($lastIncreament, 3, 0, STR_PAD_LEFT);
        $company        = Company::orderBy('id', 'desc')->first();

        $data = [
            'employee'  => $employee,
            'warning'   => $warning,
            'date'      => date('Y-m-d', strtotime($warningLetter->date)),
            'month'     => $month,
            'year'      => $year,
            'letter_id' => $letter_id,
            'company'   => $company,

        ];

        if ($level == 'I') {
            $pdf = PDF::loadView('admin.warningletter.letter_pdf', $data)->setPaper('a4', 'potrait');;
        } elseif ($level == 'II') {
            $pdf = PDF::loadView('admin.warningletter.letter2_pdf', $data)->setPaper('a4', 'potrait');;
        } elseif ($level == 'III') {
            $pdf = PDF::loadView('admin.warningletter.letter3_pdf', $data)->setPaper('a4', 'potrait');;
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
    public function destroy(WarningLetter $warningLetter)
    {
        //
    }
}
