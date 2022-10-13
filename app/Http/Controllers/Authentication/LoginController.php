<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use DB;
use Session;

class LoginController extends Controller
{
    public function index(){
        return view('Authentication.Login');
    }

    public function login(Request $request){
        $rules = [
            'userid' => 'required',
            'pass' => 'required',
        ];

        $messages = [
            'userid.required' => 'Email/SR-Code is required.',
            'pass.required' => 'Password is required.' 
        ];

        $validator = Validator::make( $request->all(), $rules, $messages);

        if($validator->fails()){
            $response = [
                'status' => 400,
                'errors' => $validator->messages()
            ];
        }
        else{

            $user = DB::table('accounts')
                ->where('gsuite_email','=',$request->userid)
                ->orWhere('email','=',$request->userid)
                ->orWhere('sr_code','=',$request->userid)
                ->first();
            
            if($user){
                if(Hash::check($request->pass, $user->password)){
                    Session(['UserID' => $user->acc_id]);
                    Session(['UserType' => $user->position]);
                    Session(['UserPassword' => $user->password]);
                    Session(['UserFirstname' => $user->firstname]);
                    Session(['UserLastname' => $user->lastname]);
                    Session(['LastActivityTime' => time()+60*5]);

                    $response = [
                        'status' => 200,
                    ];

                    $response['redirect_to'] = route(Session::get('UserType'));
                }
                else{
                    $response = [
                        'status' => 400,
                        'errors' => ['pass' => 'Incorrect password!']
                    ];
                }
            }
            else{
                $response = [
                    'status' => 400,
                    'errors' => ['userid' => 'Email/SR-Code is not connected to any account!']
                ];
            }
        }

        echo json_encode($response);
    }

    public function logout(){
        Session::flush();
        return redirect(route('LoginIndex'));
    }
}
