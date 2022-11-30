<div class="modal fade" id="modal_form_peof" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal_title" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" style="font-size: 15px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_title">Pre-Employment/ OJT Medical Form</h5>
                <button class="btn btn-primary btn-sm" id="peof_unlock_lock" value="0">
                    <span id="peof_lbl_unlock"><i class="bi bi-unlock-fill"></i> Unlock</span>
                    <span id="peof_lbl_lock" class="d-none"><i class="bi bi-lock-fill"></i> Lock</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="" method="POST" enctype="multipart/form-data" id="peof_form" >
                    <!-- form type -->
                    @csrf
                    @method('PUT')
                    <fieldset class="border border-secondary pb-2" style="border-radius: 5px;">
                        <legend  class="float-none w-auto px-1" style="font-weight: 600; font-size: 15px; margin-left: 5px;">Header</legend>
                        <div class="row px-2 pb-2">
                            <label class="col-lg-6 mt-1">
                                Type
                                <select name="peof_type" id="peof_type" class="form-select" disabled>
                                    <option value="1">Pre Employment</option>
                                    <option value="0">OJT</option>
                                </select>
                                <span class="text-danger peof-error" id="peof_type-error"></span>
                            </label>
                            <label class="col-lg-6 mt-1" disabled>
                                Date
                                <input type="date" name="peof_date" id="peof_date" class="form-control" value="{{ date('Y-m-d') }}" disabled>
                                <span class="text-danger peof-error" id="peof_date-error"></span>
                            </label>
                        </div>
                    </fieldset>

                    <fieldset class="border border-secondary pb-2 mt-2" style="border-radius: 5px;">
                        <legend  class="float-none w-auto px-1" style="font-weight: 600; font-size: 15px; margin-left: 5px;">Personal Information</legend>
                        <div class="row px-2 pb-2">
                            <label class="col-lg-4 mt-1">
                                Firstname
                                <input type="text" name="peof_firstname" id="peof_firstname" class="form-control" disabled>
                                <span class="text-danger peof-error" id="peof_firstname-error"></span>
                            </label>
                            <label class="col-lg-4 mt-1">
                                Middlename
                                <input type="text" name="peof_middlename" id="peof_middlename" class="form-control" disabled>
                                <span class="text-danger peof-error" id="peof_middlename-error"></span>
                            </label>
                            <label class="col-lg-4 mt-1">
                                Lastname
                                <input type="text" name="peof_lastname" id="peof_lastname" class="form-control" disabled>
                                <span class="text-danger peof-error" id="peof_lastname-error"></span>
                            </label>
                        </div>
                        <div class="row px-2 pb-2">
                            <label class="col-lg-6 mt-1">
                                Address
                                <input type="text" name="peof_address" id="peof_address" class="form-control" disabled>
                                <span class="text-danger peof-error" id="peof_address-error"></span>
                            </label>
                            <label class="col-lg-6 mt-1">
                                Position/ Campus
                                <input type="text" name="peof_position_campus" id="peof_position_campus" class="form-control" disabled>
                                <span class="text-danger peof-error" id="peof_position_campus-error"></span>
                            </label>
                        </div>
                        <div class="row px-2 pb-2">
                            <label class="col-lg-3 mt-1">
                                Sex
                                <select name="peof_sex" id="peof_sex" class="form-select" disabled>
                                    <option value="">--- choose --</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                                <span class="text-danger peof-error" id="peof_sex-error"></span>
                            </label>
                            <label class="col-lg-3 mt-1">
                                Civil Status
                                <select name="peof_civil_status" id="peof_civil_status" class="form-select" disabled>
                                    <option value="">--- choose --</option>
                                    <option value="single">Single</option>
                                    <option value="married">Married</option>
                                    <option value="separated">Separated</option>
                                    <option value="widowed">Widowed</option>
                                </select>
                                <span class="text-danger peof-error" id="peof_civil_status-error"></span>
                            </label>
                            <label class="col-lg-3 mt-1">
                                Birthdate:
                                <input type="date" name="peof_birthdate" id="peof_birthdate" class="form-control" disabled>
                                <span class="text-danger peof-error" id="peof_birthdate-error"></span>
                            </label>
                            <label class="col-lg-3 mt-1">
                                Age:
                                <input type="number" name="peof_age" id="peof_age" class="form-control" readonly>
                                <span class="text-danger peof-error" id="peof_age-error"></span>
                            </label>
                        </div>
                        <div class="row px-2 pb-2">
                            <label class="col-lg-6 mt-1">
                                Cellphone No:
                                <input type="tel" name="peof_contact" id="peof_contact" class="form-control" disabled>
                                <span class="text-danger peof-error" id="peof_contact-error"></span>
                            </label>
                            <label class="col-lg-6 mt-1">
                                Tel No:
                                <input type="tel" name="peof_tel" id="peof_tel" class="form-control" disabled>
                                <span class="text-danger peof-error" id="peof_tel-error"></span>
                            </label>
                        </div>
                    </fieldset>

                    <fieldset class="border border-secondary pb-2 mt-2" style="border-radius: 5px;">
                        <legend  class="float-none w-auto px-1" style="font-weight: 600; font-size: 15px; margin-left: 5px;">Patient History</legend>
                        <div class="row px-2 pb-2">
                            <label class="col-lg-12 mt-1">
                                Medical History
                                <textarea name="peof_medical_history" id="peof_medical_history" rows="3" class="form-control" disabled></textarea>
                                <span class="text-danger peof-error" id="peof_medical_history-error"></span>
                            </label>
                            <label class="col-lg-12 mt-1">
                                Family History
                                <textarea name="peof_family_history" id="peof_family_history" rows="3" class="form-control" disabled></textarea>
                                <span class="text-danger peof-error" id="peof_family_history-error"></span>
                            </label>
                            <label class="col-lg-12 mt-1">
                                Occupational History
                                <textarea name="peof_occupational_history" id="peof_occupational_history" rows="3" class="form-control" disabled></textarea>
                                <span class="text-danger peof-error" id="peof_occupational_history-error"></span>
                            </label>
                        </div>
                    </fieldset>

                    <fieldset class="border border-secondary pb-2 mt-2" style="border-radius: 5px;">
                        <legend  class="float-none w-auto px-1" style="font-weight: 600; font-size: 15px; margin-left: 5px;">Physical Examination</legend>
                        <div class="row px-2 pb-2">
                            <label class="col-lg-3 mt-1">
                                BMI
                                <select name="peof_bmi" id="peof_bmi" class="form-select" disabled>
                                    <option value="0">Normal</option>
                                    <option value="1">Not Normal</option>
                                </select>
                            </label>
                            <label class="col-lg-9 mt-1">
                                BMI Findings
                                <input name="peof_bmi_findings" id="peof_bmi_findings" type="text" class="form-control" disabled>
                                <span class="text-danger peof-error" id="peof_bmi_findings-error"></span>
                            </label>

                            <label class="col-lg-3 mt-1">
                                Skin (Tatto)
                                <select name="peof_skin" id="peof_skin" class="form-select" disabled>
                                    <option value="0">Normal</option>
                                    <option value="1">Not Normal</option>
                                </select>
                            </label>
                            <label class="col-lg-9 mt-1">
                                Skin Findings
                                <input name="peof_skin_findings" id="peof_skin_findings" type="text" class="form-control" disabled>
                                <span class="text-danger peof-error" id="peof_skin_findings-error"></span>
                            </label>

                            <label class="col-lg-3 mt-1">
                                Head and Scalp
                                <select name="peof_head_and_scalp" id="peof_head_and_scalp" class="form-select" disabled>
                                    <option value="0">Normal</option>
                                    <option value="1">Not Normal</option>
                                </select>
                            </label>
                            <label class="col-lg-9 mt-1">
                                Head and Scalp Findings
                                <input name="peof_head_and_scalp_findings" id="peof_head_and_scalp_findings" type="text" class="form-control" disabled>
                                <span class="text-danger peof-error" id="peof_head_and_scalp_findings-error"></span>  
                            </label>

                            <label class="col-lg-3 mt-1">
                                Eyes (External)
                                <select name="peof_eyes" id="peof_eyes" class="form-select" disabled>
                                    <option value="0">Normal</option>
                                    <option value="1">Not Normal</option>
                                </select>
                            </label>
                            <label class="col-lg-9 mt-1">
                                Eyes Findings
                                <input name="peof_eyes_findings" id="peof_eyes_findings"  type="text" class="form-control" disabled>
                                <span class="text-danger peof-error" id="peof_eyes_findings-error"></span>
                            </label>

                            <label class="col-lg-3 mt-1">
                                Ears (Piercing)
                                <select name="peof_ears" id="peof_ears" class="form-select" disabled>
                                    <option value="0">Normal</option>
                                    <option value="1">Not Normal</option>
                                </select>
                            </label>
                            <label class="col-lg-9 mt-1">
                                Ears Findings
                                <input name="peof_ears_findings" id="peof_ears_findings" type="text" class="form-control" disabled>
                                <span class="text-danger peof-error" id="peof_ears_findings-error"></span>
                            </label>

                            <label class="col-lg-3 mt-1">
                                Nose and Throat
                                <select name="peof_nose_and_throat" id="peof_nose_and_throat" class="form-select" disabled>
                                    <option value="0">Normal</option>
                                    <option value="1">Not Normal</option>
                                </select>
                            </label>
                            <label class="col-lg-9 mt-1">
                                Nose and Throat Findings
                                <input name="peof_nose_and_throat_findings" id="peof_nose_and_throat_findings" type="text" class="form-control" disabled>
                                <span class="text-danger peof-error" id="peof_nose_and_throat_findings-error"></span>
                            </label>

                            <label class="col-lg-3 mt-1">
                                Mouth
                                <select name="peof_mouth" id="peof_mouth" class="form-select" disabled>
                                    <option value="0">Normal</option>
                                    <option value="1">Not Normal</option>
                                </select>
                            </label>
                            <label class="col-lg-9 mt-1">
                                Mouth Findings
                                <input name="peof_mouth_findings" id="peof_mouth_findings" type="text" class="form-control" disabled>
                                <span class="text-danger peof-error" id="peof_mouth_findings-error"></span>
                            </label>

                            <label class="col-lg-3 mt-1">
                                Neck, Thyroid, LN
                                <select name="peof_neck_thyroid_ln" id="peof_neck_thyroid_ln" class="form-select" disabled>
                                    <option value="0">Normal</option>
                                    <option value="1">Not Normal</option>
                                </select>
                            </label>
                            <label class="col-lg-9 mt-1">
                                Neck, Thyroid, LN Findings
                                <input name="peof_neck_thyroid_ln_findings" id="peof_neck_thyroid_ln_findings" type="text" class="form-control" disabled>
                                <span class="text-danger peof-error" id="peof_neck_thyroid_ln_findings-error"></span>
                            </label>

                            <label class="col-lg-3 mt-1">
                                Chest, Breast, Axilla
                                <select name="peof_chest_breast_axilla" id="peof_chest_breast_axilla" class="form-select" disabled>
                                    <option value="0">Normal</option>
                                    <option value="1">Not Normal</option>
                                </select>
                            </label>
                            <label class="col-lg-9 mt-1">
                                Chest, Breast, Axilla Findings
                                <input name="peof_chest_breast_axilla_findings" id="peof_chest_breast_axilla_findings" type="text" class="form-control" disabled>
                                <span class="text-danger peof-error" id="peof_chest_breast_axilla_findings-error"></span>
                            </label>

                            <label class="col-lg-3 mt-1">
                                Heart
                                <select name="peof_heart" id="peof_heart" class="form-select" disabled>
                                    <option value="0">Normal</option>
                                    <option value="1">Not Normal</option>
                                </select>
                            </label>
                            <label class="col-lg-9 mt-1">
                                Heart Findings
                                <input name="peof_heart_findings" id="peof_heart_findings" type="text" class="form-control" disabled>
                                <span class="text-danger peof-error" id="peof_heart_findings-error"></span>
                            </label>

                            <label class="col-lg-3 mt-1">
                                Lungs
                                <select name="peof_lungs" id="peof_lungs" class="form-select" disabled>
                                    <option value="0">Normal</option>
                                    <option value="1">Not Normal</option>
                                </select>
                            </label>
                            <label class="col-lg-9 mt-1">
                                Lungs Findings
                                <input name="peof_lungs_findings" id="peof_lungs_findings" type="text" class="form-control" disabled>
                                <span class="text-danger peof-error" id="peof_lungs_findings-error"></span>
                            </label>

                            <label class="col-lg-3 mt-1">
                                Abdomen
                                <select name="peof_abdomen" id="peof_abdomen" class="form-select" disabled>
                                    <option value="0">Normal</option>
                                    <option value="1">Not Normal</option>
                                </select>
                            </label>
                            <label class="col-lg-9 mt-1">
                                Abdomen Findings
                                <input name="peof_abdomen_findings" id="peof_abdomen_findings" type="text" class="form-control" disabled>
                                <span class="text-danger peof-error" id="peof_abdomen_findings-error"></span>
                            </label>

                            <label class="col-lg-3 mt-1">
                                Anus, Rectum
                                <select name="peof_anus_rectum" id="peof_anus_rectum" class="form-select" disabled>
                                    <option value="0">Normal</option>
                                    <option value="1">Not Normal</option>
                                </select>
                            </label>
                            <label class="col-lg-9 mt-1">
                                Anus, Rectum Findings
                                <input name="peof_anus_rectum_findings" id="peof_anus_rectum_findings" type="text" class="form-control" disabled>
                                <span class="text-danger peof-error" id="peof_anus_rectum_findings-error"></span>
                            </label>

                            <label class="col-lg-3 mt-1">
                                Genital
                                <select name="peof_genital" id="peof_genital" class="form-select" disabled>
                                    <option value="0">Normal</option>
                                    <option value="1">Not Normal</option>
                                </select>
                            </label>
                            <label class="col-lg-9 mt-1">
                                Genital Findings
                                <input name="peof_genital_findings" id="peof_genital_findings" type="text" class="form-control" disabled>
                                <span class="text-danger peof-error" id="peof_genital_findings-error"></span>
                            </label>

                            <label class="col-lg-3 mt-1">
                                Musculo-Skeletal
                                <select name="peof_musculoskeletal" id="peof_musculoskeletal" class="form-select" disabled>
                                    <option value="0">Normal</option>
                                    <option value="1">Not Normal</option>
                                </select>
                            </label>
                            <label class="col-lg-9 mt-1">
                                Musculo-Skeletal Findings
                                <input name="peof_musculoskeletal_findings" id="peof_musculoskeletal_findings" type="text" class="form-control" disabled>
                                <span class="text-danger peof-error" id="peof_musculoskeletal_findings-error"></span>
                            </label>

                            <label class="col-lg-3 mt-1">
                                Extremities
                                <select name="peof_extremities" id="peof_extremities" class="form-select" disabled>
                                    <option value="0">Normal</option>
                                    <option value="1">Not Normal</option>
                                </select>
                            </label>
                            <label class="col-lg-9 mt-1">
                                Extremities Findings
                                <input name="peof_extremities_findings" id="peof_extremities_findings" type="text" class="form-control" disabled>
                                <span class="text-danger peof-error" id="peof_extremities_findings-error"></span>
                            </label>
                        </div>
                    </fieldset>

                    <fieldset class="border border-secondary pb-2 mt-2" style="border-radius: 5px;">
                        <legend  class="float-none w-auto px-1" style="font-weight: 600; font-size: 15px; margin-left: 5px;">Diagnostic Examination</legend>
                        <div class="row px-2 pb-2">
                            <label class="col-lg-4 mt-1">
                                BP
                                <input type="text" name="peof_bp" id="peof_bp" class="form-control" disabled>
                                <span class="text-danger peof-error" id="peof_bp-error"></span>
                            </label>
                            <label class="col-lg-4 mt-1">
                                HR
                                <input type="text" name="peof_hr" id="peof_hr" class="form-control" disabled>
                                <span class="text-danger peof-error" id="peof_hr-error"></span>
                            </label>
                            <label class="col-lg-4 mt-1">
                                Hearing
                                <select name="peof_hearing" id="peof_hearing" class="form-select" disabled>
                                    <option value="1">Normal</option>
                                    <option value="0">Defective</option>
                                </select>
                            </label>
                            
                            <label class="col-lg-4 mt-1">
                                Vision
                                <select name="peof_vision" id="peof_vision" class="form-select" disabled>
                                    <option value="0">Without Glasses</option>
                                    <option value="1">With Glasses</option>
                                </select>
                            </label>
                            <label class="col-lg-4 mt-1">
                                Vision (R)
                                <input type="text" name="peof_vision_r" id="peof_vision_r" class="form-control" disabled>
                                <span class="text-danger peof-error" id="peof_vision_r-error"></span>
                            </label>
                            <label class="col-lg-4 mt-1">
                                Vision (L)
                                <input type="text" name="peof_vision_l" id="peof_vision_l" class="form-control" disabled>
                                <span class="text-danger peof-error" id="peof_vision_l-error"></span>
                            </label>

                            <label class="col-lg-3 mt-1">
                                Chest XRay
                                <select name="peof_chest_xray" id="peof_chest_xray" class="form-select" disabled>
                                    <option value="0">normal</option>
                                    <option value="pa">PA</option>
                                    <option value="lordotic">Lordotic</option>
                                </select>
                            </label>
                            <label class="col-lg-9 mt-1">
                                Chest XRay Findings
                                <input type="text" name="peof_chest_xray_findings" id="peof_chest_xray_findings" class="form-control" disabled>
                                <span class="text-danger peof-error" id="peof_chest_xray_findings-error"></span>
                            </label>

                            <label class="col-lg-3 mt-1">
                                Complete Blood Count
                                <select name="peof_complete_blood_count" id="peof_complete_blood_count" class="form-select" disabled>
                                    <option value="0">Normal</option>
                                    <option value="1">Not Normal</option>
                                </select>
                            </label>

                            <label class="col-lg-9 mt-1">
                                Complete Blood Count Findings
                                <input type="text" name="peof_complete_blood_count_findings" id="peof_complete_blood_count_findings" class="form-control" disabled>
                                <span class="text-danger peof-error" id="peof_complete_blood_count_findings-error"></span>
                            </label>

                            <label class="col-lg-3 mt-1">
                                Routine Urinalysis
                                <select name="peof_routine_urinalysis" id="peof_routine_urinalysis" class="form-select" disabled>
                                    <option value="0">Normal</option>
                                    <option value="1">Not Normal</option>
                                </select>
                            </label>
                            <label class="col-lg-9 mt-1">
                                Routine Urinalysis Findings
                                <input type="text" name="peof_routine_urinalysis_findings" id="peof_routine_urinalysis_findings" class="form-control" disabled>
                                <span class="text-danger peof-error" id="peof_routine_urinalysis_findings-error"></span>
                            </label>

                            <label class="col-lg-3 mt-1">
                                Stool Examination
                                <select name="peof_stool_examination" id="peof_stool_examination" class="form-select" disabled>
                                    <option value="0">Normal</option>
                                    <option value="1">Not Normal</option>
                                </select>
                            </label>
                            <label class="col-lg-9 mt-1">
                                Stool Examination Findings
                                <input type="text" name="peof_stool_examination_findings" id="peof_stool_examination_findings" class="form-control" disabled>
                                <span class="text-danger peof-error" id="peof_stool_examination_findings-error"></span>
                            </label>

                            <label class="col-lg-3 mt-1">
                                Hepa B Screening
                                <select name="peof_hepa_b_screening" id="peof_hepa_b_screening" class="form-select" disabled>
                                    <option value="0">Normal</option>
                                    <option value="1">Not Normal</option>
                                </select>
                            </label>
                            <label class="col-lg-9 mt-1">
                                Hepa B Screening Findings
                                <input type="text" name="peof_heba_b_screening_findings" id="peof_heba_b_screening_findings" class="form-control" disabled>
                                <span class="text-danger peof-error" id="peof_heba_b_screening_findings-error"></span>
                            </label>
                
                            <label class="col-lg-6 mt-1">
                                Drug Test (Metamphetamine) 
                                <select name="peof_drug_test_metamphetamine" id="peof_drug_test_metamphetamine" class="form-select" disabled>
                                    <option value="0">Negative</option>
                                    <option value="1">Positive</option>
                                </select>
                            </label>
                            <label class="col-lg-6 mt-1">
                                Drug Test (Terahydrocambinol)
                                <select name="peof_drug_test_tetrahydrocannabinol" id="peof_drug_test_tetrahydrocannabinol" class="form-select" disabled>
                                    <option value="0">Negative</option>
                                    <option value="1">Positive</option>
                                </select>
                            </label>
                        </div>
                        
                    </fieldset>

                    <fieldset class="border border-secondary pb-2 mt-2" style="border-radius: 5px;">
                        <legend  class="float-none w-auto px-1" style="font-weight: 600; font-size: 15px; margin-left: 5px;">Certification Part.I</legend>
                        <div class="row px-2 pb-2 d-flex flex-column align-items-center">
                            <div class="col-lg-6 d-flex flex-column align-items-center mt-1">
                                Picture
                                <img id="peof_pic_preview" src="" alt="patient_profile_picture" style="width: 200px; height: 210px;" class="border border-secondary">

                                <div class="input-group mt-1 d-none">
                                    <input type="file" class="form-control" name="peof_pic" id="peof_pic" disabled>
                                    <button type="button" class="input-group-text" id="peof_pic_reset" style="cursor: pointer;" disabled><i class="bi bi-arrow-clockwise"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="row px-2 pb-2">
                            <label class="col-lg-12 mt-1">
                                School/ Company/ Institution
                                <input type="text" name="peof_school_company_institution" id="peof_school_company_institution" class="form-control" disabled>
                                <span class="text-danger peof-error" id="peof_school_company_institution-error"></span>
                            </label>
                            <label class="col-lg-12 mt-1">
                                Name
                                <input type="text" name="peof_name" id="peof_name" class="form-control" disabled>
                            </label>
                            <label class="col-lg-3 mt-1">
                                Weight (kgs)
                                <input type="number" name="peof_weight" id="peof_weight" class="form-control" disabled>
                                <span class="text-danger peof-error" id="peof_weight-error"></span>
                            </label>
                            <label class="col-lg-3 mt-1">
                                Height (cm)
                                <input type="number" name="peof_height" id="peof_height" class="form-control" disabled>
                                <span class="text-danger peof-error" id="peof_height-error"></span>
                            </label>
                            <label class="col-lg-3 mt-1">
                                Civil Status
                                <input type="text" name="peof_civil_status_1" id="peof_civil_status_1" class="form-control" disabled>
                                <span class="text-danger peof-error" id="peof_civil_status_1-error"></span>
                            </label>
                            <label class="col-lg-3 mt-1">
                                Date of Examination
                                <input type="date" name="peof_date_1" id="peof_date_1" class="form-control" disabled>
                            </label>
                            <label class="col-lg-12 mt-3 d-none">
                                <div style="text-align: justify;">
                                    &emsp; I hereby authorize BATANGAS STATE UNIVERSITY and its officially designated medical examiner and examining physician/s to furnish information that the company may need pertaining to my health status and other pertinent medical findings and do hereby release them from any and all legal responsibilities by so doing. I also further certify that the medical history contained herein is true to the best of my knowledge and any false statement will disqualify me from any employment benefits and claims.
                                </div>
                                
                            </label>
                            <label class="col-lg-12 d-none text-center mt-2">
                                <u id="peof_name_1"></u> <br>
                                Employee/ Student's Signature
                            </label>
                        </div>
                    </fieldset>

                    <fieldset class="border border-secondary pb-2 mt-2" id="peof_cert_part_ii" style="border-radius: 5px;" disabled>
                        <legend  class="float-none w-auto px-1" style="font-weight: 600; font-size: 15px; margin-left: 5px;">Certification Part. II</legend>
                        <div class="row px-2 pb-2">
                            <label class="col-lg-12">
                                &emsp; I certify that I have examined and found the applicant to be physically fit/ unfit for employment.
                            </label>
                            <label class="col-lg-12">
                                Classification
                            </label>
                            <label class="col-lg-12">
                                <div class="form-check mt-2">
                                    <input type="radio" class="form-check-input" id="a" name="peof_certificate_classification" value="a" checked>
                                    <label class="form-check-label" for="a">
                                        Class A. Physically fit to work.
                                    </label>
                                </div>
                                <div class="form-check mt-2">
                                    <input type="radio" class="form-check-input" id="b" name="peof_certificate_classification" value="b">
                                    <label class="form-check-label" for="b">
                                        Class B. Physically underdeveloped or with correctible defects but otherwise fit to work.
                                    </label>
                                </div>
                                <div class="form-check mt-2">
                                    <input type="radio" class="form-check-input" id="c" name="peof_certificate_classification" value="c">
                                    <label class="form-check-label" for="c">
                                        Class C. Employable but owing to certain impairments or conditions, requires special placement or limited duty in a specified or selected assignment requiring follow up treatment/ periodic examination.
                                    </label>
                                </div>
                            </label>
                            <label class="col-lg-12 mt-1 ps-4">
                                Needs treatment or correction of:  <br>
                                <label for="peof_treatment_skin" class="form-control p-0 border-0">
                                    <input type="checkbox" name="peof_treatment_skin" id="peof_treatment_skin"> 
                                    Skin Disease
                                </label>
                                <label for="peof_treatment_dental" class="form-control p-0 border-0">
                                    <input type="checkbox" name="peof_treatment_dental" id="peof_treatment_dental"> 
                                    Dental Defects
                                </label>
                                <label for="peof_treatment_anemia" class="form-control p-0 border-0">
                                    <input type="checkbox" name="peof_treatment_anemia" id="peof_treatment_anemia"> 
                                    Anemia
                                </label>
                                <label for="peof_treatment_poor_vision" class="form-control p-0 border-0">
                                    <input type="checkbox" name="peof_treatment_poor_vision" id="peof_treatment_poor_vision"> 
                                    Poor vision
                                </label>
                                <label for="peof_mild_urinary_tract_infection" class="form-control p-0 border-0">
                                    <input type="checkbox" name="peof_mild_urinary_tract_infection" id="peof_mild_urinary_tract_infection"> 
                                    Mild Urinary Tract Infection
                                </label>
                                <label for="peof_intestinal_parasitism" class="form-control p-0 border-0">
                                    <input type="checkbox" name="peof_intestinal_parasitism" id="peof_intestinal_parasitism"> 
                                    Intestinal Parasitism
                                </label>
                                <label for="peof_mild_hypertension" class="form-control p-0 border-0">
                                    <input type="checkbox" name="peof_mild_hypertension" id="peof_mild_hypertension"> 
                                    Mild Hypertension
                                </label>
                            </label>
                            <label class="col-lg-12">
                                <div class="form-check mt-2">
                                    <input type="radio" class="form-check-input" id="d" name="peof_certificate_classification" value="d">
                                    <label class="form-check-label" for="d">
                                        Class D. Unfit or unsafe for any type of employment
                                    </label>
                                </div>
                            </label>
                            <label class="col-lg-12">
                                <span class="text-danger peof-error" id="peof_certificate_classification-error"></span>
                            </label>
                            <label class="col-lg-12 mt-4 text-center">
                                <img src="{{ asset('storage/signature/'.$physician_details->signature) }}" alt="physician_signature" style="height: 80px; margin-bottom: -2rem;"> <br> 
                                <u>{{ $physician_details->ttl_title.'. '.$physician_details->firstname.' '.(($physician_details->middlename) ? $physician_details->middlename[0]: '').' '.$physician_details->lastname }}</u> <br>
                                Physician's Name/ Signature
                            </label>
                        </div>
                    </fieldset>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="peof_save_btn">Add</button>
            </div>
            </form>
        </div>    
    </div>
