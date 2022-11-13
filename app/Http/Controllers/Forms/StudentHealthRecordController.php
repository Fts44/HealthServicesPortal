<?php

namespace App\Http\Controllers\Forms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Storage;
use Illuminate\Support\Facades\Validator;
use Session;
use PDF;

class StudentHealthRecordController extends Controller
{
    public function insert(Request $request, $id){

        $rules = [
            "shr_med" => ['required', 'date'],
            "shr_srcode" => ['required'],
            "shr_program" => ['required'],
            "shr_firstname" => ['required'],
            "shr_lastname" => ['required'],
            "shr_home_address" => ['required'],
            "shr_gender" => ['required', 'in:male,female'],
            "shr_age" => ['required'],
            "shr_civil_status" => ['required'],
            "shr_religion" => ['required'],
            "shr_contact" => ['required'],
            "shr_date_of_birth" => ['required'],
            "shr_place_of_birth" => ['required'],
            "shr_emergency_name" => ['required'],
            "shr_emergency_business_address" => ['required'],
            "shr_emergency_relation_to_patient" => ['required'],
            "shr_emergency_contact" => ['required'],
            "shr_past_illness_asthma_last_attack" => ['required_if:shr_past_illness_asthma,=,1'],
            "shr_past_illness_hospitalization_specify" => ['required_if:shr_past_illness_hospitalization,=,1'],
            "shr_past_illness_operation_specify" => ['required_if:shr_past_illness_operation,=,1'],
            "shr_past_illness_accident_specify" => ['required_if:shr_past_illness_accident,=,1'],
            "shr_past_illness_disability_specify" => ['required_if:shr_past_illness_disability,=,1'],
            "shr_allergy_food_specify" => ['required_if:shr_allergy_food,=,1'],
            "shr_allergy_medicine_specify" => ['required_if:shr_allergy_medicine,=,1'],
            "shr_allergy_others_specify" => ['required_if:shr_allergy_others,=,1'],
            "shr_immunization_hepa_b_doses" => ['required_if:shr_immunization_hepa_b,=,1'],
            "shr_immunization_dpt_doses" => ['required_if:shr_immunization_dpt,=,1'],
            "shr_immunization_opv_doses" => ['required_if:shr_immunization_opv,=,1'],
            "shr_immunization_hib_doses" => ['required_if:shr_immunization_opv,=,1'],
            "shr_male_age_of_onset" => ['required_if:shr_gender,=,male'],
            "shr_female_menarche" => ['required_if:shr_gender,=,female'],
            "shr_female_lmp" => ['required_if:shr_gender,=,female'],
            "shr_female_dysmenorhea" => ['required_if:shr_gender,=,female'],
            "shr_female_dysmenorhea_medicine" => ['required_if:shr_female_dysmenorhea,=,1'],
            "shr_fathers_name" => ['required'],
            "shr_fathers_occupation" => ['required'],
            "shr_mothers_name" => ['required'],
            "shr_mothers_occupation" => ['required'],
            "shr_marital_status" => ['required'],
            "shr_weight" => ['required'],
            "shr_height" => ['required'],
            "shr_bmi" => ['required'],
            "shr_temperature" => ['required'],
            "shr_hr" => ['required'],
            "shr_bp" => ['required'],
            "shr_vision" => ['required'],
            "shr_hearing" => ['required'],
            "shr_blood_type" => ['required'],
            "shr_chest_xray_result" => ['required'],
            "shr_chest_xray_result_date" => ['required'],
            "shr_general_survey_findings" => ['required_if:shr_general_survey,=,1'],
            "shr_skin_findings" => ['required_if:shr_skin,=,1'],
            "shr_eye_ears_nose_findings" => ['required_if:shr_eye_ears_nose,=,1'],
            "shr_teeth_gums_findings" => ['required_if:shr_teeth_gums,=,1'],
            "shr_neck_findings" => ['required_if:shr_neck,=,1'],
            "shr_heart_findings" => ['required_if:shr_heart,=,1'],
            "shr_chest_lungs_findings" => ['required_if:shr_chest_lungs,=,1'],
            "shr_abdomen_findings" => ['required_if:shr_abdomen,=,1'],
            "shr_musculoskeletal_findings" => ['required_if:shr_musculoskeletal,=,1'],
            "shr_assessment_diagnosis_drinking_how_much" => ['required_if:shr_assessment_diagnosis_drinking,=,1'],
            "shr_assessment_diagnosis_drinking_how_often" => ['required_if:shr_assessment_diagnosis_drinking,=,1'],
            "shr_assessment_diagnosis_smoking_sticks_per_day" => ['required_if:shr_assessment_diagnosis_smoking,=,1'],
            "shr_assessment_diagnosis_smoking_since_when" => ['required_if:shr_assessment_diagnosis_smoking,=,1'],
            "shr_assessment_diagnosis_drug_kind" => ['required_if:shr_assessment_diagnosis_drug_use,=,1'],
            "shr_assessment_diagnosis_regular_use" => ['required_if:shr_assessment_diagnosis_drug_use,=,1'],
            "shr_assessment_driving_specify" => ['required_if:shr_assessment_driving,=,1'],
            "shr_assessment_diagnosis_abuse_specify" => ['required_if:shr_assessment_diagnosis_abuse,=,1'],
        ];

        $message = [
            "shr_med.required" => 'MedExam Date is required!',
            "shr_srcode.required" => 'SR-Code is required!',
            "shr_program.required" => 'Program is required!',
            "shr_firstname.required" => 'Firstname is required!',
            "shr_lastname.required" => 'Lastname is required!',
            "shr_home_address.required" => 'Home Address is required!',
            "shr_gender.required" => 'Gender is required!',
            "shr_age.required" => 'Age is required!',
            "shr_civil_status.required" => 'Civil Status is required!',
            "shr_religion.required" => 'Religion is required!',
            "shr_contact.required" => 'Contact is required!',
            "shr_date_of_birth.required" => 'Birthdate is required!',
            "shr_place_of_birth.required" => 'Birthplace is required!',
            "shr_emergency_firstname.required" => 'Firstname is required!',
            "shr_emergency_lastname.required" => 'Lastname is required!',
            "shr_emergency_business_address.required" => 'Business Address is required!',
            "shr_emergency_relation_to_patient.required" => 'Relation to patient is required!',
            "shr_emergency_contact.required" => 'Emergeny Contact is required!',
            "shr_past_illness_asthma_last_attack.required_if" => 'Asthma Last Attack is required!',
            "shr_past_illness_hospitalization_specify.required_if" => 'Hospitalization specify is required!',
            "shr_past_illness_operation_specify.required_if" => 'Operation specify is required!',
            "shr_past_illness_accident_specify.required_if" => 'Accident specify is required!',
            "shr_past_illness_disability_specify.required_if" => 'Disability specify is required!',
            "shr_allergy_food_specify.required_if" => 'Food allergy specify is required!',
            "shr_allergy_medicine_specify.required_if" => 'Medicine allergy specify is required!',
            "shr_allergy_others_specify.required_if" => 'Other allergy specify is required!',
            "shr_immunization_hepa_b_doses.required_if" => 'HepaB doses is required!',
            "shr_immunization_dpt_doses.required_if" => 'DPT doses is required!',
            "shr_immunization_opv_doses.required_if" => 'OPV doses is required!',
            "shr_immunization_hib_doses.required_if" => 'HIB doses is required!',
            "shr_male_age_of_onset.required_if" => 'Age of onset is required!',
            "shr_female_menarche.required_if" => 'Menarche is required!',
            "shr_female_lmp.required_if" => 'LMP is required!',
            "shr_female_dysmenorhea.required_if" => 'Dysmenorhea is required!',
            "shr_female_dysmenorhea_medicine.required_if" => 'Dysmenorhea medicine is required!',
            "shr_fathers_name.required" => 'Fathers name is required!',
            "shr_fathers_occupation.required" => 'Occupation is required!',
            "shr_mothers_name.required" => 'Mothers name is required!',
            "shr_mothers_occupation.required" => 'Occupation is required!',
            "shr_marital_status.required" => 'Marital status is required!',
            "shr_weight.required" => 'Weight is required!',
            "shr_height.required" => 'Height is required!',
            "shr_bmi.required" => 'BMI is required!',
            "shr_temperature.required" => 'Temparature is required!',
            "shr_hr.required" => 'HR is required!',
            "shr_bp.required" => 'BP is required!',
            "shr_vision.required" => 'Vision is required!',
            "shr_hearing.required" => 'Hearing is required!',
            "shr_blood_type.required" => 'Blood Type is required!',
            "shr_chest_xray_result.required" => 'Chest XRay result is required!',
            "shr_chest_xray_result_date.required" => 'XRay result date is required!',
            "shr_general_survey_findings.required_if" => 'Generay Survey findings is required!',
            "shr_skin_findings.required_if" => 'Skin findings is required!',
            "shr_eye_ears_nose_findings.required_if" => 'Eyes/ Ears/ Nose findings is required!',
            "shr_teeth_gums_findings.required_if" => 'Teeth/ Gums findings is required!',
            "shr_neck_findings.required_if" => 'Neck findings is required!',
            "shr_heart_findings.required_if" => 'Heart findings is required!',
            "shr_chest_lungs_findings.required_if" => 'Chest/ Lungs findings is required!',
            "shr_abdomen_findings.required_if" => 'Abdomen findings is required!',
            "shr_musculoskeletal_findings.required_if" => 'Musculoskeletal is required!',
            "shr_assessment_diagnosis_drinking_how_much.required_if" => 'Drinking how much is required!',
            "shr_assessment_diagnosis_drinking_how_often.required_if" => 'Drinking how often is required!',
            "shr_assessment_diagnosis_smoking_sticks_per_day.required_if" => 'Sticks per day is required!',
            "shr_assessment_diagnosis_smoking_since_when.required_if" => 'Smoking since when is required!', 
            "shr_assessment_diagnosis_drug_kind.required_if" => 'Drug kind is required!',
            "shr_assessment_diagnosis_regular_use.required_if" => 'Regular use is required!',
            "shr_assessment_driving_specify.required_if" => 'Specify Vehicle is required!',
            "shr_assessment_diagnosis_abuse_specify.required_if" => 'Abuse kind is required!',
        ];

        $validator = Validator::make( $request->all(), $rules, $message);

        if($validator->fails()){
            $response = [
                'title' => 'Failed!',
                'message' => 'Invalid data, Student Health Record not created.',
                'icon' => 'error',
                'status' => 400,
                'errors' => $validator->messages(),
                'form' => 'shr'
            ]; 
        }
        else{
          
            try{

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

                $shr_id = DB::table("student_health_record")->insertGetId([
                    "shr_med" => $request->shr_med,
                    "shr_srcode" => $request->shr_srcode,
                    "shr_program" => $request->shr_program,
                    "shr_profile_pic" => $file_name,
                    "shr_firstname" => $request->shr_firstname,
                    "shr_middlename" => $request->shr_middlename,
                    "shr_lastname" => $request->shr_lastname,
                    "shr_suffixname" => $request->shr_suffixname,
                    "shr_home_address" => $request->shr_home_address,
                    "shr_dorm_address" => $request->shr_dorm_address,
                    "shr_gender" => $request->shr_gender,
                    "shr_age" => $request->shr_age,
                    "shr_civil_status" => $request->shr_civil_status,
                    "shr_religion" => $request->shr_religion,
                    "shr_contact" => $request->shr_contact,
                    "shr_date_of_birth" => $request->shr_date_of_birth,
                    "shr_place_of_birth" => $request->shr_place_of_birth,
                    "shr_emergency_name" => $request->shr_emergency_name,
                    "shr_emergency_business_address" => $request->shr_emergency_business_address,
                    "shr_emergency_relation_to_patient" => $request->shr_emergency_relation_to_patient,
                    "shr_emergency_landline" => $request->shr_emergency_landline,
                    "shr_emergency_contact" => $request->shr_emergency_contact,
                    "shr_past_illness_asthma_last_attack" => (($request->shr_past_illness_asthma) ? $request->shr_past_illness_asthma_last_attack : NULL),
                    "shr_past_illness_heart_disease" => $request->shr_past_illness_heart_disease,
                    "shr_past_illness_hypertension" => $request->shr_past_illness_hypertension,
                    "shr_past_illness_epilepsy" => $request->shr_past_illness_epilepsy,
                    "shr_past_illness_diabetes" => $request->shr_past_illness_diabetes,
                    "shr_past_illness_thyroid_problem" => $request->shr_past_illness_thyroid_problem,
                    "shr_past_illness_measles" => $request->shr_past_illness_measles,
                    "shr_past_illness_mumps" => $request->shr_past_illness_mumps,
                    "shr_past_illness_varicella" => $request->shr_past_illness_varicella,
                    "shr_past_illness_hospitalization_specify" => (($request->shr_past_illness_hospitalization) ? $request->shr_past_illness_hospitalization_specify : NULL),
                    "shr_past_illness_operation_specify" => (($request->shr_past_illness_operation) ? $request->shr_past_illness_operation_specify : NULL), 
                    "shr_past_illness_accident_specify" => (($request->shr_past_illness_accident) ? $request->shr_past_illness_accident_specify : NULL),  
                    "shr_past_illness_disability_specify" => (($request->shr_past_illness_disability) ? $request->shr_past_illness_disability_specify : NULL), 
                    "shr_allergy_food_specify" => (($request->shr_allergy_food) ? $request->shr_allergy_food_specify : NULL), 
                    "shr_allergy_medicine_specify" => (($request->shr_allergy_medicine) ? $request->shr_allergy_medicine_specify : NULL),    
                    "shr_allergy_others_specify" => (($request->shr_allergy_others) ? $request->shr_allergy_others_specify : NULL),    
                    "shr_immunization_bcg" => $request->shr_immunization_bcg,
                    "shr_immunization_mmr" => $request->shr_immunization_mmr,
                    "shr_immunization_hepa_a" => $request->shr_immunization_hepa_a,
                    "shr_immunization_typhoid" => $request->shr_immunization_typhoid,
                    "shr_immunization_varicella" => $request->shr_immunization_varicella,
                    "shr_immunization_hepa_b_doses" => (($request->shr_immunization_hepa_b) ? $request->shr_immunization_hepa_b_doses : NULL),  
                    "shr_immunization_dpt_doses" => (($request->shr_immunization_dpt) ? $request->shr_immunization_dpt_doses : NULL),     
                    "shr_immunization_opv_doses" => (($request->shr_immunization_opv) ? $request->shr_immunization_opv_doses : NULL),    
                    "shr_immunization_hib_doses" => (($request->shr_immunization_hib) ? $request->shr_immunization_hib_doses : NULL),    
                    "shr_male_age_of_onset" => (($request->shr_gender=='male') ? $request->shr_male_age_of_onset : NULL),
                    "shr_female_menarche" => (($request->shr_gender=='female') ? $request->shr_female_menarche : NULL),
                    "shr_female_lmp" => (($request->shr_gender=='female') ? $request->shr_female_lmp : NULL),    
                    "shr_female_dysmenorhea" => $request->shr_female_dysmenorhea,    
                    "shr_female_dysmenorhea_medicine" => $request->shr_female_dysmenorhea_medicine,    
                    "shr_family_history_diabetes" => $request->shr_family_history_diabetes,
                    "shr_family_history_heart_disease" => $request->shr_family_history_heart_disease,
                    "shr_family_history_mental_illness" => $request->shr_family_history_mental_illness,
                    "shr_family_history_cancer" => $request->shr_family_history_cancer,
                    "shr_family_history_hypertension" => $request->shr_family_history_hypertension,
                    "shr_family_history_kidney_disease" => $request->shr_family_history_kidney_disease,
                    "shr_family_history_epilepsy" => $request->shr_family_history_epilepsy,
                    "shr_family_history_others" => $request->shr_family_history_others,
                    "shr_fathers_name" => $request->shr_fathers_name,
                    "shr_fathers_occupation" => $request->shr_fathers_occupation,
                    "shr_mothers_name" => $request->shr_mothers_name,
                    "shr_mothers_occupation" => $request->shr_mothers_occupation,
                    "shr_marital_status" => $request->shr_marital_status,
                    "shr_weight" => $request->shr_weight,
                    "shr_height" => $request->shr_height,
                    "shr_bmi" => $request->shr_bmi,
                    "shr_temperature" => $request->shr_temperature,
                    "shr_hr" => $request->shr_hr,
                    "shr_bp" => $request->shr_bp,
                    "shr_vision" => $request->shr_vision,
                    "shr_hearing" => $request->shr_hearing,
                    "shr_blood_type" => $request->shr_blood_type,
                    "shr_chest_xray_result" => $request->shr_chest_xray_result,
                    "shr_chest_xray_result_date" => $request->shr_chest_xray_result_date,
                    "shr_general_survey_findings" => (($request->shr_general_survey) ? $request->shr_general_survey_findings : NULL),
                    "shr_skin_findings" => (($request->shr_skin) ? $request->shr_skin_findings : NULL),
                    "shr_eye_ears_nose_findings" => (($request->shr_eye_ears_nose) ? $request->shr_eye_ears_nose_findings : NULL),
                    "shr_teeth_gums_findings" => (($request->shr_teeth_gums) ? $request->shr_teeth_gums_findings : NULL),
                    "shr_neck_findings" => (($request->shr_neck) ? $request->shr_neck_findings : NULL),
                    "shr_heart_findings" => (($request->shr_heart) ? $request->shr_heart_findings : NULL),
                    "shr_abdomen_findings" => (($request->shr_abdomen) ? $request->shr_abdomen_findings : NULL),
                    "shr_chest_lungs_findings" => (($request->shr_chest_lungs) ? $request->shr_chest_lungs_findings : NULL),
                    "shr_musculoskeletal_findings" => (($request->shr_musculoskeletal) ? $request->shr_musculoskeletal_findings : NULL),
                    "shr_assessment_diagnosis_drinking_how_much" => (($request->shr_assessment_diagnosis_drinking) ? $request->shr_assessment_diagnosis_drinking_how_much : NULL),
                    "shr_assessment_diagnosis_drinking_how_often" => (($request->shr_assessment_diagnosis_drinking) ? $request->shr_assessment_diagnosis_drinking_how_often : NULL),
                    "shr_assessment_diagnosis_smoking_sticks_per_day" => (($request->shr_assessment_diagnosis_smoking) ? $request->shr_assessment_diagnosis_smoking_sticks_per_day : NULL),
                    "shr_assessment_diagnosis_smoking_since_when" => (($request->shr_assessment_diagnosis_smoking) ? $request->shr_assessment_diagnosis_smoking_since_when : NULL),
                    "shr_assessment_diagnosis_drug_kind" => (($request->shr_assessment_diagnosis_drug_use) ? $request->shr_assessment_diagnosis_drug_kind : NULL),
                    "shr_assessment_diagnosis_regular_use" => (($request->shr_assessment_diagnosis_drug_use) ? $request->shr_assessment_diagnosis_regular_use : NULL),
                    "shr_assessment_driving_specify" => (($request->shr_assessment_driving) ? $request->shr_assessment_driving_specify : NULL),
                    "shr_assessment_driving_with_license" => (($request->shr_assessment_driving) ? $request->shr_assessment_driving_with_license : NULL),
                    "shr_assessment_diagnosis_abuse_specify" => (($request->shr_assessment_diagnosis_abuse) ? $request->shr_assessment_diagnosis_abuse_specify : NULL),
                ]);

                DB::table("forms")->insert([
                    "form_date_created" => date("Y-m-d"),
                    "form_date_updated"	=> NULL,
                    "form_created_by" =>  Session('user_id'),
                    "form_patient_id" =>  $id,
                    "form_type" => 'SHR',
                    "form_org_id" => $shr_id
                ]);

                $response = [
                    'title' => 'Success!',
                    'message' => 'Student Health Record created.',
                    'icon' => 'success',
                    'status' => 200
                ];
            }
            catch(Exception $e){
                $response = [
                    'title' => 'Failed!',
                    'message' => 'Server Error, Student Health Record not created.',
                    'icon' => 'error',
                    'status' => 400,
                    'errors' => $validator->messages(),
                    'form' => 'shr'
                ];
            }
        }
        echo json_encode($response);
    }

