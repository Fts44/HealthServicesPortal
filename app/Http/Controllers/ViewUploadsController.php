<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ViewUploadsController extends Controller
{
    public function view($pd_id){

        $doc_details = DB::table('patient_document')->where('pd_id',$pd_id)->first();

        if(str_contains($doc_details->pd_sys_filename,'.pdf')){
            return view('Reports.ViewUploads.PDF', compact('doc_details'));
        }
        else if(str_contains($doc_details->pd_sys_filename,'.jpg')){
            return view('Reports.ViewUploads.Image', compact('doc_details'));
        }
        else{
            echo "Unsupported File!";
        }
    }
}
