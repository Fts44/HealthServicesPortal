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
    
        Route::get('medicine/{imgn_id}', [PopulateSelect::class, 'medicine'])->name('GetMedicine');
        Route::get('medicine/qty/{imi_id}', [PopulateSelect::class, 'medicine_qty'])->name('GetMedicineQty');
    });
// ================= End Populate Select =====================

// ================= Start Patient =============================
    use App\Http\Controllers\Patient\PasswordController as PatientPassword; 

    use App\Http\Controllers\Patient\Documents\UploadsController as PatientDocumnetsUploads;
    use App\Http\Controllers\Patient\Documents\PrescriptionController as PatitentDocumentsPrescription;

    use App\Http\Controllers\Patient\Profile\PersonalDetailsController as PatientProfilePersonalDetails;
    use App\Http\Controllers\Patient\Profile\EmergencyContactController as PatientEmergencyContact;
    use App\Http\Controllers\Patient\Profile\MedicalHistoryController as PatientMedicalHistory;
    use App\Http\Controllers\Patient\Profile\FamilyDetailsController as PatientFamilyDetails;
    use App\Http\Controllers\Patient\Profile\AssessmentDiagnosisController as PatientAssessmentDiagnosis;
    use App\Http\Controllers\Patient\Profile\PasswordController as PatientPasswordController;
    use App\Http\Controllers\Patient\VaccinationInsuranceController as PatientVaccinationInsurance;
    
    use App\Http\Controllers\Patient\AttendanceController as PatientAttendance;

    use App\Http\Controllers\Patient\AnnouncementController as PatientAnnouncement;
    Route::group(['prefix' => 'patient', 'middleware' =>[ 'Inactivity', 'IsPatient']],function(){

        Route::get('announcement', [PatientAnnouncement::class, 'index'])->name('PatientAnnouncement');
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

            Route::prefix('prescription')->group(function(){
                Route::get('/', [PatitentDocumentsPrescription::class, 'index'])->name('PatientDocumentPrescription');
                Route::get('/print/{id}', [PatitentDocumentsPrescription::class, 'print'])->name('PatientDocumentPrescriptionPrint');
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

            Route::prefix('password')->group(function(){
                Route::get('', [PatientPasswordController::class, 'index'])->name('PatientPassword');
                Route::put('', [PatientPasswordController::class, 'update_password'])->name('UpdatePatientPassword');
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

        Route::prefix('attendance')->group(function(){
            Route::get('/', [PatientAttendance::class, 'index'])->name('PatientAttendance');
            Route::post('timein', [PatientAttendance::class, 'time_in'])->name('PatientAttendanceTimeIn');
            Route::post('timeout/{id}', [PatientAttendance::class, 'time_out'])->name('PatientAttendanceTimeOut');
        });
    });
// ================= End Patient =============================

// ================= Start Admin =============================
    // dashboard
    use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
    // announcement
    use App\Http\Controllers\Admin\AnnouncementController as AdminAnnouncement;
    
    // transaction
    use App\Http\Controllers\Admin\Transaction\TransactionController as AdminTransaction;
    use App\Http\Controllers\Admin\Transaction\AttendanceCodeController as AdminAttendanceCode;

    // accounts
    use App\Http\Controllers\Admin\Accounts\RequestsController as AdminAccountsRequests;
    use App\Http\Controllers\Admin\Accounts\PatientsController as AdminAccountsPatients;
    use App\Http\Controllers\Admin\Accounts\EmployeeController as AdminAccountsEmployee;
    // inventory
    use App\Http\Controllers\Admin\Inventory\Equipment\ItemController as AdminInventoryEquipmentItem;
    use App\Http\Controllers\Admin\Inventory\Equipment\AllController as AdminInventoryEquipmentAll;
    use App\Http\Controllers\Admin\Inventory\Equipment\ReportController as AdminInventoryEquipmentReport;
    
    use App\Http\Controllers\Admin\Inventory\Medicine\ItemController as AdminInventoryMedicineItem;
    use App\Http\Controllers\Admin\Inventory\Medicine\AllController as AdminInventoryMedicineAll;
    use App\Http\Controllers\Admin\Inventory\Medicine\ReportController as AdminInventoryMedicineReport;
    use App\Http\Controllers\Admin\Inventory\Medicine\DispenseController as AdminInventoryMedicineDispense;
    
    // configuration
    use App\Http\Controllers\Admin\Configuration\Inventory\Equipment\ItemController as AdminConfigurationInventoryEquipmentItem;
    use App\Http\Controllers\Admin\Configuration\Inventory\Equipment\NameController as AdminConfigurationInventoryEquipmentName;
    use App\Http\Controllers\Admin\Configuration\Inventory\Equipment\BrandController as AdminConfigurationInventoryEquipmentBrand;
    use App\Http\Controllers\Admin\Configuration\Inventory\Equipment\TypeController as AdminConfigurationInventoryEquipmentType;
    use App\Http\Controllers\Admin\Configuration\Inventory\Equipment\PlaceController as AdminConfigurationInventoryEquipmentPlace;
    
    use App\Http\Controllers\Admin\Configuration\Inventory\Medicine\GenericNameController as AdminConfigurationInventoryMedicineGenericName;
    use App\Http\Controllers\Admin\Configuration\Inventory\Medicine\BrandController as AdminConfigurationInventoryMedicineBrand;

    // forms
    use App\Http\Controllers\Forms\FormController as AdminForm;
    use App\Http\Controllers\Forms\StudentHealthRecordController as AdminSHRC;
    use App\Http\Controllers\Forms\PrescriptionController as AdminPrescription;
    use App\Http\Controllers\Forms\PreEmploymentController as AdminPEOF;
    use App\Http\Controllers\Forms\ConsultationController as AdminCnslt;
    // personal details
    use App\Http\Controllers\Admin\Profile\PersonalDetailsController as AdminProfilePersonalDetails; 
    use App\Http\Controllers\Admin\Profile\EmergencyContactController as AdminEmergencyContact; 
    use App\Http\Controllers\Admin\Profile\PasswordController as AdminPassword;
    // patient documents
    use App\Http\Controllers\Admin\Documents\PatientUploadsController as AdminPDUploads;

    Route::group(['prefix' => 'admin', 'middleware' =>[ 'Inactivity', 'IsAdmin', 'InventoryMedicine']], function(){
        Route::get('dashboard', [AdminDashboard::class, 'index'])->name('admin');

        Route::prefix('announcement')->group(function(){
            Route::get('/', [AdminAnnouncement::class, 'index'])->name('AdminAnnouncement');
            Route::post('/insert', [AdminAnnouncement::class, 'insert'])->name('AdminAnnouncementInsert');
            Route::put('/update/{id}', [AdminAnnouncement::class, 'update'])->name('AdminAnnouncementUpdate');
            Route::delete('/delete/{id}', [AdminAnnouncement::class, 'delete'])->name('AdminAnnouncementDelete');
        });

        Route::prefix('accounts')->group(function(){
           
            Route::prefix('requests')->group(function(){
                Route::get('/', [AdminAccountsRequests::class, 'index'])->name('AdminAccountsRequests');
                Route::put('/verify/{id}', [AdminAccountsRequests::class, 'verify_acc'])->name('AdminAccountsRequestsVerify');
                Route::delete('/delete/{id}', [AdminAccountsRequests::class, 'delete_acc'])->name('AdminAccountsRequestsDelete');
            });

            Route::prefix('patients')->group(function(){
                Route::get('/', [AdminAccountsPatients::class, 'index'])->name('AdminAccountsPatients');
                Route::get('/view/{id}', [AdminAccountsPatients::class, 'view_patient_details'])->name('AdminAccountsPatientsView');
            });

            Route::prefix('employee')->group(function(){
                Route::get('/', [AdminAccountsEmployee::class, 'index'])->name('AdminAccountsEmployees');
                Route::get('/view/{id}', [AdminAccountsEmployee::class, 'view_employee'])->name('AdminAccountsEmployeesView');
            });
        });

        Route::prefix('inventory')->group(function(){
            
            Route::prefix('equipment')->group(function(){
                Route::get('/', [AdminInventoryEquipmentItem::class, 'index'])->name('AdminInventoryEquipmentItem');
                Route::put('/insert', [AdminInventoryEquipmentItem::class, 'insert'])->name('AdminInventoryEquipmentItemInsert');
                Route::put('/update/{id}', [AdminInventoryEquipmentItem::class, 'update'])->name('AdminInventoryEquipmentItemUpdate');
                Route::delete('/delete/{id}', [AdminInventoryEquipmentItem::class, 'delete'])->name('AdminInventoryEquipmentItemDelete');
                Route::get('/all', [AdminInventoryEquipmentAll::class, 'index'])->name('AdminInventoryEquipmentAll');
                
                Route::get('/report/{year}', [AdminInventoryEquipmentReport::class, 'index'])->name('AdminInventoryEquipmentReport');
                Route::get('/report/print/{year}', [AdminInventoryEquipmentReport::class, 'print'])->name('AdminInventoryEquipmentReportPrint');
            });

            Route::prefix('medicine')->group(function(){
                Route::get('/all',[AdminInventoryMedicineAll::class, 'index'])->name('AdminInventoryMedicineAll');
                
                Route::get('/',[AdminInventoryMedicineItem::class, 'index'])->name('AdminInventoryMedicineItem');
                Route::put('/insert',[AdminInventoryMedicineItem::class, 'insert'])->name('AdminInventoryMedicineItemInsert');
                Route::put('/update/{id}',[AdminInventoryMedicineItem::class, 'update'])->name('AdminInventoryMedicineItemUpdate');
                Route::delete('/delete/{id}',[AdminInventoryMedicineItem::class, 'delete'])->name('AdminInventoryMedicineItemDelete');
                
                Route::put('/dispose/{id}', [AdminInventoryMedicineItem::class, 'dispose'])->name('AdminInventoryMedicineItemDisposeInsert');

                Route::get('/transaction/{id}', [AdminInventoryMedicineItem::class, 'transaction_index'])->name('AdminInventoryMedicineItemTransaction');
                Route::delete('/transaction/delete/{id}', [AdminInventoryMedicineItem::class, 'transaction_delete'])->name('AdminInventoryMedicineItemTransactionDelete');
                
                Route::get('/report', [AdminInventoryMedicineReport::class, 'index'])->name('AdminInventoryMedicineReport');
                Route::get('/report/print', [AdminInventoryMedicineReport::class, 'print'])->name('AdminInventoryMedicineReportPrint');
            });
        });
      
        Route::prefix('configuration')->group(function(){

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

            Route::prefix('medicine')->group(function(){

                Route::prefix('genericname')->group(function(){
                    Route::get('/',[AdminConfigurationInventoryMedicineGenericName::class, 'index'])->name('AdminConfigurationInventoryMedicineGenericName');
                    Route::put('/insert',[AdminConfigurationInventoryMedicineGenericName::class, 'insert'])->name('AdminConfigurationInventoryMedicineGenericNameInsert');
                    Route::put('/update/{id}',[AdminConfigurationInventoryMedicineGenericName::class, 'update'])->name('AdminConfigurationInventoryMedicineGenericNameUpdate');
                    Route::delete('/delete/{id}',[AdminConfigurationInventoryMedicineGenericName::class, 'delete'])->name('AdminConfigurationInventoryMedicineGenericNameDelete');
                });

                Route::prefix('brand')->group(function(){
                    Route::get('/', [AdminConfigurationInventoryMedicineBrand::class, 'index'])->name('AdminConfigurationInventoryMedicineBrand');
                    Route::put('/insert', [AdminConfigurationInventoryMedicineBrand::class, 'insert'])->name('AdminConfigurationInventoryMedicineBrandInsert');
                    Route::put('/update/{id}', [AdminConfigurationInventoryMedicineBrand::class, 'update'])->name('AdminConfigurationInventoryMedicineBrandUpdate');
                    Route::delete('/delete/{id}', [AdminConfigurationInventoryMedicineBrand::class, 'delete'])->name('AdminConfigurationInventoryMedicineBrandDelete');
                });
            });
        });

        Route::prefix('forms')->group(function(){
            Route::get('attach/{trans_id}/{form_id}', [AdminForm::class, 'attach'])->name('AdminFormAttach');
            Route::get('attach/{form_id}', [AdminForm::class, 'remove'])->name('AdminFormRemove');

            Route::prefix('studenthealthrecord')->group(function(){
                Route::post('insert/{id}', [AdminSHRC::class, 'insert'])->name('AdminSHRInsert');
                Route::delete('delete/{id}', [AdminSHRC::class, 'delete'])->name('AdminSHRDelete');
                Route::post('update/{id}', [AdminSHRC::class, 'update'])->name('AdminSHRUpdate');
                Route::get('retrieve/{id}', [AdminSHRC::class, 'retrieve'])->name('AdminSHRRetrieve');
                Route::get('print/SHR/{id}', [AdminSHRC::class, 'print'])->name('AdminSHRPrint');
            });

            Route::prefix('prescription')->group(function(){
                Route::post('insert/{id}', [AdminPrescription::class, 'insert'])->name('AdminPrescriptionInsert');
                Route::get('print/prescription/{id}', [AdminPrescription::class, 'print'])->name('AdminPrescriptionPrint');
                Route::delete('delete/{id}', [AdminPrescription::class, 'delete'])->name('AdminPrescriptionDelete');
                Route::get('retrieve/{id}', [AdminPrescription::class, 'retrieve'])->name('AdminPrescriptionRetrieve');
                Route::post('update/{id}', [AdminPrescription::class, 'update'])->name('AdminPrescriptionUpdate');
            });

            Route::prefix('preemployment')->group(function(){
                Route::put('insert/{id}', [AdminPEOF::class, 'insert'])->name('AdminPEOFInsert');
                Route::get('print/{id}', [AdminPEOF::class, 'print'])->name('AdminPEOFPrint');
                Route::delete('delete/{id}', [AdminPEOF::class, 'delete'])->name('AdminPEOFDelete');
                Route::put('update/{id}', [AdminPEOF::class, 'update'])->name('AdminPEOFUpdate');
                Route::get('retrieve/{id}', [AdminPEOF::class, 'retrieve'])->name('AdminPEOFRetrieve');
            });

            Route::prefix('consultaion')->group(function(){
                Route::put('insert/{id}', [AdminCnslt::class, 'insert'])->name('AdminCnsltInsert');
                Route::get('print/{id}', [AdminCnslt::class, 'print'])->name('AdminCnsltPrint');
                Route::delete('delete/{id}', [AdminCnslt::class, 'delete'])->name('AdminCnsltDelete');
                Route::put('update/{id}', [AdminCnslt::class, 'update'])->name('AdminCnsltUpdate');
                Route::get('retrieve/{id}', [AdminCnslt::class, 'retrieve'])->name('AdminCnsltRetrieve');
            });

            Route::prefix('patientuploads')->group(function(){
                Route::put('changestatus/{pd_id}', [AdminPDUploads::class, 'update_status'])->name('AdminPDUploadsCS');
                Route::put('upload/{pd_id}', [AdminPDUploads::class, 'upload'])->name('AdminPDUploads');
                Route::delete('delete/{pd_id}', [AdminPDUploads::class, 'delete'])->name('AdminPDDelete');
                Route::delete('delete/uploads/{id}', [AdminPDUploads::class, 'delete_upload'])->name('AdminPDDeletePD');
            });
            
        });

        Route::prefix('transaction')->group(function(){
            Route::get('attendance/{date}', [AdminTransaction::class, 'index'])->name('AdminTransaction');
            Route::get('newcode/{date}', [AdminAttendanceCode::class, 'get_new_code'])->name('AdminGetNewAttendanceCode');
            
            Route::get('codes', [AdminAttendanceCode::class, 'index'])->name('AdminAttendanceCode');
            Route::get('codes/{date}', [AdminAttendanceCode::class, 'update_status'])->name('AdminAttendanceCodeStatusChange');
        });

        Route::prefix('profile')->group(function(){

            Route::prefix('personaldetails')->group(function(){
                Route::get('/', [AdminProfilePersonalDetails::class, 'index'])->name('AdminProfilePersonalDetails');
                Route::put('/update', [AdminProfilePersonalDetails::class, 'update'])->name('AdminProfilePersonalDetailsUpdate');
            });
            
            Route::prefix('emergencycontact')->group(function(){
                Route::get('',[AdminEmergencyContact::class, 'index'])->name('AdminEmergencyContact');
                Route::put('/update',[AdminEmergencyContact::class, 'update_emergency_contact'])->name('AdminEmergencyContactUpdate');
            });

            Route::prefix('password')->group(function(){
                Route::get('', [AdminPassword::class, 'index'])->name('AdminPassword');
                Route::put('', [AdminPassword::class, 'update_password'])->name('UpdateAdminPassword');
            });
        });

        Route::prefix('medicinetransaction')->group(function(){
            Route::put('/{acc_id}', [AdminInventoryMedicineDispense::class, 'dispense'])->name('AdminInventoryMedicineDispense');
            Route::put('/dispense/{imt_id}', [AdminInventoryMedicineDispense::class, 'update_dispense'])->name('AdminInventoryMedicineDispenseUpdate');
        });

    });
// ================= End Admin ===============================

use App\Http\Controllers\TestPDF;
Route::get('TestPDF', [TestPDF::class, 'index']);
Route::post('TestPDF', [TestPDF::class, 'testing'])->name('test');

use App\Http\Controllers\ViewUploadsController as ViewUploads;

Route::get('view/{pd_id}', [ViewUploads::class, 'view'])->name('ViewDocument');