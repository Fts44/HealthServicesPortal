<?php

namespace App\Http\Controllers\Admin\Configuration\Inventory\Equipment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    public function index(){
        $ieid_details = DB::table('inventory_equipment_item_details as ieid')
            ->select('ieid.*', 'ien.*', 'iet.*', 'ieb.*', 'iei.iei_id')
            ->leftjoin('inventory_equipment_name as ien', 'ieid.ien_id', 'ien.ien_id')
            ->leftjoin('inventory_equipment_type as iet', 'ieid.iet_id', 'iet.iet_id')
            ->leftjoin('inventory_equipment_brand as ieb', 'ieid.ieb_id', 'ieb.ieb_id')
            ->leftjoin('inventory_equipment_item as iei', 'ieid.ieid_id', 'iei.ieid_id')
            ->groupBy('ieid.ieid_id')
            ->get();
        $ien_names = DB::table('inventory_equipment_name')->orderBy('ien_name', 'ASC')->get();
        $iet_types = DB::table('inventory_equipment_type')->orderBy('iet_type', 'ASC')->get();
        $ieb_brands = DB::table('inventory_equipment_brand')->orderBy('ieb_brand', 'ASC')->get();
        $iep_places = DB::table('inventory_equipment_place')->orderBy('iep_place', 'ASC')->get();

        return view('Admin.Configuration.Inventory.Equipment.Item')
            ->with([
                'ieid_details' => $ieid_details,
                'ien_names' => $ien_names,
                'iet_types' => $iet_types,
                'ieb_brands' => $ieb_brands,
                'iep_places' => $iep_places
            ]);
    }

    public function insert(Request $request){
        $rules = [
            'name' => ['required'],
            'unit' => ['required'],
            'type' => ['required'],
            'brand' => ['required'],
            'category' => ['required'],
            'status' => ['required']
        ];

        $validator = validator::make($request->all(), $rules);

        if($validator->fails()){
            $response = [
                'title' => 'Error!',
                'message' => 'Equipment item not added.',
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

            $is_duplicate = DB::table('inventory_equipment_item_details')
                ->where('ieid_unit', $request->unit)
                ->where('ieid_category', $request->category)
                ->where('ieid_status', $request->status)
                ->where('ien_id', $request->name)
                ->where('ieb_id', $request->brand)
                ->where('iet_id', $request->type)
                ->first();

            if($is_duplicate){
                $response = [
                    'title' => 'Error!',
                    'message' => 'Equipment item not added.',
                    'icon' => 'error',
                    'status' => 400,
                    'action' => 'Add'
                ];    
                return redirect()->back()
                    ->with('status', $response)
                    ->withErrors([
                        'name' => 'Duplicate record found!'
                    ])
                    ->withInput($request->all());
            }
            else{
                try{    
                    DB::table('inventory_equipment_item_details')->insert([
                        'ieid_unit' => $request->unit,
                        'ieid_category' => $request->category,
                        'ieid_status' => $request->status,
                        'ien_id' => $request->name,
                        'ieb_id' => $request->brand,
                        'iet_id' => $request->type
                    ]);
    
                    $response = [
                        'title' => 'Success!',
                        'message' => 'Equipment item details added.',
                        'icon' => 'success',
                        'status' => 200,
                        'action' => 'Add'
                    ];    
                    return redirect(route('AdminConfigurationInventoryEquipmentItem'))->with('status', $response);
                }
                catch(Exception $e){
                    $response = [
                        'title' => 'Error!',
                        'message' => 'Equipment item details not added.'.$e,
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
    }

    public function update(Request $request, $id){
        $rules = [
            'name' => ['required'],
            'unit' => ['required'],
            'type' => ['required'],
            'brand' => ['required'],
            'category' => ['required'],
            'status' => ['required']
        ];

        $validator = validator::make($request->all(), $rules);

        if($validator->fails()){
            $response = [
                'title' => 'Error!',
                'message' => 'Equipment item not updated.',
                'icon' => 'error',
                'status' => 400,
                'action' => 'Update',
                'ieid_id' => $id
            ];    
            return redirect()->back()
                ->with('status', $response)
                ->withErrors($validator)
                ->withInput($request->all());
        }
        else{

            $is_duplicate = DB::table('inventory_equipment_item_details')
                ->where('ieid_unit', $request->unit)
                ->where('ieid_category', $request->category)
                ->where('ieid_status', $request->status)
                ->where('ien_id', $request->name)
                ->where('ieb_id', $request->brand)
                ->where('iet_id', $request->type)
                ->first();

            if($is_duplicate){
                $response = [
                    'title' => 'Error!',
                    'message' => 'Equipment item not added.',
                    'icon' => 'error',
                    'status' => 400,
                    'action' => 'Add'
                ];    
                return redirect()->back()
                    ->with('status', $response)
                    ->withErrors([
                        'name' => 'Duplicate record found!'
                    ])
                    ->withInput($request->all());
            }
            else{   
                try{
                    DB::table('inventory_equipment_item_details')->where('ieid_id', $id)->update([
                        'ieid_unit' => $request->unit,
                        'ieid_category' => $request->category,
                        'ieid_status' => $request->status,
                        'ien_id' => $request->name,
                        'ieb_id' => $request->brand,
                        'iet_id' => $request->type
                    ]);

                    $response = [
                        'title' => 'Success!',
                        'message' => 'Equipment item details updated.',
                        'icon' => 'success',
                        'status' => 200,
                        'action' => 'Update'
                    ];    
                    return redirect(route('AdminConfigurationInventoryEquipmentItem'))->with('status', $response);
                }
                catch(Exception $e){
                    $response = [
                        'title' => 'Error!',
                        'message' => 'Equipment item details not updated.'.$e,
                        'icon' => 'error',
                        'status' => 400,
                        'action' => 'update',
                        'ieid_id' => $id
                    ];    
                    return redirect()->back()
                        ->with('status', $response)
                        ->withErrors($validator)
                        ->withInput($request->all());
                }
            }
        }
    }

    public function delete($id){

        try{
            DB::table('inventory_equipment_item_details')->where('ieid_id', $id)->delete();

            $response = [
                'title' => 'Success!',
                'message' => 'Equipment name deleted',
                'icon' => 'success',
                'status' => 200
            ];

            return redirect(route('AdminConfigurationInventoryEquipmentItem'))->with('status', $response);
        }
        catch(Exception $e){
            $response = [
                'title' => 'Error!',
                'message' => 'Equipment name not deleted'.$e,
                'icon' => 'error',
                'status' => 400
            ];

            return redirect()->back()->with('status', $response);
        }
    }
}
