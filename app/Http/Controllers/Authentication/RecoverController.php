<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Controllers\OTPController;
use App\Rules\PasswordRule as PasswordRule;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DB;

class RecoverController extends Controller
{
    public function index(){
        return view('Authentication.Recover');
    }

    public function recover(Request $request){
        $this->otp_controller = new OTPController;
        $rules = [
            'email' => ['required','max:255'],
            'otp' => ['required','numeric','min:4'],
            'pass' => ['required', 'max:20', new PasswordRule],
            'cpass' => ['required','same:pass']
        ];

        $messages = [
            'cpass.same' => 'The password does not match.',
            'cpass.required' => 'The retype password required.'
        ];
        
        if(str_contains($request->email, '@g.batstate-u.edu.ph')){         
            array_push($rules['email'], 'exists:accounts,gsuite_email');
            $message = [
                'email.exists' => 'Gsuite email is not registered.'
            ];
            $email_type = "gsuite_email";
        }
        else{
            array_push($rules['email'], 'exists:accounts,email');
            $message = [
                'email.exists' => 'Email is not registered.'
            ];
            $email_type = "email";
        }

        $validator = Validator::make( $request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        else{

            $verify_otp_request = new Request([
                'email' => $request->email,
                'otp' => $request->otp,
            ]);
    
            if($this->otp_controller->verify_otp($verify_otp_request)){
                DB::table('accounts')->where($email_type, $request->email)->update([
                    'password' => Hash::make($request->pass)
                ]);  
     
                $response = [
                    'title' => 'Success!',
                    'message' => 'Password updated.',
                    'icon' => 'success',
                    'status' => 200
                ];
                $response = json_encode($response, true);
                return redirect()->back()->with('status',$response);
            }
            else{
    
                $response = [
                    'title' => 'Invalid OTP!',
                    'message' => 'Please double check the email or get new one.',
                    'icon' => 'error',
                    'status' => 400
                ];
                $response = json_encode($response, true);
                return redirect()
                    ->back()
                    ->withInput($request->all())
                    ->with('status',$response);
            }
        }
    }
}
