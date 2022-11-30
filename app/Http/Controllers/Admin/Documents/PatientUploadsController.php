<?php

namespace App\Http\Controllers\Admin\Documents;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;
use Session;
use Storage;

class PatientUploadsController extends Controller
{

    public function upload(Request $request, $pd_id){
        $rules = [
            'document_type' => ['required'],
            'file' => ['required', 'mimes:jpeg,pdf', 'max:5120']    
        ];

        $validator = validator::make($request->all(), $rules);

        if($validator->fails()){
            $response = [
                'title' => 'Error!',
                'message' => 'Equipment item not added.',
                'icon' => 'error',
                'status' => 400,
                'errors' => $validator->messages()
            ];    
        }
        else{
            if($request->file('file')->isValid()){
                $id = $pd_id;
                $path = '/public/documents/'.$request->document_type;
                $file = $request->file('file');
                $file_name = time().'_'.$request->document_type.'_'.$id.'.'.$file->extension();
                $upload = $file->storeAs($path, $file_name);

                $upload_id = DB::table('patient_document')->insertGetId([
                    'dt_id' => $request->document_type,
                    'pd_filename' => $request->file('file')->getClientOriginalName(),
                    'pd_sys_filename' => $file_name,
                    'pd_verified_status' => 1,
                    'acc_id' => $pd_id,
                    'uploaded_by' => Session::get('user_id')
                ]);

                DB::table('forms')->insert([
                    "form_date_created" => date("Y-m-d"),
                    "form_date_updated"	=> NULL,
                    "form_created_by" =>  Session::get('user_id'),
                    "form_patient_id" =>  $pd_id,
                    "form_type" => $request->document_type,
                    "form_org_id" => $upload_id
                ]);

                $response = [
                    'title' => 'Succes!',
                    'message' => 'Document uploaded.',
                    'icon' => 'success',
                    'status' => 200
                ];
            }
        }
        echo json_encode($response);
    }
    
    public function update_status(Request $request, $pd_id){

        try{
            $pd_details = DB::table('patient_document')->where('pd_id', $pd_id)->first();

            if($pd_details->pd_verified_status){
                $nstats = 0;
            }
            else{
                $nstats = 1;
            }

            DB::table('patient_document')->where('pd_id', $pd_id)
                ->update([
                    'pd_verified_status' => $nstats
                ]);

            $response = [
                'title' => 'Success',
                'message' => 'The document status updated',
                'icon' => 'success',
                'status' => 200
            ];
        }
        catch(Exception $e){
            $response = [
                'title' => 'Failed',
                'message' => 'The document status not updated'.$e,
                'icon' => 'error',
                'status' => 400
            ];
        }

        echo json_encode($response);
    }

    public function delete(Request $request, $pd_id){
        $doc_details = DB::table('patient_document')->where('pd_id', $pd_id)->first();
        
        // echo json_encode($doc_details);
        $path = '/public/documents/'.$doc_details->dt_id.'/';
        try{
            DB::table('patient_document')->where('pd_id', $pd_id)->delete();
            DB::table('forms')->where('form_type', $doc_details->dt_id)->where('form_editable', 0)->where('form_org_id', $pd_id)->delete();
            if($doc_details->pd_sys_filename){
                Storage::delete($path.$doc_details->pd_sys_filename); 
            }

            $response = [
                'title' => 'Success!',
                'message' => 'Document deleted.',
                'icon' => 'success',
                'status' => 200
            ];
        }
        catch(Exception $e){
            $response = [
                'title' => 'Failed!',
                'message' => 'Document not deleted.'.$e,
                'icon' => 'error',
                'status' => 400
            ];
        }
        return redirect()->back()->with('status', $response);
    }

    public function delete_upload(Request $request, $id){
        $doc_details = DB::table('patient_document')->where('pd_id', $id)->first();
        // echo json_encode($doc_details);
        $path = '/public/documents/'.$doc_details->dt_id.'/';
        try{
            DB::table('patient_document')->where('pd_id', $id)->delete();

            if($doc_details->pd_sys_filename){
                Storage::delete($path.$doc_details->pd_sys_filename); 
            }

            $response = [
                'title' => 'Success!',
                'message' => 'Document deleted.',
                'icon' => 'success',
                'status' => 200
            ];
        }
        catch(Exception $e){
            $response = [
                'title' => 'Failed!',
                'message' => 'Document not deleted.'.$e,
                'icon' => 'error',
                'status' => 400
            ];
        }
        return redirect()->back()->with(['status' => $response]);
    }
}
