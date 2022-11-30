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

    public function covid_vaccination_brand(){
        $covid_vaccination_brands = DB::table('covid_vaccination_brand')
            ->get();
        
        return $covid_vaccination_brands;
    }

    public function medicine($imgn_id){
        $medicine = DB::select("SELECT t.imi_id, ((SUM(t.imi_quantity))-(IF(ISNULL(SUM(i.imt_quantity)),0,(SUM(i.imt_quantity))))) AS 'qty', DATE_FORMAT(t.imi_expiration, '%b %d, %Y') AS 'imi_expiration'
            FROM `inventory_medicine_item` as t 
            LEFT JOIN `inventory_medicine_transaction` as i 
            ON t.imi_id=i.imi_id
            WHERE t.imgn_id='".$imgn_id."' 
            AND t.imi_status = 1
            GROUP BY t.imi_id
            ORDER BY ABS( DATEDIFF( `t`.`imi_expiration`, NOW() ) )"
        );
        
        return $medicine; 
    }

    public function medicine_qty($imi_id){
        $qty = DB::select("SELECT ((i.imi_quantity)-(IF(ISNULL(SUM(t.imt_quantity)),0,(SUM(t.imt_quantity))))) AS 'qty', i.imi_id
            FROM `inventory_medicine_item` as i 
            LEFT JOIN `inventory_medicine_transaction` as t 
            ON i.imi_id = t.imi_id 
            WHERE i.imi_id='".$imi_id."' 
            GROUP BY i.imi_id"
        );

        return $qty;
    }
}
