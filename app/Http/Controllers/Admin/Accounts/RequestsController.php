<?php

namespace App\Http\Controllers\Admin\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RequestsController extends Controller
{
    public function index(){
        $accounts = DB::table('accounts')
            ->where('is_verified', '0')
            ->where('position', '!=', 'admin')
            ->orderBy('created_at', 'DESC')
            ->get();

        // echo json_encode($accounts);
        return view('Admin.Accounts.Requests')
            ->with('accounts', $accounts);
    }

    public function verify_acc(Request $request, $id){
        echo $id;
        try{
            DB::table('accounts')
                ->where('acc_id', $id)
                ->update([
                    'is_verified' => 1
                ]);

            $response = [
                'title' => 'Success!',
                'message' => 'Account verified.',
                'icon' => 'success',
                'status' => 200
            ];
            $response = json_encode($response);
            // 'AdminAccountsRequests'
            return redirect(route('admin'))
                ->with('status', $response);
        }
        catch(Exception $e){
            $response = [
                'title' => 'Failed!',
                'message' => 'Account not verified.'.$e,
                'icon' => 'error',
                'status' => 400
            ];
            $response = json_encode($response);
            return redirect(route('admin'))
                ->with('status', $response);
        }
    }

    public function delete_acc(Request $request, $id){
        try{
            DB::table('accounts')
                ->where('acc_id', $id)
                ->delete();
            
            $response = [
                'title' => 'Success!',
                'message' => 'Account deleted.',
                'icon' => 'success',
                'status' => 200
            ];
            $response = json_encode($response);
        // 'AdminAccountsRequests'
            return redirect(route('admin'))
                ->with('status', $response);
        }
        catch(Exception $e){
            $response = [
                'title' => 'Failed!',
                'message' => 'Account not deleted.'.$e,
                'icon' => 'error',
                'status' => 400
            ];
            $response = json_encode($response);
            return redirect(route('admin'))
                ->with('status', $response);
        }
    }
    
}
