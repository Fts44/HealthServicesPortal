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

    });
// ================= End Populate Select =====================

// ================= Start Patient =============================
    use App\Http\Controllers\Patient\Profile\PersonalInformationController as PatientProfilePersonalInformationController;

    Route::group(['prefix' => 'patient', 'middleware' =>[ 'IsPatient', 'Inactivity']],function(){

        Route::prefix('personalinformation')->group(function(){
            Route::get('/', [PatientProfilePersonalInformationController::class, 'index'])->name('patient');
        });

    });
// ================= End Patient =============================