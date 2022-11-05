<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentHealthRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_health_record', function (Blueprint $table) {
            $table->id("shr_id");

            $table->date("shr_med");
            $table->string("shr_srcode");
            $table->string("shr_program");

            $table->string("shr_profile_pic");
            $table->string("shr_firstname");
            $table->string("shr_middlename");
            $table->string("shr_lastname");
            $table->string("shr_suffixname")->nullable();
            $table->string("shr_home_address");
            $table->string("shr_dorm_address")->nullable();
            $table->string("shr_gender");
            $table->integer("shr_age");
            $table->string("shr_civil_status");
            $table->string("shr_religion");
            $table->string("shr_contact");
            $table->date("shr_date_of_birth");
            $table->string("shr_place_of_birth");

            $table->string("shr_emergency_firstname");
            $table->string("shr_emergency_middlename");
            $table->string("shr_emergency_lastname");
            $table->string("shr_emergency_suffixname")->nullable();    
            $table->string("shr_emergency_business_address");
            $table->string("shr_emergency_relation_to_patient");
            $table->string("shr_emergency_landline")->nullable();    
            $table->string("shr_emergency_contact");

            $table->date("shr_past_illness_asthma_last_attack")->nullable();    
            $table->boolean("shr_past_illness_heart_disease");
            $table->boolean("shr_past_illness_hypertension");
            $table->boolean("shr_past_illness_epilepsy");
            $table->boolean("shr_past_illness_diabetes");
            $table->boolean("shr_past_illness_thyroid_problem");
            $table->boolean("shr_past_illness_measles");
            $table->boolean("shr_past_illness_mumps");
            $table->boolean("shr_past_illness_varicella");
            $table->string("shr_past_illness_hospitalization_specify")->nullable();    
            $table->string("shr_past_illness_operation_specify")->nullable();    
            $table->string("shr_past_illness_accident_specify")->nullable();    
            $table->string("shr_past_illness_disability_specify")->nullable();    
            $table->string("shr_allergy_food_specify")->nullable();    
            $table->string("shr_allergy_medicine_specify")->nullable();    
            $table->boolean("shr_allergy_others_specify")->nullable();    
            $table->boolean("shr_immunization_bcg");
            $table->boolean("shr_immunization_mmr");
            $table->boolean("shr_immunization_hepa_a");
            $table->boolean("shr_immunization_typhoid");
            $table->boolean("shr_immunization_varicella");
            $table->integer("shr_immunization_hepa_b_doses")->nullable();    
            $table->integer("shr_immunization_dpt_doses")->nullable();    
            $table->integer("shr_immunization_opv_doses")->nullable();    
            $table->integer("shr_immunization_hib_doses")->nullable();    

            $table->integer("shr_male_age_of_onset")->nullable();
            $table->integer("shr_female_menarche")->nullable();
            $table->date("shr_female_lmp")->nullable();    
            $table->boolean("shr_female_dysmenorhea")->nullable();    
            $table->string("shr_female_dysmenorhea_medicine")->nullable();    

            $table->boolean("shr_family_history_diabetes");
            $table->boolean("shr_family_history_heart_disease");
            $table->boolean("shr_family_history_mental_illness");
            $table->boolean("shr_family_history_cancer");
            $table->boolean("shr_family_history_hypertension");
            $table->boolean("shr_family_history_kidney_disease");
            $table->boolean("shr_family_history_epilepsy");
            $table->boolean("shr_family_history_others");
            $table->string("shr_fathers_firstname");
            $table->string("shr_fathers_middlename");
            $table->string("shr_fathers_lastname");
            $table->string("shr_fathers_suffixname")->nullable();
            $table->string("shr_fathers_occupation");
            $table->string("shr_mothers_firstname");
            $table->string("shr_mothers_middlename");
            $table->string("shr_mothers_lastname");
            $table->string("shr_mothers_suffixname")->nullable();
            $table->string("shr_mothers_occupation");
            $table->string("shr_marital_status");
            $table->string("shr_weight");
            $table->string("shr_height");
            $table->string("shr_bmi");
            $table->string("shr_temperature");
            $table->string("shr_hr");
            $table->string("shr_bp");
            $table->string("shr_vision");
            $table->string("shr_hearing");
            $table->string("shr_blood_type");
            $table->string("shr_chest_xray_result")->nullable();
            $table->date("shr_chest_xray_result_date")->nullable();
            $table->string("shr_general_survey_findings")->nullable();
            $table->string("shr_skin_findings")->nullable();
            $table->string("shr_eye_ears_nose_findings")->nullable();
            $table->string("shr_teeth_gums_findings")->nullable();
            $table->string("shr_neck_findings")->nullable();
            $table->string("shr_heart_findings")->nullable();
            $table->string("shr_chest_lungs_findings")->nullable();
            $table->string("shr_musculoskeletal_findings")->nullable();
            $table->string("shr_assessment_diagnosis_drinking_how_much")->nullable();
            $table->string("shr_assessment_diagnosis_drinking_how_often")->nullable();
            $table->integer("shr_assessment_diagnosis_smoking_sticks_per_day")->nullable();
            $table->string("shr_assessment_diagnosis_smoking_since_when")->nullable();
            $table->string("shr_assessment_diagnosis_drug_kind")->nullable();
            $table->boolean("shr_assessment_diagnosis_regular_use")->nullable();
            $table->string("shr_assessment_driving_specify")->nullable();
            $table->boolean("shr_assessment_driving_with_license")->nullable();
            $table->string("shr_assessment_diagnosis_abuse_specify")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_health_record');
    }
}
