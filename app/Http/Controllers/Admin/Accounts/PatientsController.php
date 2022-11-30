<?php

namespace App\Http\Controllers\Admin\Accounts;

use App\Http\Controllers\PopulateSelectController as PopulateSelect;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PatientsController extends Controller
{
    public function index(){

        $patients = DB::table('accounts as acc')
            ->leftjoin('grade_level as gl', 'acc.gl_id', 'gl.gl_id')
            ->leftjoin('department as dept', 'acc.dept_id', 'dept.dept_id')
            ->leftjoin('program as prog', 'acc.prog_id', 'prog.prog_id')
            ->where('position', 'patient')
            ->where('is_verified', 1)
            // ->where('acc.gl_id', '!=', null)
            // ->where('acc.dept_id', '!=', null)
            // ->where('acc.prog_id', '!=', null)
            // ->where('acc.fd_id', '!=', null)
            ->get();

        // echo json_encode($patients);

        return view('Admin.Accounts.Patients')->with(
            'patients', $patients
        );
    }

    public function view_patient_details($id){
        
        $patient_details = DB::table('accounts as acc')
            ->select(
                'acc.*', 'gl.*', 'dept.*', 'prog.*', 

                'ec.*', 'mhpi.*', 'mha.*', 'mhmi.*', 'mhp.*', 'ad.*',
                'fd.*', 'fih.*',
                'ecadd.prov_code as ec_prov_code', 'ecadd.mun_code as ec_mun_code', 'ecadd.brgy_code as ec_brgy_code',
                'ecadd_rp.prov_name as ec_prov_name', 'ecadd_rm.mun_name as ec_mun_name', 'ecadd_rb.brgy_name as ec_brgy_name',
                
                'hadd.prov_code as home_prov_code', 'hadd.mun_code as home_mun', 'hadd.brgy_code as home_brgy',
                'hadd_rp.prov_name as home_prov_name', 'hadd_rm.mun_name as home_mun_name', 'hadd_rb.brgy_name as home_brgy_name',

                'badd.prov_code as home_prov_code', 'badd.mun_code as home_mun', 'badd.brgy_code as home_brgy',
                'badd_rp.prov_name as birth_prov_name', 'badd_rm.mun_name as birth_mun_name', 'badd_rb.brgy_name as birth_brgy_name',

                'dadd.prov_code as dorm_prov_code', 'dadd.mun_code as dorm_mun', 'dadd.brgy_code as dorm_brgy',
                'dadd_rp.prov_name as dorm_prov_name', 'dadd_rm.mun_name as dorm_mun_name', 'dadd_rb.brgy_name as dorm_brgy_name',
                'r.religion_name', 'dis.disability', 'ttl.ttl_title'
            )
            ->leftjoin('grade_level as gl', 'acc.gl_id', 'gl.gl_id')
            ->leftjoin('department as dept', 'acc.dept_id', 'dept.dept_id')
            ->leftjoin('program as prog', 'acc.prog_id', 'prog.prog_id')

            ->leftjoin('emergency_contact as ec', 'acc.ec_id', 'ec.ec_id')

            ->leftjoin('medical_history_past_illness as mhpi', 'acc.mhpi_id', 'mhpi.mhpi_id')
            ->leftjoin('medical_history_allergy as mha', 'acc.mha_id', 'mha.mha_id')
            ->leftjoin('medical_history_medical_immunization as mhmi', 'acc.mhmi_id', 'mhmi.mhmi_id')
            ->leftjoin('medical_history_pubertal as mhp', 'acc.mhp_id', 'mhp.mhp_id')

            ->leftjoin('family_details as fd', 'acc.fd_id', 'fd.fd_id')
            ->leftjoin('family_illness_history as fih', 'fd.fih_id', 'fih.fih_id')

            ->leftjoin('address as ecadd', 'ec.biz_add_id', 'ecadd.add_id')
            ->leftjoin('province as ecadd_rp', 'ecadd.prov_code', 'ecadd_rp.prov_code')
            ->leftjoin('municipality as ecadd_rm', 'ecadd.mun_code', 'ecadd_rm.mun_code')
            ->leftjoin('barangay as ecadd_rb', 'ecadd.brgy_code', 'ecadd_rb.brgy_code')

            ->leftjoin('address as hadd', 'acc.home_add_id', 'hadd.add_id')
            ->leftjoin('province as hadd_rp', 'hadd.prov_code', 'hadd_rp.prov_code')
            ->leftjoin('municipality as hadd_rm', 'hadd.mun_code', 'hadd_rm.mun_code')
            ->leftjoin('barangay as hadd_rb', 'hadd.brgy_code', 'hadd_rb.brgy_code')

            ->leftjoin('address as badd', 'acc.birth_add_id', 'badd.add_id')
            ->leftjoin('province as badd_rp', 'badd.prov_code', 'badd_rp.prov_code')
            ->leftjoin('municipality as badd_rm', 'badd.mun_code', 'badd_rm.mun_code')
            ->leftjoin('barangay as badd_rb', 'badd.brgy_code', 'badd_rb.brgy_code')

            ->leftjoin('address as dadd', 'acc.birth_add_id', 'dadd.add_id')
            ->leftjoin('province as dadd_rp', 'dadd.prov_code', 'dadd_rp.prov_code')
            ->leftjoin('municipality as dadd_rm', 'dadd.mun_code', 'dadd_rm.mun_code')
            ->leftjoin('barangay as dadd_rb', 'dadd.brgy_code', 'dadd_rb.brgy_code')

            ->leftjoin('assessment_diagnosis as ad', 'acc.ad_id', 'ad.ad_id')
            ->leftjoin('religion as r', 'acc.religion', 'r.religion_id')
            ->leftjoin('disability as dis', 'mhpi.mhpi_disability_specify', 'dis.dis_id')
            ->leftjoin('title as ttl', 'acc.title', 'ttl.ttl_id')
    
            ->where('acc_id', $id)
        ->first();

        $forms = DB::select("SELECT * FROM 
            ((SELECT f.form_id, f.form_date_created, f.form_date_updated, f.form_patient_id, f.form_editable, f.form_org_id, f.form_trans_id, 
            d.position as 'creator', t.ttl_title, d.firstname, d.middlename, d.lastname, dt.dt_name as 'form_type' 
            FROM `forms` as `f` 
            LEFT JOIN `accounts` as `d` 
            ON `f`.`form_created_by` = `d`.`acc_id` 
            LEFT JOIN `title` as `t` 
            ON `d`.`title` = `t`.`ttl_id` 
            LEFT JOIN `document_type` as `dt` 
            ON `f`.`form_type` = `dt`.`dt_id` 
            WHERE `f`.`form_patient_id` = '".$id."' 
            AND `f`.`form_editable` = 0) 
            UNION 
            (SELECT f.form_id, f.form_date_created, f.form_date_updated, f.form_patient_id, f.form_editable, f.form_org_id, f.form_trans_id, 
            d.position as 'creator', t.ttl_title, d.firstname, d.middlename, d.lastname, f.form_type 
            FROM `forms` as `f` 
            LEFT JOIN `accounts` as `d` 
            ON `f`.`form_created_by` = `d`.`acc_id` 
            LEFT JOIN `title` as `t` 
            ON `d`.`title` = `t`.`ttl_id` 
            WHERE `f`.`form_patient_id` = '".$id."' 
            AND `f`.`form_editable` = 1)) t
            ORDER BY t.form_date_created DESC"
        );  
        
        $documents = DB::table('patient_document as pd')
            ->leftjoin('document_type as dt', 'pd.dt_id', 'dt.dt_id')
            ->where('acc_id', $id)
            ->where('uploaded_by', $id)
            ->orderBy('pd.pd_date', 'DESC')
        ->get();

        $transactions = DB::select("SELECT t.*, GROUP_CONCAT(t1.FTID) AS 'attachments'
            FROM `transaction` t 
            LEFT JOIN ((SELECT f.*, CONCAT(f.form_type,'-',f.form_id,'-',f.form_org_id) AS 'FTID' 
                FROM `forms` f 
                WHERE f.form_editable=1) 
                UNION 
                (SELECT f.*, CONCAT(dt.dt_name,'-',f.form_id,'-',f.form_org_id) AS 'FTID' 
                FROM `forms` f 
                LEFT JOIN `document_type` dt 
                ON f.form_type=dt.dt_id 
                WHERE f.form_editable=0)) t1 
            ON t.trans_id=t1.`form_trans_id` 
            WHERE t.acc_id='".$id."' 
            GROUP BY t.trans_id 
            ORDER BY t.trans_date DESC;"
        );

        $dispense = DB::select("SELECT t.*, gn.imgn_generic_name, gn.imgn_id
            FROM `inventory_medicine_transaction` as t 
            LEFT JOIN `inventory_medicine_item` as i 
            ON t.imi_id=i.imi_id 
            LEFT JOIN `inventory_medicine_generic_name` as gn 
            ON i.imgn_id=gn.imgn_id
            WHERE t.acc_id='".$id."' 
            ORDER BY t.imt_date DESC"
        );

        $dm = DB::select("SELECT t.imgn_id, gn.imgn_generic_name, 
            (SUM(t.imi_quantity)-IFNULL((SELECT SUM(imt_quantity) FROM inventory_medicine_transaction WHERE imi_id=t.imi_id),0)) AS 'qty_available' 
            FROM `inventory_medicine_item` as t 
            LEFT JOIN `inventory_medicine_transaction` as i 
            ON t.imi_id = i.imt_id 
            LEFT JOIN `inventory_medicine_generic_name` as gn 
            ON t.imgn_id = gn.imgn_id 
            WHERE t.imi_status = 1 
            GROUP BY t.imgn_id 
            ORDER BY i.imt_date 
            DESC;"
        );

        $vdd = DB::table("vaccination_dose_details as vdd")
            ->where('acc_id', $id)
            ->leftjoin('covid_vaccination_brand as vb', 'vdd.vdd_brand_id', 'vb.cvb_id')
            ->leftjoin('province as p', 'vdd.vdd_prov_code', 'p.prov_code')
            ->leftjoin('municipality as m', 'vdd.vdd_mun_code', 'm.mun_code')
            ->orderBy('vdd_dose_number')
        ->get();

        
        $vs = DB::table("vaccination_status as vs")
            ->where('vs_id', $patient_details->vs_id)
        ->first();
        
        $coc = DB::table('chief_complain_category')
            ->orderBy('ccc_category')
        ->get();

        $document_type = DB::table('document_type')->get();

        $physician_details = DB::table('accounts as a')
            ->where('acc_id', Session('user_id'))
            ->leftjoin('title as ttl', 'a.title', 'ttl.ttl_id')
            ->first();



        $populate = new PopulateSelect;
        $provinces = $populate->province();
        $programs = $populate->program("all");

        return view('Admin.Accounts.PatientDetails')->with([
            'patient_details' => $patient_details,
            'documents' => $documents,
            'programs' => $programs,
            'forms' => $forms,
            'transactions' => $transactions,
            'dispense' => $dispense,
            'dm' => $dm,
            'document_type' => $document_type,
            'vdd' => $vdd,
            'vs' => $vs,
            'physician_details' => $physician_details,
            'coc' => $coc
        ]);

        
        echo json_encode($forms);
    }
}
