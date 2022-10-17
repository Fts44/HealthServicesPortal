<?php

namespace App\Http\Controllers\Patient\Profile;

use App\Http\Controllers\PopulateSelectController as PopulateSelect;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class EmergencyContactController extends Controller
{
    public function index(){
        $user_emergency_contact_details = DB::table('accounts as acc')
            ->select('ec.*', 'add.*')
            ->leftjoin('emergency_contact as ec', 'acc.ec_id', 'ec.ec_id')
            ->leftjoin('address as add', 'ec.biz_add_id', 'add.add_id')
            ->where('acc.acc_id', Session::get('user_id'))
            ->first();

        $populate = new PopulateSelect;
        $provinces = $populate->province();
        $municipalities = $populate->municipality($user_emergency_contact_details->prov_code);
        $barangays = $populate->barangay($user_emergency_contact_details->mun_code);
        // echo json_encode($user_emergency_contact_details);
        
        return view('Patient.Profile.EmergencyContact')
            ->with([
                "user_emergency_contact_details" => $user_emergency_contact_details,
                "ec_provinces" => $provinces,
                "ec_municipalities" => $municipalities,
                "ec_barangays" => $barangays 
            ]);
    }

    public function update_emergency_contact(Request $request){

        $rules = [
            'first_name' => ['required'],
            'middle_name' => ['nullable'],
            'last_name' => ['required'],
            'landline' => ['nullable'],
            'contact' => ['required'],
            'province' => ['required'],
            'municipality' => ['required'],
            'barangay' => ['required'],
            'relation_to_you' => ['required'],
        ];

        $validator = validator::make($request->all(), $rules);

        if($validator->fails()){

            $populate = new PopulateSelect;
            $provinces = $populate->province();
            $municipalities = $populate->municipality($request->province);
            $barangays = $populate->barangay($request->municipality);

            return redirect()->back()->withErrors($validator)->withInput($request->all())
                ->with([
                    "ec_provinces" => $provinces,
                    "ec_municipalities" => $municipalities,
                    "ec_barangays" => $barangays 
                ]);
        }
        else{

            try{
                $user_details = DB::table('accounts')->select('ec_id')->where('acc_id', Session::get('user_id'))->first();

                if($user_details->ec_id){
                    $ec_details = DB::table('emergency_contact')->where('ec_id', $user_details->ec_id)->first();
                    // echo json_encode($ec_details);
                    // echo json_encode($request->all());
                    DB::transaction(function() use ($request, $ec_details){
             
                        $ec_add = DB::table('address')->where('add_id', $ec_details->biz_add_id)->update([
                            'prov_code' => $request->province,
                            'mun_code' => $request->municipality,
                            'brgy_code' => $request->barangay
                        ]);

                        DB::table('emergency_contact')->where('ec_id', $ec_details->ec_id)->update([
                            'ec_firstname' => $request->first_name,
                            'ec_middlename' => $request->middle_name,
                            'ec_lastname' => $request->last_name,
                            'ec_suffixname' => $request->suffix_name,
                            'ec_relationtopatient' => $request->relation_to_you,
                            'ec_landline' => $request->landline,
                            'ec_contact' => $request->contact
                        ]);
                    });

                    $response = [
                        'title' => 'Success!',
                        'message' => 'Emergency Contact updated.',
                        'icon' => 'success',
                        'status' => 200
                    ];

                    return redirect(route('PatientEmergencyContact'))->with('status', $response);
                }
                else{

                    DB::transaction(function() use ($request){
                        // insert new address and get add_id
                        $biz_add_id = DB::table('address')->insertGetId([
                            'prov_code' => $request->province,
                            'mun_code' => $request->municipality,
                            'brgy_code' => $request->barangay
                        ]);
                        // insert to emergency contact and use the biz add id above
                        $ec_id = DB::table('emergency_contact')->insertGetId([
                            'ec_firstname' => $request->first_name,
                            'ec_middlename' => $request->middle_name,
                            'ec_lastname' => $request->last_name,
                            'ec_suffixname' => $request->suffix_name,
                            'ec_relationtopatient' => $request->relation_to_you,
                            'ec_landline' => $request->landline,
                            'ec_contact' => $request->contact,
                            'biz_add_id' => $biz_add_id
                        ]);
                        // lastly update the accounts table, ec_id column using ec_id above
                        DB::table('accounts')->where('acc_id', Session::get('user_id'))->update([
                            'ec_id' => $ec_id
                        ]);
                    });

                    $response = [
                        'title' => 'Success!',
                        'message' => 'Emergency Contact added.',
                        'icon' => 'success',
                        'status' => 200
                    ];

                    return redirect(route('PatientEmergencyContact'))->with('status', $response);
                }
            }
            catch(Exception $e){

                $response = [
                    'title' => 'Error!',
                    'message' => 'Failed to update emergency contact.'.$e,
                    'icon' => 'error',
                    'status' => 400
                ];

                return redirect(route('PatientEmergencyContact'))->with('status', $response);
            }

        }
    }
}
