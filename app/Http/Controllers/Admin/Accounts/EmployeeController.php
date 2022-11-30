<?php

namespace App\Http\Controllers\Admin\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class EmployeeController extends Controller
{
    public function index(){
        $employee = DB::table('accounts as a')
            ->where('position','!=','admin')
            ->where('position','!=','patient')
            ->leftjoin('title as ttl', 'a.title', 'ttl.ttl_id')
            ->get();

        return view('Admin.Accounts.Employee')
            ->with([
                'employee' => $employee
            ]);
    }

    public function view_employee($id){
        $acc = DB::table('accounts as a')
            ->select('a.*', 'ttl.*', 'r.*',
                'p.prov_name as home_prov', 'm.mun_name as home_mun', 'b.brgy_name as home_brgy',
                'p1.prov_name as dorm_prov', 'm1.mun_name as dorm_mun', 'b1.brgy_name as dorm_brgy'
            )
            ->where('acc_id', $id)
            ->leftjoin('title as ttl', 'a.title', 'ttl.ttl_id')

            ->leftjoin('address as h', 'a.home_add_id', 'h.add_id')
            ->leftjoin('province as p', 'h.prov_code', 'p.prov_code')
            ->leftjoin('municipality as m', 'h.mun_code', 'm.mun_code')
            ->leftjoin('barangay as b', 'h.brgy_code', 'b.brgy_code')

            ->leftjoin('address as d', 'a.dorm_add_id', 'd.add_id')
            ->leftjoin('province as p1', 'd.prov_code', 'p1.prov_code')
            ->leftjoin('municipality as m1', 'd.mun_code', 'm1.mun_code')
            ->leftjoin('barangay as b1', 'd.brgy_code', 'b1.brgy_code')

            ->leftjoin('religion as r', 'a.religion', 'r.religion_id')

        ->first();

        return view('Admin.Accounts.EmployeeDetails')->with(['e'=>$acc]);
    }
}
