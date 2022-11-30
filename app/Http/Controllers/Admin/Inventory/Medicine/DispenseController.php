<?php

namespace App\Http\Controllers\Admin\Inventory\Medicine;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;

class DispenseController extends Controller
{
    public function dispense(Request $request, $acc_id){
        $rules = [
            'medicine' => ['required'],
            'medicine_id' => ['required'],
            'qty_available' => ['required'],
            'qty_to_dispense' => ['required', 'lte:qty_available', 'gt:0'],
        ];

        $messages = [
            'qty_to_dispense.lte' => 'The qty must be less than or equal '.$request->qty_available,
            'qty_to_dispense.gt' => 'The qty must be greater than 0',
        ];

        $validator = validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            $response = [
                'title' => 'Error!',
                'message' => 'Medicine item not updated.',
                'icon' => 'error',
                'status' => 400,
                'errors' => $validator->messages()
            ]; 
        }
        else{
            try{
                DB::table('inventory_medicine_transaction')->insert([
                    'acc_id' => $acc_id,
                    'imt_type' => 'dispense',
                    'imt_quantity' => $request->qty_to_dispense,
                    'imi_id' => $request->medicine_id 
                ]);

                $response = [
                    'title' => 'Success!',
                    'message' => 'Medicine item dispensed.',
                    'icon' => 'success',
                    'status' => 200,
                ]; 
            }
            catch(Exception $e){
                $response = [
                    'title' => 'Failed!',
                    'message' => 'Medicine item not dispensed.',
                    'icon' => 'error',
                    'status' => 400
                ]; 
            }
        }
        echo json_encode($response);
    }

    public function update_dispense(Request $request, $imt_id){
        $rules = [
            'medicine' => ['required'],
            'medicine_id' => ['required'],
            'qty_available' => ['required'],
            'max_dispense_qty' => ['required'],
            'qty_to_dispense' => ['required', 'lte:max_dispense_qty', 'gt:0'],
        ];

        $messages = [
            'qty_to_dispense.lte' => 'The qty must be less than or equal '.$request->max_dispense_qty,
            'qty_to_dispense.gt' => 'The qty must be greater than 0',
        ];

        $validator = validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            $response = [
                'title' => 'Error!',
                'message' => 'Medicine item not updated.',
                'icon' => 'error',
                'status' => 400,
                'errors' => $validator->messages()
            ]; 
        }
        else{
            try{
                DB::table('inventory_medicine_transaction')->where('imt_id', $imt_id)->update([
                    'imt_type' => 'dispense',
                    'imt_quantity' => $request->qty_to_dispense,
                    'imi_id' => $request->medicine_id 
                ]);

                $response = [
                    'title' => 'Success!',
                    'message' => 'Medicine item dispensed.',
                    'icon' => 'success',
                    'status' => 200,
                ]; 
            }
            catch(Exception $e){
                $response = [
                    'title' => 'Failed!',
                    'message' => 'Medicine item not dispensed.',
                    'icon' => 'error',
                    'status' => 400
                ]; 
            }
        }
        echo json_encode($response);
    }
}
