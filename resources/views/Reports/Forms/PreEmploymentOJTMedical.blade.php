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

        .chck { 
            font-family: DejaVu Sans, sans-serif;
        }

        input[type=checkbox]:before { font-family: DejaVu Sans; font-size: 20px; }
        input[type=checkbox] { display: inline; }
    </style>

    <table class="nb" cellpadding="2">
        <thead class="nb">
            <tr class="nb">
                @for($i=1; $i<=25; $i++)
                    <th class="nb" style="width: 4%"></th>
                @endfor
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="2" class="c">
                    <img src="storage/SystemFiles/logo.png" alt="logo" style="width: 50px;">
                </td>
                <td colspan="7">BatStateU-ARASOF</td>
                <td colspan="8">BatStateU-ARASOF</td>
                <td colspan="8">BatStateU-ARASOF</td>
            </tr>
            <tr>
                <td colspan="2" class="c nbr">
                    <b>Title:</b>
                </td>
                <td colspan="23" class="c nbl">
                    <input type="checkbox"
                        @if($d->peof_type==1)
                            checked
                        @endif 
                    >&nbsp;<b>PRE-EMPLOYMENT/ OJT MEDICAL EXAMINATION FORM</b>&nbsp;
                    <input type="checkbox"
                        @if($d->peof_type==0)
                            checked
                        @endif  
                    >
                </td>
            </tr>
            <tr>
                <td colspan="25" class="r">
                    Control No: <u>{{ $d->peof_id }}</u> &nbsp;
                </td>
            </tr>
            <tr>
                <td colspan="4">LAST NAME</td><td colspan="12">{{ $d->peof_lastname }}</td>
                <td colspan="4">DATE</td><td colspan="5">{{ date_format(date_create($d->peof_date), 'F d, Y') }}</td>
            </tr>
            <tr>
                <td colspan="4">FIRST NAME</td><td colspan="12">{{ $d->peof_firstname }}</td>
                <td colspan="4">BIRTHDAY</td><td colspan="5">{{ date_format(date_create($d->peof_birthdate), 'F d, Y') }}</td>
            </tr>
            <tr>
                <td colspan="4">MIDDLE NAME</td><td colspan="12">{{ $d->peof_middlename }}</td>
                <td colspan="4">AGE</td><td colspan="5">{{ $d->peof_age }}</td>
            </tr>
            <tr>
                <td colspan="4">SEX</td><td colspan="12">{{ ucwords($d->peof_sex) }}</td>
                <td colspan="4">CIVIL STATUS</td><td colspan="5">{{ ucwords($d->peof_civil_status) }}</td>
            </tr>
            <tr>
                <td colspan="4">CELLPHONE NO</td><td colspan="12">{{ $d->peof_contact }}</td>
                <td colspan="4">TEL NO</td><td colspan="5">{{ $d->peof_tel_no }}</td>
            </tr>
            <tr>
                <td colspan="4">ADDRESS</td><td colspan="12">{{ $d->peof_address }}</td>
                <td colspan="4">POSTION/ CAMPUS</td><td colspan="5">{{ $d->peof_position_campus }}</td>
            </tr>
            <tr>
                <td colspan="6">
                    PAST MEDICAL HISTORY
                </td>
                <td colspan="19">
                    <div style="min-height: 50px; padding: 2px;">
                        {{ $d->peof_medical_history }}
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    FAMILY HISTORY
                </td>
                <td colspan="19">
                    <div style="min-height: 50px; padding: 2px;">
                        {{ $d->peof_family_history }}
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    OCCUPATIONAL HISTORY
                </td>
                <td colspan="19">
                    <div style="min-height: 50px; padding: 2px;">
                        {{ $d->peof_occupational_history }}
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="6" class="c">PHYSICAL EXAMINATION</td>
                <td colspan="4" class="c">NORMAL</td>
                <td colspan="5" class="c">FINDINGS</td>
                <td colspan="10" class="c">DIAGNOSTIC EXAMINATION</td>
            </tr>
            <tr>
                <td colspan="6">General Appearance/ Body Built (BMI)</td>
                <td colspan="4" class="c">
                    <b class="chck">
                        @if(!$d->peof_bmi_findings) 
                            ✔
                        @else 
                            &nbsp;&nbsp;
                        @endif
                    </b>
                </td>
                <td colspan="5">{{ $d->peof_bmi_findings }}</td>
                <td colspan="10" class="nbb">BLOOD PRESSURE: {{ $d->peof_bp }}</td>
            </tr>
            <tr>
                <td colspan="6">Skin (Tatto)</td>
                <td colspan="4" class="c">
                    <b class="chck">
                        @if(!$d->peof_skin_findings) 
                            ✔
                        @else 
                            &nbsp;&nbsp;
                        @endif
                    </b>
                </td>
                <td colspan="5">{{ $d->peof_skin_findings }}</td>
                <td colspan="10" class="nbb nbt">HEART RATE: <u>{{ $d->peof_hr }}</u></td>
            </tr>
            <tr>
                <td colspan="6">Head and Scalp</td>
                <td colspan="4" class="c">
                    <b class="chck">
                        @if(!$d->peof_head_and_scalp_findings) 
                            ✔
                        @else 
                            &nbsp;&nbsp;
                        @endif
                    </b>
                </td>
                <td colspan="5">{{ $d->peof_head_and_scalp_findings }}</td>
                <td colspan="10" class="nbb nbt">HEARING: 
                    (<b class="chck">
                        @if($d->peof_hearing) 
                            ✔
                        @else 
                            &nbsp;&nbsp;
                        @endif
                    </b>) Normal 
                    &nbsp;&nbsp; 
                    (<b class="chck">
                        @if(!$d->peof_hearing) 
                            ✔
                        @else 
                            &nbsp;&nbsp;
                        @endif
                    </b>) Defective</td>
            </tr>
            <tr>
                <td colspan="6">Eyes (External)</td>
                <td colspan="4" class="c">
                    <b class="chck">
                        @if(!$d->peof_eyes_findings) 
                            ✔
                        @else 
                            &nbsp;&nbsp;
                        @endif
                    </b>
                </td>
                <td colspan="5">{{ $d->peof_eyes_findings }}</td>
                <td colspan="10" class="nbb nbt">VISION: 
                    (<b class="chck">
                        @if($d->peof_vision) 
                            ✔
                        @else 
                            &nbsp;&nbsp;
                        @endif
                    </b>) With glasses 
                    &nbsp;&nbsp; 
                    R <u>{{ $d->peof_vision_l }}</u></td>
            </tr>
            <tr>
                <td colspan="6">Ears (Piercing)</td>
                <td colspan="4" class="c">
                    <b class="chck">
                        @if(!$d->peof_ears_findings) 
                            ✔
                        @else 
                            &nbsp;&nbsp;
                        @endif
                    </b>
                </td>
                <td colspan="5">{{ $d->peof_ears_findings }}</td>
                <td colspan="10" class="nbb nbt">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    (<b class="chck">
                        @if(!$d->peof_vision) 
                            ✔
                        @else 
                            &nbsp;&nbsp;
                        @endif
                    </b>) Without glasses &nbsp;&nbsp; L <u>{{ $d->peof_vision_l }}</u></td>
            </tr>
            <tr>
                <td colspan="6">Nose and Throat</td>
                <td colspan="4" class="c">
                    <b class="chck">
                        @if(!$d->peof_nose_and_throat_findings) 
                            ✔
                        @else 
                            &nbsp;&nbsp;
                        @endif
                    </b>
                </td>
                <td colspan="5">{{ $d->peof_nose_and_throat_findings }}</td>
                <td colspan="10" class="nbb nbt">CHEST X-RAY: 
                    (<b class="chck">
                        @if($d->peof_chest_xray_findings=='pa') 
                            ✔
                        @else 
                            &nbsp;&nbsp;
                        @endif
                    </b>) PA 
                    &nbsp;&nbsp; 
                    (<b class="chck">
                        @if($d->peof_chest_xray_findings=='lordotic') 
                            ✔
                        @else 
                            &nbsp;&nbsp;
                        @endif
                    </b>) Lordotic 
                </td>
            </tr>
            <tr>
                <td colspan="6">Mouth</td>
                <td colspan="4" class="c">
                    <b class="chck">
                        @if(!$d->peof_mouth_findings) 
                            ✔
                        @else 
                            &nbsp;&nbsp;
                        @endif
                    </b>
                </td>
                <td colspan="5">{{ $d->peof_mouth_findings }}</td>
                <td colspan="10" class="nbb nbt">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    (<b class="chck">
                        @if($d->peof_chest_xray=='0') 
                            ✔
                        @else 
                            &nbsp;&nbsp;
                        @endif
                    </b>) Normal &nbsp;&nbsp; Findings <u>{{ $d->peof_chest_xray_findings }}</u></td>
            </tr>
            <tr>
                <td colspan="6">Neck, Thyroid, LN</td>
                <td colspan="4" class="c">
                    <b class="chck">
                        @if(!$d->peof_neck_thyroid_ln_findings) 
                            ✔
                        @else 
                            &nbsp;&nbsp;
                        @endif
                    </b>
                </td>
                <td colspan="5">{{ $d->peof_neck_thyroid_ln_findings }}</td>
                <td colspan="10" class="nbb nbt">COMPLETE BLOOD COUNT:</td>
            </tr>
            <tr>
                <td colspan="6">Chest, Breast, Axilla</td>
                <td colspan="4" class="c">
                    <b class="chck">
                        @if(!$d->peof_chest_breast_axilla_findings) 
                            ✔
                        @else 
                            &nbsp;&nbsp;
                        @endif
                    </b>
                </td>
                <td colspan="5">
                    {{ $d->peof_chest_breast_axilla_findings }}
                </td>
                <td colspan="10" class="nbb nbt">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    (<b class="chck">
                        @if(!$d->peof_cbc_findings) 
                            ✔
                        @else 
                            &nbsp;&nbsp;
                        @endif
                    </b>) Normal &nbsp;&nbsp; Findings <u>{{ $d->peof_cbc_findings }}</u></td>
                </td>
            </tr>
            <tr>
                <td colspan="6">Heart</td>
                <td colspan="4" class="c">
                    <b class="chck">
                        @if(!$d->peof_heart_findings) 
                            ✔
                        @else 
                            &nbsp;&nbsp;
                        @endif
                    </b>
                </td>
                <td colspan="5">{{ $d->peof_heart_findings }}</td>
                <td colspan="10" class="nbb nbt">ROUTINE URINALYSIS:</td>
            </tr>
            <tr>
                <td colspan="6">Lungs</td>
                <td colspan="4" class="c">
                    <b class="chck">
                        @if(!$d->peof_lungs_findings) 
                            ✔
                        @else 
                            &nbsp;&nbsp;
                        @endif
                    </b>
                </td>
                <td colspan="5">{{ $d->peof_lungs_findings }}</td>
                <td colspan="10" class="nbb nbt">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    (<b class="chck">
                        @if(!$d->peof_routine_urinalysis_findings) 
                            ✔
                        @else 
                            &nbsp;&nbsp;
                        @endif
                    </b>) Normal 
                    &nbsp;&nbsp; Findings <u>{{ $d->peof_routine_urinalysis_findings }}</u></td>
                </td>
            </tr>
            <tr>
                <td colspan="6">Abdomen</td>
                <td colspan="4" class="c">
                    <b class="chck">
                        @if(!$d->peof_abdomen_findings) 
                            ✔
                        @else 
                            &nbsp;&nbsp;
                        @endif
                    </b>
                </td>
                <td colspan="5">
                    {{ $d->peof_abdomen_findings }}
                </td>
                <td colspan="10" class="nbb nbt">STOOL EXAMINATION:</td>
            </tr>
            <tr>
                <td colspan="6">Anus, Rectum</td>
                <td colspan="4" class="c">
                    <b class="chck">
                        @if(!$d->peof_anus_rectum_findings) 
                            ✔
                        @else 
                            &nbsp;&nbsp;
                        @endif
                    </b>
                </td>
                <td colspan="5">{{ $d->peof_anus_rectum_findings }}</td>
                <td colspan="10" class="nbb nbt">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    (<b class="chck">
                        @if(!$d->peof_stool_examination_findings) 
                            ✔
                        @else 
                            &nbsp;&nbsp;
                        @endif
                    </b>) Normal 
                    &nbsp;&nbsp; Findings <u>{{ $d->peof_stool_examination_findings }}</u></td>
                </td>
            </tr>
            <tr>
                <td colspan="6">Genital</td>
                <td colspan="4" class="c">
                    <b class="chck">
                        @if(!$d->peof_genital_findings) 
                            ✔
                        @else 
                            &nbsp;&nbsp;
                        @endif
                    </b>
                </td>
                <td colspan="5">
                    {{ $d->peof_genital_findings }}
                </td>
                <td colspan="10" class="nbb nbt">HEPA B SCREENING:</td>
            </tr>
            <tr>
                <td colspan="6">Musculo-Skeletal</td>
                <td colspan="4" class="c">
                    <b class="chck">
                        @if(!$d->peof_musculoskeletal_findings) 
                            ✔
                        @else 
                            &nbsp;&nbsp;
                        @endif
                    </b>
                </td>
                <td colspan="5">
                    {{ $d->peof_musculoskeletal_findings }}
                </td>
                <td colspan="10" class="nbb nbt">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    (<b class="chck">
                        @if(!$d->peof_hepa_b_screening_findings) 
                            ✔
                        @else 
                            &nbsp;&nbsp;
                        @endif
                    </b>) Normal 
                    &nbsp;&nbsp; Findings <u>{{ $d->peof_hepa_b_screening_findings }}</u></td>
                </td>
            </tr>
            <tr>
                <td colspan="6">Extremities</td>
                <td colspan="4" class="c">
                    <b class="chck">
                        @if(!$d->peof_extremities_findings) 
                            ✔
                        @else 
                            &nbsp;&nbsp;
                        @endif
                    </b>
                </td>
                <td colspan="5">
                    @if($d->peof_extremities_findings) 
                        {{ $d->peof_extremities_findings }}
                    @endif
                </td>
                <td colspan="10" class="nbb nbt">DRUG TEST:</td>
            </tr>
            <tr>
                <td colspan="6"></td>
                <td colspan="4"></td>
                <td colspan="5"></td>
                <td colspan="10" class="nbb nbt">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Metamphetamine <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                    (<b class="chck">
                        @if(!$d->peof_drug_test_metamphetamine) 
                            ✔
                        @else 
                            &nbsp;&nbsp;
                        @endif
                    </b>) Negative 
                    &nbsp;&nbsp;
                    (<b class="chck">
                        @if($d->peof_drug_test_metamphetamine) 
                            ✔
                        @else 
                            &nbsp;&nbsp;
                        @endif
                    </b>) Positive 
                    <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tetrahydrocannabinol <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                    (<b class="chck">
                        @if(!$d->peof_drug_test_tetrahydrocannabinol) 
                            ✔
                        @else 
                            &nbsp;&nbsp;
                        @endif
                    </b>) Negative 
                    &nbsp;&nbsp; 
                    (<b class="chck">
                        @if($d->peof_drug_test_tetrahydrocannabinol) 
                            ✔
                        @else 
                            &nbsp;&nbsp;
                        @endif
                    </b>) Positive
                </td>
            </tr>
            <tr>
                <td colspan="25" class="c">CERTIFICATION</td>
            </tr>
            <tr>
                <td colspan="12" class="nbb">
                    School/Company/Institution: {{ ucwords($d->peof_school_company_institution) }}
                </td>
                <td colspan="13" class="nbb">
                    I certify that I have examined and found the applicant to be physically fit/ unfit for employment.
                </td>
            </tr>
            <tr>
                <td colspan="12" class="nbb nbt">
                    Name: {{ ucwords($d->peof_firstname.' '.(($d->peof_middlename) ? $d->peof_middlename[0].'.' : '' ).' '.$d->peof_lastname) }}
                </td>
                <td colspan="13" class="nbb nbt">
                    CLASSIFICATION
                </td>
            </tr>
            <tr>
                <td colspan="5">
                    <img src="{{ 'storage/profile_picture/'.$d->peof_pic }}" alt="logo" style="width: 140px; height: 140px;">
                </td>
                <td colspan="7" class="nbt">
                    Weights (kgs): {{ $d->peof_weight }}<br><br>
                    Height (cm): {{ $d->peof_height }}<br><br>
                    Civil Status: {{ ucwords($d->peof_civil_status) }}<br><br>
                    Date of Examination: {{ date_format(date_create($d->peof_date),'M d, Y') }}
                </td>
                <td colspan="13" class="nbb nbt">
                    (<b class="chck">✔</b>) CLASS A. Physically fit to work. <br><br>
                    (&nbsp;&nbsp;) CLASS B. Physically underdeveloped or with correctible defects but otherwise fit to work. <br><br>
                    (&nbsp;&nbsp;) CLASS C. Employable but owing to certain impairments or conditions, requires special placement or limited duty in a specified or selected assignment requiring follow up treatment/ periodic examination.
                </td>
            </tr>
            <tr>
                <td colspan="12">
                    <div style="text-align: justify; padding-left: 10px; padding-right: 10px; padding-top: 10px;">
                        &emsp; I hereby authorize BATANGAS STATE UNIVERSITY and its officially designated medical examiner and examining physician/s to furnish information that the company may need pertaining to my health status and other pertinent medical findings and do hereby release them from any and all legal responsibilities by so doing. I also further certify that the medical history contained herein is true to the best of my knowledge and any false statement will disqualify me from any employment benefits and claims.
                    </div>
                    <div style="text-align: center; margin-top: 90px; margin-bottom: 10px;">
                        
                        <u>{{ strtoupper($d->peof_firstname.' '.(($d->peof_middlename) ? $d->peof_middlename[0].'.' : '' ).' '.$d->peof_lastname) }}</u> <br>
                        Employee's Student Singature 
                    </div>
                </td>
                <td colspan="13">
                    <div style="margin-left: 20px;">
                        Needs treatment of correction of: <br><br>
                        (&nbsp;&nbsp;) Skin Disease <br>
                        (&nbsp;&nbsp;) Dental Defects <br>
                        (&nbsp;&nbsp;) Anemia <br>
                        (&nbsp;&nbsp;) Poor vision <br>
                        (&nbsp;&nbsp;) Mild Urinary Tract Infection <br>
                        (&nbsp;&nbsp;) Intestinal Parasitism <br>
                        (&nbsp;&nbsp;) Mild Hypertension <br>
                    </div>
                    <br>
                    (&nbsp;&nbsp;) CLASS D. Unfit or unsafe for any type of employment
                    <div style="text-align: center; margin-top: 10px; margin-bottom: 10px;">
                    <img src="{{ 'storage/signature/'.$d->signature }}" alt="physician_signature" style="height: 80px; margin-bottom: -2rem;"> <br> 
                        <u> {{ strtoupper($d->ttl_title.'. '.$d->firstname.' '.(($d->middlename) ? $d->middlename[0].'. ' : '').$d->lastname )}} </u> <br>
                        Physician's Signature
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="25">
                    <i style="padding: 5px;">
                        Note: This certificate does not cover conditions or disease that will require procedure nad examination for their detection and also those which are asymptomatic at the time of examination. Valid only for three (3) months from date of examination.
                    </i>
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>