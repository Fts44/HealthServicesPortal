<?php

namespace App\Http\Controllers\Forms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;
use PDF;

class ConsultationController extends Controller
{
    public function insert(Request $request, $id){
        $rules = [
            'cnslt_chief_complain' => ['required'],
            'cnslt_program_office' => ['required'],
            'cnslt_nnotes' => ['required_without:cnslt_dnotes'],
            'cnslt_dnotes' => ['required_without:cnslt_nnotes'],
            'cnslt_bp' => ['required'],
            'cnslt_temp' => ['required'],
            'cnslt_hr' => ['required'],
            'cnslt_oxygen_level' => ['required'],
            'cnslt_diagnosis' => ['required'],
        ];

        $validator = validator::make($request->all(), $rules);

        if($validator->fails()){

            $response = [
                'title' => 'Error!',
                'message' => 'Consultation form not added.',
                'icon' => 'error',
                'status' => 400,
                'errors' => $validator->messages()
            ];    
        }
        else{
            try{

                $cnslt = DB::table('consultation')->insertGetId([
                    'cnslt_patient_id' => $id ,
                    'cnslt_physician_id' => Session('user_id'),
                    'cnslt_program_office' => $request->cnslt_program_office,
                    'cnslt_nnotes' => $request->cnslt_nnotes ,
                    'cnslt_dnotes' => $request->cnslt_dnotes ,
                    'cnslt_bp' => $request->cnslt_bp ,
                    'cnslt_hr' => $request->cnslt_hr ,
                    'cnslt_temp' => $request->cnslt_temp ,
                    'cnslt_ol' => $request->cnslt_oxygen_level ,
                    'cnslt_diagnosis' => $request->cnslt_diagnosis ,
                ]);

                DB::table("forms")->insert([
                    "form_date_created" => date("Y-m-d"),
                    "form_date_updated"	=> NULL,
                    "form_created_by" =>  Session('user_id'),
                    "form_patient_id" =>  $id,
                    "form_editable" => 1,
                    "form_type" => 'CNSLT',
                    "form_org_id" => $cnslt
                ]);

                $response = [
                    'title' => 'Success!',
                    'message' => 'Consultation form added.',
                    'icon' => 'success',
                    'status' => 200
                ];  
            }
            catch(Exception $e){

            }
        }

        return (object)$response;
    }

    public function print($id){
        $fd = DB::table('forms')->where('form_type', 'CNSLT')
            ->where('form_id', $id)->first();

        $d = DB::table('consultation as c')
            ->where('cnslt_id', $fd->form_org_id)
            ->leftjoin('accounts as a', 'c.cnslt_physician_id', 'a.acc_id')
            ->leftjoin('title as ttl', 'a.title', 'ttl.ttl_id')
            ->leftjoin('accounts as p', 'c.cnslt_patient_id', 'p.acc_id')
            ->leftjoin('address as hadd', 'a.home_add_id', 'hadd.add_id')
            ->leftjoin('province as hadd_rp', 'hadd.prov_code', 'hadd_rp.prov_code')
            ->leftjoin('municipality as hadd_rm', 'hadd.mun_code', 'hadd_rm.mun_code')
            ->leftjoin('barangay as hadd_rb', 'hadd.brgy_code', 'hadd_rb.brgy_code')
            ->leftjoin('chief_complain_category as ccc', 'c.cnslt_chief_complain', 'ccc.ccc_id')
            ->first();

        $pd = DB::table('accounts as a')
            ->where('acc_id', $fd->form_created_by)
            ->leftjoin('title as ttl', 'a.title', 'ttl.ttl_id')
            ->first();

        $filename = 'Medical Consultation Form '.$id;
        $pdf = PDF::loadView('Reports.Forms.Consultation', compact('d','fd', 'pd','filename'));
        $pdf->setPaper('legal', 'portrait');
        
        return $pdf->stream($filename);
    }

    public function delete($id){
        try{
            $form = DB::table('forms')->where('form_id', $id)->first();

            if($form){
                DB::table('forms')->where('form_id', $id)->delete();
                DB::table('consultation')->where('cnslt_id', $form->form_org_id)->delete();
            }
            
            $response = [
                'title' => 'Success!',
                'message' => 'Consultation Form deleted.',
                'icon' => 'success',
                'status' => 200,
            ];
        }
        catch(Exception $e){
            $response = [
                'title' => 'Failed!',
                'message' => 'Server Error, Consultation Form not deleted.',
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
                $peof = DB::table('consultation as c')
                ->select('c.*')
                ->leftjoin('forms as f', 'c.cnslt_id', 'f.form_org_id')
                ->leftjoin('accounts as acc', 'f.form_patient_id', 'acc.acc_id')
                ->where('c.cnslt_id', $form->form_org_id)
                ->first();
            }
            
            $response = [
                'title' => 'Success!',
                'message' => 'Consultation Medical Examination retrieve.',
                'icon' => 'success',
                'status' => 200,
                'data' => $peof
            ];
        }
        catch(Exception $e){
            $response = [
                'title' => 'Failed!',
                'message' => 'Server Error, Consultation Medical Examination cant retrieve.',
                'icon' => 'error',
                'status' => 400,
            ];
        }
        echo json_encode($response);
    }

    public function update(Request $request, $id){
        $rules = [
            'cnslt_chief_complain' => ['required'],
            'cnslt_program_office' => ['required'],
            'cnslt_nnotes' => ['required_without:cnslt_dnotes'],
            'cnslt_dnotes' => ['required_without:cnslt_nnotes'],
            'cnslt_bp' => ['required'],
            'cnslt_temp' => ['required'],
            'cnslt_hr' => ['required'],
            'cnslt_oxygen_level' => ['required'],
            'cnslt_diagnosis' => ['required'],
        ];

        $validator = validator::make($request->all(), $rules);

        if($validator->fails()){

            $response = [
                'title' => 'Error!',
                'message' => 'Consultation form not updated.',
                'icon' => 'error',
                'status' => 400,
                'errors' => $validator->messages()
            ];    
        }
        else{
            try{

                $fd = DB::table('forms')->where('form_id', $id)->first();

                $cnslt = DB::table('consultation')->where('cnslt_id', $fd->form_org_id)->update([
                    'cnslt_patient_id' => $id ,
                    'cnslt_physician_id' => Session('user_id'),
                    'cnslt_program_office' => $request->cnslt_program_office,
                    'cnslt_nnotes' => $request->cnslt_nnotes ,
                    'cnslt_dnotes' => $request->cnslt_dnotes ,
                    'cnslt_bp' => $request->cnslt_bp ,
                    'cnslt_hr' => $request->cnslt_hr ,
                    'cnslt_temp' => $request->cnslt_temp ,
                    'cnslt_ol' => $request->cnslt_oxygen_level ,
                    'cnslt_diagnosis' => $request->cnslt_diagnosis ,
                ]);

                $response = [
                    'title' => 'Success!',
                    'message' => 'Consultation form updated.',
                    'icon' => 'success',
                    'status' => 200
                ];  
            }
            catch(Exception $e){

            }
        }

        return (object)$response;
    }
}
