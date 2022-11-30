<?php

namespace App\Http\Controllers\Patient\Documents;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use PDF;

class PrescriptionController extends Controller
{
    public function index(){

        $pres = DB::table('forms as f')
            ->where('f.form_patient_id', Session('user_id'))
            ->leftjoin('accounts as a', 'f.form_created_by', 'a.acc_id')
            ->leftjoin('title as ttl', 'a.title', 'ttl.ttl_id')
            ->get();         

        return view('Patient.Documents.Prescription')
            ->with([
                'pres' => $pres
            ]);
    }

    public function print($id){

        $pres = DB::table('prescription as p')
            ->select('f.*', 'p.*', 
            'a.firstname as pfn', 'a.middlename as pmn', 'a.lastname as pln',
            'a.gender as pg', 'a.civil_status', 'a.birthdate',
            't.ttl_title as dt',
            'b.firstname as dfn', 'b.middlename as dmn', 'b.lastname as dln', 'b.signature as ds', 'b.license_no as dlicense'
            )
            ->where('f.form_id', $id)
            ->leftjoin('forms as f', 'p.pres_id', 'f.form_org_id')
            ->leftjoin('accounts as a', 'f.form_patient_id', 'a.acc_id')
            ->leftjoin('accounts as b', 'f.form_created_by', 'b.acc_id')
            ->leftjoin('title as t', 'b.title', 't.ttl_id')
            ->first();

        $filename = 'Prescription_'.$id;
        $pdf = PDF::loadView('Reports.Forms.Prescription', compact('pres', 'filename'));
        $pdf->setPaper('letter', 'portrait');
        
        return $pdf->stream($filename);
    }
    
}
