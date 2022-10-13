<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\MailerController;
use Session;

class OTPController extends Controller
{
    public function __construct(){
        $this->mailer = new MailerController;
    }

    public function generate_new_otp($email){
        $otp = rand(1000,9999);
        session(['OTP' => $otp]);
        session(['Email' => $email]);
        session(['ExpiredAt' =>  time()+60*5]);

        return $otp;
    }

    public function compose_mail(Request $request){

        if($request->msg_type == 'register'){
            
            if(str_contains($request->email,'@g.batstate-u.edu.ph')){
                $rules = [
                    'email' => ['required','unique:accounts,gsuite_email'],     
                ];
                $message = [
                    'email.unique' => 'Gsuite email already registered.'
                ];
            }   
            else{
                $rules = [
                    'email' => ['required','unique:accounts,email'],     
                ];
                $message = [
                    'email.unique' => 'Email already registered.'
                ];
            }

        }
        else{

            if(str_contains($request->email,'@g.batstate-u.edu.ph')){
                $rules = [
                    'email' => ['required','email','exists:accounts,gsuite_email'],     
                ];
                $message = [
                    'email.exists' => 'Gsuite email is not registered.'
                ];
            }   
            else{
                $rules = [
                    'email' => ['required','email','exists:accounts,email'],     
                ];
                $message = [
                    'email.exists' => 'Email is not registered.'
                ];
            }

        }

        $validator = Validator::make($request->all(), $rules, $message);

        if($validator->fails()){
            $response = [
                'status' => 400,
                'errors' => $validator->messages()
            ];
        }
        else{
            $new_otp = $this->generate_new_otp($request->email);
            $msg_body = "";

            if($request->msg_type == "register"){
                $msg_body = "Hello!,<br><p>To register this email to your account, Please use this One Time Pin (OTP): <b>".$new_otp."</b><br><br>For inquiries Contact: [email of school here]<br><i>***Note: This email is automatically generated by the ARASOF-Health Services. Please do not reply to this email!***</i>";
            }
            else{
                $msg_body = "Hello!,<br><p>To recover your account, Please use this One Time Pin (OTP): <b>".$new_otp."</b><br><br>For inquiries Contact: [email of school here]<br><i>***Note: This email is automatically generated by the ARASOF-Health Services. Please do not reply to this email!***</i>";
            }

            $send_request = new Request([
                'emailTo' => $request->email,
                'body' => $msg_body,
                'subject'  => 'Health Services (ARASOF) - One Time Pin'
            ]);
    
            if($this->mailer->send($send_request)){
                $response = [
                    'status' => 200,
                    'title' => 'OTP sent!',
                    'message' => 'Check your inbox or “spam” folder.',
                    'icon' => 'success'
                ];
            }
            else{
                $response = [
                    'status' => 200,
                    'title' => 'OTP not sent!',
                    'message' => 'Something went wrong! Please try again later.',
                    'icon' => 'error'
                ];
            }
        }      
        echo json_encode($response);
    }

    public function verify_otp(Request $request){
        $otp = session('OTP');
        $email = session('Email');
        $expiredAt = session('ExpiredAt');

        if($otp == $request->otp && $email == $request->email && ($expiredAt >= time())){
            return true;
        }
        else{
            return false;
        }
    }
}
