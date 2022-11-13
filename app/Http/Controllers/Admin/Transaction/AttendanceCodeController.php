<?php

namespace App\Http\Controllers\Admin\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class AttendanceCodeController extends Controller
{
    public function get_todays_code(){
        // change the date in xampp php.ini instead of using this line of code
        // date_default_timezone_set('Asia/Manila');
        $todays_code = DB::table('attendance_code')
            ->where('ac_date', date("Y-m-d"))
            ->first();

        if(!$todays_code){
            $new_ac_code = rand ( 1000 , 9999 );

            DB::table('attendance_code')->insert([
                'ac_date' =>  date("Y-m-d"),
                'ac_code' => $new_ac_code
            ]);

            $todays_code = DB::table('attendance_code')
            ->where('ac_date',  date("Y-m-d"))
            ->first();
        }

        return $todays_code->ac_code;
    }

    public function get_new_code($date){
        $new_ac_code = rand ( 1000 , 9999 );

        DB::table('attendance_code')->where('ac_date', $date)->update([
            'ac_code' => $new_ac_code
        ]);

        return $new_ac_code;
    }

    public function index(){
    
    }
}
