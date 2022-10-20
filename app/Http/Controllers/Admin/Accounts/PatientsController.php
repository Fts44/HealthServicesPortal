<?php

namespace App\Http\Controllers\Admin\Accounts;

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
}
