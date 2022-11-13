<div class="modal fade" id="modal_form_shr" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal_title" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" style="font-size: 15px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_title">Student Health Record</h5>
                <button class="btn btn-primary btn-sm" id="shr_unlock_lock" value="0">
                    <span id="shr_lbl_unlock"><i class="bi bi-unlock-fill"></i> Unlock</span>
                    <span id="shr_lbl_lock" class="d-none"><i class="bi bi-lock-fill"></i> Lock</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="{{ route('AdminSHRInsert', ['id'=>$patient_details->acc_id]) }}" method="POST" enctype="multipart/form-data" id="shr_form" >
                    <!-- date, sr, prog -->
                    @csrf
                    <fieldset class="border border-secondary pb-2" style="border-radius: 5px;">
                        <legend  class="float-none w-auto px-1" style="font-weight: 600; font-size: 15px; margin-left: 5px;">Header</legend>
                        <div class="row px-2 pb-2">
                            <label class="col-lg-4 mt-1">
                                Medical Examination Date:
                                <input type="date" name="shr_med" id="shr_med" class="form-control" value="{{ old('shr_med') }}" disabled>
                                <span class="text-danger shr-error-message" id="shr_med_error">
                                    @error('shr_med')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                            <label class="col-lg-3 mt-1">
                                SR-Code:
                                <input type="text" name="shr_srcode" id="shr_srcode" class="form-control" value="{{ old('shr_srcode') }}" disabled>
                                <span class="text-danger shr-error-message" id="shr_srcode_error">
                                    @error('shr_srcode')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                            <label class="col-lg-5 mt-1">
                                Program:
                                <select name="shr_program" id="shr_program" class="form-select" disabled>
                                    <option value="">--- choose ---</option>
                                    @foreach($programs as $prog)
                                        <option value="{{ $prog->prog_id }}" {{ (old('shr_program')==$prog->prog_id) ? 'selected' : '' }}>{{ $prog->prog_name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger shr-error-message" id="shr_program_error">
                                    @error('shr_program')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                        </div>
                    </fieldset>

                    <!-- personal info -->
                    <fieldset class="border border-secondary pb-2 mt-2" style="border-radius: 5px;">
                        <legend  class="float-none w-auto px-1" style="font-weight: 600; font-size: 15px; margin-left: 5px;">Personal Information</legend>
                        <div class="row px-2 pb-2 d-flex flex-column align-items-center">
                            <div class="col-lg-6 d-flex flex-column align-items-center mt-1">
                                Profile Pictre:
                                <img id="shr_pic" src="" alt="patient_profile_picture" style="width: 200px; height: 210px;" class="border border-secondary">

                                <div class="input-group mt-1">
                                    <input type="file" class="form-control" name="shr_profile_pic" id="shr_profile_pic" disabled>
                                    <button type="button" class="input-group-text" id="shr_reset_profile_pic" style="cursor: pointer;" disabled><i class="bi bi-arrow-clockwise"></i></button>
                                </div>

                                <span class="text-danger shr-error-message" id="shr_profile_pic_error">
                                    @error('shr_profile_pic')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                               
                        </div>
                        
                        <div class="row px-2 pb-2">
                            <label class="col-lg-3 mt-1">
                                Firstname:
                                <input type="text" name="shr_firstname" id="shr_firstname" class="form-control" value="{{ old('shr_firstname') }}" disabled>
                                <span class="text-danger shr-error-message" id="shr_firstname_error">
                                    @error('shr_firstname')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                            <label class="col-lg-3 mt-1">
                                Middlename:
                                <input type="text" name="shr_middlename" id="shr_middlename" class="form-control" value="{{ old('shr_middlename') }}" disabled>
                                <span class="text-danger shr-error-message" id="shr_middlename_error">
                                    @error('shr_middlename')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                            <label class="col-lg-3 mt-1">
                                Lastname:
                                <input type="text" name="shr_lastname" id="shr_lastname" class="form-control" value="{{ old('shr_lastname') }}" disabled>
                                <span class="text-danger shr-error-message" id="shr_lastname_error">
                                    @error('shr_lastname')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                            <label class="col-lg-3 mt-1">
                                Suffix:
                                <input type="text" name="shr_suffixname" id="shr_suffixname" class="form-control" value="{{ old('shr_suffixname') }}" disabled>
                            </label>
                        </div>

                        <div class="row px-2 pb-2">
                            <label class="col-lg-6 mt-1">
                                Home Address:
                                <input type="text" name="shr_home_address" id="shr_home_address" class="form-control" value="{{ old('shr_home_address') }}" disabled>
                                <span class="text-danger shr-error-message" id="shr_home_address_error">
                                    @error('shr_home_address')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                            <label class="col-lg-6 mt-1">
                                Dormitory Address:
                                <input type="text" name="shr_dorm_address" id="shr_dorm_address" class="form-control" value="{{ old('shr_dorm_addres') }}" disabled>
                            </label>
                        </div>

                        <div class="row px-2 pb-2">
                            <label class="col-lg-2 mt-1">
                                Gender:
                                <select name="shr_gender" id="shr_gender" class="form-select" disabled>
                                    <option value="">--- choose ---</option>
                                    <option value="male" {{(old('shr_gender')=='male') ? 'selected' : ''}}>Male</option>
                                    <option value="female" {{(old('shr_gender')=='female') ? 'selected' : ''}}>Female</option>
                                </select>
                                <span class="text-danger shr-error-message" id="shr_gender_error">
                                    @error('shr_gender')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                            
                            <label class="col-lg-2 mt-1">
                                Age:
                                <input type="number" name="shr_age" id="shr_age" class="form-control" value="{{ old('shr_age') }}" readonly>
                                <span class="text-danger shr-error-message" id="shr_age_error">
                                    @error('shr_age')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                            <label class="col-lg-2 mt-1">
                                Civil Status:
                                <select name="shr_civil_status" id="shr_civil_status" class="form-select" disabled>
                                    <option value="">--- choose ---</option>
                                    <option value="single" {{ (old('shr_civil_status')=='single') ? 'selected' : '' }}>Single</option>
                                    <option value="married" {{ (old('shr_civil_status')=='married') ? 'selected' : '' }}>Married</option>
                                    <option value="divorced" {{ (old('shr_civil_status')=='divorced') ? 'selected' : '' }}>Divorced</option>
                                    <option value="separated" {{ (old('shr_civil_status')=='separated') ? 'selected' : '' }}>Separated</option>
                                    <option value="widowed" {{ (old('shr_civil_status')=='widowed') ? 'selected' : '' }}>Widowed</option>
                                </select>
                                <span class="text-danger shr-error-message" id="shr_civil_status_error">
                                    @error('shr_civil_status')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                            <label class="col-lg-3 mt-1">
                                Religion:
                                <input type="text" name="shr_religion" id="shr_religion" class="form-control" value="{{ old('shr_religion') }}" disabled>
                                <span class="text-danger shr-error-message" id="shr_religion_error">
                                    @error('shr_religion')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                            <label class="col-lg-3 mt-1">
                                Contact:
                                <input type="text" name="shr_contact" id="shr_contact" class="form-control" value="{{ old('shr_contact') }}" disabled>
                                <span class="text-danger shr-error-message" id="shr_contact_error">
                                    @error('shr_contact')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                        </div>

                        <div class="row px-2 pb-2">
                            <label class="col-lg-6 mt-1">
                                Date of Birth:
                                <input type="date" name="shr_date_of_birth" id="shr_date_of_birth" class="form-control" value="{{ old('shr_date_of_birth') }}" disabled>
                                <span class="text-danger shr-error-message" 
                                id="shr_date_of_birth_error">
                                    @error('shr_date_of_birth')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                            <label class="col-lg-6 mt-1">
                                Place of Birth:
                                <input type="text" name="shr_place_of_birth" id="shr_place_of_birth" class="form-control" value="{{ old('shr_place_of_birth') }}" disabled>
                                <span class="text-danger shr-error-message" 
                                id="shr_place_of_birth_error">
                                    @error('shr_place_of_birth')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                        </div>
                    </fieldset>

                    <!-- emergency contact -->
                    <fieldset class="border border-secondary pb-2 mt-2" style="border-radius: 5px;">
                        <legend  class="float-none w-auto px-1" style="font-weight: 600; font-size: 15px; margin-left: 5px;">Emergency Contact</legend>
                        
                        <div class="row px-2 pb-2">
                            <label class="col-lg-6 mt-1">
                                Name:
                                <input type="text" name="shr_emergency_name" id="shr_emergency_name" class="form-control" value="{{ old('shr_emergency_firstname') }}" disabled>
                                <span class="text-danger shr-error-message" id="shr_emergency_name_error">
                                    @error('shr_emergency_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                        </div>
                        
                        <div class="row px-2 pb-2">
                            <label class="col-lg-6 mt-1">
                                Business Address:
                                <input type="text" name="shr_emergency_business_address" id="shr_emergency_business_address" class="form-control" value="{{ old('shr_emergency_business_address') }}" disabled>
                                <span class="text-danger shr-error-message" id="shr_emergency_business_address_error">
                                    @error('shr_emergency_business_address')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                            <label class="col-lg-3 mt-1">
                                Relation to patient:
                                <input type="text" name="shr_emergency_relation_to_patient" id="shr_emergency_relation_to_patient" class="form-control" value="{{ old('shr_emergency_relation_to_patient') }}" disabled>
                                <span class="text-danger shr-error-message" id="shr_emergency_relation_to_patient_error">
                                    @error('shr_emergency_relation_to_patient')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                        </div>

                        <div class="row px-2 pb-2">
                            <div class="col-lg-6 mt-1">
                                Landline:
                                <input type="text" name="shr_emergency_landline" id="shr_emergency_landline" class="form-control" value="{{ old('shr_emergency_landline') }}" disabled>
                                <span class="text-danger shr-error-message" id="shr_emergency_landline_error">
                                    @error('shr_emergency_landline')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-lg-6 mt-1">
                                Cellphone no:
                                <input type="text" name="shr_emergency_contact" id="shr_emergency_contact" class="form-control" value="{{ old('shr_emergency_contact') }}" disabled>
                                <span class="text-danger shr-error-message" id="shr_emergency_contact_error">
                                    @error('shr_emergency_contact')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                    </fieldset>

                    <!-- past illness -->
                    <fieldset class="border border-secondary pb-2 mt-2" style="border-radius: 5px;">
                        <legend  class="float-none w-auto px-1" style="font-weight: 600; font-size: 15px; margin-left: 5px;">Past Illness</legend>
                        
                        <div class="row px-2 pb-2">
                            <label class="col-lg-3 mt-1">
                                Asthma:
                                <select name="shr_past_illness_asthma" id="shr_past_illness_asthma" class="form-select" disabled>
                                    <option value="0" {{ (old('shr_past_illness_asthma')) ? '' : 'selected' }}>No</option>
                                    <option value="1" {{ (old('shr_past_illness_asthma')) ? 'selected' : '' }}>Yes</option>
                                </select>
                                <span class="text-danger shr-error-message" id="shr_past_illness_asthma_error">
                                    @error('shr_past_illness_asthma')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>

                            <label class="col-lg-3 mt-1">
                                Last Attack (Asthma):
                                <input type="date" name="shr_past_illness_asthma_last_attack" id="shr_past_illness_asthma_last_attack" class="form-control" value="{{ old('shr_past_illness_asthma_last_attack') }}" disabled>
                                <span class="text-danger shr-error-message" id="shr_past_illness_asthma_last_attack_error">
                                    @error('shr_past_illness_asthma_last_attack')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>

                            <label class="col-lg-3 mt-1">
                                Heart Disease:
                                <select name="shr_past_illness_heart_disease" id="shr_past_illness_heart_disease" class="form-select" disabled>
                                    <option value="0" {{ (old('shr_past_illness_heart_disease')=='0') ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ (old('shr_past_illness_heart_disease')=='1') ? 'selected' : '' }}>Yes</option>
                                </select>
                                <span class="text-danger shr-error-message" id="shr_past_illness_heart_disease_error">
                                    @error('shr_past_illness_heart_disease')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>

                            <label class="col-lg-3 mt-1">
                                Hypertension:
                                <select name="shr_past_illness_hypertension" id="shr_past_illness_hypertension" class="form-select" disabled>
                                    <option value="0" {{ (old('shr_past_illness_hypertension')=='0') ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ (old('shr_past_illness_hypertension')=='1') ? 'selected' : '' }}>Yes</option>
                                </select>
                                <span class="text-danger shr-error-message" id="shr_past_illness_hypertension_error">
                                    @error('shr_past_illness_hypertension')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                        </div>

                        <div class="row px-2 pb-2">
                            
                            <label class="col-lg-3 mt-1">
                                Epilepsy:
                                <select name="shr_past_illness_epilepsy" id="shr_past_illness_epilepsy" class="form-select" disabled>
                                    <option value="0" {{ (old('shr_past_illness_epilepsy')=='0') ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ (old('shr_past_illness_epilepsy')=='1') ? 'selected' : '' }}>Yes</option>
                                </select>
                                <span class="text-danger shr-error-message" id="shr_past_illness_epilepsy_error">
                                    @error('shr_past_illness_epilepsy')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>

                            <label class="col-lg-3 mt-1">
                                Diabetes:
                                <select name="shr_past_illness_diabetes" id="shr_past_illness_diabetes" class="form-select" disabled>
                                    <option value="0" {{ (old('shr_past_illness_diabetes')=='0') ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ (old('shr_past_illness_diabetes')=='1') ? 'selected' : '' }}>Yes</option>
                                </select>
                                <span class="text-danger shr-error-message" id="shr_past_illness_diabetes_error">
                                    @error('shr_past_illness_diabetes')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>

                            <label class="col-lg-3 mt-1">
                                Thyroid Problem:
                                <select name="shr_past_illness_thyroid_problem" id="shr_past_illness_thyroid_problem" class="form-select" disabled>
                                    <option value="0" {{ (old('shr_past_illness_thyroid_problem')=='0') ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ (old('shr_past_illness_thyroid_problem')=='1') ? 'selected' : '' }}>Yes</option>
                                </select>
                                <span class="text-danger shr-error-message" id="shr_past_illness_thyroid_problem_error">
                                    @error('shr_past_illness_thyroid_problem')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>

                            <label class="col-lg-3 mt-1">
                                Measles:
                                <select name="shr_past_illness_measles" id="shr_past_illness_measles" class="form-select" disabled>
                                    <option value="0" {{ (old('shr_past_illness_measles')=='0') ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ (old('shr_past_illness_measles')=='1') ? 'selected' : '' }}>Yes</option>
                                </select>
                                <span class="text-danger shr-error-message" id="shr_past_illness_measles_error">
                                    @error('shr_past_illness_measles')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                        </div>

                        <div class="row px-2 pb-2">
                            
                            <label class="col-lg-3 mt-1">
                                Mumps:
                                <select name="shr_past_illness_mumps" id="shr_past_illness_mumps" class="form-select" disabled>
                                    <option value="0" {{ (old('shr_past_illness_mumps')=='0') ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ (old('shr_past_illness_mumps')=='1') ? 'selected' : '' }}>Yes</option>
                                </select>
                                <span class="text-danger shr-error-message" id="shr_past_illness_mumps_error">
                                    @error('shr_past_illness_mumps')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>

                            <label class="col-lg-3 mt-1">
                                Varicella:
                                <select name="shr_past_illness_varicella" id="shr_past_illness_varicella" class="form-select" disabled>
                                    <option value="0" {{ (old('shr_past_illness_varicella')=='0') ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ (old('shr_past_illness_varicella')=='1') ? 'selected' : '' }}>Yes</option>
                                </select>
                                <span class="text-danger shr-error-message" id="shr_past_illness_varicella_error">
                                    @error('shr_past_illness_varicella')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                        </div>

                        <div class="row px-2 pb-2">
                            <label class="col-lg-3 mt-1">
                                Hospitalization:
                                <select name="shr_past_illness_hospitalization" id="shr_past_illness_hospitalization" class="form-select" disabled>
                                    <option value="0" {{ (!old('shr_past_illness_hospitalization_specify')) ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ (old('shr_past_illness_hospitalization_specify')) ? 'selected' : '' }}>Yes</option>
                                </select>
                                <span class="text-danger shr-error-message" id="shr_past_illness_hospitalization_error">
                                    @error('shr_past_illness_hospitalization')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>

                            <label class="col-lg-6 mt-1">
                                Specify:
                                <input type="text" name="shr_past_illness_hospitalization_specify" id="shr_past_illness_hospitalization_specify" class="form-control" value="{{ old('shr_past_illness_hospitalization_specify') }}" disabled>
                                <span class="text-danger shr-error-message" id="shr_past_illness_hospitalization_specify_error">
                                    @error('shr_past_illness_hospitalization_specify')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                        </div>

                        <div class="row px-2 pb-2">
                            <label class="col-lg-3 mt-1">
                                Operation:
                                <select name="shr_past_illness_operation" id="shr_past_illness_operation" class="form-select" disabled>
                                    <option value="0" {{ (!old('shr_past_illness_operation_specify')) ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ (old('shr_past_illness_operation_specify')) ? 'selected' : '' }}>Yes</option>
                                </select>
                                <span class="text-danger shr-error-message" id="shr_past_illness_operation_error">
                                    @error('shr_past_illness_operation')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>

                            <label class="col-lg-6 mt-1">
                                Specify:
                                <input type="text" name="shr_past_illness_operation_specify" id="shr_past_illness_operation_specify" class="form-control" value="{{ old('shr_past_illness_operation_specify') }}" disabled>
                                <span class="text-danger shr-error-message" id="shr_past_illness_operation_specify_error">
                                    @error('shr_past_illness_operation_specify')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                        </div>

                        <div class="row px-2 pb-2">
                            <label class="col-lg-3 mt-1">
                                Accident:
                                <select name="shr_past_illness_accident" id="shr_past_illness_accident" class="form-select" disabled>
                                    <option value="0" {{ (!old('shr_past_illness_accident_specify')) ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ (old('shr_past_illness_accident_specify')) ? 'selected' : '' }}>Yes</option>
                                </select>
                                <span class="text-danger shr-error-message" id="shr_past_illness_accident_error">
                                    @error('shr_past_illness_accident')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>

                            <label class="col-lg-6 mt-1">
                                Specify:
                                <input type="text" name="shr_past_illness_accident_specify" id="shr_past_illness_accident_specify" class="form-control" value="{{ old('shr_past_illness_accident_specify') }}" disabled>
                                <span class="text-danger shr-error-message" id="shr_past_illness_accident_specify_error">
                                    @error('shr_past_illness_accident_specify')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                        </div>

                        <div class="row px-2 pb-2">
                            <label class="col-lg-3 mt-1">
                                Disability:
                                <select name="shr_past_illness_disability" id="shr_past_illness_disability" class="form-select" disabled>
                                    <option value="0" {{ (!old('shr_past_illness_disability_specify')) ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ (old('shr_past_illness_disability_specify')) ? 'selected' : '' }}>Yes</option>
                                </select>
                                <span class="text-danger shr-error-message" id="shr_past_illness_disability_error">
                                    @error('shr_past_illness_disability')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>

                            <label class="col-lg-6 mt-1">
                                Specify:
                                <input type="text" name="shr_past_illness_disability_specify" id="shr_past_illness_disability_specify" class="form-control" value="{{ old('shr_past_illness_disability_specify') }}" disabled>
                                <span class="text-danger shr-error-message" id="shr_past_illness_disability_specify_error">
                                    @error('shr_past_illness_disability_specify')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                        </div>
                    </fieldset>

                    <!-- allergy -->
                    <fieldset class="border border-secondary mt-2" style="border-radius: 5px;">
                        <legend  class="float-none w-auto px-1" style="font-weight: 600; font-size: 15px; margin-left: 5px;">Allergy</legend>
                        <div class="row px-2 pb-2">
                            <label class="col-lg-3">
                                Food:
                                <select name="shr_allergy_food" id="shr_allergy_food" class="form-select" disabled>
                                    <option value="0" {{ (!old('shr_allergy_food_specify')) ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ (old('shr_allergy_food_specify')) ? 'selected' : '' }}>Yes</option>
                                </select>
                                <span class="text-danger shr-error-message" id="shr_allergy_food_error">
                                    @error('shr_allergy_food')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                            <label class="col-lg-6">
                                Specify:
                                <input type="text" name="shr_allergy_food_specify" id="shr_allergy_food_specify" class="form-control" value="{{ old('shr_allergy_food_specify') }}" disabled>
                                <span class="text-danger shr-error-message" id="shr_allergy_food_specify_error">
                                    @error('shr_allergy_food_specify')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                        </div>
                        <div class="row px-2 pb-2">
                            <label class="col-lg-3">
                                Medicine:
                                <select name="shr_allergy_medicine" id="shr_allergy_medicine" class="form-select" disabled>
                                    <option value="0" {{ (!old('shr_allergy_medicine_specify')) ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ (old('shr_allergy_medicine_specify')) ? 'selected' : '' }}>Yes</option>
                                </select>
                                <span class="text-danger shr-error-message" id="shr_allergy_medicine_error">
                                    @error('shr_allergy_medicine')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                            <label class="col-lg-6">
                                Specify:
                                <input type="text" name="shr_allergy_medicine_specify" id="shr_allergy_medicine_specify" class="form-control" value="{{ old('shr_allergy_medicine_specify') }}" disabled>
                                <span class="text-danger shr-error-message" id="shr_allergy_medicine_specify_error">
                                    @error('shr_allergy_medicine_specify')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                        </div>
                        <div class="row px-2 pb-2">
                            <label class="col-lg-3">
                                Others:
                                <select name="shr_allergy_others" id="shr_allergy_others" class="form-select" disabled>
                                    <option value="0" {{ (!old('shr_allergy_others_specify')) ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ (old('shr_allergy_others_specify')) ? 'selected' : '' }}>Yes</option>
                                </select>
                                <span class="text-danger shr-error-message" id="shr_allergy_others_error">
                                    @error('shr_allergy_others')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                            <label class="col-lg-6">
                                Specify:
                                <input type="text" name="shr_allergy_others_specify" id="shr_allergy_others_specify" class="form-control" disabled>
                                <span class="text-danger shr-error-message" id="shr_allergy_others_specify_error">
                                    @error('shr_allergy_others_specify')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                        </div>
                    </fieldset>

                    <!-- immunization -->
                    <fieldset class="border border-secondary mt-2" style="border-radius: 5px;">
                        <legend  class="float-none w-auto px-1" style="font-weight: 600; font-size: 15px; margin-left: 5px;">Immunization</legend>
                        <div class="row px-2 pb-2">
                            <label class="col-lg-3 mt-1">
                                BCG:
                                <select name="shr_immunization_bcg" id="shr_immunization_bcg" class="form-select" disabled>
                                    <option value="0" {{ (old('shr_immunization_bcg')=='0') ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ (old('shr_immunization_bcg')=='1') ? 'selected' : '' }}>Yes</option>
                                </select>
                                <span class="text-danger shr-error-message" id="shr_immunization_bcg_error">
                                    @error('shr_immunization_bcg')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                            <label class="col-lg-3 mt-1">
                                MMR:
                                <select name="shr_immunization_mmr" id="shr_immunization_mmr" class="form-select" disabled>
                                    <option value="0" {{ (old('shr_immunization_mmr')=='0') ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ (old('shr_immunization_mmr')=='1') ? 'selected' : '' }}>Yes</option>
                                </select>
                                <span class="text-danger shr-error-message" id="shr_immunization_mmr_error">
                                    @error('shr_immunization_mmr')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                            <label class="col-lg-3 mt-1">
                                HEPA A:
                                <select name="shr_immunization_hepa_a" id="shr_immunization_hepa_a" class="form-select" disabled>
                                    <option value="0" {{ (old('shr_immunization_hepa_a')=='0') ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ (old('shr_immunization_hepa_a')=='1') ? 'selected' : '' }}>Yes</option>
                                </select>
                                <span class="text-danger shr-error-message" id="shr_immunization_hepa_a_error">
                                    @error('shr_immunization_hepa_a')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                            <label class="col-lg-3 mt-1">
                                Typhoid:
                                <select name="shr_immunization_typhoid" id="shr_immunization_typhoid" class="form-select" disabled>
                                    <option value="0" {{ (old('shr_immunization_typhoid')=='0') ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ (old('shr_immunization_typhoid')=='1') ? 'selected' : '' }}>Yes</option>
                                </select>
                                <span class="text-danger shr-error-message" id="shr_immunization_typhoid_error">
                                    @error('shr_immunization_typhoid')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                        </div>
                        <div class="row px-2 pb-2">
                            <label class="col-lg-3 mt-1">
                                Varicella:
                                <select name="shr_immunization_varicella" id="shr_immunization_varicella" class="form-select" disabled>
                                    <option value="0" {{ (old('shr_immunization_varicella')=='0') ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ (old('shr_immunization_varicella')=='1') ? 'selected' : '' }}>Yes</option>
                                </select>
                                <span class="text-danger shr-error-message" id="shr_immunization_varicella_error">
                                    @error('shr_immunization_varicella')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                        </div>
                        <div class="row px-2 pb-2">
                            <label class="col-lg-3 mt-1">
                                Hepa B:
                                <select name="shr_immunization_hepa_b" id="shr_immunization_hepa_b" class="form-select" disabled>
                                    <option value="0" {{ (!old('shr_immunization_hepa_b_doses')) ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ (old('shr_immunization_hepa_b_doses')) ? 'selected' : '' }}>Yes</option>
                                </select>
                                <span class="text-danger shr-error-message" id="shr_immunization_hepa_b_error">
                                    @error('shr_immunization_hepa_b')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                            <label class="col-lg-3 mt-1">
                                Hepa B Doses:
                                <input type="number" name="shr_immunization_hepa_b_doses" id="shr_immunization_hepa_b_doses" class="form-control" value="{{ old('shr_immunization_hepa_b_doses') }}" disabled>
                                <span class="text-danger shr-error-message" id="shr_immunization_hepa_b_doses_error">
                                    @error('shr_immunization_hepa_b_doses')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                            <label class="col-lg-3 mt-1">
                                DPT:
                                <select name="shr_immunization_dpt" id="shr_immunization_dpt" class="form-select" disabled>
                                    <option value="0" {{ (!old('shr_immunization_dpt_doses')) ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ (old('shr_immunization_dpt_doses')) ? 'selected' : '' }}>Yes</option>
                                </select>
                                <span class="text-danger shr-error-message" id="shr_immunization_dpt_error">
                                    @error('shr_immunization_dpt')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                            <label class="col-lg-3 mt-1">
                                DPT Doses:
                                <input type="number" name="shr_immunization_dpt_doses" id="shr_immunization_dpt_doses" class="form-control" value="{{ old('shr_immunization_dpt_doses') }}" disabled>
                                <span class="text-danger shr-error-message" id="shr_immunization_dpt_doses_error">
                                    @error('shr_immunization_dpt_doses')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                        </div>
                        <div class="row px-2 pb-2">
                            <label class="col-lg-3 mt-1">
                                OPV:
                                <select name="shr_immunization_opv" id="shr_immunization_opv" class="form-select" disabled>
                                    <option value="0" {{ (!old('shr_immunization_opv_doses')) ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ (old('shr_immunization_opv_doses')) ? 'selected' : '' }}>Yes</option>
                                </select>
                                <span class="text-danger shr-error-message" id="shr_immunization_opv_error">
                                    @error('shr_immunization_opv')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                            <label class="col-lg-3 mt-1">
                                OPV Doses:
                                <input type="number" name="shr_immunization_opv_doses" id="shr_immunization_opv_doses" class="form-control" value="{{ old('shr_immunization_opv_doses') }}" disabled>
                                <span class="text-danger shr-error-message" id="shr_immunization_opv_doses_error">
                                    @error('shr_immunization_opv_doses')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                            <label class="col-lg-3 mt-1">
                                HIB:
                                <select name="shr_immunization_hib" id="shr_immunization_hib" class="form-select" disabled>
                                    <option value="0" {{ (!old('shr_immunization_hib_doses')) ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ (old('shr_immunization_hib_doses')) ? 'selected' : '' }}>Yes</option>
                                </select>
                                <span class="text-danger shr-error-message" id="shr_immunization_hib_error">
                                    @error('shr_immunization_hib')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                            <label class="col-lg-3 mt-1">
                                HIB Doses:
                                <input type="number" name="shr_immunization_hib_doses" id="shr_immunization_hib_doses" class="form-control" value="{{ old('shr_immunization_hib_doses') }}" disabled>
                                <span class="text-danger shr-error-message" id="shr_immunization_hib_doses_error">
                                    @error('shr_immunization_hib_doses')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                        </div>
                    </fieldset>

                    <!-- pubertal -->
                    <fieldset class="border border-secondary mt-2" style="border-radius: 5px;">
                        <legend  class="float-none w-auto px-1" style="font-weight: 600; font-size: 15px; margin-left: 5px;">Pubertal</legend>
                        <div class="row px-2 pb-2">
                            <div class="col-lg-6 mt-1">
                                Male:
                                <div class="row mt-1">
                                    <label class="col-lg-6">
                                        Age of onset:
                                        <input type="number" name="shr_male_age_of_onset" id="shr_male_age_of_onset" class="form-control" 
                                        value="{{ old('shr_male_age_of_onset') }}" disabled>
                                        <span class="text-danger shr-error-message" id="shr_male_age_of_onset_error">
                                            @error('shr_male_age_of_onset')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-6 mt-1">
                                Female:
                                <div class="row">
                                    <label class="col-lg-6 mt-1">
                                        Menarche:
                                        <input type="number" name="shr_female_menarche" id="shr_female_menarche" class="form-control" 
                                        value="{{ (old('shr_gender')=='female') ? old('shr_female_menarche') : '' }}" disabled>
                                        <span class="text-danger shr-error-message" id="shr_female_menarche_error">
                                            @error('shr_female_menarche')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </label>
                                    <label class="col-lg-6 mt-1">
                                        LMP:
                                        <input type="date" name="shr_female_lmp" id="shr_female_lmp" class="form-control"
                                        value="{{ (old('shr_gender')=='female') ? old('shr_female_lmp') : '' }}" disabled>
                                        <span class="text-danger shr-error-message" id="shr_female_lmp_error">
                                            @error('shr_female_lmp')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </label>
                                </div>
                                <div class="row">
                                    <label class="col-lg-6 mt-1">
                                        Dysmenorhea:
                                        <select name="shr_female_dysmenorhea" id="shr_female_dysmenorhea" class="form-select" disabled>
                                            <option value="">--- choose ---</option>
                                            <option value="0" {{ (old('shr_gender')=='female') ? (old('shr_gender_dysmenorhea')=='0') ? 'selected' : '' : '' }}>No</option>
                                            <option value="1" {{ (old('shr_gender')=='female') ? (old('shr_gender_dysmenorhea')=='1') ? 'selected' : '' : '' }}>Yes</option>
                                        </select>
                                        <span class="text-danger shr-error-message" id="shr_female_dysmenorhea_error">
                                            @error('shr_female_dysmenorhea')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </label>
                                    <label class="col-lg-6 mt-1">
                                        Medicine:
                                        <input type="text" name="shr_female_dysmenorhea_medicine" id="shr_female_dysmenorhea_medicine" class="form-control" 
                                        value="{{ (old('shr_gender')=='female') ? old('shr_female_dysmenorhea_medicine') : '' }}" disabled>
                                        <span class="text-danger shr-error-message" id="shr_female_dysmenorhea_medicine_error">
                                            @error('shr_female_dysmenorhea_medicine')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </fieldset>    
                    
                    <!-- family history -->
                    <fieldset class="border border-secondary mt-2" style="border-radius: 5px;">
                        <legend  class="float-none w-auto px-1" style="font-weight: 600; font-size: 15px; margin-left: 5px;">Family History</legend>
                        <div class="row px-2 pb-2">
                            <label class="col-lg-3 mt-1">
                                Diabetes:
                                <select name="shr_family_history_diabetes" id="shr_family_history_diabetes" class="form-select" disabled>
                                    <option value="0" {{ (!old('shr_family_history_diabetes')) ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ (old('shr_family_history_diabetes')) ? 'selected' : '' }}>Yes</option>
                                </select>
                                <span class="text-danger shr-error-message" id="shr_family_history_diabetes_error">
                                    @error('shr_family_history_diabetes')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                            <label class="col-lg-3 mt-1">
                                Heart Disease:
                                <select name="shr_family_history_heart_disease" id="shr_family_history_heart_disease" class="form-select" disabled>
                                    <option value="0" {{ (!old('shr_family_history_heart_disease')) ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ (old('shr_family_history_heart_disease')) ? 'selected' : '' }}>Yes</option>
                                </select>
                                <span class="text-danger shr-error-message" id="shr_family_history_heart_disease_error">
                                    @error('shr_family_history_heart_disease')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                            <label class="col-lg-3 mt-1">
                                Mental Illness:
                                <select name="shr_family_history_mental_illness" id="shr_family_history_mental_illness" class="form-select" disabled>
                                    <option value="0" {{ (!old('shr_family_history_mental_illness')) ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ (old('shr_family_history_mental_illness')) ? 'selected' : '' }}>Yes</option>
                                </select>
                                <span class="text-danger shr-error-message" id="shr_family_history_mental_illness_error">
                                    @error('shr_family_history_mental_illness')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                            <label class="col-lg-3 mt-1">
                                Cancer:
                                <select name="shr_family_history_cancer" id="shr_family_history_cancer" class="form-select" disabled>
                                    <option value="0" {{ (!old('shr_family_history_cancer')) ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ (old('shr_family_history_cancer')) ? 'selected' : '' }}>Yes</option>
                                </select>
                                <span class="text-danger shr-error-message" id="shr_family_history_cancer_error">
                                    @error('shr_family_history_cancer')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                        </div>
                        <div class="row px-2 pb-2">
                            <label class="col-lg-3 mt-1">
                                Hypertension:
                                <select name="shr_family_history_hypertension" id="shr_family_history_hypertension" class="form-select" disabled>
                                    <option value="0" {{ (!old('shr_family_history_hypertension')) ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ (old('shr_family_history_hypertension')) ? 'selected' : '' }}>Yes</option>
                                </select>
                                <span class="text-danger shr-error-message" id="shr_family_history_hypertension_error">
                                    @error('shr_family_history_hypertension')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                            <label class="col-lg-3 mt-1">
                                Kidney Disease:
                                <select name="shr_family_history_kidney_disease" id="shr_family_history_kidney_disease" class="form-select" disabled>
                                    <option value="0" {{ (!old('shr_family_history_kidney_disease')) ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ (old('shr_family_history_kidney_disease')) ? 'selected' : '' }}>Yes</option>
                                </select>
                                <span class="text-danger shr-error-message" id="shr_family_history_kidney_disease_error">
                                    @error('shr_family_history_kidney_disease')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                            <label class="col-lg-3 mt-1">
                                Epilepsy:
                                <select name="shr_family_history_epilepsy" id="shr_family_history_epilepsy" class="form-select" disabled>
                                    <option value="0" {{ (!old('shr_family_history_epilepsy')) ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ (old('shr_family_history_epilepsy')) ? 'selected' : '' }}>Yes</option>
                                </select>
                                <span class="text-danger shr-error-message" id="shr_family_history_epilepsy_error">
                                    @error('shr_family_history_epilepsy')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                            <label class="col-lg-3 mt-1">
                                Others:
                                <select name="shr_family_history_others" id="shr_family_history_others" class="form-select" disabled>
                                    <option value="0" {{ (!old('shr_family_history_others')) ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ (old('shr_family_history_others')) ? 'selected' : '' }}>Yes</option>
                                </select>
                                <span class="text-danger shr-error-message" id="shr_family_history_others_error">
                                    @error('shr_family_history_others')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                        </div>
                        <div class="row px-2 pb-2">
                            <div class="col-lg-6 mt-1">
                                Father's Name:
                                <input type="text" name="shr_fathers_name" id="shr_fathers_name" class="form-control" value="{{ old('shr_fathers_firstname') }}" disabled>
                                <span class="text-danger shr-error-message" id="shr_fathers_name_error">
                                    @error('shr_fathers_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-lg-3 mt-1">
                                Occupation:
                                <input type="text" name="shr_fathers_occupation" id="shr_fathers_occupation" class="form-control" value="{{ old('shr_fathers_occupation') }}" disabled>
                                <span class="text-danger shr-error-message" id="shr_fathers_occupation_error">
                                    @error('shr_fathers_occupation')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="row px-2 pb-2">
                            <div class="col-lg-6 mt-1">
                                Mother's Name:
                                <input type="text" name="shr_mothers_name" id="shr_mothers_name" class="form-control" value="{{ old('shr_mothers_firstname') }}" disabled>
                                <span class="text-danger shr-error-message" id="shr_mothers_name_error">
                                    @error('shr_mothers_firstname')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-lg-3 mt-1">
                                Occupation:
                                <input type="text" name="shr_mothers_occupation" id="shr_mothers_occupation" class="form-control" value="{{ old('shr_mothers_occupation') }}" disabled>
                                <span class="text-danger shr-error-message" id="shr_mothers_occupation_error">
                                    @error('shr_mothers_occupation')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="row px-2 pb-2">
                            <label class="col-lg-3 mt-1">
                                Marital Status:
                                <select name="shr_marital_status" id="shr_marital_status" class="form-select" disabled>
                                    <option value="">--- choose ---</option>
                                    <option value="married" {{ (old('shr_marital_status')=='married') ? 'selected' : '' }}>Married</option>
                                    <option value="unmarried" {{ (old('shr_marital_status')=='unmarried') ? 'selected' : '' }}>Unmarried</option>
                                    <option value="separated" {{ (old('shr_marital_status')=='separated') ? 'selected' : '' }}>Separated</option>
                                </select>
                                <span class="text-danger shr-error-message" id="shr_marital_status_error">
                                    @error('shr_marital_status')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                        </div>
                    </fieldset>

                    <!-- physical examination -->
                    <fieldset class="border border-secondary mt-2" style="border-radius: 5px;">
                        <legend  class="float-none w-auto px-1" style="font-weight: 600; font-size: 15px; margin-left: 5px;">Physical Examination</legend>
                        <div class="row px-2 pb-2">
                            <label class="col-lg-3 mt-1">
                                Weight (kg):
                                <input type="number" name="shr_weight" id="shr_weight" class="form-control" value="{{ old('shr_weight') }}" onblur="if(this.value==''){this.value=0;}" disabled>
                                <span class="text-danger shr-error-message" id="shr_weight_error">
                                    @error('shr_weight')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                            <label class="col-lg-3 mt-1">
                                Height (m):
                                <input type="number" name="shr_height" id="shr_height" class="form-control" value="{{ old('shr_height') }}" onblur="if(this.value==''){this.value=0;}" disabled>
                                <span class="text-danger shr-error-message" id="shr_height_error">
                                    @error('shr_height')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>

                            <label class="col-lg-6 mt-1">
                                BMI (Weight in kg/height in meter sq.):
                                <input type="text" name="shr_bmi" id="shr_bmi" class="form-control" value="{{ old('shr_bmi') }}" readonly>
                                <span class="text-danger shr-error-message" id="shr_bmi_error">
                                    @error('shr_bmi')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                        </div>
                        <div class="row px-2 pb-2">
                            <label class="col-lg-3 mt-1">
                                Temperature:
                                <input type="text" name="shr_temperature" id="shr_temperature" class="form-control" value="{{ old('shr_temperature') }}" disabled>
                                <span class="text-danger shr-error-message" id="shr_temperature_error">
                                    @error('shr_temperature')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                            <label class="col-lg-3 mt-1">
                                HR:
                                <input type="text" name="shr_hr" id="shr_hr" class="form-control" value="{{ old('shr_temperature') }}" disabled> 
                                <span class="text-danger shr-error-message" id="shr_hr_error">
                                    @error('shr_hr')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                            <label class="col-lg-3 mt-1">
                                BP:
                                <input type="text" name="shr_bp" id="shr_bp" class="form-control" value="{{ old('shr_bp') }}" disabled>
                                <span class="text-danger shr-error-message" id="shr_bp_error">
                                    @error('shr_bp')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                            <label class="col-lg-3 mt-1">
                                Vision:
                                <input type="text" name="shr_vision" id="shr_vision" class="form-control" value="{{ old('shr_vision') }}" disabled>
                                <span class="text-danger shr-error-message" id="shr_vision_error">
                                    @error('shr_vision')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                        </div>
                        <div class="row px-2 pb-2">
                            <label class="col-lg-3 mt-1">
                                Hearing:
                                <input type="text" name="shr_hearing" id="shr_hearing" class="form-control" value="{{ old('shr_hearing') }}" disabled>
                                <span class="text-danger shr-error-message" id="shr_hearing_error">
                                    @error('shr_hearing')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                            <label class="col-lg-3 mt-1">
                                Blood Type:
                                <select name="shr_blood_type" id="shr_blood_type" class="form-select" disabled>
                                <option value="">--- choose ---</option>
                                <option value="a positive"  {{ (old('shr_blood_type')=='a positive') ? 'selected' : '' }}>A Positive</option>
                                <option value="a negative"  {{ (old('shr_blood_type')=='a negative') ? 'selected' : '' }}>A Negative</option>
                                <option value="ab positive" {{ (old('shr_blood_type')=='ab positive') ? 'selected' : '' }}>AB Positive</option>
                                <option value="ab negative" {{ (old('shr_blood_type')=='ab negative') ? 'selected' : '' }}>AB Negative</option>
                                <option value="b positive"  {{ (old('shr_blood_type')=='b positive') ? 'selected' : '' }}>B Positive</option>
                                <option value="b negative"  {{ (old('shr_blood_type')=='b negative') ? 'selected' : '' }}>B Negative</option>
                                <option value="o positive"  {{ (old('shr_blood_type')=='o positive') ? 'selected' : '' }}>O Positive</option>
                                <option value="o negative"  {{ (old('shr_blood_type')=='o negative') ? 'selected' : '' }}>O Negative</option>
                                </select>
                                <span class="text-danger shr-error-message" id="shr_blood_type_error">
                                    @error('shr_blood_type')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                        </div>
                        <div class="row px-2 pb-2">
                            <label class="col-lg-6 mt-1">
                                Chest X-Ray Result:
                                <input type="text" name="shr_chest_xray_result" id="shr_chest_xray_result" class="form-control" value="{{ old('shr_chest_xray_result') }}" disabled>
                                <span class="text-danger shr-error-message" id="shr_chest_xray_result_error">
                                    @error('shr_chest_xray_result')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                            <label class="col-lg-3 mt-1">
                                Date (X-Ray Result):
                                <input type="date" name="shr_chest_xray_result_date" id="shr_chest_xray_result_date"  class="form-control" value="{{ old('shr_chest_xray_result_date') }}" disabled>
                                <span class="text-danger shr-error-message" id="shr_chest_xray_result_date_error">
                                    @error('shr_chest_xray_result_date')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                        </div>
                        <div class="row px-2 pb-2">
                            <label class="col-lg-12 mt-2 text-danger" style="font-size: 15px;">If no or not normal, describe only the abnormal findings in the space below.</label>
                            
                            <label class="col-lg-3 mt-1">
                                General Survey:
                                <select name="shr_general_survey" id="shr_general_survey" class="form-select" disabled>
                                    <option value="0" {{ (!old('shr_general_survey_findings')) ? 'selected' : '' }}>Normal</option>
                                    <option value="1" {{ (old('shr_general_survey_findings')) ? 'selected' : '' }}>Not Normal</option>
                                </select>
                                <span class="text-danger shr-error-message" id="shr_general_survey_error">
                                    @error('shr_general_survey')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                            <label class="col-lg-9 mt-1">
                                Findings (general survey):
                                <input type="text" name="shr_general_survey_findings" id="shr_general_survey_findings" class="form-control" value="{{ old('shr_general_survey_findings') }}" disabled>
                                <span class="text-danger shr-error-message" id="shr_general_survey_findings_error">
                                    @error('shr_general_survey_findings')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>

                            <label class="col-lg-3 mt-1">
                                Skin:
                                <select name="shr_skin" id="shr_skin" class="form-select" disabled>
                                    <option value="0" {{ (!old('shr_skin_findings')) ? 'selected' : '' }}>Normal</option>
                                    <option value="1" {{ (old('shr_skin_findings')) ? 'selected' : '' }}>Not Normal</option>
                                </select>
                                <span class="text-danger shr-error-message" id="shr_skin_error">
                                    @error('shr_skin')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                            <label class="col-lg-9 mt-1">
                                Findings (skin):
                                <input type="text" name="shr_skin_findings" id="shr_skin_findings" class="form-control" value="{{ old('shr_skin_findings') }}" disabled>
                                <span class="text-danger shr-error-message" id="shr_skin_findings_error">
                                    @error('shr_skin_findings')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>

                            <label class="col-lg-3 mt-1">
                                Eyes/ Ears/ Nose:
                                <select name="shr_eye_ears_nose" id="shr_eye_ears_nose" class="form-select" disabled>
                                    <option value="0" {{ (!old('shr_eye_ears_nose_findings')) ? 'selected' : '' }}>Normal</option>
                                    <option value="1" {{ (old('shr_eye_ears_nose_findings')) ? 'selected' : '' }}>Not Normal</option>
                                </select>
                                <span class="text-danger shr-error-message" id="shr_eye_ears_nose_error">
                                    @error('shr_eye_ears_nose')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                            <label class="col-lg-9 mt-1">
                                Findings (eyes/ ears/ nose):
                                <input type="text" name="shr_eye_ears_nose_findings" id="shr_eye_ears_nose_findings" class="form-control" value="{{ old('shr_eye_ears_nose_findings') }}" disabled>
                                <span class="text-danger shr-error-message" id="shr_eye_ears_nose_findings_error">
                                    @error('shr_eye_ears_nose_findings')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>

                            <label class="col-lg-3 mt-1">
                                Teeth/ Gums:
                                <select name="shr_teeth_gums" id="shr_teeth_gums" class="form-select" disabled>
                                    <option value="0" {{ (!old('shr_teeth_gums_findings')) ? 'selected' : '' }}>Normal</option>
                                    <option value="1" {{ (old('shr_teeth_gums_findings')) ? 'selected' : '' }}>Not Normal</option>
                                </select>
                                <span class="text-danger shr-error-message" id="shr_teeth_gums_error">
                                    @error('shr_teeth_gums')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                            <label class="col-lg-9 mt-1">
                                Findings (teeth/ gums):
                                <input type="text" name="shr_teeth_gums_findings" id="shr_teeth_gums_findings" class="form-control" value="{{ old('shr_teeth_gums_findings') }}" disabled>
                                <span class="text-danger shr-error-message" id="shr_teeth_gums_findings_error">
                                    @error('shr_teeth_gums_findings')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>

                            <label class="col-lg-3 mt-1">
                                Neck:
                                <select name="shr_neck" id="shr_neck" class="form-select" disabled>
                                    <option value="0" {{ (!old('shr_neck_findings')) ? 'selected' : '' }}>Normal</option>
                                    <option value="1" {{ (old('shr_neck_findings')) ? 'selected' : '' }}>Not Normal</option>
                                </select>
                                <span class="text-danger shr-error-message" id="shr_neck_error">
                                    @error('shr_neck')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                            <label class="col-lg-9 mt-1">
                                Findings (neck):
                                <input type="text" name="shr_neck_findings" id="shr_neck_findings" class="form-control" value="{{ old('shr_neck_findings') }}" disabled>
                                <span class="text-danger shr-error-message" id="shr_neck_findings_error">
                                    @error('shr_neck_findings')
                                        {{ $message }}
                                    @enderror
                                </span>    
                            </label>

                            <label class="col-lg-3 mt-1">
                                Heart:
                                <select name="shr_heart" id="shr_heart" class="form-select" disabled>
                                    <option value="0" {{ (!old('shr_heart_findings')) ? 'selected' : '' }}>Normal</option>
                                    <option value="1" {{ (old('shr_heart_findings')) ? 'selected' : '' }}>Not Normal</option>
                                </select>
                                <span class="text-danger shr-error-message" id="shr_heart_error">
                                    @error('shr_heart')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                            <label class="col-lg-9 mt-1">
                                Findings (heart):
                                <input type="text" name="shr_heart_findings" id="shr_heart_findings" class="form-control" value="{{ old('shr_heart_findings') }}" disabled>
                                <span class="text-danger shr-error-message" id="shr_heart_findings_error">
                                    @error('shr_heart_findings')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>

                            <label class="col-lg-3 mt-1">
                                Chest/ Lungs:
                                <select name="shr_chest_lungs" id="shr_chest_lungs" class="form-select" disabled>
                                    <option value="0" {{ (!old('shr_chest_lungs_findings')) ? 'selected' : '' }}>Normal</option>
                                    <option value="1" {{ (old('shr_chest_lungs_findings')) ? 'selected' : '' }}>Not Normal</option>
                                </select>
                                <span class="text-danger shr-error-message" id="shr_chest_lungs_error">
                                    @error('shr_chest_lungs')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                            <label class="col-lg-9 mt-1">
                                Findings (chest/ lungs):
                                <input type="text" name="shr_chest_lungs_findings" id="shr_chest_lungs_findings" class="form-control" value="{{ old('shr_chest_lungs') }}" disabled>
                                <span class="text-danger shr-error-message" id="shr_chest_lungs_findings_error">
                                    @error('shr_chest_lungs_findings')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>

                            <label class="col-lg-3 mt-1">
                                Abdomen:
                                <select name="shr_abdomen" id="shr_abdomen" class="form-select" disabled>
                                    <option value="0" {{ (!old('shr_abdomen_findings')) ? 'selected' : '' }}>Normal</option>
                                    <option value="1" {{ (old('shr_abdomen_findings')) ? 'selected' : '' }}>Not Normal</option>
                                </select>
                                <span class="text-danger shr-error-message" id="shr_abdomen_error">
                                    @error('shr_abdomen')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                            <label class="col-lg-9 mt-1">
                                Findings (abdomen):
                                <input type="text" name="shr_abdomen_findings" id="shr_abdomen_findings" class="form-control" value="{{ old('shr_abdomen_findings') }}" disabled>
                                <span class="text-danger shr-error-message" id="shr_abdomen_findings_error">
                                    @error('shr_abdomen_findings')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>

                            <label class="col-lg-3 mt-1">
                                Musculoskeletal:
                                <select name="shr_musculoskeletal" id="shr_musculoskeletal" class="form-select" disabled>
                                    <option value="0" {{ (!old('shr_musculoskeletal_findings')) ? 'selected' : '' }}>Normal</option>
                                    <option value="1" {{ (old('shr_musculoskeletal_findings')) ? 'selected' : '' }}>Not Normal</option>
                                </select>
                                <span class="text-danger shr-error-message" id="shr_musculoskeletal_error">
                                    @error('shr_musculoskeletal')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                            <label class="col-lg-9 mt-1">
                                Findings (musculoskeletal):
                                <input type="text" name="shr_musculoskeletal_findings" id="shr_musculoskeletal_findings" class="form-control" value="{{ old('shr_musculoskeletal_findings') }}" disabled>
                                <span class="text-danger shr-error-message" id="shr_musculoskeletal_findings_error">
                                    @error('shr_musculoskeletal_findings')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                        </div>
                    </fieldset>

                    <!-- assesment diagnosis -->
                    <fieldset class="border border-secondary mt-2" style="border-radius: 5px;">
                        <legend  class="float-none w-auto px-1" style="font-weight: 600; font-size: 15px; margin-left: 5px;">Assesment Diagnosis</legend>
                        <div class="row px-2 pb-2">
                            <label class="col-lg-4">
                                Drinking?
                                <select name="shr_assessment_diagnosis_drinking" id="shr_assessment_diagnosis_drinking" class="form-select" disabled>
                                    <option value="0" {{ (!old('shr_assessment_diagnosis_drinking_how_much')) ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ (old('shr_assessment_diagnosis_drinking_how_much')) ? 'selected' : '' }}>Yes</option>
                                </select>
                                <span class="text-danger shr-error-message" id="shr_assessment_diagnosis_drinking_error">
                                    @error('shr_assessment_diagnosis_drinking')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                            <label class="col-lg-4">
                                How much?
                                <input type="text" name="shr_assessment_diagnosis_drinking_how_much" id="shr_assessment_diagnosis_drinking_how_much" class="form-control" 
                                value="{{ old('shr_assessment_diagnosis_drinking_how_much') }}" disabled>
                                <span class="text-danger shr-error-message" id="shr_assessment_diagnosis_drinking_how_much_error">
                                    @error('shr_assessment_diagnosis_drinking_how_much')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                            <label class="col-lg-4">
                                How often?
                                <select class="form-select" name="shr_assessment_diagnosis_drinking_how_often" id="shr_assessment_diagnosis_drinking_how_often" disabled>
                                    <option value="" {{ (!old('shr_assessment_diagnosis_drinking_how_often')) ? 'selected' : '' }}>--- choose ---</option>
                                    <option value="one time a week" {{ (old('shr_assessment_diagnosis_drinking_how_often')=='one time a week') ? 'selected' : '' }}>One time a week</option>
                                    <option value="two times a week" {{ (old('shr_assessment_diagnosis_drinking_how_often')=='two times a week') ? 'selected' : '' }}>Two times a week</option>
                                    <option value="three times a week" {{ (old('shr_assessment_diagnosis_drinking_how_often')=='three times a week') ? 'selected' : '' }}>Three times a week</option>
                                    <option value="four times a week" {{ (old('shr_assessment_diagnosis_drinking_how_often')=='four times a week') ? 'selected' : '' }}>Four times a week</option>
                                    <option value="five times a week" {{ (old('shr_assessment_diagnosis_drinking_how_often')=='five times a week') ? 'selected' : '' }}>Five times a week</option>
                                    <option value="six times a week" {{ (old('shr_assessment_diagnosis_drinking_how_often')=='six times a week') ? 'selected' : '' }}>Six times a week</option>
                                    <option value="seven times a week" {{ (old('shr_assessment_diagnosis_drinking_how_often')=='seven times a week') ? 'selected' : '' }}>Seven times a week</option>
                                </select>
                                <span class="text-danger shr-error-message" id="shr_assessment_diagnosis_drinking_how_often_error">
                                    @error('shr_assessment_diagnosis_drinking_how_often')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                        </div>
                        <div class="row px-2 pb-2">
                            <label class="col-lg-4">
                                Smoking?
                                <select name="shr_assessment_diagnosis_smoking" id="shr_assessment_diagnosis_smoking" class="form-select" disabled>
                                    <option value="0" {{ (!old('shr_assessment_diagnosis_smoking_sticks_per_day')) ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ (old('shr_assessment_diagnosis_smoking_sticks_per_day')) ? 'selected' : '' }}>Yes</option>
                                </select>
                                <span class="text-danger shr-error-message" id="shr_assessment_diagnosis_smoking_error">
                                    @error('shr_assessment_diagnosis_smoking')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                            <label class="col-lg-4">
                                Number of Sticks/day?
                                <input type="number" name="shr_assessment_diagnosis_smoking_sticks_per_day" id="shr_assessment_diagnosis_smoking_sticks_per_day" class="form-control"
                                value="{{ old('shr_assessment_diagnosis_smoking_sticks_per_day') }}" disabled>
                                <span class="text-danger shr-error-message" id="shr_assessment_diagnosis_smoking_sticks_per_day_error">
                                    @error('shr_assessment_diagnosis_smoking_sticks_per_day')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                            <label class="col-lg-4">
                                Since when (Yrs. Old)? 
                                <input type="number" name="shr_assessment_diagnosis_smoking_since_when" id="shr_assessment_diagnosis_smoking_since_when" class="form-control"
                                value="{{ old('shr_assessment_diagnosis_smoking_since_when') }}" disabled>
                                <span class="text-danger shr-error-message" id="shr_assessment_diagnosis_smoking_since_when_error">
                                    @error('shr_assessment_diagnosis_smoking_since_when')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                        </div>
                        <div class="row px-2 pb-2">
                            <label class="col-lg-4">
                                Drug use?
                                <select name="shr_assessment_diagnosis_drug_use" id="shr_assessment_diagnosis_drug_use" class="form-select" disabled>
                                    <option value="0" {{ (!old('shr_assessment_diagnosis_drug_kind')) ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ (old('shr_assessment_diagnosis_drug_kind')) ? 'selected' : '' }}>Yes</option>
                                </select>
                                <span class="text-danger shr-error-message" id="shr_assessment_diagnosis_drug_use_error">
                                    @error('shr_assessment_diagnosis_drug_use')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                            <label class="col-lg-4">
                                Kind:
                                <input type="text" name="shr_assessment_diagnosis_drug_kind" id="shr_assessment_diagnosis_drug_kind" class="form-control"
                                value="{{ old('shr_assessment_diagnosis_drug_kind') }}" disabled>
                                <span class="text-danger shr-error-message" id="shr_assessment_diagnosis_drug_kind_error">
                                    @error('shr_assessment_diagnosis_drug_kind')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                            <label class="col-lg-4">
                                Regular Use?
                                <select name="shr_assessment_diagnosis_regular_use" id="shr_assessment_diagnosis_regular_use" class="form-select" disabled>
                                    <option value="0" {{ (old('shr_assessment_diagnosis_regular_use')=='0') ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ (old('shr_assessment_diagnosis_regular_use')=='1') ? 'selected' : '' }}>Yes</option>
                                </select>
                                <span class="text-danger shr-error-message" id="shr_assessment_diagnosis_regular_use_error">
                                    @error('shr_assessment_diagnosis_regular_use')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                        </div>
                        <div class="row px-2 pb-2">
                            <label class="col-lg-4">
                                Driving?
                                <select name="shr_assessment_driving" id="shr_assessment_driving" class="form-select" disabled>
                                    <option value="0" {{ (old('shr_assessment_driving')) ? '' : 'selected' }}>No</option>
                                    <option value="1" {{ (old('shr_assessment_driving')) ? 'selected' : '' }}>Yes</option>
                                </select>
                                <span class="text-danger shr-error-message" id="shr_assessment_driving_error">
                                    @error('shr_assessment_driving')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                            <label class="col-lg-4">
                                Specify Vehicle:
                                <input type="text" name="shr_assessment_driving_specify" id="shr_assessment_driving_specify" class="form-control"
                                value="{{ old('shr_assessment_driving_specify') }}" disabled>
                                <span class="text-danger shr-error-message" id="shr_assessment_driving_specify_error">
                                    @error('shr_assessment_driving_specify')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                            <label class="col-lg-4">
                                With license?
                                <select name="shr_assessment_driving_with_license" id="shr_assessment_driving_with_license" class="form-select" disabled>
                                    <option value="0" {{ (old('shr_assessment_driving_with_license')=='0') ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ (old('shr_assessment_driving_with_license')=='1') ? 'selected' : '' }}>Yes</option>
                                </select>
                                <span class="text-danger shr-error-message" id="shr_assessment_driving_with_license_error">
                                    @error('shr_assessment_driving_with_license')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                        </div>
                        <div class="row px-2 pb-2">
                            <label class="col-lg-4">
                                Abuse? (Physical, Sexual, Verbal)
                                <select name="shr_assessment_diagnosis_abuse" id="shr_assessment_diagnosis_abuse" class="form-select" disabled>
                                    <option value="0" {{ (old('shr_assessment_diagnosis_abuse')) ? '' : 'selected' }}>No</option>
                                    <option value="1" {{ (old('shr_assessment_diagnosis_abuse')) ? 'selected' : '' }}>Yes</option>
                                </select>
                                <span class="text-danger shr-error-message" id="shr_assessment_diagnosis_abuse_error">
                                    @error('shr_assessment_diagnosis_abuse')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                            <label class="col-lg-8">
                                Specify what kind of abuse:
                                <input type="text" name="shr_assessment_diagnosis_abuse_specify" id="shr_assessment_diagnosis_abuse_specify" class="form-control"
                                value="{{ old('shr_assessment_diagnosis_abuse_specify') }}" disabled>
                                <span class="text-danger shr-error-message" id="shr_assessment_diagnosis_abuse_specify_error">
                                    @error('shr_assessment_diagnosis_abuse_specify')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </label>
                        </div>
                    </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="shr_save_btn">Add</button>
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

    function if_true_disable(independent, dependent){
        if($(independent).val()==0){
            disable(dependent);
        }
        else{
            enable(dependent);
        }
    }

    function clear_disable(id){
        $(id).css("color", "#e9ecef");
        disable(id);
    }

    function set_input(id, val){
        $(id).val(val);
    }

    function enable_all_inputs(){
        // header
        enable('#shr_med, #shr_srcode, #shr_program');
        // personal details
        enable('#shr_profile_pic, #shr_reset_profile_pic, #shr_firstname, #shr_middlename, #shr_lastname, #shr_suffixname, #shr_home_address, #shr_dorm_address, #shr_gender, #shr_civil_status, #shr_religion, #shr_contact, #shr_date_of_birth, #shr_place_of_birth');
        // emergency contact
        enable('#shr_emergency_name, #shr_emergency_business_address, #shr_emergency_relation_to_patient, #shr_emergency_landline, #shr_emergency_contact');
        // past illness
        enable('#shr_past_illness_asthma, #shr_past_illness_asthma_last_attack, #shr_past_illness_heart_disease, #shr_past_illness_hypertension, #shr_past_illness_epilepsy, #shr_past_illness_diabetes, #shr_past_illness_thyroid_problem, #shr_past_illness_measles, #shr_past_illness_mumps, #shr_past_illness_varicella, #shr_past_illness_hospitalization, #shr_past_illness_hospitalization_specify, #shr_past_illness_operation, #shr_past_illness_operation_specify, #shr_past_illness_accident, #shr_past_illness_accident_specify, #shr_past_illness_disability, #shr_past_illness_disability_specify');
            // dependent dropdowns
            if_true_disable('#shr_past_illness_asthma', '#shr_past_illness_asthma_last_attack');
            if_true_disable('#shr_past_illness_hospitalization', '#shr_past_illness_hospitalization_specify');
            if_true_disable('#shr_past_illness_operation', '#shr_past_illness_operation_specify');
            if_true_disable('#shr_past_illness_accident', '#shr_past_illness_accident_specify');
            if_true_disable('#shr_past_illness_disability', '#shr_past_illness_disability_specify');
        // allergy
        enable('#shr_allergy_food, #shr_allergy_food_specify, #shr_allergy_medicine, #shr_allergy_medicine_specify, #shr_allergy_others, #shr_allergy_others_specify');
            // dependent dropdowns
            if_true_disable('#shr_allergy_food', '#shr_allergy_food_specify');
            if_true_disable('#shr_allergy_medicine', '#shr_allergy_medicine_specify');
            if_true_disable('#shr_allergy_others', '#shr_allergy_others_specify');
        // immunization
        enable('#shr_immunization_bcg, #shr_immunization_mmr, #shr_immunization_hepa_a, #shr_immunization_typhoid, #shr_immunization_varicella, #shr_immunization_hepa_b, #shr_immunization_dpt, #shr_immunization_opv, #shr_immunization_hib');
            // dependent dropdowns
            if_true_disable('#shr_immunization_hepa_b', '#shr_immunization_hepa_b_doses');
            if_true_disable('#shr_immunization_dpt', '#shr_immunization_dpt_doses');
            if_true_disable('#shr_immunization_opv', '#shr_immunization_opv_doses');
            if_true_disable('#shr_immunization_hib', '#shr_immunization_hib_doses');
        // pubertal
        $('#shr_male_age_of_onset').removeAttr(($('#shr_gender').val()=='male') ? 'disabled' : '');
        $('#shr_female_menarche').removeAttr(($('#shr_gender').val()=='female') ? 'disabled' : '');
        $('#shr_female_lmp').removeAttr(($('#shr_gender').val()=='female') ? 'disabled' : '');
        $('#shr_female_dysmenorhea').removeAttr(($('#shr_gender').val()=='female') ? 'disabled' : '');
        $('#shr_female_dysmenorhea_medicine').removeAttr(($('#shr_gender').val()=='female' && $('#shr_female_dysmenorhea').val()=='1') ? 'disabled' : '' );
        // family history
        enable('#shr_family_history_diabetes, #shr_family_history_heart_disease, #shr_family_history_mental_illness, #shr_family_history_cancer, #shr_family_history_hypertension, #shr_family_history_kidney_disease, #shr_family_history_epilepsy, #shr_family_history_others, #shr_fathers_name, #shr_fathers_occupation, #shr_mothers_name, #shr_mothers_occupation, #shr_marital_status');
        // assesment diagnosis
        enable('#shr_weight, #shr_height, #shr_temperature, #shr_hr, #shr_bp, #shr_vision, #shr_hearing, #shr_blood_type, #shr_chest_xray_result, #shr_chest_xray_result_date');
        // physical examination
        enable('#shr_weight, #shr_height, #shr_temperature, #shr_hr, #shr_bp, #shr_vision, #shr_hearing, #shr_blood_type, #shr_chest_xray_result, #shr_chest_xray_result_date');
        enable('#shr_general_survey, #shr_general_survey_findings, #shr_skin, #shr_skin_findings, #shr_eye_ears_nose, #shr_eye_ears_nose_findings, #shr_teeth_gums, #shr_teeth_gums_findings, #shr_neck, #shr_neck_findings, #shr_heart, #shr_heart_findings, #shr_chest_lungs, #shr_chest_lungs_findings, #shr_abdomen, #shr_abdomen_findings, #shr_musculoskeletal, #shr_musculoskeletal_findings');
            // dependednt dropdowns
            if_true_disable('#shr_general_survey', '#shr_general_survey_findings');
            if_true_disable('#shr_skin', '#shr_skin_findings');
            if_true_disable('#shr_eye_ears_nose', '#shr_eye_ears_nose_findings');
            if_true_disable('#shr_teeth_gums', '#shr_teeth_gums_findings');
            if_true_disable('#shr_neck', '#shr_neck_findings');
            if_true_disable('#shr_heart', '#shr_heart_findings');
            if_true_disable('#shr_chest_lungs', '#shr_chest_lungs_findings');
            if_true_disable('#shr_abdomen', '#shr_abdomen_findings');
            if_true_disable('#shr_musculoskeletal', '#shr_musculoskeletal_findings');
        // assesment diagnosis
        enable('#shr_assessment_diagnosis_drinking, #shr_assessment_diagnosis_drinking_how_much, #shr_assessment_diagnosis_drinking_how_often, #shr_assessment_diagnosis_smoking, #shr_assessment_diagnosis_smoking_sticks_per_day, #shr_assessment_diagnosis_smoking_since_when, #shr_assessment_diagnosis_drug_use, #shr_assessment_diagnosis_drug_kind, #shr_assessment_diagnosis_regular_use, #shr_assessment_driving, #shr_assessment_driving_specify, #shr_assessment_driving_with_license, #shr_assessment_diagnosis_abuse, #shr_assessment_diagnosis_abuse_specify');
            // dependent dropdowns
            if_true_disable('#shr_assessment_diagnosis_drinking', '#shr_assessment_diagnosis_drinking_how_much, #shr_assessment_diagnosis_drinking_how_often');
            if_true_disable('#shr_assessment_diagnosis_smoking', '#shr_assessment_diagnosis_smoking_sticks_per_day, #shr_assessment_diagnosis_smoking_since_when');
            if_true_disable('#shr_assessment_diagnosis_drug_use', '#shr_assessment_diagnosis_drug_kind, #shr_assessment_diagnosis_regular_use');
            if_true_disable('#shr_assessment_driving', '#shr_assessment_driving_specify, #shr_assessment_driving_with_license');
            if_true_disable('#shr_assessment_diagnosis_abuse', '#shr_assessment_diagnosis_abuse_specify');
    }

    function disable_all_inputs(){
        // header
        disable('#shr_med, #shr_srcode, #shr_program');
        // personal details
        disable('#shr_profile_pic, #shr_reset_profile_pic, #shr_firstname, #shr_middlename, #shr_lastname, #shr_suffixname, #shr_home_address, #shr_dorm_address, #shr_gender, #shr_civil_status, #shr_religion, #shr_contact, #shr_date_of_birth, #shr_place_of_birth');
        // emergency contact
        disable('#shr_emergency_name, #shr_emergency_business_address, #shr_emergency_relation_to_patient, #shr_emergency_landline, #shr_emergency_contact');
        // past illness
        disable('#shr_past_illness_asthma, #shr_past_illness_asthma_last_attack, #shr_past_illness_heart_disease, #shr_past_illness_hypertension, #shr_past_illness_epilepsy, #shr_past_illness_diabetes, #shr_past_illness_thyroid_problem, #shr_past_illness_measles, #shr_past_illness_mumps, #shr_past_illness_varicella, #shr_past_illness_hospitalization, #shr_past_illness_hospitalization_specify, #shr_past_illness_operation, #shr_past_illness_operation_specify, #shr_past_illness_accident, #shr_past_illness_accident_specify, #shr_past_illness_disability, #shr_past_illness_disability_specify');
        // allergy
        disable('#shr_allergy_food, #shr_allergy_food_specify, #shr_allergy_medicine, #shr_allergy_medicine_specify, #shr_allergy_others, #shr_allergy_others_specify');
        // immunization
        disable('#shr_immunization_bcg, #shr_immunization_mmr, #shr_immunization_hepa_a, #shr_immunization_typhoid, #shr_immunization_varicella, #shr_immunization_hepa_b, #shr_immunization_hepa_b_doses, #shr_immunization_dpt, #shr_immunization_dpt_doses, #shr_immunization_opv, #shr_immunization_opv_doses, #shr_immunization_hib, #shr_immunization_hib_doses');
        // pubertal
        disable('#shr_male_age_of_onset, #shr_female_menarche, #shr_female_lmp, #shr_female_dysmenorhea, #shr_female_dysmenorhea_medicine');
        // family history
        disable('#shr_family_history_diabetes, #shr_family_history_heart_disease, #shr_family_history_mental_illness, #shr_family_history_cancer, #shr_family_history_hypertension, #shr_family_history_kidney_disease, #shr_family_history_epilepsy, #shr_family_history_others, #shr_fathers_name, #shr_fathers_occupation, #shr_mothers_name, #shr_mothers_occupation, #shr_marital_status');
        // physical examination
        disable('#shr_weight, #shr_height, #shr_temperature, #shr_hr, #shr_bp, #shr_vision, #shr_hearing, #shr_blood_type, #shr_chest_xray_result, #shr_chest_xray_result_date');
        disable('#shr_general_survey, #shr_general_survey_findings, #shr_skin, #shr_skin_findings, #shr_eye_ears_nose, #shr_eye_ears_nose_findings, #shr_teeth_gums, #shr_teeth_gums_findings, #shr_neck, #shr_neck_findings, #shr_heart, #shr_heart_findings, #shr_chest_lungs, #shr_chest_lungs_findings, #shr_abdomen, #shr_abdomen_findings, #shr_musculoskeletal, #shr_musculoskeletal_findings');
        // assesment diagnosis
        disable('#shr_assessment_diagnosis_drinking, #shr_assessment_diagnosis_drinking_how_much, #shr_assessment_diagnosis_drinking_how_often, #shr_assessment_diagnosis_smoking, #shr_assessment_diagnosis_smoking_sticks_per_day, #shr_assessment_diagnosis_smoking_since_when, #shr_assessment_diagnosis_drug_use, #shr_assessment_diagnosis_drug_kind, #shr_assessment_diagnosis_regular_use, #shr_assessment_driving, #shr_assessment_driving_specify, #shr_assessment_driving_with_license, #shr_assessment_diagnosis_abuse, #shr_assessment_diagnosis_abuse_specify');    
    }

    function insert_new_shr(){
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

        var patient_data = {
            "shr_med": "{{ date('Y-m-d') }}",
            "shr_srcode": "{{ $patient_details->sr_code }}",
            "shr_program": "{{ $patient_details->prog_id }}",
            "shr_profile_pic": "{{ $patient_details->profile_pic }}",
            "shr_firstname": "{{  $patient_details->firstname }}",
            "shr_middlename": "{{ $patient_details->middlename }}",
            "shr_lastname": "{{ $patient_details->lastname }}",
            "shr_suffixname": "{{ $patient_details->suffixname }}",
            "shr_home_address": "{{ ($patient_details->home_brgy_name.', '.$patient_details->home_mun_name.', '.$patient_details->home_prov_name) }}",
            "shr_dorm_address": "{{ (($patient_details->dorm_brgy_name) ? $patient_details->dorm_brgy_name.', '.$patient_details->dorm_mun_name.', '.$patient_details->dorm_prov_name : '') }}",
            "shr_gender": "{{ $patient_details->gender }}",
            "shr_age": "{{ $interval->y }}",
            "shr_civil_status": "{{ $patient_details->civil_status }}",
            "shr_religion": "{{ $patient_details->religion_name }}",
            "shr_contact": "{{ $patient_details->contact }}",
            "shr_date_of_birth": "{{ $patient_details->birthdate }}",
            "shr_place_of_birth": "{{ ($patient_details->birth_brgy_name.', '.$patient_details->birth_mun_name.', '.$patient_details->birth_prov_name) }}",
            "shr_emergency_name": "{{ $patient_details->ec_firstname.' '.$patient_details->ec_middlename.' '.$patient_details->ec_lastname.' '.$patient_details->ec_suffixname }}",
            "shr_emergency_business_address": "{{ ($patient_details->ec_brgy_name.', '.$patient_details->ec_mun_name.', '.$patient_details->ec_prov_name) }}",
            "shr_emergency_relation_to_patient": "{{ $patient_details->ec_relationtopatient }}",
            "shr_emergency_landline": "{{ $patient_details->ec_landline }}",
            "shr_emergency_contact": "{{ $patient_details->ec_contact }}",
            "shr_past_illness_asthma": "{{ ($patient_details->mhpi_asthma_last_attack) ? '1' : '0' }}",
            "shr_past_illness_asthma_last_attack": "{{ $patient_details->mhpi_asthma_last_attack }}",
            "shr_past_illness_heart_disease": "{{ $patient_details->mhpi_heart_disease }}",
            "shr_past_illness_hypertension": "{{ $patient_details->mhpi_hypertension }}",
            "shr_past_illness_epilepsy": "{{ $patient_details->mhpi_epilepsy }}",
            "shr_past_illness_diabetes": "{{ $patient_details->mhpi_diabetes }}",
            "shr_past_illness_thyroid_problem": "{{ $patient_details->mhpi_thyroid_problem }}",
            "shr_past_illness_measles": "{{ $patient_details->mhpi_measles }}",
            "shr_past_illness_mumps": "{{ $patient_details->mhpi_mumps }}",
            "shr_past_illness_varicella": "{{ $patient_details->mhpi_varicella }}",
            "shr_past_illness_hospitalization": "{{ ($patient_details->mhpi_hospitalization_specify) ? '1' : '0' }}",
            "shr_past_illness_hospitalization_specify": "{{ $patient_details->mhpi_hospitalization_specify }}",
            "shr_past_illness_operation": "{{ ($patient_details->mhpi_operation_specify) ? '1' : '0' }}",
            "shr_past_illness_operation_specify": "{{ $patient_details->mhpi_operation_specify }}",
            "shr_past_illness_accident": "{{ ($patient_details->mhpi_accident_specify) ? '1' : '0' }}",
            "shr_past_illness_accident_specify": "{{ $patient_details->mhpi_accident_specify }}",
            "shr_past_illness_disability": "{{ ($patient_details->mhpi_disability_specify) ? '1' : '0' }}",
            "shr_past_illness_disability_specify": "{{ $patient_details->disability }}",
            "shr_allergy_food": "{{ ($patient_details->mha_food_specify) ? '1' : '0' }}",
            "shr_allergy_food_specify": "{{ $patient_details->mha_food_specify }}",
            "shr_allergy_medicine": "{{ ($patient_details->mha_medicine_specify) ? '1' : '0' }}",
            "shr_allergy_medicine_specify": "{{ $patient_details->mha_medicine_specify }}",
            "shr_allergy_others": "{{ ($patient_details->mha_others_specify) ? '1' : '0' }}",
            "shr_allergy_others_specify": "{{ $patient_details->mha_others_specify }}",
            "shr_immunization_bcg": "{{ $patient_details->mhmi_bcg }}",
            "shr_immunization_mmr": "{{ $patient_details->mhmi_mmr }}",
            "shr_immunization_hepa_a": "{{ $patient_details->mhmi_hepa_a }}",
            "shr_immunization_typhoid": "{{ $patient_details->mhmi_typhoid }}",
            "shr_immunization_varicella": "{{ $patient_details->mhmi_varicella }}",
            "shr_immunization_hepa_b": "{{ ($patient_details->mhmi_hepa_b_doses) ? '1' : '0' }}",
            "shr_immunization_hepa_b_doses": "{{ $patient_details->mhmi_hepa_b_doses }}",
            "shr_immunization_dpt": "{{ ($patient_details->mhmi_dpt_doses) ? '1' : '0' }}",
            "shr_immunization_dpt_doses": "{{ $patient_details->mhmi_dpt_doses }}",
            "shr_immunization_opv": "{{ ($patient_details->mhmi_opv_doses) ? '1' : '0' }}",
            "shr_immunization_opv_doses": "{{ $patient_details->mhmi_opv_doses }}",
            "shr_immunization_hib": "{{ ($patient_details->mhmi_hib_doses) ? '1' : '0' }}",
            "shr_immunization_hib_doses": "{{ $patient_details->mhmi_hib_doses }}",
            "shr_male_age_of_onset": "{{  $patient_details->mhp_male_age_on_set }}",
            "shr_female_menarche": "{{ $patient_details->mhp_female_menarche }}",
            "shr_female_lmp": "{{ $patient_details->mhp_female_lmp }}",
            "shr_female_dysmenorhea": "{{ $patient_details->mhp_female_dysmenorhea }}",
            "shr_female_dysmenorhea_medicine": "{{ $patient_details->mhp_female_dysmenorhea_medicine }}",
            "shr_family_history_diabetes": "{{ $patient_details->fih_diabetes }}",
            "shr_family_history_heart_disease": "{{ $patient_details->fih_heart_disease }}",
            "shr_family_history_mental_illness": "{{ $patient_details->fih_mental }}",
            "shr_family_history_cancer": "{{ $patient_details->fih_cancer }}",
            "shr_family_history_hypertension": "{{ $patient_details->fih_hypertension }}",
            "shr_family_history_kidney_disease": "{{ $patient_details->fih_kidney_disease }}",
            "shr_family_history_epilepsy": "{{ $patient_details->fih_epilepsy }}",
            "shr_family_history_others": "{{ $patient_details->fih_others }}",
            "shr_fathers_name": "{{ $patient_details->fd_father_firstname.' '.$patient_details->fd_father_middlename.' '.$patient_details->fd_father_lastname.' '.$patient_details->fd_father_suffixname  }}",
            "shr_fathers_occupation": "{{ $patient_details->fd_father_occupation }}",
            "shr_mothers_name": "{{ $patient_details->fd_mother_firstname.' '.$patient_details->fd_mother_middlename.' '.$patient_details->fd_mother_lastname.' '.$patient_details->fd_mother_suffixname }}",
            "shr_mothers_occupation": "{{ $patient_details->fd_mother_occupation }}",
            "shr_marital_status": "{{ $patient_details->fd_marital_status }}",
            "shr_weight": "{{ ($patient_details->weight) ? $patient_details->weight : '0' }}",
            "shr_height": "{{ ($patient_details->height) ? $patient_details->height : '0' }}",
            "shr_bmi": "{{ $bmi }}",
            "shr_temperature": "",
            "shr_hr": "",
            "shr_bp": "",
            "shr_vision": "",
            "shr_hearing": "",
            "shr_blood_type": "{{ $patient_details->blood_type }}",
            "shr_chest_xray_result": "",
            "shr_chest_xray_result_date": "",
            "shr_general_survey": "0",
            "shr_general_survey_findings": "",
            "shr_skin": "0",
            "shr_skin_findings": "",
            "shr_eye_ears_nose": "0",
            "shr_eye_ears_nose_findings": "",
            "shr_teeth_gums": "0",
            "shr_teeth_gums_findings": "",
            "shr_neck": "0",
            "shr_neck_findings": "",
            "shr_heart": "0",
            "shr_heart_findings": "",
            "shr_chest_lungs": "0",
            "shr_chest_lungs_findings": "",
            "shr_abdomen": "0",
            "shr_abdomen_findings": "",
            "shr_musculoskeletal": "0",
            "shr_musculoskeletal_findings": "",
            "shr_assessment_diagnosis_drinking": "{{ ($patient_details->ad_drinking_how_much) ? '1' : '0' }}",
            "shr_assessment_diagnosis_drinking_how_much": "{{ $patient_details->ad_drinking_how_much }}",
            "shr_assessment_diagnosis_drinking_how_often": "{{ $patient_details->ad_drinking_how_often }}",
            "shr_assessment_diagnosis_smoking": "{{ ($patient_details->ad_smoking_sticks_per_day) ? '1' : '0' }}",
            "shr_assessment_diagnosis_smoking_sticks_per_day": "{{ $patient_details->ad_smoking_sticks_per_day }}",
            "shr_assessment_diagnosis_smoking_since_when": "{{ $patient_details->ad_smoking_since_when }}",
            "shr_assessment_diagnosis_drug_use": "{{ ($patient_details->ad_drug_kind) ? '1' : '0' }}",
            "shr_assessment_diagnosis_drug_kind": "{{ $patient_details->ad_drug_kind }}",
            "shr_assessment_diagnosis_regular_use": "{{ $patient_details->ad_drug_regular_use }}",
            "shr_assessment_driving": "{{ ($patient_details->ad_driving_specify) ? '1' : '0' }}",
            "shr_assessment_driving_specify": "{{  $patient_details->ad_driving_specify }}",
            "shr_assessment_driving_with_license": "{{ $patient_details->ad_driving_with_license }}",
            "shr_assessment_diagnosis_abuse": "{{ ($patient_details->ad_abuse_specify) ? '1' : '0' }}",
            "shr_assessment_diagnosis_abuse_specify": "{{ $patient_details->ad_abuse_specify }}"
        }
        $('#shr_save_btn').html('Add');
        set_shr_data(JSON.stringify(patient_data), "{{ route('AdminSHRInsert', ['id'=>$patient_details->acc_id]) }}");
    }

    function set_shr_data(data, href){
        data = JSON.parse(data);
        console.log(data);
        $('#shr_med').val(data.shr_med);
        $('#shr_srcode').val(data.shr_srcode);
        $("#shr_program").val(data.shr_program);
        $("#shr_pic").attr("src", "{{ asset('storage/profile_picture').'/' }}"+((data.shr_profile_pic) ? data.shr_profile_pic : data.profile_pic));
        $("#shr_firstname").val(data.shr_firstname);
        $("#shr_middlename").val(data.shr_middlename);
        $("#shr_lastname").val(data.shr_lastname);
        $("#shr_suffixname").val(data.shr_suffixname);
        $("#shr_home_address").val(data.shr_home_address);
        $("#shr_dorm_address").val(data.shr_dorm_address);
        $("#shr_gender").val(data.shr_gender);
        $("#shr_age").val(data.shr_age);
        $("#shr_civil_status").val(data.shr_civil_status);
        $("#shr_religion").val(data.shr_religion);
        $("#shr_contact").val(data.shr_contact);
        $("#shr_date_of_birth").val(data.shr_date_of_birth);
        $("#shr_place_of_birth").val(data.shr_place_of_birth);
        $("#shr_emergency_name").val(data.shr_emergency_name);
        $("#shr_emergency_business_address").val(data.shr_emergency_business_address);
        $("#shr_emergency_relation_to_patient").val(data.shr_emergency_relation_to_patient);
        $("#shr_emergency_landline").val(data.shr_emergency_landline);
        $("#shr_emergency_contact").val(data.shr_emergency_contact);
        $("#shr_past_illness_asthma").val((data.shr_past_illness_asthma_last_attack) ? '1' : '0');
        $("#shr_past_illness_asthma_last_attack").val(data.shr_past_illness_asthma_last_attack);
        $("#shr_past_illness_heart_disease").val(data.shr_past_illness_heart_disease);
        $("#shr_past_illness_hypertension").val(data.shr_past_illness_hypertension);
        $("#shr_past_illness_epilepsy").val(data.shr_past_illness_epilepsy);
        $("#shr_past_illness_diabetes").val(data.shr_past_illness_diabetes);
        $("#shr_past_illness_thyroid_problem").val(data.shr_past_illness_thyroid_problem);
        $("#shr_past_illness_measles").val(data.shr_past_illness_measles);
        $("#shr_past_illness_mumps").val(data.shr_past_illness_mumps);
        $("#shr_past_illness_varicella").val(data.shr_past_illness_varicella)
        $("#shr_past_illness_hospitalization").val((data.shr_past_illness_hospitalization_specify) ? '1' : '0');
        $("#shr_past_illness_hospitalization_specify").val(data.shr_past_illness_hospitalization_specify);
        $("#shr_past_illness_operation").val((data.shr_past_illness_operation_specify) ? '1' : '0');
        $("#shr_past_illness_operation_specify").val(data.shr_past_illness_operation_specify);
        $("#shr_past_illness_accident").val((data.shr_past_illness_accident_specify) ? '1' : '0');
        $("#shr_past_illness_accident_specify").val(data.shr_past_illness_accident_specify);
        $("#shr_past_illness_disability").val((data.shr_past_illness_disability_specify) ? '1' : '0');
        $("#shr_past_illness_disability_specify").val(data.shr_past_illness_disability_specify);
        $("#shr_allergy_food").val((data.shr_allergy_food_specify) ? '1' : '0');
        $("#shr_allergy_food_specify").val(data.shr_allergy_food_specify);
        $("#shr_allergy_medicine").val((data.shr_allergy_medicine_specify) ? '1' : '0');
        $("#shr_allergy_medicine_specify").val(data.shr_allergy_medicine_specify);
        $("#shr_allergy_others").val((data.shr_allergy_others_specify) ? '1' : '0');
        $("#shr_allergy_others_specify").val(data.shr_allergy_others_specify);
        $("#shr_immunization_bcg").val(data.shr_immunization_bcg);
        $("#shr_immunization_mmr").val(data.shr_immunization_mmr);
        $("#shr_immunization_hepa_a").val(data.shr_immunization_hepa_a);
        $("#shr_immunization_typhoid").val(data.shr_immunization_typhoid);
        $("#shr_immunization_varicella").val(data.shr_immunization_varicella);
        $("#shr_immunization_hepa_b").val((data.shr_immunization_hepa_b_doses) ? '1' : '0');
        $("#shr_immunization_hepa_b_doses").val(data.shr_immunization_hepa_b_doses);
        $("#shr_immunization_dpt").val((data.shr_immunization_dpt_doses) ? '1' : '0');
        $("#shr_immunization_dpt_doses").val(data.shr_immunization_dpt_doses);
        $("#shr_immunization_opv").val((data.shr_immunization_opv_doses) ? '1' : '0');
        $("#shr_immunization_opv_doses").val(data.shr_immunization_opv_doses);
        $("#shr_immunization_hib").val((data.shr_immunization_hib_doses) ? '1' : '0');
        $("#shr_immunization_hib_doses").val(data.shr_immunization_hib_doses);
        $("#shr_male_age_of_onset").val(data.shr_male_age_of_onset);
        $("#shr_female_menarche").val(data.shr_female_menarche);
        $("#shr_female_lmp").val(data.shr_female_lmp); 
        $("#shr_female_dysmenorhea").val(data.shr_female_dysmenorhea); 
        $("#shr_female_dysmenorhea_medicine").val(data.shr_female_dysmenorhea_medicine);
        $("#shr_family_history_diabetes").val(data.shr_family_history_diabetes);
        $("#shr_family_history_heart_disease").val(data.shr_family_history_heart_disease);
        $("#shr_family_history_mental_illness").val(data.shr_family_history_mental_illness);
        $("#shr_family_history_cancer").val(data.shr_family_history_cancer);
        $("#shr_family_history_hypertension").val(data.shr_family_history_hypertension);
        $("#shr_family_history_kidney_disease").val(data.shr_family_history_kidney_disease);
        $("#shr_family_history_epilepsy").val(data.shr_family_history_epilepsy);
        $("#shr_family_history_others").val(data.shr_family_history_others);        
        $("#shr_fathers_name").val(data.shr_fathers_name);
        $("#shr_fathers_occupation").val(data.shr_fathers_occupation);
        $("#shr_mothers_name").val(data.shr_mothers_name);
        $("#shr_mothers_occupation").val(data.shr_mothers_occupation);
        $("#shr_marital_status").val(data.shr_marital_status);
        $("#shr_weight").val(data.shr_weight);
        $("#shr_height").val(data.shr_height);
        $("#shr_bmi").val(data.shr_bmi);
        $("#shr_temperature").val(data.shr_temperature);
        $("#shr_hr").val(data.shr_hr);
        $("#shr_bp").val(data.shr_bp);
        $("#shr_vision").val(data.shr_vision);
        $("#shr_hearing").val(data.shr_hearing);
        $("#shr_blood_type").val(data.shr_blood_type);
        $("#shr_chest_xray_result").val(data.shr_chest_xray_result);
        $("#shr_chest_xray_result_date").val(data.shr_chest_xray_result_date);
        $("#shr_general_survey").val((data.shr_general_survey_findings) ? '1' : '0');
        $("#shr_general_survey_findings").val(data.shr_general_survey_findings);
        $("#shr_skin").val((data.shr_skin_findings) ? '1' : '0');
        $("#shr_skin_findings").val(data.shr_skin_findings);
        $("#shr_eye_ears_nose").val((data.shr_eye_ears_nose_findings) ? '1' : '0');
        $("#shr_eye_ears_nose_findings").val(data.shr_eye_ears_nose_findings);
        $("#shr_teeth_gums").val((data.shr_teeth_gums_findings) ? '1' : '0');
        $("#shr_teeth_gums_findings").val(data.shr_teeth_gums_findings);
        $("#shr_neck").val((data.shr_neck_findings) ? '1' : '0');
        $("#shr_neck_findings").val(data.shr_neck_findings);
        $("#shr_heart").val((data.shr_heart_findings) ? '1' : '0');
        $("#shr_heart_findings").val(data.shr_heart_findings);
        $("#shr_chest_lungs").val((data.shr_chest_lungs_findings) ? '1' : '0');
        $("#shr_chest_lungs_findings").val(data.shr_chest_lungs_findings);
        $("#shr_abdomen").val((data.shr_abdomen_findings) ? '1' : '0');
        $("#shr_abdomen_findings").val(data.shr_abdomen_findings);
        $("#shr_musculoskeletal").val((data.shr_musculoskeletal_findings) ? '1' : '0');
        $("#shr_musculoskeletal_findings").val(data.shr_musculoskeletal_findings);
        $("#shr_assessment_diagnosis_drinking").val((data.shr_assessment_diagnosis_drinking_how_much) ? '1' : '0');
        $("#shr_assessment_diagnosis_drinking_how_much").val(data.shr_assessment_diagnosis_drinking_how_much);
        $("#shr_assessment_diagnosis_drinking_how_often").val(data.shr_assessment_diagnosis_drinking_how_often);
        $("#shr_assessment_diagnosis_smoking").val((data.shr_assessment_diagnosis_smoking_since_when) ? '1' : '0');
        $("#shr_assessment_diagnosis_smoking_sticks_per_day").val(data.shr_assessment_diagnosis_smoking_since_when);
        $("#shr_assessment_diagnosis_smoking_since_when").val(data.shr_assessment_diagnosis_smoking_since_when);
        $("#shr_assessment_diagnosis_drug_use").val((data.shr_assessment_diagnosis_drug_kind) ? '1' : '0');
        $("#shr_assessment_diagnosis_drug_kind").val(data.shr_assessment_diagnosis_drug_kind);
        $("#shr_assessment_diagnosis_regular_use").val(data.shr_assessment_diagnosis_regular_use);
        $("#shr_assessment_driving").val((data.shr_assessment_driving_specify) ? '1' : '0');
        $("#shr_assessment_driving_specify").val(data.shr_assessment_driving_specify);
        $("#shr_assessment_driving_with_license").val(data.shr_assessment_driving_with_license);
        $("#shr_assessment_diagnosis_abuse").val((data.shr_assessment_diagnosis_abuse_specify) ? '1' : '0');
        $("#shr_assessment_diagnosis_abuse_specify").val(data.shr_assessment_diagnosis_abuse_specify);
        $("#shr_form").attr("action", href);
        $('#modal_form_shr').modal('show');
    }

    $('#shr_gender').change(function(){
        let gender = $(this).val();
        if(gender == 'male'){
            clear_disable('#shr_female_menarche');
            clear_disable('#shr_female_lmp');
            clear_disable('#shr_female_dysmenorhea');
            clear_disable('#shr_female_dysmenorhea_medicine');
            enable('#shr_male_age_of_onset');
            // set_input('#shr_male_age_of_onset', "{{ $patient_details->mhp_male_age_on_set }}")
        }
        else{
            enable('#shr_male_age_of_onset');
            enable('#shr_female_menarche');
            enable('#shr_female_lmp');
            enable('#shr_female_dysmenorhea');
            enable('#shr_female_dysmenorhea_medicine');
            clear_disable('#shr_male_age_of_onset');
            // set_input('#shr_female_menarche', "{{ $patient_details->mhp_female_menarche }}");
            // set_input('#shr_female_lmp', "{{ $patient_details->mhp_female_lmp }}");
            // set_input('#shr_female_dysmenorhea', "{{ $patient_details->mhp_female_dysmenorhea }}");
            // set_input('#shr_female_dysmenorhea', "{{ $patient_details->mhp_female_dysmenorhea_medicine }}");
        }
    });

    //profile picture
    $('#shr_profile_pic').change(function(){
        let file = $("input[type=file]").get(0).files[0];
        if(file){
            var reader = new FileReader();
            reader.onload = function(){
                $("#shr_pic").attr("src", reader.result);
            }
            reader.readAsDataURL(file);
        }
    });

    $('#shr_date_of_birth').change(function(){
        var startDay = new Date($('#shr_date_of_birth').val());
        var endDay = new Date("{{ date('Y-m-d') }}");
        const time = Math.abs(endDay - startDay);
        const year = Math.floor(time/ (1000*60*60*24*365));
        $('#shr_age').val(year);
    });

    $('#shr_reset_profile_pic').click(function(){
        $('#shr_pic').attr("src", "{{ ($patient_details->profile_pic) ? asset('storage/profile_picture/'.$patient_details->profile_pic) : asset('storage/default_avatar.png') }}");
        $('#shr_profile_pic').val('');
    });

    $('#shr_past_illness_asthma').change(function(){
        let asthma = $(this).val();
        if(asthma=='0'){
            clear_disable('#shr_past_illness_asthma_last_attack');
        }
        else{
            enable('#shr_past_illness_asthma_last_attack');
        }
    });

    $('#shr_past_illness_hospitalization').change(function(){
        let hospitalization = $(this).val();
        if(hospitalization=='0'){
            clear_disable('#shr_past_illness_hospitalization_specify');
        }
        else{
            enable('#shr_past_illness_hospitalization_specify');
        }
    });

    $('#shr_past_illness_operation').change(function(){
        let hospitalization = $(this).val();
        if(hospitalization=='0'){
            clear_disable('#shr_past_illness_operation_specify');
        }
        else{
            enable('#shr_past_illness_operation_specify');
        }
    });

    $('#shr_past_illness_accident').change(function(){
        let hospitalization = $(this).val();
        if(hospitalization=='0'){
            clear_disable('#shr_past_illness_accident_specify');
        }
        else{
            enable('#shr_past_illness_accident_specify');
        }
    });

    $('#shr_past_illness_disability').change(function(){
        let hospitalization = $(this).val();
        if(hospitalization=='0'){
            clear_disable('#shr_past_illness_disability_specify');
        }
        else{
            enable('#shr_past_illness_disability_specify');
        }
    });

    $('#shr_allergy_food').change(function(){
        let afood = $(this).val();
        if(afood=='0'){
            clear_disable('#shr_allergy_food_specify');
        }
        else{
            enable('#shr_allergy_food_specify');
        }
    });

    $('#shr_allergy_medicine').change(function(){
        let amedicine = $(this).val();
        if(amedicine=='0'){
            clear_disable('#shr_allergy_medicine_specify');
        }
        else{
            enable('#shr_allergy_medicine_specify');
        }
    });

    $('#shr_allergy_others').change(function(){
        let amedicine = $(this).val();
        if(amedicine=='0'){
            clear_disable('#shr_allergy_others_specify');
        }
        else{
            enable('#shr_allergy_others_specify');
        }
    });

    $('#shr_immunization_hepa_b').change(function(){
        let hepab = $(this).val();
        if(hepab=='0'){
            clear_disable('#shr_immunization_hepa_b_doses');
        }
        else{
            enable('#shr_immunization_hepa_b_doses');
        }
    });

    $('#shr_immunization_opv').change(function(){
        if($(this).val()=='0'){
            clear_disable('#shr_immunization_opv_doses');
        }
        else{
            enable('#shr_immunization_opv_doses');
        }
    });

    $('#shr_immunization_hib').change(function(){
        if($(this).val()=='0'){
            clear_disable('#shr_immunization_hib_doses');
        }
        else{
            enable('#shr_immunization_hib_doses');
        }
    });

    $('#shr_immunization_dpt').change(function(){
        if($(this).val()=='0'){
            clear_disable('#shr_immunization_dpt_doses');
        }
        else{
            enable('#shr_immunization_dpt_doses');
        }
    });

    $('#shr_general_survey').change(function(){
        if($(this).val()=='0'){
            clear_disable('#shr_general_survey_findings');
        }
        else{
            enable('#shr_general_survey_findings');
        }
    });

    $('#shr_skin').change(function(){
        if($(this).val()=='0'){
            clear_disable('#shr_skin_findings');
        }
        else{
            enable('#shr_skin_findings');
        }
    });

    $('#shr_eye_ears_nose').change(function(){
        if($(this).val()=='0'){
            clear_disable('#shr_eye_ears_nose_findings');
        }
        else{
            enable('#shr_eye_ears_nose_findings');
        }
    });

    $('#shr_teeth_gums').change(function(){
        if($(this).val()=='0'){
            clear_disable('#shr_teeth_gums_findings');
        }
        else{
            enable('#shr_teeth_gums_findings');
        }
    });

    $('#shr_neck').change(function(){
        if($(this).val()=='0'){
            clear_disable('#shr_neck_findings');
        }
        else{
            enable('#shr_neck_findings');
        }
    });

    $('#shr_heart').change(function(){
        if($(this).val()=='0'){
            clear_disable('#shr_heart_findings');
        }
        else{
            enable('#shr_heart_findings');
        }
    });

    $('#shr_chest_lungs').change(function(){
        if($(this).val()=='0'){
            clear_disable('#shr_chest_lungs_findings');
        }
        else{
            enable('#shr_chest_lungs_findings');
        }
    });

    $('#shr_abdomen').change(function(){
        if($(this).val()=='0'){
            clear_disable('#shr_abdomen_findings');
        }
        else{
            enable('#shr_abdomen_findings');
        }
    });

    $('#shr_musculoskeletal').change(function(){
        if($(this).val()=='0'){
            clear_disable('#shr_musculoskeletal_findings');
        }
        else{
            enable('#shr_musculoskeletal_findings');
        }
    });

    $('#shr_assessment_diagnosis_drinking').change(function(){
        if($(this).val()=='0'){
            clear_disable('#shr_assessment_diagnosis_drinking_how_much, #shr_assessment_diagnosis_drinking_how_often');
        }
        else{
            enable('#shr_assessment_diagnosis_drinking_how_much, #shr_assessment_diagnosis_drinking_how_often');
        }
    });

    $('#shr_assessment_diagnosis_smoking').change(function(){
        if($(this).val()=='0'){
            clear_disable('#shr_assessment_diagnosis_smoking_sticks_per_day, #shr_assessment_diagnosis_smoking_since_when');
        }
        else{
            enable('#shr_assessment_diagnosis_smoking_sticks_per_day, #shr_assessment_diagnosis_smoking_since_when');
        }
    });

    $('#shr_assessment_diagnosis_drug_use').change(function(){
        if($(this).val()=='0'){
            clear_disable('#shr_assessment_diagnosis_drug_kind, #shr_assessment_diagnosis_regular_use');
        }
        else{
            enable('#shr_assessment_diagnosis_drug_kind, #shr_assessment_diagnosis_regular_use');
        }
    });

    $('#shr_assessment_driving').change(function(){
        if($(this).val()=='0'){
            clear_disable('#shr_assessment_driving_specify, #shr_assessment_driving_with_license');
        }
        else{
            enable('#shr_assessment_driving_specify, #shr_assessment_driving_with_license');
        }
    });

    $('#shr_assessment_diagnosis_abuse').change(function(){
        if($(this).val()=='0'){
            clear_disable('#shr_assessment_diagnosis_abuse_specify');
        }
        else{
            enable('#shr_assessment_diagnosis_abuse_specify');
        }
    });

    $('#shr_weight, #shr_height').keyup(function(){
        let weight = $('#shr_weight').val();
        let height = $('#shr_height').val();
        let bmi = (weight / (height * height)).toFixed(2);
        $('#shr_bmi').val(bmi);
    });

    function shr_unlock(){
        $('#shr_unlock_lock').val('1');
        $('#shr_lbl_unlock').addClass('d-none');
        $('#shr_lbl_lock').removeClass('d-none');
        enable_all_inputs(); 
    }

    function shr_lock(){
        $('#shr_unlock_lock').val('0');
        $('#shr_lbl_lock').addClass('d-none');
        $('#shr_lbl_unlock').removeClass('d-none');
        disable_all_inputs();
    }

    $('#shr_unlock_lock').click(function(){
        let btn_action = $('#shr_unlock_lock').val();
        // lock
        if(btn_action=='1'){
            shr_lock();
        }
        // unlock
        else{
            shr_unlock();
        }     
    });

    $("#shr_save_btn").click(function(e) {      
        let shr_lock_unlock = $('#shr_unlock_lock').val();
        if(shr_lock_unlock == '0'){
            shr_unlock();
        }

        var formData = new FormData($('#shr_form')[0]);

        $.ajax({
            type: "POST",
            url: $('#shr_form').attr('action'),
            contentType: false,
            processData: false,
            data: formData,
            enctype: 'multipart/form-data',
            success: function(response){
                response = JSON.parse(response);
                console.log(response);
                swal(response.title, response.message, response.icon);
                $('.shr-error-message').html("");
                if(response.status == 400){
                    $.each(response.errors, function(key, err_values){
                        $('#'+key+'_error').html(err_values);
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
                // response = JSON.parse(response);
                console.log(response);
            }
        })
        
        if(shr_lock_unlock=='1'){
            shr_unlock();
        }
        else{
            shr_lock();
        }
    });

    function delete_shr(id, href){
        event.preventDefault();
        swal({
            title: "Are you sure?",
            text: "Your about to delete SHR form #"+id+"!",
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

    function retrieve_shr(id, href){
        $.ajax({
            type: "GET",
            url: href,
            success: function(response){
                response = JSON.parse(response);
                console.log(response);
                response = response.data;
                response = JSON.stringify(response);
                $('#shr_save_btn').html('Update');
                set_shr_data(response, ("{{ route('AdminSHRUpdate', ['id'=>'id']) }}").replace('id', id));
            },
            error: function(response){
                // response = JSON.parse(response);
                console.log(response);
            }
        })
    }
</script>