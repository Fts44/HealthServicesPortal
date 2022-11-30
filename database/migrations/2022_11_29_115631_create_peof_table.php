<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeofTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peof', function (Blueprint $table) {
            $table->id('peof_id');
            $table->integer('peof_type'); //1 PreEmployment, 0 OJT
            $table->date('peof_date');
            $table->string('peof_lastname');
            $table->string('peof_firstname');
            $table->string('peof_middlename');
            $table->string('peof_sex');
            $table->date('peof_birthdate'); 
            $table->integer('peof_age'); 
            $table->string('peof_civil_status');
            $table->string('peof_contact'); //cellphone
            $table->string('peof_tel_no')->nullable(); // tel no
            $table->string('peof_address');
            $table->string('peof_position_campus');
            $table->longText('peof_medical_history');
            $table->longText('peof_family_history');
            $table->longText('peof_occupational_history');
            $table->string('peof_chest_xray');
            //columns here if empty means that they are normal
            $table->string('peof_bmi_findings')->nullable();
            $table->string('peof_skin_findings')->nullable();
            $table->string('peof_head_and_scalp_findings')->nullable();
            $table->string('peof_eyes_findings')->nullable();
            $table->string('peof_ears_findings')->nullable();
            $table->string('peof_nose_and_throat_findings')->nullable();
            $table->string('peof_mouth_findings')->nullable(); 
            $table->string('peof_neck_thyroid_ln_findings')->nullable();
            $table->string('peof_chest_breast_axilla_findings')->nullable();
            $table->string('peof_heart_findings')->nullable();
            $table->string('peof_lungs_findings')->nullable();
            $table->string('peof_abdomen_findings')->nullable();
            $table->string('peof_anus_rectum_findings')->nullable();
            $table->string('peof_genital_findings')->nullable();
            $table->string('peof_musculoskeletal_findings')->nullable();
            $table->string('peof_extremities_findings')->nullable();
            $table->string('peof_chest_xray_findings')->nullable();
            $table->string('peof_cbc_findings')->nullable();
            $table->string('peof_routine_urinalysis_findings')->nullable();
            $table->string('peof_stool_examination_findings')->nullable();
            $table->string('peof_hepa_b_screening_findings')->nullable(); 

            $table->string('peof_bp');
            $table->string('peof_hr');
            $table->boolean('peof_hearing');
            $table->string('peof_vision'); // 1 - without glasses , 0 - with glasses
            $table->string('peof_vision_r');
            $table->string('peof_vision_l');
            $table->boolean('peof_drug_test_metamphetamine');
            $table->boolean('peof_drug_test_tetrahydrocannabinol');

            $table->string('peof_pic');
            $table->string('peof_school_company_institution');
            $table->string('peof_weight');
            $table->string('peof_height');
            $table->string('peof_classification');
            $table->string('peof_needs_for_treatment')->nullable();
            
            $table->integer('peof_patient_id');
            $table->integer('peof_physician_id');
            $table->string('peof_patient_signature')->nullable();
            $table->string('peof_physician_signature')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peof');
    }
}
