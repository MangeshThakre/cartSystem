<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class registerController extends Controller
{
    //
    public function show(){

        return view('/register');
    }

    public function showlogin(){
        return view('component/login');
    }
    public function landing_page(request $request ){
       $user_id=$request->session()->get('id');
        
        return view('component/landing',['user_id'=>$user_id]);
    }

}
