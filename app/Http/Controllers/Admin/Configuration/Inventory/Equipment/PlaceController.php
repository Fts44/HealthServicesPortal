<?php

namespace App\Http\Controllers\Admin\Configuration\Inventory\Equipment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PlaceController extends Controller
{
    public function index(){
        $ie_places = DB::table('inventory_equipment_place as iep')
            ->select('iep.*', 'iei_id')
            ->leftjoin('inventory_equipment_item as iei', 'iep.iep_id', 'iei.iep_id')
            ->groupBy('iep.iep_id')
            ->get();
        // echo json_encode($ie_places);
        return view('Admin.Configuration.Inventory.Equipment.Place')->with([
            'ie_places' => $ie_places
        ]);
    }

    public function insert(Request $request){
        // echo json_encode($request->all());

        $rules = [
            'place' => ['required', 'unique:inventory_equipment_place,iep_place'],
            'status' => ['required', 'in:0,1']
        ];
        
        $validator = validator::make($request->all(), $rules);
        
        if($validator->fails()){
            $response = [
                'title' => 'Error!',
                'message' => 'Equipment place not added.',
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
                DB::table('inventory_equipment_place')->insert([
                    'iep_place' => $request->place,
                    'iep_status' => $request->status 
                ]);

                $response = [
                    'title' => 'Success!',
                    'message' => 'Equipment place added',
                    'icon' => 'success',
                    'status' => 200
                ];

                return redirect(route('AdminConfigurationInventoryEquipmentPlace'))->with('status', $response);
            }
            catch(Exception $e){
                $response = [
                    'title' => 'Success!',
                    'message' => 'Equipment place not added.'.$e,
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
            'place' => ['required', 'unique:inventory_equipment_place,iep_place,'.$id.',iep_id'],
            'status' => ['required', 'in:0,1']
        ];
        
        $validator = validator::make($request->all(), $rules);
        
        if($validator->fails()){
            $response = [
                'title' => 'Error!',
                'message' => 'Equipment place not updated.',
                'icon' => 'error',
                'status' => 400,
                'action' => 'Update',
                'iep_id' => $id
            ];    
            return redirect()->back()
                ->with('status', $response)
                ->withErrors($validator)
                ->withInput($request->all());
        }
        else{
            try{
                DB::table('inventory_equipment_place')->where('iep_id', $id)->update([
                    'iep_place' => $request->place,
                    'iep_status' => $request->status 
                ]);
    
                $response = [
                    'title' => 'Success!',
                    'message' => 'Equipment place updated',
                    'icon' => 'success',
                    'status' => 200
                ];
    
                return redirect(route('AdminConfigurationInventoryEquipmentPlace'))->with('status', $response);
            }
            catch(Exception $e){
                $response = [
                    'title' => 'Success!',
                    'message' => 'Equipment place not updated.'.$e,
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
            DB::table('inventory_equipment_place')->where('iep_id', $id)->delete();

            $response = [
                'title' => 'Success!',
                'message' => 'Equipment place deleted',
                'icon' => 'success',
                'status' => 200
            ];

            return redirect(route('AdminConfigurationInventoryEquipmentPlace'))->with('status', $response);
        }
        catch(Exception $e){
            $response = [
                'title' => 'Error!',
                'message' => 'Equipment place not deleted'.$e,
                'icon' => 'error',
                'status' => 400
            ];

            return redirect(route('AdminConfigurationInventoryEquipmentPlace'))->with('status', $response);
        }
    }
}
