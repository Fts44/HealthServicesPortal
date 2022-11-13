<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class AnnouncementController extends Controller
{
    public function index(){

        $announcements = DB::table('announcement as anm')
            ->select('anm.*', 'acc.position', 'acc.firstname')
            ->leftjoin('accounts as acc', 'anm.anm_creator_id', 'acc.acc_id')
            // ->where('anm_active_until', '>=', date("Y-m-d"))
            ->paginate(3);

        return view('Admin.Announcement')
            ->with([
                'announcements' => $announcements
            ]);
    }

    public function insert(Request $request){

        $rules = [
            "active_until" => ['required', 'date'],
            "title" => ['required'],
            "body" => ['required']
        ];

        $validator = validator::make($request->all(), $rules);

        if($validator->fails()){
            $response = [
                'title' => 'Error!',
                'message' => 'Announcment not added.',
                'icon' => 'error',
                'status' => 400,
                'errors' => $validator->messages()
            ];
        }
        else{

            try{
                DB::table('announcement')->insert([
                    'anm_title' => $request->title,
                    'anm_body' => $request->body,
                    'anm_active_until' => $request->active_until,
                    'anm_created_at' => date("Y-m-d"),
                    'anm_creator_id' => Session('user_id')
                ]);
    
                $response = [
                    'title' => 'Success!',
                    'message' => 'Announcment added.',
                    'icon' => 'success',
                    'status' => 200
                ];
            }
            catch(Exception $e){
                $response = [
                    'title' => 'Error!',
                    'message' => 'Announcment not added.'.$e,
                    'icon' => 'error',
                    'status' => 400
                ];
            }
            
        }

        echo json_encode($response);
    }

    public function update(Request $request){

        $rules = [
            "id" => ['required'],
            "active_until" => ['required', 'date'],
            "title" => ['required'],
            "body" => ['required']
        ];

        $validator = validator::make($request->all(), $rules);

        if($validator->fails()){
            $response = [
                'title' => 'Error!',
                'message' => 'Announcment not added.',
                'icon' => 'error',
                'status' => 400,
                'errors' => $validator->messages()
            ];
        }
        else{

            try{
                DB::table('announcement')->where('anm_id', $request->id)->update([
                    'anm_title' => $request->title,
                    'anm_body' => $request->body,
                    'anm_active_until' => $request->active_until,
                    'anm_creator_id' => Session('user_id')
                ]);
    
                $response = [
                    'title' => 'Success!',
                    'message' => 'Announcment updated.',
                    'icon' => 'success',
                    'status' => 200
                ];
            }
            catch(Exception $e){
                $response = [
                    'title' => 'Error!',
                    'message' => 'Announcment not updated.'.$e,
                    'icon' => 'error',
                    'status' => 400
                ];
            }
            
        }

        echo json_encode($response);
    }

    public function delete(Request $request, $id){

        try{
            DB::table('announcement')
                ->where('anm_id', $id)
                ->delete();

            $response = [
                'title' => 'Success!',
                'message' => 'Announcment deleted.',
                'icon' => 'success',
                'status' => 200
            ];
        }
        catch(Exception $e){
            $response = [
                'title' => 'Failed!',
                'message' => 'Announcment not deleted.'.$e,
                'icon' => 'error',
                'status' => 400
            ];
        }

        echo json_encode($response);
    }
}
