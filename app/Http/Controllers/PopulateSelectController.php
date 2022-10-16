<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PopulateSelectController extends Controller
{
    public function province(){
        $provinces = DB::table('province')
        ->orderBy('prov_name','ASC')
        ->get();
        return $provinces;
    }

    public function municipality($prov_code){     
        if($prov_code == 'all'){
            $municipalities = DB::table('municipality')
            ->orderBy('mun_name','ASC')
            ->get();
        }
        else{
            $municipalities = DB::table('municipality')
            ->where('prov_code','=',$prov_code)
            ->orderBy('mun_name','ASC')
            ->get();
        }
        return $municipalities;
    }

    public function barangay($mun_code){
        if($mun_code == 'all'){
            $barangays = DB::table('barangay')
            ->orderBy('brgy_name','ASC')
            ->get();
        }
        else{
            $barangays = DB::table('barangay')
            ->where('mun_code','=',$mun_code)
            ->orderBy('brgy_name','ASC')
            ->get();
        }
        return $barangays;
    }

    public function grade_level(){
        $grade_levels = DB::table('grade_level')
        ->get();

        return $grade_levels;
    }

    public function department($gl_id){
        $departments = DB::table('department')
        ->where('gl_id', $gl_id)
        ->orderBy('dept_code','ASC')
        ->get();

        return $departments;
    }

    public function program($dept_id){
        if($dept_id=="all"){
            $programs = DB::table('program')
            ->orderBy('prog_code','ASC')
            ->get();
        }
        else{
            $programs = DB::table('program')
            ->orderBy('prog_code','ASC')
            ->where('dept_id', $dept_id)->get();
        }
        return $programs;
    }

    public function religion(){
        $grade_levels = DB::table('religion')
        ->get();

        return $grade_levels;
    }
}
