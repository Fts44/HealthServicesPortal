<?php

namespace App\Http\Controllers\Forms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;
use PDF;

class PrescriptionController extends Controller
{
    public function insert(Request $request, $id){

        $rules = [
            'pres_date' => ['required', 'date'],
            'pres_body' => ['required']
        ];

        $messages = [
            'pres_date.required' => 'The date is required',
            'pres_body.required' => 'The prescription body is required'
        ];

        $validator = validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            $response = [
                'title' => 'Error!',
                'message' => 'Prescription not added.',
                'icon' => 'error',
                'status' => 400,
                'errors' => $validator->messages()
            ];    
        }
        else{

            try{
                $pres_id = DB::table('prescription')->insertGetId([
                    'pres_body' => $request->pres_body
                ]);

                DB::table('forms')->insert([
                    'form_date_created' => $request->pres_date,
                    'form_created_by' => Session('user_id'),
                    'form_patient_id' => $id,
                    'form_editable' => 1,
                    'form_org_id' => $pres_id,
                    'form_type' => 'Prescription'
                ]);

                $response = [
                    'title' => 'Success!',
                    'message' => 'Prescription added.',
                    'icon' => 'success',
                    'status' => 200
                ];  
            }
            catch(Exception $e){
                $response = [
                    'title' => 'Error!',
                    'message' => 'Prescription not added.'.$e,
                    'icon' => 'error',
                    'status' => 400
                ];    
            }
        }
        echo json_encode($response);
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

    public function delete($id){
        try{
            $form = DB::table('forms')->where('form_id', $id)->first();

            if($form){
                DB::table('forms')->where('form_id', $id)->delete();
                DB::table('prescription')->where('pres_id', $form->form_org_id)->delete();
            }
            
            $response = [
                'title' => 'Success!',
                'message' => 'Student Health Record deleted.',
                'icon' => 'success',
                'status' => 200,
            ];
        }
        catch(Exception $e){
            $response = [
                'title' => 'Failed!',
                'message' => 'Server Error, Student Health Record not deleted.',
                'icon' => 'error',
                'status' => 400,
            ];
        }
        return redirect()->back()->with('status', $response);
    }

    public function retrieve($id){
        try{
            $form = DB::table('forms')
                ->where('form_id', $id)
                ->first();

            if($form){
                $pres = DB::table('prescription as p')
                    ->select('f.*', 'p.*', 
                    'a.firstname as pfn', 'a.middlename as pmn', 'a.lastname as pln',
                    'a.gender as pg', 'a.civil_status', 'a.birthdate',
                    't.ttl_title as dt',
                    'b.firstname as dfn', 'b.middlename as dmn', 'b.lastname as dln'
                    )
                    ->where('f.form_id', $id)
                    ->leftjoin('forms as f', 'p.pres_id', 'f.form_org_id')
                    ->leftjoin('accounts as a', 'f.form_patient_id', 'a.acc_id')
                    ->leftjoin('accounts as b', 'f.form_created_by', 'b.acc_id')
                    ->leftjoin('title as t', 'b.title', 't.ttl_id')
                    ->first();
            }
            
            $response = $pres;
        }
        catch(Exception $e){
            $response = [
                'title' => 'Failed!',
                'message' => 'Server Error, Prescription cant retrieve.',
                'icon' => 'error',
                'status' => 400,
            ];
        }
        echo json_encode($response);
    }

    public function update(Request $request, $id){

        $rules = [
            'pres_date' => ['required', 'date'],
            'pres_body' => ['required']
        ];

        $messages = [
            'pres_date.required' => 'The date is required',
            'pres_body.required' => 'The prescription body is required'
        ];

        $validator = validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            $response = [
                'title' => 'Error!',
                'message' => 'Prescription not added.',
                'icon' => 'error',
                'status' => 400,
                'errors' => $validator->messages()
            ];    
        }
        else{

            try{
                $form = DB::table('forms')->where('form_id', $id)->first();
                
                DB::table('forms')->where('form_id', $id)
                    ->update([
                        'form_date_created' => $request->pres_date
                    ]);

                DB::table('prescription')->where('pres_id', $form->form_org_id)
                    ->update([
                        'pres_body' => $request->pres_body
                    ]);
                $response = [
                    'title' => 'Success!',
                    'message' => 'Prescription updated.',
                    'icon' => 'success',
                    'status' => 200
                ];  
            }
            catch(Exception $e){
                $response = [
                    'title' => 'Error!',
                    'message' => 'Prescription not added.'.$e,
                    'icon' => 'error',
                    'status' => 400
                ];    
            }
        }
        echo json_encode($response);
    }
}
