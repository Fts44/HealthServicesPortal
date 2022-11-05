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
                'r.religion_name', 'dis.disability'
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

            ->where('acc_id', $id)
            ->first();
        
            $documents = DB::table('patient_document as pd')
                ->leftjoin('document_type as dt', 'pd.dt_id', 'dt.dt_id')
                ->where('acc_id', $id)
                ->get();

            $populate = new PopulateSelect;
            $provinces = $populate->province();
            $programs = $populate->program("all");

        $forms = DB::table('forms as f')
            ->select('f.*', 'd.position as creator')
            ->leftjoin('accounts as d', 'f.form_created_by', 'd.acc_id')
            ->get();
            
        // echo json_encode($forms);

        return view('Admin.Accounts.PatientDetails')->with([
            'patient_details' => $patient_details,
            'documents' => $documents,
            'programs' => $programs,
            'forms' => $forms
        ]);
    }
}
