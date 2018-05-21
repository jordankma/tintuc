<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class QuanLyController extends Controller
{
    //
    public function getTinhot(){
    	return view('admin.quanly.tinhot');
    }
    public function postTinhot(Request $request){
   		echo $request->Tin1; 		
    }
}
