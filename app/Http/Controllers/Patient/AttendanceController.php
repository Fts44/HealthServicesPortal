<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Admin\Transaction\AttendanceCodeController as AttendanceCodeController;

class AttendanceController extends Controller
{
    public function __construct(){
        date_default_timezone_set('Asia/Manila');
        $AttendanceCode = new AttendanceCodeController;
        $todays_attendance_code = $AttendanceCode->get_todays_code();
    }

    public function get_user_details(){
        $user_details = DB::table('accounts as acc')
            ->select('acc.*', 'prog.*', 'dept.*')
            ->leftjoin('program as prog', 'acc.prog_id', 'prog.prog_id')
            ->leftjoin('department as dept', 'acc.dept_id', 'dept.dept_id')
            ->where('acc_id', Session::get('user_id'))
            ->first();
        return $user_details;
    }

    public function index(){
        $all_attendance = DB::table('transaction')
            ->where('acc_id', Session::get('user_id'))
            ->orderBy('trans_date', 'DESC')
            ->orderBy('trans_time_in', 'DESC')
            ->get();

        return view('patient.attendance')->with([
            'all_attendance' => $all_attendance
        ]);
    }

    public function time_in(Request $request){
        $rules = [
            'date' => ['required'],
            'code' => ['required'],
            'purpose' => ['required'],
            'specify_purpose' => ['required_if:purpose,==,Others']
        ];

        $messages = [
            'specify_purpose.required_if' => 'The purpose field is required.'
        ];

        $validator = validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->all())
                ->with([
                    'form' => 'time_in'
                ]);
        }
        else{
            // check if code match the date and if the status is open
            $ac_details = DB::table('attendance_code')
                ->where('ac_date', date_format(date_create($request->date),'Y-m-d'))
                ->where('ac_code', $request->code)
                ->first();

            if(!$ac_details){
                return redirect()->back()
                ->withErrors([
                    'code' => 'The code is invalid.',
                ])
                ->with([
                    'form' => 'time_in'
                ])
                ->withInput($request->all());
            }
            else{
                
                if(!$ac_details->ac_status){
                    $response = [
                        'title' => 'Failed!',
                        'message' => 'Attendance for the date you entered is close.',
                        'icon' => 'error',
                        'status' => 400
                    ];
        
                    return redirect()->back()
                        ->withErrors($validator)
                        ->withInput($request->all())
                        ->with([
                            'status' => $response,
                            'form' => 'time_in'
                        ]);
                }
                else{
                    $user_details = $this->get_user_details();
                    
                    if($user_details){

                        if(Hash::check($request->pass, $user_details->password)){

                            $existing_trans = DB::table('transaction')
                                ->where('trans_time_out', NULL)
                                ->where('acc_id', Session::get('user_id'))
                                ->first();

                            if($existing_trans){
                                $response = [
                                    'title' => 'Failed!',
                                    'message' => 'You have an existing attendance please time out first.',
                                    'icon' => 'error',
                                    'status' => 400
                                ];
                    
                                return redirect()->back()
                                    ->withErrors($validator)
                                    ->withInput($request->all())
                                    ->with([
                                        'status' => $response,
                                        'form' => 'time_in'
                                    ]);
                            }
                            else{
                                DB::table('transaction')->insert([
                                    'trans_date' => $request->date,
                                    'trans_patient_name' => $user_details->firstname." ".(($user_details->middlename) ? $user_details->middlename[0].". " : '').$user_details->lastname,
                                    'trans_department' => (($user_details->dept_code) ? $user_details->dept_code : '' ),
                                    'trans_srcode' => (($user_details->sr_code) ? $user_details->sr_code : '' ),
                                    'trans_program' => (($user_details->prog_code) ? $user_details->prog_code : '' ),
                                    'trans_classification' => $user_details->classification,
                                    'trans_purpose' => $request->purpose,
                                    'trans_purpose_specify' => $request->specify_purpose,
                                    'acc_id' => Session::get('user_id')
                                ]);
    
                                $response = [
                                    'title' => 'Success!',
                                    'message' => 'Successfully time in.',
                                    'icon' => 'success',
                                    'status' => 200
                                ];
                    
                                return redirect()->back()
                                    ->with([
                                        'status' => $response
                                    ]);
                            }
                        }
                        else{
                            return redirect()->back()
                            ->withErrors([
                                'pass' => 'The passwod is incorrect.',
                            ])
                            ->with([
                                'form' => 'time_in'
                            ])
                            ->withInput($request->all());
                        }
                        
                    }
                    
                }

            }
        }
    }

    public function time_out(Request $request, $id){
        $rules = [
            'time_out_pass' => ['required']
        ];

        $messages = [
            'time_out_pass.required' => 'The password field is required.'
        ];

        $validator = validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->all())
                ->with([
                    'form' => 'time_out',
                    'trans_id' => $id
                ]);
        }
        else{
            $user_details = $this->get_user_details();
                    
            if($user_details){
                if(Hash::check($request->time_out_pass, $user_details->password)){
                    DB::table('transaction')
                        ->where('trans_id', $id)
                        ->where('acc_id', Session::get('user_id'))
                        ->update([
                            'trans_time_out' => date('H:i:s'),
                        ]);

                    $response = [
                        'title' => 'Success!',
                        'message' => 'Successfully time out.',
                        'icon' => 'success',
                        'status' => 200
                    ];
        
                    return redirect()->back()
                        ->with([
                            'status' => $response
                        ]);  
                }
                else{
                    return redirect()->back()
                        ->withErrors([
                            'time_out_pass' => 'The passwod is incorrect.',
                        ])
                        ->with([
                            'form' => 'time_out',
                            'trans_id' => $id
                        ])
                        ->withInput($request->all());
                }
            }
        }
    }
}
