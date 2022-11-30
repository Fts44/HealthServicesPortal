<?php

namespace App\Http\Controllers\Forms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class FormController extends Controller
{
    public function attach($trans_id, $form_id){
        
        try{    
            DB::table('forms')->where('form_id', $form_id)
                ->update([
                    'form_trans_id' => $trans_id
            ]);

            $response = [
                'status' => 200,
                'title' => 'Success',
                'message' => 'Records added!',
                'icon' => 'success'
            ];
        }
        catch(Exception $e){
            $response = [
                'status' => 400,
                'title' => 'Failed',
                'message' => 'Records not added!',
                'icon' => 'error'
            ];
        }
        echo json_encode($response);
    }

    public function remove($form_id){
        try{    
            DB::table('forms')->where('form_id', $form_id)
                ->update([
                    'form_trans_id' => ''
            ]);

            $response = [
                'status' => 200,
                'title' => 'Success',
                'message' => 'Records removed!',
                'icon' => 'success'
            ];
        }
        catch(Exception $e){
            $response = [
                'status' => 400,
                'title' => 'Failed',
                'message' => 'Records not removed!',
                'icon' => 'error'
            ];
        }
        echo json_encode($response);
    }
}
