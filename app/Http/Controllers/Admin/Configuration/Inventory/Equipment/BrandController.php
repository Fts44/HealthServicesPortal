<?php

namespace App\Http\Controllers\Admin\Configuration\Inventory\Equipment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    public function index(){
        $ie_brands = DB::table('inventory_equipment_brand as ieb')
            ->select('ieb.*', 'ieid.ieid_id')
            ->leftjoin('inventory_equipment_item_details as ieid', 'ieb.ieb_id', 'ieid.ieb_id')
            ->groupBy('ieb.ieb_id')
            ->get();
        // echo json_encode($ie_brands);
        return view('Admin.Configuration.Inventory.Equipment.Brand')->with([
            'ie_brands' => $ie_brands
        ]);
    }

    public function insert(Request $request){

        // echo json_encode($request->all());

        $rules = [
            'brand' => ['required', 'unique:inventory_equipment_brand,ieb_brand'],
            'status' => ['required', 'in:0,1']
        ];
        
        $validator = validator::make($request->all(), $rules);
        
        if($validator->fails()){
            $response = [
                'title' => 'Success!',
                'message' => 'Equipment brand not added.',
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
                DB::table('inventory_equipment_brand')->insert([
                    'ieb_brand' => $request->brand,
                    'ieb_status' => $request->status 
                ]);

                $response = [
                    'title' => 'Success!',
                    'message' => 'Equipment brand added',
                    'icon' => 'success',
                    'status' => 200
                ];

                return redirect(route('AdminConfigurationInventoryEquipmentBrand'))->with('status', $response);
            }
            catch(Exception $e){
                $response = [
                    'title' => 'Success!',
                    'message' => 'Equipment brand not added.'.$e,
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
            'brand' => ['required', 'unique:inventory_equipment_brand,ieb_brand,'.$id.',ieb_id'],
            'status' => ['required', 'in:0,1']
        ];
        
        $validator = validator::make($request->all(), $rules);
        
        if($validator->fails()){
            $response = [
                'title' => 'Error!',
                'message' => 'Equipment name not updated.',
                'icon' => 'error',
                'status' => 400,
                'action' => 'Update',
                'ien_id' => $id
            ];    
            return redirect()->back()
                ->with('status', $response)
                ->withErrors($validator)
                ->withInput($request->all());
        }
        else{
            try{
                DB::table('inventory_equipment_brand')->where('ieb_id', $id)->update([
                    'ieb_brand' => $request->brand,
                    'ieb_status' => $request->status 
                ]);

                $response = [
                    'title' => 'Success!',
                    'message' => 'Equipment Brand updated',
                    'icon' => 'success',
                    'status' => 200
                ];

                return redirect(route('AdminConfigurationInventoryEquipmentBrand'))->with('status', $response);
            }
            catch(Exception $e){
                $response = [
                    'title' => 'Success!',
                    'message' => 'Equipment brand not updated.'.$e,
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
            DB::table('inventory_equipment_brand')->where('ieb_id', $id)->delete();

            $response = [
                'title' => 'Success!',
                'message' => 'Equipment brand deleted',
                'icon' => 'success',
                'status' => 200
            ];

            return redirect(route('AdminConfigurationInventoryEquipmentBrand'))->with('status', $response);
        }
        catch(Exception $e){
            $response = [
                'title' => 'Error!',
                'message' => 'Equipment brand not deleted'.$e,
                'icon' => 'error',
                'status' => 400
            ];

            return redirect()->back()->with('status', $response);
        }
    }
}
