<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class WebLoginController extends Controller
{
    public function WebLogin(Request $request, $Camera, $token){
         Artisan::call("camera:token $Camera bearer " . $token );  
         return view('done');
    }   
}