</div>

<script>
    
    function enable(id){
        $(id).css("color", "#444444");
        $(id).attr('disabled', false);
    }

    function disable(id){
        $(id).attr('disabled', true);
    }

    function clear_disable(id){
        $(id).css("color", "#e9ecef");
        disable(id);
    }

    function set_input(id, val){
        $(id).val(val);
    }

    function if_true_disable(independent, dependent){
        if($(independent).val()==0){
            $(dependent).css("color", "#e9ecef");
            disable(dependent);
        }
        else{
            enable(dependent);
        }
    }

    function peof_enable_all_inputs(){
        // header
        enable('#peof_type, #peof_date');
        // personal info
        enable('#peof_firstname, #peof_middlename, #peof_lastname, #peof_address, #peof_position_campus, #peof_sex, #peof_civil_status, #peof_birthdate, #peof_contact, #peof_tel');
        // patient history
        enable('#peof_medical_history, #peof_family_history, #peof_occupational_history');
        // physical examination
        enable('#peof_bmi, #peof_skin, #peof_head_and_scalp, #peof_eyes, #peof_ears, #peof_nose_and_throat, #peof_mouth, #peof_neck_thyroid_ln, #peof_chest_breast_axilla, #peof_heart, #peof_lungs, #peof_abdomen, #peof_anus_rectum, #peof_genital, #peof_musculoskeletal, #peof_extremities');
        if_true_disable('#peof_bmi', '#peof_bmi_findings');
        if_true_disable('#peof_skin', '#peof_skin_findings');
        if_true_disable('#peof_head_and_scalp', '#peof_head_and_scalp_findings');
        if_true_disable('#peof_eyes', '#peof_eyes_findings');
        if_true_disable('#peof_ears', '#peof_ears_findings');
        if_true_disable('#peof_nose_and_throat', '#peof_nose_and_throat_findings');
        if_true_disable('#peof_mouth', '#peof_mouth_findings');
        if_true_disable('#peof_neck_thyroid_ln', '#peof_neck_thyroid_ln_findings');
        if_true_disable('#peof_chest_breast_axilla', '#peof_chest_breast_axilla_findings');
        if_true_disable('#peof_heart', '#peof_heart_findings');
        if_true_disable('#peof_lungs', '#peof_lungs_findings');
        if_true_disable('#peof_abdomen', '#peof_abdomen_findings');
        if_true_disable('#peof_anus_rectum', '#peof_anus_rectum_findings');
        if_true_disable('#peof_genital', '#peof_genital_findings');
        if_true_disable('#peof_musculoskeletal', '#peof_musculoskeletal_findings');
        if_true_disable('#peof_extremities', '#peof_extremities_findings');

        enable('#peof_bp, #peof_hr, #peof_hearing, #peof_vision, #peof_vision_r, #peof_vision_l');
        enable('#peof_chest_xray, #peof_complete_blood_count, #peof_routine_urinalysis, #peof_stool_examination, #peof_hepa_b_screening');
        if_true_disable('#peof_chest_xray', '#peof_chest_xray_findings');
        if_true_disable('#peof_complete_blood_count', '#peof_complete_blood_count_findings');
        enable('#peof_drug_test_metamphetamine, #peof_drug_test_terahydrocambinol');
        enable('#peof_p, #peof_drug_test_tetrahydrocannabinol');
        enable('#peof_pic, #peof_school_company_institution, #peof_weight, #peof_height, #peof_cert_part_ii');
    }

    function peof_disable_all_inputs(){
        // header
        disable('#peof_type, #peof_date');
        // personal info
        disable('#peof_firstname, #peof_middlename, #peof_lastname, #peof_address, #peof_position_campus, #peof_sex, #peof_civil_status, #peof_birthdate, #peof_contact, #peof_tel');
        // patient history
        disable('#peof_medical_history, #peof_family_history, #peof_occupational_history');
        // physical examination
        disable('#peof_bmi, #peof_bmi_findings');
        disable('#peof_bmi, #peof_bmi_findings');
        disable('#peof_skin, #peof_skin_findings');
        disable('#peof_head_and_scalp, #peof_head_and_scalp_findings');
        disable('#peof_eyes, #peof_eyes_findings');
        disable('#peof_ears, #peof_ears_findings');
        disable('#peof_nose_and_throat, #peof_nose_and_throat_findings');
        disable('#peof_mouth, #peof_mouth_findings');
        disable('#peof_neck_thyroid_ln, #peof_neck_thyroid_ln_findings');
        disable('#peof_chest_breast_axilla, #peof_chest_breast_axilla_findings');
        disable('#peof_heart, #peof_heart_findings');
        disable('#peof_lungs, #peof_lungs_findings');
        disable('#peof_abdomen, #peof_abdomen_findings');
        disable('#peof_anus_rectum, #peof_anus_rectum_findings');
        disable('#peof_genital, #peof_genital_findings');
        disable('#peof_musculoskeletal, #peof_musculoskeletal_findings');
        disable('#peof_extremities, #peof_extremities_findings');
        // diagnostic
        disable('#peof_bp, #peof_hr, #peof_hearing, #peof_vision, #peof_vision_r, #peof_vision_l');
        disable('#peof_chest_xray, #peof_complete_blood_count, #peof_routine_analysis, #peof_stool_examination, #peof_hepa_b_screening');
        disable('#peof_drug_test_metamphetamine, #peof_drug_test_terahydrocambinol');
        disable('#peof_pic, #peof_school_company_institution, #peof_weight, #peof_height, #peof_cert_part_ii');
    }

    function peof_unlock(){
        $('#peof_unlock_lock').val('1');
        $('#peof_lbl_unlock').addClass('d-none');
        $('#peof_lbl_lock').removeClass('d-none');
        peof_enable_all_inputs(); 
    }

    function peof_lock(){
        $('#peof_unlock_lock').val('0');
        $('#peof_lbl_lock').addClass('d-none');
        $('#peof_lbl_unlock').removeClass('d-none');
        peof_disable_all_inputs();
    }

    function set_data_peof(data, href){
        data = JSON.parse(data);
        $('#peof_type').val(data.peof_type);
        $('#peof_date, #peof_date_1').val(data.peof_date);
        $('#peof_firstname').val(data.peof_firstname);
        $('#peof_middlename').val(data.peof_middlename);
        $('#peof_lastname').val(data.peof_lastname);
        $('#peof_name').val(data.peof_firstname+' '+data.peof_middlename+' '+data.peof_lastname);
        $('#peof_name_1').html(data.peof_firstname+' '+data.peof_middlename+' '+data.peof_lastname);
        $('#peof_address').val(data.peof_address);
        $('#peof_position_campus').val(data.peof_position_campus);
        $('#peof_sex').val(data.peof_sex);
        $('#peof_civil_status, #peof_civil_status_1').val(data.peof_civil_status);
        $('#peof_birthdate').val(data.peof_birthdate);
        $('#peof_age').val(data.peof_age);
        $('#peof_contact').val(data.peof_contact);
        $('#peof_tel').val(data.peof_tel);
        $('#peof_medical_history').val(data.peof_medical_history);
        $('#peof_family_history').val(data.peof_family_history);
        $('#peof_occupational_history').val(data.peof_occupational_history);
        $('#peof_bmi').val((data.peof_bmi_findings) ? 1 : 0);
        $('#peof_bmi_findings').val(data.peof_bmi_findings);
        $('#peof_skin').val((data.peof_skin_findings) ? 1 : 0);
        $('#peof_skin_findings').val(data.peof_skin_findings);
        $('#peof_head_and_scalp').val((data.peof_head_and_scalp_findings) ? 1 : 0);
        $('#peof_head_and_scalp_findings').val(data.peof_head_and_scalp_findings);
        $('#peof_eyes').val((data.peof_eyes_findings) ? 1 : 0);
        $('#peof_eyes_findings').val(data.peof_eyes_findings);
        $('#peof_ears').val((data.peof_ears_findings) ? 1 : 0);
        $('#peof_ears_findings').val(data.peof_ears_findings);
        $('#peof_nose_and_throat').val((data.peof_nose_and_throat_findings) ? 1 : 0);
        $('#peof_nose_and_throat_findings').val(data.peof_nose_and_throat_findings);
        $('#peof_mouth').val((data.peof_mouth_findings) ? 1 : 0);
        $('#peof_mouth_findings').val(data.peof_mouth_findings);
        $('#peof_neck_thyroid_ln').val((data.peof_neck_thyroid_ln_findings) ? 1 : 0);
        $('#peof_neck_thyroid_ln_findings').val(data.peof_neck_thyroid_ln_findings);
        $('#peof_chest_breast_axilla').val((data.peof_chest_breast_axilla_findings) ? 1 : 0);
        $('#peof_chest_breast_axilla_findings').val(data.peof_chest_breast_axilla_findings);
        $('#peof_heart').val((data.peof_heart_findings) ? 1 : 0);
        $('#peof_heart_findings').val(data.peof_heart_findings);
        $('#peof_lungs').val((data.peof_lungs_findings) ? 1 : 0);
        $('#peof_lungs_findings').val(data.peof_lungs_findings);
        $('#peof_abdomen').val((data.peof_abdomen_findings) ? 1 : 0);
        $('#peof_abdomen_findings').val(data.peof_abdomen_findings);
        $('#peof_anus_rectum').val((data.peof_anus_rectum_findings) ? 1 : 0);
        $('#peof_anus_rectum_findings').val(data.peof_anus_rectum_findings);
        $('#peof_genital').val((data.peof_genital_findings) ? 1 : 0);
        $('#peof_genital_findings').val(data.peof_genital_findings);
        $('#peof_musculoskeletal').val((data.peof_musculoskeletal_findings) ? 1 : 0);
        $('#peof_musculoskeletal_findings').val(data.peof_musculoskeletal_findings);
        $('#peof_extremities').val((data.peof_extremities_findings) ? 1 : 0);
        $('#peof_extremities_findings').val(data.peof_extremities_findings);
        $('#peof_bp').val(data.peof_bp);
        $('#peof_hr').val(data.peof_hr);
        $('#peof_cbc').val(data.peof_cbc);
        $('#peof_routine_urinalysis').val((data.peof_routine_urinalysis_findings) ? 1 : 0);
        $('#peof_routine_urinalysis_findings').val(data.peof_routine_urinalysis_findings);
        $('#peof_stool_examination').val((data.peof_stool_examination_findings) ? 1 : 0);
        $('#peof_stool_examination_findings').val(data.peof_stool_examination_findings);
        $('#peof_hepa_b_screening').val((data.peof_hepa_b_screening_findings) ? 1 : 0);
        $('#peof_hepa_b_screening_findings').val(data.peof_hepa_b_screening_findings);
        $('#peof_drug_test_metamphetamine').val(data.peof_drug_test_metamphetamine);
        $('#peof_drug_test_tetrahydrocannabinol').val(data.peof_drug_test_tetrahydrocannabinol);
        $('#peof_pic_preview').attr('src',"{{ asset('storage/profile_picture').'/' }}"+data.peof_pic);
        $('#peof_weight').val(data.peof_weight);
        $('#peof_height').val(data.peof_height);
        $('#peof_vision').val(data.peof_vision);
        $('#peof_vision_l').val(data.peof_vision_l);
        $('#peof_vision_r').val(data.peof_vision_r);
        $('#peof_school_company_institution').val(data.peof_school_company_institution);
        $('#peof_pic_preview')
        $("#peof_form").attr("action", href);
        $('#modal_form_peof').modal('show');
    }

    function insert_data_peof(){
        @php 
            $date = new DateTime($patient_details->birthdate);
            $now = new DateTime();
            $interval = $now->diff($date);

            $weight = $patient_details->weight;
            $height = $patient_details->height;

            try {
                $bmi = round($weight / ($height**2),2);
            } catch( Exception $e ){
                $bmi = 0;
            }
        @endphp
        var data = {
            "peof_type" : "1",
            "peof_date": "{{ date('Y-m-d') }}",
            "peof_firstname" : "{{  $patient_details->firstname }}",
            "peof_middlename" : "{{  $patient_details->middlename }}",
            "peof_lastname" : "{{  $patient_details->lastname }}",
            "peof_address": "{{ ($patient_details->home_brgy_name.', '.$patient_details->home_mun_name.', '.$patient_details->home_prov_name) }}",
            "peof_position_campus": "{{ ucwords($patient_details->classification).'/ ARASOF' }}",
            "peof_sex": "{{ $patient_details->gender }}",
            "peof_civil_status": "{{ $patient_details->civil_status }}",
            "peof_birthdate": "{{ $patient_details->birthdate }}",
            "peof_age": "{{ $interval->y }}",
            "peof_contact": "{{ $patient_details->contact }}",
            "peof_tel": "",
            "peof_medical_history": "",
            "peof_family_history": "",
            "peof_occupational_history": "",
            "peof_bmi_findings": "",
            "peof_skin_findings": "",
            "peof_head_and_scalp_findings": "",
            "peof_eyes_findings": "",
            "peof_ears_findings": "",
            "peof_nose_and_throat_findings": "",
            "peof_mouth_findings": "",
            "peof_neck_thyroid_ln_findings": "",
            "peof_chest_breast_axilla_findings": "",
            "peof_heart_findings": "",
            "peof_lungs_findings": "",
            "peof_abdomen_findings": "",
            "peof_anus_rectum_findings": "",
            "peof_genital_findings": "",
            "peof_musculoskeletal_findings": "",
            "peof_extremities_findings": "",
            "peof_bp": "",
            "peof_hr": "",
            "peof_cbc": "",
            "peof_routine_urinalysis_findings": "",
            "peof_stool_examination_findings": "",
            "peof_hepa_b_screening_findings": "",
            "peof_drug_test_metamphetamine": "0",
            "peof_drug_test_tetrahydrocannabinol": "0",
            "peof_pic": "{{ $patient_details->profile_pic }}",
            "peof_weight": "",
            "peof_height": "",
            "peof_vision": "0",
            "peof_certificate_classification": "b",
            "peof_needs_for_treatment": "",
            "peof_patient_signature": "{{ $patient_details->signature }}",
            "peof_physician_signature": ""
        };
        set_data_peof(JSON.stringify(data), "{{ route('AdminPEOFInsert', ['id'=>$patient_details->acc_id]) }}");
    }

    function delete_peof(id, href){
        event.preventDefault();
        swal({
            title: "Are you sure?",
            text: "Your about to delete form #"+id+"!",
            icon: "warning",
            buttons: ["Cancel", "Yes"],
            dangerMode: true,
        }).then(function(value){
            if(value){
                $('#delete_form').attr('action', href);
                $('#delete_form').submit();
            }
        }); 
    }

    function retrieve_peof(id, href){
        console.log(href);
        $.ajax({
            type: "GET",
            url: href,
            success: function(response){
                response = JSON.parse(response);
                console.log(response);
                response = response.data;
                response = JSON.stringify(response);
                $('#peof_save_btn').html('Update');
                set_data_peof(response, ("{{ route('AdminPEOFUpdate', ['id'=>'id']) }}").replace('id', id));
            },
            error: function(response){
                console.log(response);
            }
        })
    }

    $('#peof_pic').change(function(){
        let file = $("input[type=file]").get(0).files[0];
        if(file){
            var reader = new FileReader();
            reader.onload = function(){
                $("#peof_pic_preview").attr("src", reader.result);
            }
            reader.readAsDataURL(file);
        }
    });

    $('#peof_unlock_lock').click(function(){
        if($(this).val()==0){
            peof_unlock();
        }
        else{
            peof_lock();
        }
    });

    $('#peof_save_btn').click(function(){
        $('.peof-error').html("");
        var formData = new FormData($('#peof_form')[0]);
        $.ajax({
            type: "POST",
            url: $('#peof_form').attr('action'),
            contentType: false,
            processData: false,
            data: formData,
            enctype: 'multipart/form-data',
            success: function(response){
                swal(response.title, response.message, response.icon);         
                if(response.status == 400){
                    $.each(response.errors, function(key, err_values){
                        $('#'+key+'-error').html(err_values);
                    });
                }
                else{
                    swal(response.title, response.message, response.icon)
                    .then(function(){
                        location.reload();
                    });           
                }
            },
            error: function(response){
                console.log(response);
            }
        })
    })

    $('#peof_birthdate').change(function(){
        var startDay = new Date($(this).val());
        var endDay = new Date("{{ date('Y-m-d') }}");
        const time = Math.abs(endDay - startDay);
        const year = Math.floor(time/ (1000*60*60*24*365));
        $('#peof_age').val(year);
    });

    $('#peof_bmi').change(function(){
        if_true_disable(this,'#peof_bmi_findings');
    });
    
    $('#peof_skin').change(function(){
        if_true_disable(this, '#peof_skin_findings');
    });

    $('#peof_head_and_scalp').change(function(){
        if_true_disable(this, '#peof_head_and_scalp_findings');
    });

    $('#peof_eyes').change(function(){
        if_true_disable(this, '#peof_eyes_findings');
    });

    $('#peof_ears').change(function(){
        if_true_disable(this, '#peof_ears_findings');
    });

    $('#peof_nose_and_throat').change(function(){
        if_true_disable(this, '#peof_nose_and_throat_findings');
    });

    $('#peof_mouth').change(function(){
        if_true_disable(this, '#peof_mouth_findings');
    });

    $('#peof_neck_thyroid_ln').change(function(){
        if_true_disable(this, '#peof_neck_thyroid_ln_findings');
    });

    $('#peof_chest_breast_axilla').change(function(){
        if_true_disable(this, '#peof_chest_breast_axilla_findings');
    });

    $('#peof_heart').change(function(){
        if_true_disable(this, '#peof_heart_findings');
    });

    $('#peof_lungs').change(function(){
        if_true_disable(this, '#peof_lungs_findings');
    });

    $('#peof_abdomen').change(function(){
        if_true_disable(this, '#peof_abdomen_findings');
    });

    $('#peof_anus_rectum').change(function(){
        if_true_disable(this, '#peof_anus_rectum_findings');
    });

    $('#peof_genital').change(function(){
        if_true_disable(this, '#peof_genital_findings');
    });

    $('#peof_musculoskeletal').change(function(){
        if_true_disable(this, '#peof_musculoskeletal_findings');
    });

    $('#peof_extremities').change(function(){
        if_true_disable(this, '#peof_extremities_findings');
    });

    $('#peof_chest_xray').change(function(){
        if_true_disable(this, '#peof_chest_xray_findings');
    });

    $('#peof_complete_blood_count').change(function(){
        if_true_disable(this, '#peof_complete_blood_count_findings');
    });

    $('#peof_routine_urinalysis').change(function(){
        if_true_disable(this, '#peof_routine_urinalysis_findings');
    });

    $('#peof_stool_examination').change(function(){
        if_true_disable(this, '#peof_stool_examination_findings');
    });

    $('#peof_hepa_b_screening').change(function(){
        if_true_disable(this, '#peof_heba_b_screening_findings');
    });
</script>