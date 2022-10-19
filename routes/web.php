<?php

use Illuminate\Support\Facades\Route;

Route::get('/noaccess', function(){
    return view('Errors.NoAccess');
})->name('NoAccess');


// ================= Start Authentication ===================
    use App\Http\Controllers\Authentication\LoginController as Login;
    use App\Http\Controllers\Authentication\RegisterController as Register;
    use App\Http\Controllers\Authentication\RecoverController as Recover;
    use App\Http\Controllers\OTPController as OTP;

    Route::get('/logout', [Login::class, 'logout'])->name('Logout');
    Route::post('/otp', [OTP::class, 'compose_mail'])->name('SendOTP');

    Route::group(['middleware' => 'IsLoggedIn'],function(){

        Route::prefix('/')->group(function(){
            Route::get('', [Login::class, 'index'])->name('LoginIndex');
            Route::post('login', [Login::class, 'login'])->name('Login');
        });

        Route::prefix('/register')->group(function(){
            Route::get('', [Register::class, 'index'])->name('RegisterIndex');
            Route::post('register', [Register::class, 'register'])->name('Register');
        });

        Route::prefix('/recover')->group(function(){
            Route::get('', [Recover::class, 'index'])->name('RecoverIndex');
            Route::post('recover', [Recover::class, 'recover'])->name('Recover');
        });
    });
// ================= End Authentication ======================

// ================= Start Populate Select =====================
    use App\Http\Controllers\PopulateSelectController as PopulateSelect;

    Route::prefix('populate')->group(function(){
        // start address
            Route::get('province',[PopulateSelect::class, 'province'])->name('GetProvince');
            Route::get('municipality/{prov_code}', [PopulateSelect::class, 'municipality'])->name('GetMunicipality');
            Route::get('barangay/{mun_code}', [PopulateSelect::class, 'barangay'])->name('GetBarangay');
        // end address

        Route::get('gradelevel', [PopulateSelect::class, 'grade_level'])->name('GetGradeLevel');
        Route::get('department/{gl_id}',[PopulateSelect::class, 'department'])->name('GetDepartment');
        Route::get('program/{dept_id}',[PopulateSelect::class, 'program'])->name('GetProgram');
        
        Route::get('religion', [PopulateSelect::class, 'religion'])->name('GetReligion');
        Route::get('covidvaccinationbrand', [PopulateSelect::class, 'covid_vaccination_brand'])->name('GetCovidVaccinationBrand');
    });
// ================= End Populate Select =====================

// ================= Start Patient =============================
    use App\Http\Controllers\Patient\Profile\PersonalDetailsController as PatientProfilePersonalDetails;
    use App\Http\Controllers\Patient\Profile\EmergencyContactController as PatientEmergencyContact;
    use App\Http\Controllers\Patient\Profile\MedicalHistoryController as PatientMedicalHistory;
    use App\Http\Controllers\Patient\Profile\FamilyDetailsController as PatientFamilyDetails;
    use App\Http\Controllers\Patient\Profile\AssessmentDiagnosisController as PatientAssessmentDiagnosis;
    use App\Http\Controllers\Patient\VaccinationInsuranceController as PatientVaccinationInsurance;
    use App\Http\Controllers\Patient\PasswordController as PatientPassword; 

    Route::group(['prefix' => 'patient', 'middleware' =>[ 'IsPatient', 'Inactivity']],function(){

        Route::prefix('personaldetails')->group(function(){
            Route::get('/', [PatientProfilePersonalDetails::class, 'index'])->name('patient');
            Route::put('/update', [PatientProfilePersonalDetails::class, 'update_information'])->name('PatientPersonalDetailsUpdate');
            Route::put('/update/profilepic', [PatientProfilePersonalDetails::class, 'update_pic'])->name('PatientPersonalPicUpdate');
        });

        Route::prefix('emergencycontact')->group(function(){
            Route::get('/', [PatientEmergencyContact::class, 'index'])->name('PatientEmergencyContact');        
            Route::put('/update', [PatientEmergencyContact::class, 'update_emergency_contact'])->name('PatientEmergencyContactUpdate');
        });

        Route::prefix('medicalhistory')->group(function(){
            Route::get('/', [PatientMedicalHistory::class, 'index'])->name('PatientMedicalHistory');
            Route::put('/update', [PatientMedicalHistory::class, 'update_medical_history'])->name('PatientMedicalHistoryUpdate');
        });
        
        Route::prefix('familydetails')->group(function(){
            Route::get('/', [PatientFamilyDetails::class, 'index'])->name('PatientFamilyDetails');
            Route::put('/update', [PatientFamilyDetails::class, 'update_family_details'])->name('PatientFamilyDetailsUpdate');
        });

        Route::prefix('assessmentdiagnosis')->group(function(){
            Route::get('/', [PatientAssessmentDiagnosis::class, 'index'])->name('PatientAssessmentDiagnosis');
            Route::put('/update', [PatientAssessmentDiagnosis::class, 'update_assessment_diagnosis'])->name('PatientAssessmentDiagnosisUpdate');
        });

        Route::prefix('covidvaccinationinsurance')->group(function(){
            Route::get('/', [PatientVaccinationInsurance::class, 'index'])->name('PatientVaccinationInsurance');
            Route::put('/insurance/update', [PatientVaccinationInsurance::class, 'update_vaxstatus_insurance'])->name('PatientInsuranceUpdate');
            
            Route::put('/dosage/insert', [PatientVaccinationInsurance::class, 'insert_vax_dose'])->name('PatientDosageInsert');
            Route::put('/dosage/update/{id}', [PatientVaccinationInsurance::class, 'update_vax_dose'])->name('PatientDosageUpdate');
            Route::delete('/dosage/delete/{id}', [PatientVaccinationInsurance::class, 'delete_vax_dose'])->name('PatientDosageDelete');
            
            Route::put('/file/insert', [PatientVaccinationInsurance::class, 'insert_insurance'])->name('PatientFileInsert');
            Route::delete('/file/delete/{id}', [PatientVaccinationInsurance::class, 'delete_insurance'])->name('PatientFileDelete');
        }); 

        Route::prefix('password')->group(function(){
            Route::get('/', [PatientPassword::class, 'index'])->name('PatientPassword');
            Route::put('/', [PatientPassword::class, 'update_password'])->name('PatientPasswordUpdate');
        });
    });
// ================= End Patient =============================