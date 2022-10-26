<?php

namespace App\Http\Controllers\Admin\Inventory\Equipment;

use App\Http\Controllers\Controller;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    public function index(){
        $item_details = DB::table('inventory_equipment_item_details as ieid')
            ->select('ieid.*', 'ien.*', 'iet.*', 'ieb.*')
            ->leftjoin('inventory_equipment_name as ien', 'ieid.ien_id', 'ien.ien_id')
            ->leftjoin('inventory_equipment_type as iet', 'ieid.iet_id', 'iet.iet_id')
            ->leftjoin('inventory_equipment_brand as ieb', 'ieid.ieb_id', 'ieb.ieb_id')
            ->orderBy('ien.ien_name', 'ASC')
            ->get();
    
        $places = DB::table('inventory_equipment_place')
            ->orderBy('iep_place', 'ASC')
            ->where('iep_place','!=','none')
            ->get();

        $inventory_items = DB::table('inventory_equipment_item as iei')
            ->select('iei.*', 'ieid.*', 'ien.*', 'iet.*', 'ieb.*', 'iep.*')
            ->leftjoin('inventory_equipment_item_details as ieid', 'iei.ieid_id', 'ieid.ieid_id')
            ->leftjoin('inventory_equipment_name as ien', 'ieid.ien_id', 'ien.ien_id')
            ->leftjoin('inventory_equipment_type as iet', 'ieid.iet_id', 'iet.iet_id')
            ->leftjoin('inventory_equipment_brand as ieb', 'ieid.ieb_id', 'ieb.ieb_id')
            ->leftjoin('inventory_equipment_place as iep', 'iei.iep_id', 'iep.iep_id')
            ->where('is_deleted', '0')
            ->get();
        // echo json_encode($inventory_items);
        return view('Admin.Inventory.Equipment.Item')
            ->with([
                'inventory_items' => $inventory_items,
                'item_details' => $item_details,
                'places' => $places
            ]);
    }

    public function insert(Request $request){
        // echo json_encode($request->all());

        $rules = [
            'item' => ['required'],
            'quantity' => ['required', 'numeric', 'min:1', 'max:10'], 
            'date_added' => ['required'],
            'condition' => ['required'],
            'place' => ['required'],
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
            try{
                $item = [];
                $status = [];
                for($i=0; $i<$request->quantity; $i++){
                    array_push($item, [
                        'iei_qty' => 1,
                        'iei_condition' => $request->condition,
                        'iei_date_added' => $request->date_added,
                        'ieid_id' => $request->item,
                        'iep_id' => $request->place,
                    ]);
                }

                // insert item and get their ids
                foreach($item as $key => $value){
                    $newId = DB::table('inventory_equipment_item')->insertGetId($item[$key]);

                    DB::table('inventory_equipment_update_condition')->insert([
                        'ieuc_id' => (date_format(new DateTime($request->date_added),'Y-m'))."-".$newId."-".$request->place,
                        'ieuc_date' => date_format(new DateTime($request->date_added),'Y-m-d'),
                        'ieuc_to_condition' => $request->condition,
                        'ieuc_from_condition' => $request->condition,
                        'iep_id' => $request->place,
                        'iei_id' => $newId
                    ]);
                }
               
                $response = [
                    'title' => 'Success!',
                    'message' => 'Equipment item added.',
                    'icon' => 'success',
                    'status' => 200
                ];    

                return redirect(route('AdminInventoryEquipmentItem'))->with('status', $response);
            }
            catch(Exception $e){
                $response = [
                    'title' => 'Error!',
                    'message' => 'Equipment item not added.'.$e,
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
            'item' => ['required'],
            'quantity' => ['required', 'numeric'], 
            'date_added' => ['required', 'date'],
            'date_condition_update' => ['required', 'date','after:date_added'],
            'condition' => ['required'],
            'place' => ['required'],
        ];

        $validator = validator::make($request->all(), $rules);

        if($validator->fails()){
            $response = [
                'title' => 'Error!',
                'message' => 'Equipment item not updated.',
                'icon' => 'error',
                'status' => 400,
                'action' => 'Update',
                'iei_id' => $id
            ];    
            return redirect()->back()
                ->with('status', $response)
                ->withErrors($validator)
                ->withInput($request->all());
        }
        else{
            try{
                $item = DB::table('inventory_equipment_item')->where('iei_id', $id)->first();
                $condition = DB::table('inventory_equipment_update_condition')->where('ieuc_id', (date_format(new DateTime($request->date_condition_update),'Y-m'))."-".$id."-".$request->place)->first();
                
                DB::table('inventory_equipment_item')->where('iei_id', $id)->update([
                    'iei_qty' => $request->quantity,
                    'iei_condition' => $request->condition,
                    'iei_date_added' => $request->date_added,
                    'ieid_id' => $request->item,
                    'iep_id' => $request->place
                ]);

                if($condition){
                    DB::table('inventory_equipment_update_condition')->where('ieuc_id', (date_format(new DateTime($request->date_condition_update),'Y-m'))."-".$id."-".$request->place)->update([
                        'ieuc_date' => date_format(new DateTime($request->date_condition_update),'Y-m-d'),
                        'ieuc_to_condition' => $request->condition,
                        'ieuc_from_condition' => $item->iei_condition,
                        'iep_id' => $request->place,
                        'iei_id' => $id
                    ]);
                }
                else{
                    DB::table('inventory_equipment_update_condition')->insert([
                        'ieuc_id' => (date_format(new DateTime($request->date_condition_update),'Y-m'))."-".$id."-".$request->place, 
                        'ieuc_date' => date_format(new DateTime($request->date_condition_update),'Y-m-d'),
                        'ieuc_to_condition' => $request->condition,
                        'ieuc_from_condition' => $item->iei_condition,
                        'iep_id' => $request->place,
                        'iei_id' => $id
                    ]);
                }
                
                
                $response = [
                    'title' => 'Success!',
                    'message' => 'Equipment item updated.',
                    'icon' => 'success',
                    'status' => 200
                ];   
                
                $response = [
                    'title' => 'Success!',
                    'message' => 'Equipment item updated.',
                    'icon' => 'success',
                    'status' => 200
                ];    
                return redirect(route('AdminInventoryEquipmentItem'))->with('status', $response);
            }
            catch(Exception $e){
                $response = [
                    'title' => 'Error!',
                    'message' => 'Equipment item not updated.'.$e,
                    'icon' => 'error',
                    'status' => 400,
                    'action' => 'Update'
                ];    
                return redirect()->back()
                    ->with('status', $response)
                    ->withErrors($validator)
                    ->withInput($request->all());
            }
        }
    }

    public function delete($id){
        $item_details = DB::table('inventory_equipment_item')
            ->where('iei_id', $id)
            ->first();

        $is_exist_on_logs = DB::select("SELECT * FROM `inventory_equipment_update_condition`
            WHERE `iei_id` = '".$id."' AND MONTH(`ieuc_date`) != MONTH('".$item_details->iei_date_added."')");

        echo json_encode($is_exist_on_logs);
        
        try{
            if($is_exist_on_logs){
                DB::table('inventory_equipment_item')->where('iei_id', $id)->update([
                    'is_deleted' => '1'
                ]);

                DB::table('inventory_equipment_update_condition')->insert([
                    'ieuc_id' => ((string)date('Y-m'))."-".$id."-".$item_details->iep_id,
                    'ieuc_date' => date('Y-m-d'),
                    'ieuc_to_condition' => $item_details->iei_condition,
                    'ieuc_from_condition' => $item_details->iei_condition,
                    'iep_id' => $item_details->iep_id,
                    'iei_id' => $id,
                    'is_deleted' => '1'
                ]);
            }
            else{
                DB::table('inventory_equipment_item')->where('iei_id', $id)->delete();
                DB::table('inventory_equipment_update_condition')->where('iei_id', $id)->delete();
            }
            
            $response = [
                'title' => 'Success!',
                'message' => 'Equipment item deleted',
                'icon' => 'success',
                'status' => 200
            ];

            return redirect(route('AdminInventoryEquipmentItem'))->with('status', $response);
        }
        catch(Exception $e){
            $response = [
                'title' => 'Error!',
                'message' => 'Equipment item not deleted'.$e,
                'icon' => 'error',
                'status' => 400
            ];

            return redirect()->back()->with('status', $response);
        }
    }
}
