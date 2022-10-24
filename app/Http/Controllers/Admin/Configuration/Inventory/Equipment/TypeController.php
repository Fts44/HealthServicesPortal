<?php

namespace App\Http\Controllers\Admin\Configuration\Inventory\Equipment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class TypeController extends Controller
{

    public function index(){
        $ie_types = DB::table('inventory_equipment_type as iet')
            ->select('iet.*', 'ieid.ieid_id')
            ->leftjoin('inventory_equipment_item_details as ieid', 'iet.iet_id', 'ieid.iet_id')
            ->groupBy('iet.iet_id')
            ->get();

        // echo json_encode($ie_types);
        return view('Admin.Configuration.Inventory.Equipment.Type')->with([
            'ie_types' => $ie_types
        ]);
    }

    public function insert(Request $request){

        // echo json_encode($request->all());

        $rules = [
            'type' => ['required', 'unique:inventory_equipment_type,iet_type'],
            'status' => ['required', 'in:0,1']
        ];
        
        $validator = validator::make($request->all(), $rules);
        
        if($validator->fails()){
            $response = [
                'title' => 'Success!',
                'message' => 'Equipment type not added.',
                'icon' => 'error',
                'status' => 400,
                'action' => 'Add'
            ];    
            return redirect()->back()
                ->with('status', $response)
                ->withErrors($validator)
                ->withInput($request->all());
        }
        else{
            try{
                DB::table('inventory_equipment_type')->insert([
                    'iet_type' => $request->type,
                    'iet_status' => $request->status 
                ]);

                $response = [
                    'title' => 'Success!',
                    'message' => 'Equipment type added',
                    'icon' => 'success',
                    'status' => 200
                ];

                return redirect(route('AdminConfigurationInventoryEquipmentType'))->with('status', $response);
            }
            catch(Exception $e){
                $response = [
                    'title' => 'Success!',
                    'message' => 'Equipment type not added.'.$e,
                    'icon' => 'error',
                    'status' => 400,
                    'action' => 'Add'
                ];    
                return redirect()->back()
                    ->with('status', $response)
                    ->withErrors($validator)
                    ->withInput($request->all());
            }
        }
    }

    public function update(Request $request, $id){
        $rules = [
            'type' => ['required', 'unique:inventory_equipment_type,iet_type,'.$id.',iet_id'],
            'status' => ['required', 'in:0,1']
        ];
        
        $validator = validator::make($request->all(), $rules);
        
        if($validator->fails()){
            $response = [
                'title' => 'Error!',
                'message' => 'Equipment type not updated.',
                'icon' => 'error',
                'status' => 400,
                'action' => 'Update',
                'iet_id' => $id
            ];    
            return redirect()->back()
                ->with('status', $response)
                ->withErrors($validator)
                ->withInput($request->all());
        }
        else{
            try{
                DB::table('inventory_equipment_type')->where('iet_id', $id)->update([
                    'iet_type' => $request->type,
                    'iet_status' => $request->status 
                ]);
    
                $response = [
                    'title' => 'Success!',
                    'message' => 'Equipment type updated',
                    'icon' => 'success',
                    'status' => 200
                ];
    
                return redirect(route('AdminConfigurationInventoryEquipmentType'))->with('status', $response);
            }
            catch(Exception $e){
                $response = [
                    'title' => 'Success!',
                    'message' => 'Equipment type not updated.'.$e,
                    'icon' => 'error',
                    'status' => 400,
                    'action' => 'Add'
                ];    
                return redirect()->back()
                    ->with('status', $response)
                    ->withErrors($validator)
                    ->withInput($request->all());
            }
        }
    }

    public function delete($id){
        try{
            DB::table('inventory_equipment_type')->where('iet_id', $id)->delete();

            $response = [
                'title' => 'Success!',
                'message' => 'Equipment type deleted',
                'icon' => 'success',
                'status' => 200
            ];

            return redirect(route('AdminConfigurationInventoryEquipmentType'))->with('status', $response);
        }
        catch(Exception $e){
            $response = [
                'title' => 'Error!',
                'message' => 'Equipment type not deleted'.$e,
                'icon' => 'error',
                'status' => 400
            ];

            return redirect()->back()->with('status', $response);
        }
    }
}
