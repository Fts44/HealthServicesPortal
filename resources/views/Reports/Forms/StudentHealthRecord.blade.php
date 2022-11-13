<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $filename }}</title>
</head>
<body>
<style>
        * {
            font-size: 13px;
            font-family: 'Times', Verdana, Tahoma, "DejaVu Sans", sans-serif;
        }

        .c{
            text-align:center;
        }

        .r{
            text-align:right;
        }

        table, td, th {
            border: 1px solid black;
        }

        table tr th {
            text-align:center;
        }

        table{
            border-collapse: collapse;
            width: 100%;
        }

        .nb {
            border: none;
        }

        .ns {
            border-left: none;
            border-right: none;
        }

        .nbt{
            border-top: none;
        }

        .nbl{
            border-left: none;
        }

        .nbr{
            border-right: none;
        }

        .nbb{
            border-bottom: none;
        }

        .ws{
            border-left: 1px solid black;
            border-right: 1px solid black;
        }

        .wt{
            border-top: 1px solid black;
        }

        .wb{
            border-bottom: 1px solid black;
        }

        .tu{
            text-transform: uppercase;
        }

        td {
            height: 18px;
        }

        .u {
            text-decoration: underline;
        }

        input[type=checkbox]:before { font-family: DejaVu Sans; font-size: 20px; }
        input[type=checkbox] { display: inline; }
    </style>

    <table class="nb" cellpadding="2">
        <thead class="nb">
            <tr class="nb">
                @for($i=1; $i<=24; $i++)
                    <th class="nb"></th>
                @endfor
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="2" class="c">
                    <img src="storage/SystemFiles/logo.png" alt="logo" style="width: 50px;">
                </td>
                <td colspan="7">Something is here</td>
                <td colspan="7">Something is here</td>
                <td colspan="8">Something is here</td>
            </tr>
            <tr>
                <td colspan="11" class="nbr" style="height: 50px;">
                    Date of Medical Examination: {{ date_format(date_create($d->shr_med),'F d, Y') }}
                </td>
                <td colspan="4" class="nbl nbr c">
                    SR-Code: {{ $d->shr_srcode }}
                </td>
                <td colspan="9" class="nbl r">Program: {{ $d->prog_name }}</td>
            </tr> 
            <tr>
                <td colspan="18" style="">
                    A complete medical history and physical examination is compulsory to <br>
                    complete your admission to Batangas State University. Kindly provide <br>
                    the necessary information. This record will be treated with utmost confidentiality.
                </td>
                <td colspan="6" class="c">
                    <img src="storage/profile_picture/{{ $d->shr_profile_pic }}" alt="logo" style="width: 150px; height: 150px;">
                </td>
            </tr>
            <tr class="ws">
                <td colspan="8" class="nb">
                    <b>LAST NAME:</b><span class="tu"> {{ $d->shr_lastname." ".$d->shr_suffixname }}</span>
                </td>
                <td colspan="8" class="nb">
                    <b>MIDDLE NAME:</b><span class="tu"> {{ $d->shr_middlename }}</span>
                </td>
                <td colspan="8" class="nb">
                    <b>FIRST NAME:</b><span class="tu"> {{ $d->shr_firstname }}</span>
                </td>
            </tr>
            <tr class="ws">
                <td colspan="24" class="nb">
                    <b>HOME ADDRESS:</b><span class="tu"> {{ $d->shr_home_address }}</span>
                </td>
            </tr>
            <tr class="ws">
                <td colspan="24" class="nb">
                    <b>DORMITORY ADDRESS:</b><span class="tu"> {{ $d->shr_dorm_address }}</span>
                </td>
            </tr>
            <tr class="ws">
                <td colspan="4" class="nb"><b>GENDER:</b><span class="tu"> {{ $d->shr_gender }}</span></td>
                <td colspan="2" class="nb"><b>AGE:</b><span class="tu">{{ $d->shr_age }}</span></td>
                <td colspan="6" class="nb"><b>CIVIL STATUS:</b><span class="tu">{{ $d->shr_civil_status }}</span></td>
                <td colspan="7" class="nb"><b>RELIGION:</b><span class="tu">{{ $d->shr_religion }}</span></td>
                <td colspan="5" class="nb"><b>CONTACT:</b><span class="tu">{{ $d->shr_contact }}</span></td>
            </tr>
            <tr class="ws">
                <td colspan="12" class="nb">
                    <b>DATE OF BIRTH:</b><span class="tu"> {{ date_format(date_create($d->shr_date_of_birth),'F d, Y') }}</span>
                </td>
                <td colspan="12" class="nb">
                    <b>PLACE OF BIRTH:</b><span class="tu"> {{ $d->shr_place_of_birth }}</span>
                </td>
            </tr>
            <tr class="ws wt">
                <td colspan="24" class="nb">
                    <b>IN CASE OF EMERGENCY PLEASE CONTACT</b>
                </td>
            </tr>
            <tr class="ws">
                <td colspan="12" class="nb">
                    <b>NAME:</b><span class="tu"> {{ $d->shr_emergency_name }}</span>
                </td>
                <td colspan="12" class="nb">
                    <b>RELATION:</b><span class="tu"> {{ $d->shr_emergency_relation_to_patient }}</span>
                </td>
            </tr>
            <tr class="ws">
                <td colspan="24" class="nb">
                    <b>BUSINESS ADDRESS:</b><span class="tu"> {{ $d->shr_emergency_business_address }}</span>
                </td>
            </tr>
            <tr class="ws">
                <td colspan="12" class="nb">
                    <b>LANDLINE: </b><span class="tu">{{ $d->shr_emergency_landline }}</span>
                </td>
                <td colspan="12" class="nb">
                    <b>CONTACT: </b><span class="tu">{{ $d->shr_emergency_contact }}</span>
                </td>
            </tr>
            <tr class="ws wt">
                <td colspan="24" class="nb">
                    <b>PAST MEDICAL HISTORY</b>
                </td>
            </tr>
            <tr class="ws">
                <td colspan="2" class="nb">
                    Past illness
                </td>
                <td colspan="8" class="nb">
                    <input type="checkbox" {{ ($d->shr_past_illness_asthma_last_attack) ? 'checked' : '' }}> Asthma; Last Attack:<span class="u"> {{ date_format(date_create($d->shr_past_illness_asthma_last_attack),'M d, Y') }}</span>
                </td>
                <td colspan="3" class="nb">
                    <input type="checkbox" {{ ($d->shr_past_illness_measles) ? 'checked' : '' }}> Measles
                </td>
                <td colspan="11" class="nb">
                    <input type="checkbox" {{ ($d->shr_past_illness_hospitalization_specify) ? 'checked' : '' }}> Hospitalization:
                        @if($d->shr_past_illness_hospitalization_specify)
                            <span class="u"> {{ $d->shr_past_illness_hospitalization_specify }}</span>
                        @else
                            ________________________________
                        @endif
                </td>
            </tr>
            <tr class="ws">
                <td class="nb" colspan="2"></td>
                <td class="nb" colspan="8"><input type="checkbox" {{ ($d->shr_past_illness_heart_disease) ? 'checked' : '' }}> Heart Disease</td>
                <td class="nb" colspan="3"><input type="checkbox" {{ ($d->shr_past_illness_mumps) ? 'checked' : '' }}> Mumps</td>
                <td colspan="11" class="nb">
                    <input type="checkbox" {{ ($d->shr_past_illness_operation_specify) ? 'checked' : '' }}> Operation:
                        @if($d->shr_past_illness_operation_specify)
                            <span class="u"> {{ $d->shr_past_illness_operation_specify }}</span>
                        @else
                            ________________________________
                        @endif
                </td>
            </tr>
            <tr class="ws">
                <td class="nb" colspan="2"></td>
                <td class="nb" colspan="8"><input type="checkbox" {{ ($d->shr_past_illness_hypertension) ? 'checked' : '' }}> Hypertension</td>
                <td class="nb" colspan="3"><input type="checkbox" {{ ($d->shr_past_illness_varicella) ? 'checked' : '' }}> Varicella</td>
                <td colspan="11" class="nb">
                    <input type="checkbox" {{ ($d->shr_past_illness_accident_specify) ? 'checked' : '' }}> Accident:
                        @if($d->shr_past_illness_accident_specify)
                            <span class="u"> {{ $d->shr_past_illness_accident_specify }}</span>
                        @else
                            ________________________________
                        @endif
                </td>
            </tr>
            <tr class="ws">
                <td class="nb" colspan="2"></td>
                <td class="nb" colspan="8"><input type="checkbox" {{ ($d->shr_past_illness_epilepsy) ? 'checked' : '' }}> Epilepsy</td>
                <td class="nb" colspan="3"></td>
                <td colspan="11" class="nb">
                    <input type="checkbox" {{ ($d->shr_past_illness_disability_specify) ? 'checked' : '' }}> Disability:
                        @if($d->shr_past_illness_disability_specify)
                            <span class="u"> {{ $d->shr_past_illness_disability_specify }}</span>
                        @else
                            ________________________________
                        @endif
                </td>
            </tr>
            <tr class="ws">
                <td class="nb" colspan="2"></td>
                <td class="nb" colspan="8"><input type="checkbox" {{ ($d->shr_past_illness_diabetes) ? 'checked' : '' }}> Diabetes</td>
                <td class="nb" colspan="3"></td>
                <td colspan="11" class="nb"></td>
            </tr>
            <tr class="ws">
                <td class="nb" colspan="2"></td>
                <td class="nb" colspan="8"><input type="checkbox" {{ ($d->shr_past_illness_thyroid_problem) ? 'checked' : '' }}> Thyroid Problem</td>
                <td class="nb" colspan="3"></td>
                <td colspan="11" class="nb"></td>
            </tr>
            <tr class="ws">
                <td class="nb" colspan="2">Allergy:</td>
                <td class="nb" colspan="2">Food:</td>
                <td class="nb" colspan="2"><input type="checkbox" {{ (!$d->shr_allergy_food_specify) ? 'checked' : '' }}> No</td>
                <td class="nb" colspan="18"><input type="checkbox" {{ ($d->shr_allergy_food_specify) ? 'checked' : '' }}> Yes, Specify:
                    @if($d->shr_allergy_food_specify)
                        <span class="u"> {{ $d->shr_allergy_food_specify }}</span>
                    @else
                        ________________________________
                    @endif
                </td>
            </tr>
            <tr class="ws">
                <td class="nb" colspan="2"></td>
                <td class="nb" colspan="2">Medicine:</td>
                <td class="nb" colspan="2"><input type="checkbox" {{ (!$d->shr_allergy_medicine_specify) ? 'checked' : '' }}> No</td>
                <td class="nb" colspan="18"><input type="checkbox" {{ ($d->shr_allergy_medicine_specify) ? 'checked' : '' }}> Yes, Specify:
                    @if($d->shr_allergy_medicine_specify)
                        <span class="u"> {{ $d->shr_allergy_medicine_specify }}</span>
                    @else
                        ________________________________
                    @endif
                </td>
            </tr>
            <tr class="ws">
                <td class="nb" colspan="2"></td>
                <td class="nb" colspan="2">Others:</td>
                <td class="nb" colspan="2"><input type="checkbox" {{ (!$d->shr_allergy_others_specify) ? 'checked' : '' }}> No</td>
                <td class="nb" colspan="18"><input type="checkbox" {{ ($d->shr_allergy_others_specify) ? 'checked' : '' }}> Yes, Specify:
                    @if($d->shr_allergy_others_specify)
                        <span class="u"> {{ $d->shr_allergy_others_specify }}</span>
                    @else
                        ________________________________
                    @endif
                </td>
            </tr>
            <tr class="ws wt">
                <td class="nb" colspan="24">
                    Meidication Immunization:
                </td> 
            </tr>
            <tr class="ws">
                <td class="nb" colspan="2"></td>
                <td class="nb" colspan="2"><li>BCG</li></td>
                <td class="nb" colspan="2"><input type="checkbox" {{ ($d->shr_immunization_bcg) ? 'checked' : '' }}> Yes</td>
                <td class="nb" colspan="4"><input type="checkbox" {{ (!$d->shr_immunization_bcg) ? 'checked' : '' }}> No</td>
                <td class="nb" colspan="2"><li>Hepa B</li></td>
                <td class="nb" colspan="4"><input type="checkbox" {{ ($d->shr_immunization_hepa_b_doses) ? 'checked' : '' }}> Yes; <u>{{ ($d->shr_immunization_hepa_b_doses) ? '_'.$d->shr_immunization_hepa_b_doses.'_' : '___' }}</u> doses</td>
                <td class="nb" colspan="8"><input type="checkbox" {{ (!$d->shr_immunization_hepa_b_doses) ? 'checked' : '' }}> No</td>
            </tr>
            <tr class="ws">
                <td class="nb" colspan="2"></td>
                <td class="nb" colspan="2"><li>MMR</li></td>
                <td class="nb" colspan="2"><input type="checkbox" {{ ($d->shr_immunization_mmr) ? 'checked' : '' }}> Yes</td>
                <td class="nb" colspan="4"><input type="checkbox" {{ (!$d->shr_immunization_mmr) ? 'checked' : '' }}> No</td>
                <td class="nb" colspan="2"><li>DPT</li></td>
                <td class="nb" colspan="4"><input type="checkbox" {{ ($d->shr_immunization_dpt_doses) ? 'checked' : '' }}> Yes; <u>{{ ($d->shr_immunization_dpt_doses) ? '_'.$d->shr_immunization_dpt_doses.'_' : '___' }}</u> doses</td>
                <td class="nb" colspan="8"><input type="checkbox" {{ (!$d->shr_immunization_dpt_doses) ? 'checked' : '' }}> No</td>
            </tr>
            <tr class="ws">
                <td class="nb" colspan="2"></td>
                <td class="nb" colspan="2"><li>Hepa A</li></td>
                <td class="nb" colspan="2"><input type="checkbox" {{ ($d->shr_immunization_hepa_a) ? 'checked' : '' }}> Yes</td>
                <td class="nb" colspan="4"><input type="checkbox" {{ (!$d->shr_immunization_hepa_a) ? 'checked' : '' }}> No</td>
                <td class="nb" colspan="2"><li>OPV</li></td>
                <td class="nb" colspan="4"><input type="checkbox" {{ ($d->shr_immunization_opv_doses) ? 'checked' : '' }}> Yes; <u>{{ ($d->shr_immunization_opv_doses) ? '_'.$d->shr_immunization_opv_doses.'_' : '___' }}</u> doses</td>
                <td class="nb" colspan="8"><input type="checkbox" {{ (!$d->shr_immunization_opv_doses) ? 'checked' : '' }}> No</td>
            </tr>
            <tr class="ws">
                <td class="nb" colspan="2"></td>
                <td class="nb" colspan="2"><li>Thypoid</li></td>
                <td class="nb" colspan="2"><input type="checkbox" {{ ($d->shr_immunization_typhoid) ? 'checked' : '' }}> Yes</td>
                <td class="nb" colspan="4"><input type="checkbox" {{ (!$d->shr_immunization_typhoid) ? 'checked' : '' }}> No</td>
                <td class="nb" colspan="2"><li>HIB</li></td>
                <td class="nb" colspan="4"><input type="checkbox" {{ ($d->shr_immunization_hib_doses) ? 'checked' : '' }}> Yes; <u>{{ ($d->shr_immunization_hib_doses) ? '_'.$d->shr_immunization_hib_doses.'_' : '___' }}</u> doses</td>
                <td class="nb" colspan="8"><input type="checkbox" {{ (!$d->shr_immunization_hib_doses) ? 'checked' : '' }}> No</td>
            </tr>
            <tr class="ws">
                <td class="nb" colspan="2"></td>
                <td class="nb" colspan="2"><li>Varicella</li></td>
                <td class="nb" colspan="2"><input type="checkbox" {{ ($d->shr_immunization_varicella) ? 'checked' : '' }}> Yes</td>
                <td class="nb" colspan="4"><input type="checkbox" {{ (!$d->shr_immunization_varicella) ? 'checked' : '' }}> No</td>
                <td class="nb" colspan="14"></td>
            </tr>
            <tr class="ws wt">
                <td class="nb" colspan="24">
                    <b>PUBERTAL HISTORY</b>
                </td>
            </tr>
            <tr class="ws">
                <td class="nb" colspan="12">Male</td>
                <td class="nb" colspan="12">Female</td>
            </tr>
            <tr class="ws">
                <td class="nb" colspan="12">Age of Onset: <u>{{ '__'.$d->shr_male_age_of_onset.'__' }}</u></td>
                <td class="nb" colspan="6">Menarche: <u>{{ ($d->shr_female_menarche) ? '__'.$d->shr_female_menarche.'__' : '________________' }}</u></td>
                <td class="nb" colspan="6">LMP: <u>{{ ($d->shr_female_lmp) ? '__'.date_format(date_create($d->shr_female_lmp),'F d, Y').'__' : '________________' }}</u></td>
            </tr>
            <tr class="ws">
                <td class="nb" colspan="12"></td>
                <td class="nb" colspan="6">Dysmenorhea: <input type="checkbox"> No <input type="checkbox"> Yes; </td>
                <td class="nb" colspan="6">Medicine:  <u>{{ ($d->shr_female_dysmenorhea_medicine) ? '__'.$d->shr_female_dysmenorhea_medicine.'__' : '________________' }}</u></td>
            </tr>
            <tr class="ws wt">
                <td class="nb" colspan="24"> <b>FAMILY HISTORY</b></td>
            </tr>
            <tr class="ws">
                <td class="nb" colspan="5"><input type="checkbox" {{ ($d->shr_family_history_diabetes) ? 'checked' : '' }}> Diabetes</td>
                <td class="nb" colspan="5"><input type="checkbox" {{ ($d->shr_family_history_heart_disease) ? 'checked' : '' }}> Heart Disease</td>
                <td class="nb" colspan="5"><input type="checkbox" {{ ($d->shr_family_history_mental_illness) ? 'checked' : '' }}> Mental Illness</td>
                <td class="nb" colspan="9"><input type="checkbox" {{ ($d->shr_family_history_cancer) ? 'checked' : '' }}> Cancer</td>
            </tr>
            <tr class="ws">
                <td class="nb" colspan="5"><input type="checkbox" {{ ($d->shr_family_history_hypertension) ? 'checked' : '' }}> Hypertension</td>
                <td class="nb" colspan="5"><input type="checkbox" {{ ($d->shr_family_history_kidney_disease) ? 'checked' : '' }}> Kidney Disease</td>
                <td class="nb" colspan="5"><input type="checkbox" {{ ($d->shr_family_history_epilepsy) ? 'checked' : '' }}> Epilepsy</td>
                <td class="nb" colspan="9"><input type="checkbox" {{ ($d->shr_family_history_others) ? 'checked' : '' }}> Others</td>
            </tr>
            <tr class="ws">
                <td class="nb" colspan="6">Father: <u>{{ $d->shr_fathers_name }}</u></td>
                <td class="nb" colspan="6">Occupation: <u>{{ ($d->shr_fathers_occupation) ? $d->shr_fathers_occupation : _______________ }}</u></td>
                <td class="nb" colspan="6">Mother: <u>{{ $d->shr_mothers_name }}</u></td>
                <td class="nb" colspan="6">Occupation: <u>{{ ($d->shr_mothers_occupation) ? $d->shr_mothers_occupation : _______________ }}</u></td>
            </tr>
            <tr class="ws">
                <td class="nb" colspan="24">
                    Present Marital Status: <input type="checkbox" {{ ($d->shr_marital_status=="married") ? 'checked' : '' }}> Married <input type="checkbox" {{ ($d->shr_marital_status=="unmarried") ? 'checked' : '' }}> Unmarried  <input type="checkbox" {{ ($d->shr_marital_status=="separated") ? 'checked' : '' }}> Separated
                </td>
            </tr>
            <tr class="ws wt">
                <td class="nb" colspan="24">
                    Temperature: <u>{{ "__".($d->shr_temperature)."__" }}</u> HR: <u>{{ "__".($d->shr_hr)."__" }}</u> BP: <u>{{ "__".($d->shr_bp)."__" }}</u> Vision: <u>{{ "__".($d->shr_vision)."__" }}</u> Hearing: <u>{{ "__".($d->shr_hearing)."__" }}</u>
                </td>
            </tr>
            <tr class="ws">
                <td class="nb" colspan="24">
                    Chest X-ray Result: <u>{{ "__".($d->shr_chest_xray_result)."__" }}</u> Date: <u>{{ "__".date_format(date_create($d->shr_chest_xray_result_date),'F d, Y')."__" }}</u> 
                </td>
            </tr>
            <tr class="ws">
                <td class="nb" colspan="24">
                    Blood Type: <u class="tu">{{ "__".($d->shr_blood_type)."__" }}</u>
                </td>
            </tr>
            <tr class="ws">
                <td class="nb" colspan="24">
                </td>
            </tr>
            <tr class="ws">
                <td class="nb" colspan="24">Please check if normal. Describe only the abnormal findings in the space below.</td>
            </tr>
            <tr class="ws">
                <td class="nb" colspan="24"><input type="checkbox" {{ (!$d->shr_general_survey_findings) ? 'checked' : '' }}> General Survey; <u>{{ $d->shr_general_survey_findings }}</u></td>
            </tr>
            <tr class="ws">
                <td class="nb" colspan="24"><input type="checkbox" {{ (!$d->shr_skin_findings) ? 'checked' : '' }}> Skin; <u>{{ $d->shr_skin_findings }}</u></td>
            </tr>
            <tr class="ws">
                <td class="nb" colspan="24"><input type="checkbox" {{ (!$d->shr_eye_ears_nose_findings) ? 'checked' : '' }}> Eyes/ Ears/ Nose; <u>{{ $d->shr_eye_ears_nose_findings }}</u></td>
            </tr>
            <tr class="ws">
                <td class="nb" colspan="24"><input type="checkbox" {{ (!$d->shr_teeth_gums_findings) ? 'checked' : '' }}> Teeth/ Gums; <u>{{ $d->shr_teeth_gums_findings }}</u></td>
            </tr>
            <tr class="ws">
                <td class="nb" colspan="24"><input type="checkbox" {{ (!$d->shr_neck_findings) ? 'checked' : '' }}> Neck; <u>{{ $d->shr_neck_findings }}</u></td>
            </tr>
            <tr class="ws">
                <td class="nb" colspan="24"><input type="checkbox" {{ (!$d->shr_heart_findings) ? 'checked' : '' }}> Heart; <u>{{ $d->shr_heart_findings }}</u></td>
            </tr>
            <tr class="ws">
                <td class="nb" colspan="24"><input type="checkbox" {{ (!$d->shr_chest_lungs_findings) ? 'checked' : '' }}> Chest/ Lungs; <u>{{ $d->shr_chest_lungs_findings }}</u></td>
            </tr>
            <tr class="ws">
                <td class="nb" colspan="24"><input type="checkbox" {{ (!$d->shr_abdomen_findings) ? 'checked' : '' }}> Abdomen; <u>{{ $d->shr_abdomen_findings }}</u></td>
            </tr>
            <tr class="ws">
                <td class="nb" colspan="24"><input type="checkbox" {{ (!$d->shr_musculoskeletal_findings) ? 'checked' : '' }}> Musculoskeletal; <u>{{ $d->shr_musculoskeletal_findings }}</u></td>
            </tr>
            <tr class="ws">
                <td class="nb" colspan="24"></td>
            </tr>
            <tr class="ws">
                <td class="nb" colspan="24">
                    <b>ASSESMENT DIAGNOSIS</b>
                </td>
            </tr>
            <tr class="ws">
                <td class="nb" colspan="6"></td>
                <td class="nb" colspan="2">NO</td>
                <td class="nb" colspan="2">YES</td>
                <td class="nb" colspan="14">IF YES</td>
            </tr>
            <tr class="ws">
                <td class="nb" colspan="6">
                    1. Drinking 
                </td>
                <td class="nb" colspan="2">
                    <input type="checkbox" {{ (!$d->shr_assessment_diagnosis_drinking_how_much) ? 'checked' : '' }}> 
                </td>
                <td class="nb" colspan="2">
                    <input type="checkbox" {{ ($d->shr_assessment_diagnosis_drinking_how_much) ? 'checked' : '' }}>
                </td>
                <td class="nb" colspan="14">
                    How much? <u>{{ ($d->shr_assessment_diagnosis_drinking_how_much) ? $d->shr_assessment_diagnosis_drinking_how_much.' bottle(s) ' : '______________' }}</u>
                    How often? <u>{{ ($d->shr_assessment_diagnosis_drinking_how_often) ? $d->shr_assessment_diagnosis_drinking_how_often : '_________' }}</u>
                </td>
            </tr>
            <tr class="ws">
                <td class="nb" colspan="6">
                    2. Smoking 
                </td>
                <td class="nb" colspan="2">
                    <input type="checkbox" {{ (!$d->shr_assessment_diagnosis_smoking_sticks_per_day) ? 'checked' : '' }}>
                </td>
                <td class="nb" colspan="2">
                    <input type="checkbox" {{ ($d->shr_assessment_diagnosis_smoking_sticks_per_day) ? 'checked' : '' }}>
                </td>
                <td class="nb" colspan="14">
                    Number of sticks per day? <u>{{ ($d->shr_assessment_diagnosis_smoking_sticks_per_day) ? ($d->shr_assessment_diagnosis_smoking_sticks_per_day.' bottle(s)') : '_________' }}</u>
                    Since when? <u>{{ ($d->shr_assessment_diagnosis_smoking_since_when) ? ($d->shr_assessment_diagnosis_smoking_since_when.' years old') : '_________' }}</u>
                </td>
            </tr>
            <tr class="ws">
                <td class="nb" colspan="6">
                    3. Drug Use 
                </td>
                <td class="nb" colspan="2">
                    <input type="checkbox" {{ (!$d->shr_assessment_diagnosis_drug_kind) ? 'checked' : '' }}>
                </td>
                <td class="nb" colspan="2">
                    <input type="checkbox" {{ ($d->shr_assessment_diagnosis_drug_kind) ? 'checked' : '' }}>
                </td>
                <td class="nb" colspan="14">
                    Kind: <u class="tu">{{ ($d->shr_assessment_diagnosis_drug_kind) ? $d->shr_assessment_diagnosis_drug_kind : '_________' }}</u>
                    Regular use? YES <input type="checkbox" {{ ($d->shr_assessment_diagnosis_regular_use) ? 'checked' : '' }}> NO <input type="checkbox" {{ (!$d->shr_assessment_diagnosis_regular_use) ? 'checked' : '' }}> 
                </td>
            </tr>
            <tr class="ws">
                <td class="nb" colspan="6">
                    4. Driving 
                </td>
                <td class="nb" colspan="2">
                    <input type="checkbox" {{ (!$d->shr_assessment_driving_specify) ? 'checked' : '' }}>
                </td>
                <td class="nb" colspan="2">
                    <input type="checkbox" {{ ($d->shr_assessment_driving_specify) ? 'checked' : '' }}>
                </td>
                <td class="nb" colspan="14">
                    Specify Vehicle: <u class="tu">{{ ($d->shr_assessment_driving_specify) ? $d->shr_assessment_driving_specify : '_________' }}</u>
                    With License? YES <input type="checkbox" {{ ($d->shr_assessment_driving_with_license) ? 'checked' : '' }}> NO <input type="checkbox" {{ (!$d->shr_assessment_driving_with_license) ? 'checked' : '' }}> 
                </td>
            </tr>
            <tr class="ws wb">
                <td class="nb" colspan="6">
                    5. Abuse (Physical, Sexual, Verbal) 
                </td>
                <td class="nb" colspan="2">
                    <input type="checkbox" {{ (!$d->shr_assessment_diagnosis_abuse_specify) ? 'checked' : '' }}>
                </td>
                <td class="nb" colspan="2">
                    <input type="checkbox" {{ ($d->shr_assessment_diagnosis_abuse_specify) ? 'checked' : '' }}>
                </td>
                <td class="nb" colspan="14">
                    Specify Vehicle: <u class="tu">{{ ($d->shr_assessment_diagnosis_abuse_specify) ? $d->shr_assessment_diagnosis_abuse_specify : '_________' }}</u>
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>