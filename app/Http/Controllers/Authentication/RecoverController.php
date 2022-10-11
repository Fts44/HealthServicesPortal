<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RecoverController extends Controller
{
    public function index(){
        return view('Authentication.Recover');
    }
}
