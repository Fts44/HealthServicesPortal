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
    });
// ================= End Populate Select =====================

// ================= Start Patient =============================
    use App\Http\Controllers\Patient\Profile\PersonalDetailsController as PatientProfilePersonalDetails;
    use App\Http\Controllers\Patient\Profile\EmergencyContactController as PatientEmergencyContact;
    use App\Http\Controllers\Patient\Profile\MedicalHistoryController as PatientMedicalHistory;
    use App\Http\Controllers\Patient\Profile\FamilyDetailsController as PatientFamilyDetails;
    use App\Http\Controllers\Patient\Profile\AssessmentDiagnosisController as PatientAssessmentDiagnosis;
    
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
    });
// ================= End Patient =============================