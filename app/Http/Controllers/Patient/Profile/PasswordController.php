<?php

namespace App\Http\Controllers\Patient\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Hash;
use App\Rules\PasswordRule;

class PasswordController extends Controller
{
    public function index(){
        return view('Patient.Profile.Password');
    }

    public function update_password(Request $request){
        $rules = [
            'new_password' => ['required', new PasswordRule],
            'retype_new_password' => ['required','same:new_password'],
            'old_password' => ['required'],
        ];

        $validator = validator::make($request->all(), $rules);

        if($validator->fails()){
            $response = [
                'title' => 'Failed!',
                'message' => 'Password not updated.',
                'icon' => 'error',
                'status' => 400
            ];

            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->all())
                ->with([
                    'status' => $response
                ]);
        }   
        else{
            $old_password = DB::table('accounts')->where('acc_id', Session::get('user_id'))->first()->password;

            try{
                if(Hash::check($request->old_password, $old_password)){
                    DB::table('accounts')->where('acc_id',Session::get('user_id'))->update([
                        'password' => Hash::make($request->new_password)
                    ]);
                    $response = [
                        'title' => 'Success!',
                        'message' => 'Password updated.',
                        'icon' => 'success',
                        'status' => 200
                    ];
                    // $response = json_encode($response);
                    return redirect()->back()->with('status',$response);
                }
                else{
                    $response = [
                        'title' => 'Failed!',
                        'message' => 'Wrong old password.',
                        'icon' => 'error',
                        'status' => 400
                    ];  
                    // $response = json_encode($response, true);
                    return redirect()->back()->with('status',$response)
                        ->withErrors(['old_password' => 'Incorrect password.'])
                        ->withInput($request->all());
                }
            }
            catch(Exception $e){
                $response = [
                    'title' => 'Failed!',
                    'message' => 'Wrong old password.'.$e,
                    'icon' => 'error',
                    'status' => 400
                ];  
                // $response = json_encode($response, true);
                return redirect()->back()->with('status',$response)->withErrors($validator)->withInput($request->all());
            }

        }
    }
}
