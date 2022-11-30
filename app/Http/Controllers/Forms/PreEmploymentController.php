<?php

namespace App\Http\Controllers\Forms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;
use PDF;

class PreEmploymentController extends Controller
{
    public function insert(Request $request, $id){

        $rules = [
            'peof_type' => ['required'],
            'peof_date' => ['required'],
            'peof_firstname' => ['required'],
            'peof_middlename' => ['required'],
            'peof_lastname' => ['required'],
            'peof_address' => ['required'],
            'peof_position_campus' => ['required'],
            'peof_sex' => ['required'],
            'peof_civil_status' => ['required'],
            'peof_birthdate' => ['required'],
            'peof_contact' => ['required'],
            'peof_medical_history' => ['required'],
            'peof_family_history' => ['required'],
            'peof_occupational_history' => ['required'],
            'peof_bmi_findings' => ['required_if:peof_bmi,==,1'],
            'peof_skin_findings' => ['required_if:peof_skin,==,1'],
            'peof_head_and_scalp_findings' => ['required_if:peof_head_and_scalp,==,1'],
            'peof_eyes_findings' => ['required_if:peof_eyes,==,1'],
            'peof_ears_findings' => ['required_if:peof_ears,==,1'],
            'peof_nose_and_throat_findings' => ['required_if:peof_nose_and_throat,==,1'],
            'peof_mouth_findings' => ['required_if:peof_mouth,==,1'],
            'peof_neck_thyroid_ln_findings' => ['required_if:peof_neck_thyroid_ln,==,1'],
            'peof_chest_breast_axilla_findings' => ['required_if:peof_chest_breast_axilla,==,1'],
            'peof_heart_findings' => ['required_if:peof_heart,==,1'],
            'peof_lungs_findings' => ['required_if:peof_lungs,==,1'],
            'peof_abdomen_findings' => ['required_if:peof_abdomen,==,1'],
            'peof_anus_rectum_findings' => ['required_if:peof_anus_rectum,==,1'],
            'peof_genital_findings' => ['required_if:peof_genital,==,1'],
            'peof_musculoskeletal_findings' => ['required_if:peof_musculoskeletal,==,1'],
            'peof_extremities_findings' => ['required_if:peof_extremities,==,1'],
            'peof_bp' => ['required'],
            'peof_hr' => ['required'],
            'peof_hearing' => ['required'],
            'peof_vision' => ['required'],
            'peof_vision_r' => ['required'],
            'peof_vision_l' => ['required'],
            'peof_chest_xray_findings' => ['required_if:peof_chest_xray,==,pa,lordotic'],
            'peof_complete_blood_count_findings' => ['required_if:peof_complete_blood_count,==,1'],
            'peof_routine_urinalysis_findings' => ['required_if:peof_routine_urinalysis,==,1'],
            'peof_stool_examination_findings' => ['required_if:peof_stool_examination,==,1'],
            'peof_hepa_b_screening_findings' => ['required_if:peof_hepa_b_screening,==,1'],
            'peof_school_company_institution' => ['required'],
            'peof_weight' => ['required'],
            'peof_height' => ['required'],
            'peof_certificate_classification' => ['required'],
        ];

        $messages = [

        ];

        $validator = validator::make($request->all(), $rules, $messages);

        if($validator->fails()){

            $response = [
                'title' => 'Error!',
                'message' => 'Pre-Employement/OJT Medical form not added.',
                'icon' => 'error',
                'status' => 400,
                'errors' => $validator->messages()
            ];    
        }
        else{

            if($request->file('shr_profile_pic')){
                $path = '/public/profile_picture/';
                $file = $request->file('shr_profile_pic');
                $file_name = $id.'_'.time().'.'.$file->extension();
                $upload = $file->storeAs($path, $file_name);
            }
            else{
                $file_name = DB::table('accounts')
                    ->where('acc_id', $id)
                    ->select('profile_pic')
                    ->first()
                    ->profile_pic;
            }

            $phys_details = DB::table('accounts')
                ->where('acc_id', Session('user_id'))
                ->first();

            try{

                $peof_id = DB::table('peof')->insertGetId([
                    'peof_type' => $request->peof_type,
                    'peof_date' => $request->peof_date,
                    'peof_lastname' => $request->peof_lastname,
                    'peof_firstname' => $request->peof_firstname,
                    'peof_middlename' => $request->peof_middlename,
                    'peof_sex' => $request->peof_sex,
                    'peof_age' => $request->peof_age,
                    'peof_birthdate' => $request->peof_birthdate,
                    'peof_civil_status' => $request->peof_civil_status,
                    'peof_contact' => $request->peof_contact,
                    'peof_tel_no' => $request->peof_tel_no,
                    'peof_address' => $request->peof_address, 
                    'peof_position_campus' => $request->peof_position_campus, 
                    'peof_medical_history' => $request->peof_medical_history, 
                    'peof_family_history' => $request->peof_family_history, 
                    'peof_occupational_history' => $request->peof_occupational_history, 
                    'peof_bmi_findings' => ($request->peof_bmi) ? $request->peof_bmi_findings : NULL,
                    'peof_skin_findings' => ($request->peof_skin) ? $request->peof_skin_findings : NULL,
                    'peof_head_and_scalp_findings' => ($request->peof_head_and_scalp) ? $request->peof_head_and_scalp_findings : NULL,
                    'peof_eyes_findings' => ($request->peof_eyes) ? $request->peof_eyes_findings : NULL,
                    'peof_nose_and_throat_findings' => ($request->peof_nose_and_throat) ? $request->peof_nose_and_throat_findings : NULL,
                    'peof_mouth_findings' => ($request->peof_mouth) ? $request->peof_mouth_findings : NULL,
                    'peof_neck_thyroid_ln_findings' => ($request->peof_neck_thyroid_ln) ? $request->peof_neck_thyroid_ln_findings : NULL,
                    'peof_chest_breast_axilla_findings' => ($request->peof_chest_breast_axilla) ? $request->peof_chest_breast_axilla : NULL,
                    'peof_heart_findings' => ($request->peof_heart) ? $request->peof_heart_findings : NULL,
                    'peof_abdomen_findings' => ($request->peof_abdomen) ? $request->peof_abdomen_findings : NULL,
                    'peof_anus_rectum_findings' => ($request->peof_anus_rectum) ? $request->peof_anus_rectum_findings : NULL,
                    'peof_genital_findings' => ($request->peof_genital) ? $request->peof_genital_findings : NULL,
                    'peof_musculoskeletal_findings' => ($request->peof_musculoskeletal) ? $request->peof_musculoskeletal_findings : NULL,
                    'peof_extremities_findings' => ($request->peof_extremities) ? $request->peof_extremities_findings : NULL,
                    'peof_chest_xray' => $request->peof_chest_xray,
                    'peof_chest_xray_findings' => ($request->peof_chest_xray) ? $request->peof_chest_xray_findings : NULL,
                    'peof_cbc_findings' => ($request->peof_cbc) ? $request->peof_cbc_findings : NULL,
                    'peof_routine_urinalysis_findings' => ($request->peof_routine_urinalysis) ? $request->peof_routine_urinalysis_findings : NULL,
                    'peof_stool_examination_findings' => ($request->peof_stool_examination) ? $request->peof_stool_examination_findings : NULL,
                    'peof_hepa_b_screening_findings' => ($request->peof_hepa_b_screening) ? $request->peof_hepa_b_screening_findings : NULL,
                    'peof_bp' => $request->peof_bp,
                    'peof_hr' => $request->peof_hr,
                    'peof_hearing' => $request->peof_hearing,
                    'peof_vision' => $request->peof_vision,
                    'peof_vision_r' => $request->peof_vision_r,
                    'peof_vision_l' => $request->peof_vision_l,
                    'peof_drug_test_metamphetamine' => $request->peof_drug_test_metamphetamine,
                    'peof_drug_test_tetrahydrocannabinol' => $request->peof_drug_test_tetrahydrocannabinol,
                    'peof_pic' => $file_name,
                    'peof_school_company_institution' => $request->peof_school_company_institution,
                    'peof_weight' => $request->peof_weight,
                    'peof_height' => $request->peof_height,
                    'peof_classification' => 'a',
                    'peof_needs_for_treatment' => NULL,
                    'peof_patient_id' => $id,
                    'peof_physician_id' => Session('user_id'),
                    'peof_patient_signature' => NULL,
                    'peof_physician_signature' => $phys_details->signature,
                ]);

                DB::table("forms")->insert([
                    "form_date_created" => date("Y-m-d"),
                    "form_date_updated"	=> NULL,
                    "form_created_by" =>  Session('user_id'),
                    "form_patient_id" =>  $id,
                    "form_editable" => 1,
                    "form_type" => 'PEOF',
                    "form_org_id" => $peof_id
                ]);

                $response = [
                    'title' => 'Success!',
                    'message' => 'Pre-Employement/OJT Medical form added.',
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
        $org_id = DB::table('forms')->where('form_type', 'PEOF')
            ->where('form_id', $id)->first();

        $d = DB::table('peof as p')
            ->where('peof_id', $org_id->form_org_id)
            ->leftjoin('accounts as a', 'p.peof_physician_id', 'a.acc_id')
            ->leftjoin('title as ttl', 'a.title', 'ttl.ttl_id')
            ->first();

        // echo json_encode($d);

        $filename = 'Pre-Employment/OJT_Medical_Examination'.$id;
        // echo json_encode($d);
        $pdf = PDF::loadView('Reports.Forms.PreEmploymentOJTMedical', compact('d', 'filename'));
        $pdf->setPaper('legal', 'portrait');
        
        return $pdf->stream($filename);
    }

    public function delete($id){
        try{
            $form = DB::table('forms')->where('form_id', $id)->first();

            if($form){
                DB::table('forms')->where('form_id', $id)->delete();
                DB::table('peof')->where('peof_id', $form->form_org_id)->delete();
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
                $peof = DB::table('peof as p')
                ->select('p.*')
                ->leftjoin('forms as f', 'p.peof_id', 'f.form_org_id')
                ->leftjoin('accounts as acc', 'f.form_patient_id', 'acc.acc_id')
                ->where('p.peof_id', $form->form_org_id)
                ->first();
            }
            
            $response = [
                'title' => 'Success!',
                'message' => 'Pre-Employment/OJT Medical Examination retrieve.',
                'icon' => 'success',
                'status' => 200,
                'data' => $peof
            ];
        }
        catch(Exception $e){
            $response = [
                'title' => 'Failed!',
                'message' => 'Server Error, Student Health Record cant retrieve.',
                'icon' => 'error',
                'status' => 400,
            ];
        }
        echo json_encode($response);
    }

    public function update(Request $request, $id){

        $rules = [
            'peof_type' => ['required'],
            'peof_date' => ['required'],
            'peof_firstname' => ['required'],
            'peof_middlename' => ['required'],
            'peof_lastname' => ['required'],
            'peof_address' => ['required'],
            'peof_position_campus' => ['required'],
            'peof_sex' => ['required'],
            'peof_civil_status' => ['required'],
            'peof_birthdate' => ['required'],
            'peof_contact' => ['required'],
            'peof_medical_history' => ['required'],
            'peof_family_history' => ['required'],
            'peof_occupational_history' => ['required'],
            'peof_bmi_findings' => ['required_if:peof_bmi,==,1'],
            'peof_skin_findings' => ['required_if:peof_skin,==,1'],
            'peof_head_and_scalp_findings' => ['required_if:peof_head_and_scalp,==,1'],
            'peof_eyes_findings' => ['required_if:peof_eyes,==,1'],
            'peof_ears_findings' => ['required_if:peof_ears,==,1'],
            'peof_nose_and_throat_findings' => ['required_if:peof_nose_and_throat,==,1'],
            'peof_mouth_findings' => ['required_if:peof_mouth,==,1'],
            'peof_neck_thyroid_ln_findings' => ['required_if:peof_neck_thyroid_ln,==,1'],
            'peof_chest_breast_axilla_findings' => ['required_if:peof_chest_breast_axilla,==,1'],
            'peof_heart_findings' => ['required_if:peof_heart,==,1'],
            'peof_lungs_findings' => ['required_if:peof_lungs,==,1'],
            'peof_abdomen_findings' => ['required_if:peof_abdomen,==,1'],
            'peof_anus_rectum_findings' => ['required_if:peof_anus_rectum,==,1'],
            'peof_genital_findings' => ['required_if:peof_genital,==,1'],
            'peof_musculoskeletal_findings' => ['required_if:peof_musculoskeletal,==,1'],
            'peof_extremities_findings' => ['required_if:peof_extremities,==,1'],
            'peof_bp' => ['required'],
            'peof_hr' => ['required'],
            'peof_hearing' => ['required'],
            'peof_vision' => ['required'],
            'peof_vision_r' => ['required'],
            'peof_vision_l' => ['required'],
            'peof_chest_xray_findings' => ['required_if:peof_chest_xray,==,pa,lordotic'],
            'peof_complete_blood_count_findings' => ['required_if:peof_complete_blood_count,==,1'],
            'peof_routine_urinalysis_findings' => ['required_if:peof_routine_urinalysis,==,1'],
            'peof_stool_examination_findings' => ['required_if:peof_stool_examination,==,1'],
            'peof_hepa_b_screening_findings' => ['required_if:peof_hepa_b_screening,==,1'],
            'peof_school_company_institution' => ['required'],
            'peof_weight' => ['required'],
            'peof_height' => ['required'],
            'peof_certificate_classification' => ['required'],
        ];

        $messages = [

        ];

        $validator = validator::make($request->all(), $rules, $messages);

        if($validator->fails()){

            $response = [
                'title' => 'Error!',
                'message' => 'Pre-Employement/OJT Medical form not added.',
                'icon' => 'error',
                'status' => 400,
                'errors' => $validator->messages()
            ];    
        }
        else{
            $phys_details = DB::table('accounts')
                ->where('acc_id', Session('user_id'))
                ->first();

            $fd = DB::table('forms')->where('form_id', $id)->first();
            try{

                $peof_id = DB::table('peof')->where('peof_id', $fd->form_org_id)->update([
                    'peof_type' => $request->peof_type,
                    'peof_date' => $request->peof_date,
                    'peof_lastname' => $request->peof_lastname,
                    'peof_firstname' => $request->peof_firstname,
                    'peof_middlename' => $request->peof_middlename,
                    'peof_sex' => $request->peof_sex,
                    'peof_age' => $request->peof_age,
                    'peof_birthdate' => $request->peof_birthdate,
                    'peof_civil_status' => $request->peof_civil_status,
                    'peof_contact' => $request->peof_contact,
                    'peof_tel_no' => $request->peof_tel_no,
                    'peof_address' => $request->peof_address, 
                    'peof_position_campus' => $request->peof_position_campus, 
                    'peof_medical_history' => $request->peof_medical_history, 
                    'peof_family_history' => $request->peof_family_history, 
                    'peof_occupational_history' => $request->peof_occupational_history, 
                    'peof_bmi_findings' => ($request->peof_bmi) ? $request->peof_bmi_findings : NULL,
                    'peof_skin_findings' => ($request->peof_skin) ? $request->peof_skin_findings : NULL,
                    'peof_head_and_scalp_findings' => ($request->peof_head_and_scalp) ? $request->peof_head_and_scalp_findings : NULL,
                    'peof_eyes_findings' => ($request->peof_eyes) ? $request->peof_eyes_findings : NULL,
                    'peof_nose_and_throat_findings' => ($request->peof_nose_and_throat) ? $request->peof_nose_and_throat_findings : NULL,
                    'peof_mouth_findings' => ($request->peof_mouth) ? $request->peof_mouth_findings : NULL,
                    'peof_neck_thyroid_ln_findings' => ($request->peof_neck_thyroid_ln) ? $request->peof_neck_thyroid_ln_findings : NULL,
                    'peof_chest_breast_axilla_findings' => ($request->peof_chest_breast_axilla) ? $request->peof_chest_breast_axilla : NULL,
                    'peof_heart_findings' => ($request->peof_heart) ? $request->peof_heart_findings : NULL,
                    'peof_abdomen_findings' => ($request->peof_abdomen) ? $request->peof_abdomen_findings : NULL,
                    'peof_anus_rectum_findings' => ($request->peof_anus_rectum) ? $request->peof_anus_rectum_findings : NULL,
                    'peof_genital_findings' => ($request->peof_genital) ? $request->peof_genital_findings : NULL,
                    'peof_musculoskeletal_findings' => ($request->peof_musculoskeletal) ? $request->peof_musculoskeletal_findings : NULL,
                    'peof_extremities_findings' => ($request->peof_extremities) ? $request->peof_extremities_findings : NULL,
                    'peof_chest_xray' => $request->peof_chest_xray,
                    'peof_chest_xray_findings' => ($request->peof_chest_xray) ? $request->peof_chest_xray_findings : NULL,
                    'peof_cbc_findings' => ($request->peof_cbc) ? $request->peof_cbc_findings : NULL,
                    'peof_routine_urinalysis_findings' => ($request->peof_routine_urinalysis) ? $request->peof_routine_urinalysis_findings : NULL,
                    'peof_stool_examination_findings' => ($request->peof_stool_examination) ? $request->peof_stool_examination_findings : NULL,
                    'peof_hepa_b_screening_findings' => ($request->peof_hepa_b_screening) ? $request->peof_hepa_b_screening_findings : NULL,
                    'peof_bp' => $request->peof_bp,
                    'peof_hr' => $request->peof_hr,
                    'peof_hearing' => $request->peof_hearing,
                    'peof_vision' => $request->peof_vision,
                    'peof_vision_r' => $request->peof_vision_r,
                    'peof_vision_l' => $request->peof_vision_l,
                    'peof_drug_test_metamphetamine' => $request->peof_drug_test_metamphetamine,
                    'peof_drug_test_tetrahydrocannabinol' => $request->peof_drug_test_tetrahydrocannabinol,
                    'peof_school_company_institution' => $request->peof_school_company_institution,
                    'peof_weight' => $request->peof_weight,
                    'peof_height' => $request->peof_height,
                    'peof_classification' => 'a',
                    'peof_needs_for_treatment' => NULL,
                ]);

                $response = [
                    'title' => 'Success!',
                    'message' => 'Pre-Employement/OJT Medical form updated.',
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
