<?php

namespace App\Http\Controllers\Patient\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\PopulateSelectController as PopulateSelect;
use App\Http\Controllers\OTPController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use App\Rules\GsuiteRule;
use App\Rules\PasswordRule;
use App\Rules\NotGsuiteRule;

class PersonalDetailsController extends Controller
{
    public function get_user_details(){
        $user_details = 
            DB::table('accounts as acc')
                ->select(
                    'acc.*',
                    'home.prov_code as home_prov', 'home.mun_code as home_mun', 'home.brgy_code as home_brgy',
                    'birth.prov_code as birth_prov', 'birth.mun_code as birth_mun', 'birth.brgy_code as birth_brgy',
                    'dorm.prov_code as dorm_prov', 'dorm.mun_code as dorm_mun', 'dorm.brgy_code as dorm_brgy'
                )
                ->where('acc_id',Session::get('UserID'))
                ->leftjoin('address as home','acc.home_add_id', 'home.add_id')
                ->leftjoin('address as birth','acc.birth_add_id', 'birth.add_id')
                ->leftjoin('address as dorm','acc.dorm_add_id', 'dorm.add_id')
                ->first();

        return $user_details;
    }

    public function index(){
        $user_details = $this->get_user_details();

        $populate = new PopulateSelect;
        $provinces = $populate->province(); //same to three select province

        $home_municipalities = $populate->municipality($user_details->home_prov); //get the selected home municipality
        $home_barangays = $populate->barangay($user_details->home_mun); //get the selected home barangay

        $birthplace_municipalities = $populate->municipality($user_details->birth_prov); //get the selected birth municipality
        $birthplace_barangays = $populate->barangay($user_details->birth_mun); //get the selected birth barangay

        $dormitory_municipalities = $populate->municipality($user_details->dorm_prov); //get the selected dorm municipality
        $dormitory_barangays = $populate->barangay($user_details->dorm_mun); //get the selected dorm barangay

        $grade_levels = $populate->grade_level();//get grade levels
        $departments = $populate->department($user_details->gl_id);//get department based on selected grade_levels
        $programs = $populate->program($user_details->dept_id); //get programs based on selected department

        // echo json_encode($user_details);
       
        return view('Patient.Profile.PersonalDetails')
            ->with([
                'user_details' => $user_details,
                'provinces' => $provinces,
                'home_municipalities' => $home_municipalities,
                'home_barangays' => $home_barangays,

                'birthplace_municipalities' => $birthplace_municipalities,
                'birthplace_barangays' => $birthplace_barangays,

                'dormitory_municipalities' => $dormitory_municipalities,
                'dormitory_barangays' => $dormitory_barangays,

                'grade_levels' => $grade_levels,
                'departments' => $departments,
                'programs' => $programs
            ]);
    }
}
