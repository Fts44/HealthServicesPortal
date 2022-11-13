<?php

namespace App\Http\Controllers\Admin\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Transaction\AttendanceCodeController as AttendanceCodeController;
use DB;

class TransactionController extends Controller
{
    public function index_today(){
        $AttendanceCode = new AttendanceCodeController;
        $todays_attendance_code = $AttendanceCode->get_todays_code();
        
        $todays_trans = DB::table('transaction')
            ->where('trans_date', date('Y-m-d'))
            ->orderBy('trans_time_in', 'DESC')
            ->get();

        return view('Admin.Transaction.Today')
            ->with([
                'todays_code' => $todays_attendance_code,
                'today_trans' => $todays_trans
            ]);
    }
}
