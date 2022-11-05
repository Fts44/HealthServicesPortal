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
    use App\Http\Controllers\Patient\PasswordController as PatientPassword; 

    use App\Http\Controllers\Patient\Documents\UploadsController as PatientDocumnetsUploads;

    use App\Http\Controllers\Patient\Profile\PersonalDetailsController as PatientProfilePersonalDetails;
    use App\Http\Controllers\Patient\Profile\EmergencyContactController as PatientEmergencyContact;
    use App\Http\Controllers\Patient\Profile\MedicalHistoryController as PatientMedicalHistory;
    use App\Http\Controllers\Patient\Profile\FamilyDetailsController as PatientFamilyDetails;
    use App\Http\Controllers\Patient\Profile\AssessmentDiagnosisController as PatientAssessmentDiagnosis;
    use App\Http\Controllers\Patient\VaccinationInsuranceController as PatientVaccinationInsurance;
    

    Route::group(['prefix' => 'patient', 'middleware' =>[ 'Inactivity', 'IsPatient']],function(){

        Route::prefix('password')->group(function(){
            Route::get('/', [PatientPassword::class, 'index'])->name('PatientPassword');
            Route::put('/', [PatientPassword::class, 'update_password'])->name('PatientPasswordUpdate');
        });

        Route::prefix('documents')->group(function(){
            Route::prefix('uploads')->group(function(){
                Route::get('/', [PatientDocumnetsUploads::class, 'index'])->name('PatientDocumentsUploads');
                Route::put('/', [PatientDocumnetsUploads::class, 'upload'])->name('PatientDocumnetsUploadsInsert');
                Route::delete('/delete/{id}', [PatientDocumnetsUploads::class, 'delete_upload'])->name('PatientDocumnetsUploadsDelete');
            });
        });

        Route::prefix('profile')->group(function(){

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

        Route::prefix('covidvaccinationinsurance')->group(function(){
            Route::get('/', [PatientVaccinationInsurance::class, 'index'])->name('PatientVaccinationInsurance');
            Route::put('/insurance/update', [PatientVaccinationInsurance::class, 'update_vaxstatus_insurance'])->name('PatientInsuranceUpdate');
            
            Route::put('/dosage/insert', [PatientVaccinationInsurance::class, 'insert_vax_dose'])->name('PatientDosageInsert');
            Route::put('/dosage/update/{id}', [PatientVaccinationInsurance::class, 'update_vax_dose'])->name('PatientDosageUpdate');
            Route::delete('/dosage/delete/{id}', [PatientVaccinationInsurance::class, 'delete_vax_dose'])->name('PatientDosageDelete');
            
            Route::put('/file/insert', [PatientVaccinationInsurance::class, 'insert_insurance'])->name('PatientFileInsert');
            Route::delete('/file/delete/{id}', [PatientVaccinationInsurance::class, 'delete_insurance'])->name('PatientFileDelete');
        }); 
    });
// ================= End Patient =============================

// ================= Start Admin =============================
    use App\Http\Controllers\Admin\AnnouncementController as AdminAnnouncementController;
    // accounts
    use App\Http\Controllers\Admin\Accounts\RequestsController as AdminAccountsRequests;
    use App\Http\Controllers\Admin\Accounts\PatientsController as AdminAccountsPatients;

    // inventory
    use App\Http\Controllers\Admin\Inventory\Equipment\ItemController as AdminInventoryEquipmentItem;
    use App\Http\Controllers\Admin\Inventory\Equipment\AllController as AdminInventoryEquipmentAll;
    use App\Http\Controllers\Admin\Inventory\Equipment\ReportController as AdminInventoryEquipmentReport;
    
    // configuration
    use App\Http\Controllers\Admin\Configuration\Inventory\Equipment\ItemController as AdminConfigurationInventoryEquipmentItem;
    use App\Http\Controllers\Admin\Configuration\Inventory\Equipment\NameController as AdminConfigurationInventoryEquipmentName;
    use App\Http\Controllers\Admin\Configuration\Inventory\Equipment\BrandController as AdminConfigurationInventoryEquipmentBrand;
    use App\Http\Controllers\Admin\Configuration\Inventory\Equipment\TypeController as AdminConfigurationInventoryEquipmentType;
    use App\Http\Controllers\Admin\Configuration\Inventory\Equipment\PlaceController as AdminConfigurationInventoryEquipmentPlace;
    
    use App\Http\Controllers\Forms\StudentHealthRecordController as AdminSHRC;

    Route::group(['prefix' => 'admin', 'middleware' =>[ 'Inactivity', 'IsAdmin']], function(){
       
        Route::prefix('/announcement')->group(function(){
            Route::get('/', [AdminAnnouncementController::class, 'index'])->name('AdminAnnouncement');
        });

        Route::prefix('/accounts')->group(function(){
           
            Route::prefix('requests')->group(function(){
                Route::get('/', [AdminAccountsRequests::class, 'index'])->name('admin');
                Route::put('/verify/{id}', [AdminAccountsRequests::class, 'verify_acc'])->name('AdminAccountsRequestsVerify');
                Route::delete('/delete/{id}', [AdminAccountsRequests::class, 'delete_acc'])->name('AdminAccountsRequestsDelete');
            });

            Route::prefix('patients')->group(function(){
                Route::get('/', [AdminAccountsPatients::class, 'index'])->name('AdminAccountsPatients');
                Route::get('/view/{id}', [AdminAccountsPatients::class, 'view_patient_details'])->name('AdminAccountsPatientsView');
            });

        });

        Route::prefix('/inventory')->group(function(){
            
            Route::prefix('equipment')->group(function(){
                Route::get('/', [AdminInventoryEquipmentItem::class, 'index'])->name('AdminInventoryEquipmentItem');
                Route::put('/insert', [AdminInventoryEquipmentItem::class, 'insert'])->name('AdminInventoryEquipmentItemInsert');
                Route::put('/update/{id}', [AdminInventoryEquipmentItem::class, 'update'])->name('AdminInventoryEquipmentItemUpdate');
                Route::delete('/delete/{id}', [AdminInventoryEquipmentItem::class, 'delete'])->name('AdminInventoryEquipmentItemDelete');
                Route::get('/all', [AdminInventoryEquipmentAll::class, 'index'])->name('AdminInventoryEquipmentAll');
                
                Route::get('/report/{year}', [AdminInventoryEquipmentReport::class, 'index'])->name('AdminInventoryEquipmentReport');
                Route::get('/report/print/{year}', [AdminInventoryEquipmentReport::class, 'print'])->name('AdminInventoryEquipmentReportPrint');
            });
        });
      
        Route::prefix('/configuration')->group(function(){

            Route::prefix('equipments')->group(function(){
                
                Route::prefix('item')->group(function(){
                    Route::get('/', [AdminConfigurationInventoryEquipmentItem::class, 'index'])->name('AdminConfigurationInventoryEquipmentItem');
                    Route::put('/insert', [AdminConfigurationInventoryEquipmentItem::class, 'insert'])->name('AdminConfigurationInventoryEquipmentItemInsert');
                    Route::put('/update/{id}', [AdminConfigurationInventoryEquipmentItem::class, 'update'])->name('AdminConfigurationInventoryEquipmentItemUpdate');
                    Route::delete('/delete/{id}', [AdminConfigurationInventoryEquipmentItem::class, 'delete'])->name('AdminConfigurationInventoryEquipmentItemDelete');
                });

                Route::prefix('name')->group(function(){
                    Route::get('/', [AdminConfigurationInventoryEquipmentName::class, 'index'])->name('AdminConfigurationInventoryEquipmentName');
                    Route::put('/insert', [AdminConfigurationInventoryEquipmentName::class, 'insert'])->name('AdminConfigurationInventoryEquipmentNameInsert');
                    Route::put('/update/{id}', [AdminConfigurationInventoryEquipmentName::class, 'update'])->name('AdminConfigurationInventoryEquipmentNameUpdate');
                    Route::delete('/delete/{id}', [AdminConfigurationInventoryEquipmentName::class, 'delete'])->name('AdminConfigurationInventoryEquipmentNameDelete');
                });

                Route::prefix('brand')->group(function(){
                    Route::get('/', [AdminConfigurationInventoryEquipmentBrand::class, 'index'])->name('AdminConfigurationInventoryEquipmentBrand');
                    Route::put('/insert', [AdminConfigurationInventoryEquipmentBrand::class, 'insert'])->name('AdminConfigurationInventoryEquipmentBrandInsert');
                    Route::put('/update/{id}', [AdminConfigurationInventoryEquipmentBrand::class, 'update'])->name('AdminConfigurationInventoryEquipmentBrandUpdate');
                    Route::delete('/delete/{id}', [AdminConfigurationInventoryEquipmentBrand::class, 'delete'])->name('AdminConfigurationInventoryEquipmentBrandDelete');
                });

                Route::prefix('type')->group(function(){
                    Route::get('/', [AdminConfigurationInventoryEquipmentType::class, 'index'])->name('AdminConfigurationInventoryEquipmentType');
                    Route::put('/insert', [AdminConfigurationInventoryEquipmentType::class, 'insert'])->name('AdminConfigurationInventoryEquipmentTypeInsert');
                    Route::put('/update/{id}', [AdminConfigurationInventoryEquipmentType::class, 'update'])->name('AdminConfigurationInventoryEquipmentTypeUpdate');
                    Route::delete('/delete/{id}', [AdminConfigurationInventoryEquipmentType::class, 'delete'])->name('AdminConfigurationInventoryEquipmentTypeDelete');
                });

                Route::prefix('place')->group(function(){
                    Route::get('/', [AdminConfigurationInventoryEquipmentPlace::class, 'index'])->name('AdminConfigurationInventoryEquipmentPlace');
                    Route::put('/insert', [AdminConfigurationInventoryEquipmentPlace::class, 'insert'])->name('AdminConfigurationInventoryEquipmentPlaceInsert');
                    Route::put('/update/{id}', [AdminConfigurationInventoryEquipmentPlace::class, 'update'])->name('AdminConfigurationInventoryEquipmentPlaceUpdate');
                    Route::delete('/delete/{id}', [AdminConfigurationInventoryEquipmentPlace::class, 'delete'])->name('AdminConfigurationInventoryEquipmentPlaceDelete');
                });

            });
        });

        Route::prefix('/forms')->group(function(){
            Route::prefix('studenthealthrecord')->group(function(){
                Route::post('insert/{id}', [AdminSHRC::class, 'insert'])->name('AdminSHRInsert');
                Route::get('print/SHR/{id}', [AdminSHRC::class, 'print'])->name('AdminSHRPrint');
            });
        });
    });
// ================= End Admin ===============================

use App\Http\Controllers\TestPDF;
Route::get('TestPDF', [TestPDF::class, 'index']);
Route::post('TestPDF', [TestPDF::class, 'testing'])->name('test');