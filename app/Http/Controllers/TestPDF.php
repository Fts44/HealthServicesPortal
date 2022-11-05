<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use DB;

class TestPDF extends Controller
{
    public function index(){
        $data = [

            'title' => 'Welcome to ItSolutionStuff.com',

            'date' => date('m/d/Y')

        ];

        $pdf = PDF::loadView('Errors.NoAccess');
        $pdf->set_paper(array(0, 0, 595, 841), 'portrait');
        $filename = 'test';

        return $pdf->stream($filename);


    }

    public function testing(Request $request){
        echo json_encode($request->all());
    }
}
