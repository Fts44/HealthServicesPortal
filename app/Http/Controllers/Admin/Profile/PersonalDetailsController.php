<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\PopulateSelectController as PopulateSelect;
use App\Http\Controllers\OTPController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;

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
                ->where('acc_id',Session::get('user_id'))
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
        
        $dormitory_municipalities = $populate->municipality($user_details->dorm_prov); //get the selected dorm municipality
        $dormitory_barangays = $populate->barangay($user_details->dorm_mun); //get the selected dorm barangay

        $religions = $populate->religion(); //get religions
        
        return view('Admin.Profile.PersonalDetails')
            ->with([
                'acc' => $user_details,
                'provinces' => $provinces,

                'home_municipalities' => $home_municipalities,
                'home_barangays' => $home_barangays,

                'dormitory_municipalities' => $dormitory_municipalities,
                'dormitory_barangays' => $dormitory_barangays,

                'religions' => $religions
            ]);
    }

    public function update(Request $request){

        $user_id = Session::get('user_id');
        $user_details = DB::table('accounts')->where('acc_id', $user_id)->first();

        $rules = [
            'profile_picture' => ['required_without:prev_profile_picture', 'image', 'max:5120'],
            'title' => ['required'],
            'employee_id' => ['required', 'unique:accounts,sr_code,'.$user_id.',acc_id'],
            'email' => ['required', 'email', new NotGsuiteRule, 'unique:accounts,email,'.$user_id.',acc_id'],
            'gsuite' => ['nullable', 'email', new GsuiteRule, 'unique:accounts,gsuite_email,'.$user_id.',acc_id'],
            'otp' => ['required_with:gsuite'],
            'firstname' => ['required'],
            'lastname' => ['required'],
            'civil_status' => ['required'],
            'contact' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:11', 'unique:accounts,contact,'.$user_id.',acc_id'],
            'sex' => ['required'],
            'home_province' => ['required'],
            'home_municipality' => ['required'],
            'home_barangay' => ['required'],
            'religion' => ['required'],
            'birthdate' => ['required'],
            'dormitory_municipality' => ['required_with:dormitory_province'],
            'dormitory_barangay' => ['required_with:dormitory_province'],
            'signature' => ['required_without:prev_signature', 'mimes:png', 'max: 1024']     
        ];

        $messages = [
            'profile_picture.required_without' => 'The profile picture field is required.',
            'otp.required_with' => 'The otp field is required.',
            'dormitory_municipality.required_with' => 'The dormitory municipality field is required.',
            'dormitory_barangay.required_with' => 'The dormitory barangay field is required.',
            'signature.required_without' => 'The signature field is required.'
        ];

        $validator = Validator::make( $request->all(), $rules, $messages);

        // otp
        $otp_valid = 2;

        if($request->gsuite && $request->otp && !$user_details->gsuite_email){              
            $this->OTPController = new OTPController;
            $otp_request = new Request([
                'email'   => $request->gsuite,
                'otp' => $request->otp,
            ]);
            $otp_status = $this->OTPController->verify_otp($otp_request);

            if($otp_status){
                $otp_valid = 1;
            }
            else{
                $otp_valid = 0;
            }
        }

        if($validator->fails() || $otp_valid == 0){
            if($otp_valid == 0){
                $validator->getMessageBag()->add('otp', 'The otp is invalid!');
            }
            $response = [
                'title' => 'Failed!',
                'message' => 'Personal Information not updated.',
                'icon' => 'error',
                'status' => 400,
                'errors' => $validator->messages()
            ]; 
        }
        else if($otp_valid == 1 || $otp_valid == 2){

            try{

                DB::transaction(function() use ($request, $user_id, $user_details, $otp_valid){

                    // get previouse picture 
                    $file_name = $user_details->profile_pic;

                    // profile picture
                    if($request->profile_picture){
                        $path = '/public/profile_picture/';
                        $file = $request->file('profile_picture');
                        $file_name = $user_id.'_'.time().'.'.$file->extension();
                        $upload = $file->storeAs($path, $file_name);

                        if($user_details->profile_pic){
                            Storage::delete($path.$user_details->profile_pic); 
                        }
                    }

                    $signature_name = $user_details->signature;

                    if($request->signature){
                        $path = '/public/signature/';
                        $file = $request->file('signature');
                        $signature_name = $user_id.'_'.time().'.'.$file->extension();
                        $upload = $file->storeAs($path, $signature_name);

                        if($user_details->profile_pic){
                            Storage::delete($path.$user_details->signature); 
                        }
                    }
                    // home address
                    if($user_details->home_add_id){
                        DB::table('address')->where('add_id', $user_details->home_add_id)->update([
                            'prov_code' => $request->home_province,
                            'mun_code' => $request->home_municipality,
                            'brgy_code' => $request->home_barangay
                        ]);
                    }
                    else{
                        $user_details->home_add_id = DB::table('address')->InsertGetId([
                            'prov_code' => $request->home_province,
                            'mun_code' => $request->home_municipality,
                            'brgy_code' => $request->home_barangay
                        ]);
                    }

                    // dorm address
                    if($request->dormitory_province){
                        if($user_details->dorm_add_id){
                            DB::table('address')->where('add_id', $user_details->dorm_add_id)->update([
                                'prov_code' => $request->dormitory_province,
                                'mun_code' => $request->dormitory_municipality,
                                'brgy_code' => $request->dormitory_barangay
                            ]);
                        }
                        else{
                            $user_details->dorm_add_id = DB::table('address')->InsertGetId([
                                'prov_code' => $request->dormitory_province,
                                'mun_code' => $request->dormitory_municipality,
                                'brgy_code' => $request->dormitory_barangay
                            ]);
                        }
                    }
                    else{
                        if($user_details->dorm_add_id){
                            DB::table('address')->where('add_id', $user_details->dorm_add_id)->delete();
                        }
                    }
                    
                    if($otp_valid==1){
                        DB::table('accounts')->where('acc_id', $user_id)->update([
                            'gsuite_email' => $request->gsuite,
                            'is_verified' => 1
                        ]);
                    }

                    DB::table('accounts')->where('acc_id', Session('user_id'))->update([
                        'profile_pic' => $file_name,
                        'signature' => $signature_name,
                        'license_no' => $request->license_no,
                        'sr_code' => $request->employee_id,
                        'email' => $request->email,
                        'firstname' =>  $request->firstname, 
                        'middlename' =>  $request->middlename,
                        'lastname' =>  $request->lastname,
                        'suffixname' =>  $request->suffixname,
                        'gender' => $request->sex,
                        'civil_status' =>  $request->civil_status,
                        'contact' => $request->contact,
                        'home_add_id' => $user_details->home_add_id,
                        'religion' => $request->religion,
                        'birthdate' => $request->birthdate,
                        'dorm_add_id' => $user_details->dorm_add_id,
                        'title' => $request->title 
                    ]);

                    
                });

                $response = [
                    'title' => 'Success!',
                    'message' => 'Personal Information updated.',
                    'icon' => 'success',
                    'status' => 200
                ]; 
            }
            catch(Exception $e){
                $response = [
                    'title' => 'Failed!',
                    'message' => 'Personal Information not updated.'.$e,
                    'icon' => 'error',
                    'status' => 200
                ]; 
            }
            
        }

        echo json_encode($response);
    }
}
