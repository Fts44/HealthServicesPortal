<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use DB;

class TestPDF extends Controller
{
    public function index(){

        $a = DB::table('announcement')
            ->where('anm_id', 1)
            ->first();

        $data = [

            'title' => 'Welcome to ItSolutionStuff.com',

            'date' => date('m/d/Y')

        ];

        $pdf = PDF::loadView('Errors.NoAccess', compact('a'));
        $pdf->set_paper(array(0, 0, 595, 841), 'portrait');
        $filename = 'test';

        return $pdf->stream($filename);

        // return view('Errors.NoAccess', compact('a'));
    }

    public function testing(Request $request){
        echo json_encode($request->all());
    }
}
