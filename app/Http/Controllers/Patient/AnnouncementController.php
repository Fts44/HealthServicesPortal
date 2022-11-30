<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class AnnouncementController extends Controller
{
    public function index(){

        $announcements = DB::table('announcement as anm')
            ->select('anm.*', 'acc.position', 'acc.firstname')
            ->leftjoin('accounts as acc', 'anm.anm_creator_id', 'acc.acc_id')
            ->where('anm_active_until', '>=', date("Y-m-d"))
            ->paginate(3);

        return view('Patient.Announcement')
            ->with([
                'announcements' => $announcements
            ]);
    }
}