    public function retrieve($id){
        try{
            $form = DB::table('forms')
                ->where('form_id', $id)
                ->first();

            if($form){
                $shr = DB::table('student_health_record as shr')
                ->select('shr.*', 'acc.profile_pic')
                ->leftjoin('forms as f', 'shr.shr_id', 'f.form_org_id')
                ->leftjoin('accounts as acc', 'f.form_patient_id', 'acc.acc_id')
                ->where('shr.shr_id', $form->form_org_id)
                ->first();
            }
            
            $response = [
                'title' => 'Success!',
                'message' => ' Student Health Record retrieve.',
                'icon' => 'success',
                'status' => 200,
                'data' => $shr
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
            "shr_med" => ['required', 'date'],
            "shr_srcode" => ['required'],
            "shr_program" => ['required'],
            "shr_firstname" => ['required'],
            "shr_lastname" => ['required'],
            "shr_home_address" => ['required'],
            "shr_gender" => ['required', 'in:male,female'],
            "shr_age" => ['required'],
            "shr_civil_status" => ['required'],
            "shr_religion" => ['required'],
            "shr_contact" => ['required'],
            "shr_date_of_birth" => ['required'],
            "shr_place_of_birth" => ['required'],
            "shr_emergency_name" => ['required'],
            "shr_emergency_business_address" => ['required'],
            "shr_emergency_relation_to_patient" => ['required'],
            "shr_emergency_contact" => ['required'],
            "shr_past_illness_asthma_last_attack" => ['required_if:shr_past_illness_asthma,=,1'],
            "shr_past_illness_hospitalization_specify" => ['required_if:shr_past_illness_hospitalization,=,1'],
            "shr_past_illness_operation_specify" => ['required_if:shr_past_illness_operation,=,1'],
            "shr_past_illness_accident_specify" => ['required_if:shr_past_illness_accident,=,1'],
            "shr_past_illness_disability_specify" => ['required_if:shr_past_illness_disability,=,1'],
            "shr_allergy_food_specify" => ['required_if:shr_allergy_food,=,1'],
            "shr_allergy_medicine_specify" => ['required_if:shr_allergy_medicine,=,1'],
            "shr_allergy_others_specify" => ['required_if:shr_allergy_others,=,1'],
            "shr_immunization_hepa_b_doses" => ['required_if:shr_immunization_hepa_b,=,1'],
            "shr_immunization_dpt_doses" => ['required_if:shr_immunization_dpt,=,1'],
            "shr_immunization_opv_doses" => ['required_if:shr_immunization_opv,=,1'],
            "shr_immunization_hib_doses" => ['required_if:shr_immunization_opv,=,1'],
            "shr_male_age_of_onset" => ['required_if:shr_gender,=,male'],
            "shr_female_menarche" => ['required_if:shr_gender,=,female'],
            "shr_female_lmp" => ['required_if:shr_gender,=,female'],
            "shr_female_dysmenorhea" => ['required_if:shr_gender,=,female'],
            "shr_female_dysmenorhea_medicine" => ['required_if:shr_female_dysmenorhea,=,1'],
            "shr_fathers_name" => ['required'],
            "shr_fathers_occupation" => ['required'],
            "shr_mothers_name" => ['required'],
            "shr_mothers_occupation" => ['required'],
            "shr_marital_status" => ['required'],
            "shr_weight" => ['required'],
            "shr_height" => ['required'],
            "shr_bmi" => ['required'],
            "shr_temperature" => ['required'],
            "shr_hr" => ['required'],
            "shr_bp" => ['required'],
            "shr_vision" => ['required'],
            "shr_hearing" => ['required'],
            "shr_blood_type" => ['required'],
            "shr_chest_xray_result" => ['required'],
            "shr_chest_xray_result_date" => ['required'],
            "shr_general_survey_findings" => ['required_if:shr_general_survey,=,1'],
            "shr_skin_findings" => ['required_if:shr_skin,=,1'],
            "shr_eye_ears_nose_findings" => ['required_if:shr_eye_ears_nose,=,1'],
            "shr_teeth_gums_findings" => ['required_if:shr_teeth_gums,=,1'],
            "shr_neck_findings" => ['required_if:shr_neck,=,1'],
            "shr_heart_findings" => ['required_if:shr_heart,=,1'],
            "shr_chest_lungs_findings" => ['required_if:shr_chest_lungs,=,1'],
            "shr_abdomen_findings" => ['required_if:shr_abdomen,=,1'],
            "shr_musculoskeletal_findings" => ['required_if:shr_musculoskeletal,=,1'],
            "shr_assessment_diagnosis_drinking_how_much" => ['required_if:shr_assessment_diagnosis_drinking,=,1'],
            "shr_assessment_diagnosis_drinking_how_often" => ['required_if:shr_assessment_diagnosis_drinking,=,1'],
            "shr_assessment_diagnosis_smoking_sticks_per_day" => ['required_if:shr_assessment_diagnosis_smoking,=,1'],
            "shr_assessment_diagnosis_smoking_since_when" => ['required_if:shr_assessment_diagnosis_smoking,=,1'],
            "shr_assessment_diagnosis_drug_kind" => ['required_if:shr_assessment_diagnosis_drug_use,=,1'],
            "shr_assessment_diagnosis_regular_use" => ['required_if:shr_assessment_diagnosis_drug_use,=,1'],
            "shr_assessment_driving_specify" => ['required_if:shr_assessment_driving,=,1'],
            "shr_assessment_diagnosis_abuse_specify" => ['required_if:shr_assessment_diagnosis_abuse,=,1'],
        ];

        $message = [
            "shr_med.required" => 'MedExam Date is required!',
            "shr_srcode.required" => 'SR-Code is required!',
            "shr_program.required" => 'Program is required!',
            "shr_firstname.required" => 'Firstname is required!',
            "shr_lastname.required" => 'Lastname is required!',
            "shr_home_address.required" => 'Home Address is required!',
            "shr_gender.required" => 'Gender is required!',
            "shr_age.required" => 'Age is required!',
            "shr_civil_status.required" => 'Civil Status is required!',
            "shr_religion.required" => 'Religion is required!',
            "shr_contact.required" => 'Contact is required!',
            "shr_date_of_birth.required" => 'Birthdate is required!',
            "shr_place_of_birth.required" => 'Birthplace is required!',
            "shr_emergency_firstname.required" => 'Firstname is required!',
            "shr_emergency_lastname.required" => 'Lastname is required!',
            "shr_emergency_business_address.required" => 'Business Address is required!',
            "shr_emergency_relation_to_patient.required" => 'Relation to patient is required!',
            "shr_emergency_contact.required" => 'Emergeny Contact is required!',
            "shr_past_illness_asthma_last_attack.required_if" => 'Asthma Last Attack is required!',
            "shr_past_illness_hospitalization_specify.required_if" => 'Hospitalization specify is required!',
            "shr_past_illness_operation_specify.required_if" => 'Operation specify is required!',
            "shr_past_illness_accident_specify.required_if" => 'Accident specify is required!',
            "shr_past_illness_disability_specify.required_if" => 'Disability specify is required!',
            "shr_allergy_food_specify.required_if" => 'Food allergy specify is required!',
            "shr_allergy_medicine_specify.required_if" => 'Medicine allergy specify is required!',
            "shr_allergy_others_specify.required_if" => 'Other allergy specify is required!',
            "shr_immunization_hepa_b_doses.required_if" => 'HepaB doses is required!',
            "shr_immunization_dpt_doses.required_if" => 'DPT doses is required!',
            "shr_immunization_opv_doses.required_if" => 'OPV doses is required!',
            "shr_immunization_hib_doses.required_if" => 'HIB doses is required!',
            "shr_male_age_of_onset.required_if" => 'Age of onset is required!',
            "shr_female_menarche.required_if" => 'Menarche is required!',
            "shr_female_lmp.required_if" => 'LMP is required!',
            "shr_female_dysmenorhea.required_if" => 'Dysmenorhea is required!',
            "shr_female_dysmenorhea_medicine.required_if" => 'Dysmenorhea medicine is required!',
            "shr_fathers_name.required" => 'Fathers name is required!',
            "shr_fathers_occupation.required" => 'Occupation is required!',
            "shr_mothers_name.required" => 'Mothers name is required!',
            "shr_mothers_occupation.required" => 'Occupation is required!',
            "shr_marital_status.required" => 'Marital status is required!',
            "shr_weight.required" => 'Weight is required!',
            "shr_height.required" => 'Height is required!',
            "shr_bmi.required" => 'BMI is required!',
            "shr_temperature.required" => 'Temparature is required!',
            "shr_hr.required" => 'HR is required!',
            "shr_bp.required" => 'BP is required!',
            "shr_vision.required" => 'Vision is required!',
            "shr_hearing.required" => 'Hearing is required!',
            "shr_blood_type.required" => 'Blood Type is required!',
            "shr_chest_xray_result.required" => 'Chest XRay result is required!',
            "shr_chest_xray_result_date.required" => 'XRay result date is required!',
            "shr_general_survey_findings.required_if" => 'Generay Survey findings is required!',
            "shr_skin_findings.required_if" => 'Skin findings is required!',
            "shr_eye_ears_nose_findings.required_if" => 'Eyes/ Ears/ Nose findings is required!',
            "shr_teeth_gums_findings.required_if" => 'Teeth/ Gums findings is required!',
            "shr_neck_findings.required_if" => 'Neck findings is required!',
            "shr_heart_findings.required_if" => 'Heart findings is required!',
            "shr_chest_lungs_findings.required_if" => 'Chest/ Lungs findings is required!',
            "shr_abdomen_findings.required_if" => 'Abdomen findings is required!',
            "shr_musculoskeletal_findings.required_if" => 'Musculoskeletal is required!',
            "shr_assessment_diagnosis_drinking_how_much.required_if" => 'Drinking how much is required!',
            "shr_assessment_diagnosis_drinking_how_often.required_if" => 'Drinking how often is required!',
            "shr_assessment_diagnosis_smoking_sticks_per_day.required_if" => 'Sticks per day is required!',
            "shr_assessment_diagnosis_smoking_since_when.required_if" => 'Smoking since when is required!', 
            "shr_assessment_diagnosis_drug_kind.required_if" => 'Drug kind is required!',
            "shr_assessment_diagnosis_regular_use.required_if" => 'Regular use is required!',
            "shr_assessment_driving_specify.required_if" => 'Specify Vehicle is required!',
            "shr_assessment_diagnosis_abuse_specify.required_if" => 'Abuse kind is required!',
        ];

        $validator = Validator::make( $request->all(), $rules, $message);

        if($validator->fails()){
            $response = [
                'title' => 'Failed!',
                'message' => 'Invalid data, Student Health Record not updated.',
                'icon' => 'error',
                'status' => 400,
                'errors' => $validator->messages(),
                'form' => 'shr'
            ]; 
        }
        else{
            try{

                if($request->file('shr_profile_pic')){
                    $path = '/public/profile_picture/';
                    $file = $request->file('shr_profile_pic');
                    $file_name = 'SHR-'.$id.'_'.time().'.'.$file->extension();
                    $upload = $file->storeAs($path, $file_name);
                }
                else{
                    $file_name = DB::table('student_health_record')
                        ->where('shr_id', $id)
                        ->select('shr_profile_pic')
                        ->first()
                        ->shr_profile_pic;
                }

                $shr_id = DB::table("student_health_record")->where('shr_id', $id)->update([
                    "shr_med" => $request->shr_med,
                    "shr_srcode" => $request->shr_srcode,
                    "shr_program" => $request->shr_program,
                    "shr_profile_pic" => $file_name,
                    "shr_firstname" => $request->shr_firstname,
                    "shr_middlename" => $request->shr_middlename,
                    "shr_lastname" => $request->shr_lastname,
                    "shr_suffixname" => $request->shr_suffixname,
                    "shr_home_address" => $request->shr_home_address,
                    "shr_dorm_address" => $request->shr_dorm_address,
                    "shr_gender" => $request->shr_gender,
                    "shr_age" => $request->shr_age,
                    "shr_civil_status" => $request->shr_civil_status,
                    "shr_religion" => $request->shr_religion,
                    "shr_contact" => $request->shr_contact,
                    "shr_date_of_birth" => $request->shr_date_of_birth,
                    "shr_place_of_birth" => $request->shr_place_of_birth,
                    "shr_emergency_name" => $request->shr_emergency_name,
                    "shr_emergency_business_address" => $request->shr_emergency_business_address,
                    "shr_emergency_relation_to_patient" => $request->shr_emergency_relation_to_patient,
                    "shr_emergency_landline" => $request->shr_emergency_landline,
                    "shr_emergency_contact" => $request->shr_emergency_contact,
                    "shr_past_illness_asthma_last_attack" => (($request->shr_past_illness_asthma) ? $request->shr_past_illness_asthma_last_attack : NULL),
                    "shr_past_illness_heart_disease" => $request->shr_past_illness_heart_disease,
                    "shr_past_illness_hypertension" => $request->shr_past_illness_hypertension,
                    "shr_past_illness_epilepsy" => $request->shr_past_illness_epilepsy,
                    "shr_past_illness_diabetes" => $request->shr_past_illness_diabetes,
                    "shr_past_illness_thyroid_problem" => $request->shr_past_illness_thyroid_problem,
                    "shr_past_illness_measles" => $request->shr_past_illness_measles,
                    "shr_past_illness_mumps" => $request->shr_past_illness_mumps,
                    "shr_past_illness_varicella" => $request->shr_past_illness_varicella,
                    "shr_past_illness_hospitalization_specify" => (($request->shr_past_illness_hospitalization) ? $request->shr_past_illness_hospitalization_specify : NULL),
                    "shr_past_illness_operation_specify" => (($request->shr_past_illness_operation) ? $request->shr_past_illness_operation_specify : NULL), 
                    "shr_past_illness_accident_specify" => (($request->shr_past_illness_accident) ? $request->shr_past_illness_accident_specify : NULL),  
                    "shr_past_illness_disability_specify" => (($request->shr_past_illness_disability) ? $request->shr_past_illness_disability_specify : NULL), 
                    "shr_allergy_food_specify" => (($request->shr_allergy_food) ? $request->shr_allergy_food_specify : NULL), 
                    "shr_allergy_medicine_specify" => (($request->shr_allergy_medicine) ? $request->shr_allergy_medicine_specify : NULL),    
                    "shr_allergy_others_specify" => (($request->shr_allergy_others) ? $request->shr_allergy_others_specify : NULL),    
                    "shr_immunization_bcg" => $request->shr_immunization_bcg,
                    "shr_immunization_mmr" => $request->shr_immunization_mmr,
                    "shr_immunization_hepa_a" => $request->shr_immunization_hepa_a,
                    "shr_immunization_typhoid" => $request->shr_immunization_typhoid,
                    "shr_immunization_varicella" => $request->shr_immunization_varicella,
                    "shr_immunization_hepa_b_doses" => (($request->shr_immunization_hepa_b) ? $request->shr_immunization_hepa_b_doses : NULL),  
                    "shr_immunization_dpt_doses" => (($request->shr_immunization_dpt) ? $request->shr_immunization_dpt_doses : NULL),     
                    "shr_immunization_opv_doses" => (($request->shr_immunization_opv) ? $request->shr_immunization_opv_doses : NULL),    
                    "shr_immunization_hib_doses" => (($request->shr_immunization_hib) ? $request->shr_immunization_hib_doses : NULL),    
                    "shr_male_age_of_onset" => (($request->shr_gender=='male') ? $request->shr_male_age_of_onset : NULL),
                    "shr_female_menarche" => (($request->shr_gender=='female') ? $request->shr_female_menarche : NULL),
                    "shr_female_lmp" => (($request->shr_gender=='female') ? $request->shr_female_lmp : NULL),    
                    "shr_female_dysmenorhea" => $request->shr_female_dysmenorhea,    
                    "shr_female_dysmenorhea_medicine" => $request->shr_female_dysmenorhea_medicine,    
                    "shr_family_history_diabetes" => $request->shr_family_history_diabetes,
                    "shr_family_history_heart_disease" => $request->shr_family_history_heart_disease,
                    "shr_family_history_mental_illness" => $request->shr_family_history_mental_illness,
                    "shr_family_history_cancer" => $request->shr_family_history_cancer,
                    "shr_family_history_hypertension" => $request->shr_family_history_hypertension,
                    "shr_family_history_kidney_disease" => $request->shr_family_history_kidney_disease,
                    "shr_family_history_epilepsy" => $request->shr_family_history_epilepsy,
                    "shr_family_history_others" => $request->shr_family_history_others,
                    "shr_fathers_name" => $request->shr_fathers_name,
                    "shr_fathers_occupation" => $request->shr_fathers_occupation,
                    "shr_mothers_name" => $request->shr_mothers_name,
                    "shr_mothers_occupation" => $request->shr_mothers_occupation,
                    "shr_marital_status" => $request->shr_marital_status,
                    "shr_weight" => $request->shr_weight,
                    "shr_height" => $request->shr_height,
                    "shr_bmi" => $request->shr_bmi,
                    "shr_temperature" => $request->shr_temperature,
                    "shr_hr" => $request->shr_hr,
                    "shr_bp" => $request->shr_bp,
                    "shr_vision" => $request->shr_vision,
                    "shr_hearing" => $request->shr_hearing,
                    "shr_blood_type" => $request->shr_blood_type,
                    "shr_chest_xray_result" => $request->shr_chest_xray_result,
                    "shr_chest_xray_result_date" => $request->shr_chest_xray_result_date,
                    "shr_general_survey_findings" => (($request->shr_general_survey) ? $request->shr_general_survey_findings : NULL),
                    "shr_skin_findings" => (($request->shr_skin) ? $request->shr_skin_findings : NULL),
                    "shr_eye_ears_nose_findings" => (($request->shr_eye_ears_nose) ? $request->shr_eye_ears_nose_findings : NULL),
                    "shr_teeth_gums_findings" => (($request->shr_teeth_gums) ? $request->shr_teeth_gums_findings : NULL),
                    "shr_neck_findings" => (($request->shr_neck) ? $request->shr_neck_findings : NULL),
                    "shr_heart_findings" => (($request->shr_heart) ? $request->shr_heart_findings : NULL),
                    "shr_abdomen_findings" => (($request->shr_abdomen) ? $request->shr_abdomen_findings : NULL),
                    "shr_chest_lungs_findings" => (($request->shr_chest_lungs) ? $request->shr_chest_lungs_findings : NULL),
                    "shr_musculoskeletal_findings" => (($request->shr_musculoskeletal) ? $request->shr_musculoskeletal_findings : NULL),
                    "shr_assessment_diagnosis_drinking_how_much" => (($request->shr_assessment_diagnosis_drinking) ? $request->shr_assessment_diagnosis_drinking_how_much : NULL),
                    "shr_assessment_diagnosis_drinking_how_often" => (($request->shr_assessment_diagnosis_drinking) ? $request->shr_assessment_diagnosis_drinking_how_often : NULL),
                    "shr_assessment_diagnosis_smoking_sticks_per_day" => (($request->shr_assessment_diagnosis_smoking) ? $request->shr_assessment_diagnosis_smoking_sticks_per_day : NULL),
                    "shr_assessment_diagnosis_smoking_since_when" => (($request->shr_assessment_diagnosis_smoking) ? $request->shr_assessment_diagnosis_smoking_since_when : NULL),
                    "shr_assessment_diagnosis_drug_kind" => (($request->shr_assessment_diagnosis_drug_use) ? $request->shr_assessment_diagnosis_drug_kind : NULL),
                    "shr_assessment_diagnosis_regular_use" => (($request->shr_assessment_diagnosis_drug_use) ? $request->shr_assessment_diagnosis_regular_use : NULL),
                    "shr_assessment_driving_specify" => (($request->shr_assessment_driving) ? $request->shr_assessment_driving_specify : NULL),
                    "shr_assessment_driving_with_license" => (($request->shr_assessment_driving) ? $request->shr_assessment_driving_with_license : NULL),
                    "shr_assessment_diagnosis_abuse_specify" => (($request->shr_assessment_diagnosis_abuse) ? $request->shr_assessment_diagnosis_abuse_specify : NULL),
                ]);

                DB::table("forms")
                ->where('form_type', 'SHR')
                ->where('form_org_id', $id)
                ->update([
                    "form_date_updated"	=> date("Y-m-d")
                ]);

                $response = [
                    'title' => 'Success!',
                    'message' => 'Student Health Record updated.',
                    'icon' => 'success',
                    'status' => 200
                ];
            }
            catch(Exception $e){
                $response = [
                    'title' => 'Failed!',
                    'message' => 'Server Error, Student Health Record not updated.'.$e,
                    'icon' => 'error',
                    'status' => 400,
                    'form' => 'shr'
                ];
            }
        }

        echo json_encode($response);
    }

    public function delete($id){
        try{
            $form = DB::table('forms')->where('form_id', $id)->first();

            if($form){
                DB::table('forms')->where('form_id', $id)->delete();
                DB::table('student_health_record')->where('shr_id', $form->form_org_id)->delete();
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

    public function print($id){
        $d = DB::table('student_health_record as shr')
            ->leftjoin('program as prog', 'shr.shr_program', 'prog.prog_id')
            ->where('shr_id', $id)
            ->first();

        // echo json_encode($d);

        $filename = 'Student_Health_Record_'.$id;
        
        $pdf = PDF::loadView('Reports.Forms.StudentHealthRecord', compact('d', 'filename'));
        $pdf->setPaper('a4', 'portrait');
        
        return $pdf->stream($filename);
    }
}
