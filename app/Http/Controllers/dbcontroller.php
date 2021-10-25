<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;

use App\Models\studentregister;
use App\models\cart;
use App\models\order;
use App\models\product;

class dbcontroller extends Controller
{
    //
    public function show(){
// insert data
    //  DB::insert('insert into practice (first_name, lastname,city) value(?,?,?)',['sonam','patil','nara']);/


    //  reed data
        $practice=DB::select ('select * from practice');
        // $practice=DB::select('select * from practice where first_name=?',['mangesh'] );
        // dd($practice);

        // updata data
        DB::update('update practice set FIRST_name=? where id =?',['sonal',3]);
        return view('db',['practice'=>$practice]);
    }

////// register//////
    public function registerValue(Request $request){
     $studentregister=new studentregister;
     $studentregister->firstName=$request->firstName;
     $studentregister->lastName=$request->lastName;
     $studentregister->gender=$request->gender;
     $studentregister->phoneNo=$request->phoneNo;
     $studentregister->email=$request->email;
     $studentregister->password=$request->password;

        $existingEmail=studentregister::where('email',[$request->email])->get();
        
        if(empty($existingEmail[0])){
          
        
            $studentregister->save();
           

               return view('component/login');
        }else{    
    
          return view('/register',['email'=>$existingEmail[0]->email]);
        } 

    }

//////////login////////
public function loginValue(request $request ){
    $existingdata=studentregister::where(['email'=>$request->email,'password'=>$request->password])->get();
    if (!empty($existingdata)){
        $id=($existingdata[0])->id;
        $firstname=($existingdata[0])->firstName;
        $lastname=($existingdata[0])->lastName;
        $gender=($existingdata[0])->gender;
        $phoneNo=($existingdata[0])->phoneNo;
        $email=($existingdata[0])->email;

       $request->session()->put('id',$id);

return view('component/account',['id'=>$id,'firstname'=>$firstname,'lastname'=> $lastname,'gender'=>$gender, 'phoneNo'=>$phoneNo, 'email'=> $email]);

    }else{
        return view('/component/login');
    }
}



public function account(request $request){
    
$session=$request->session()->get('id');


if(!empty($session)){
    $user_id=$request->session()->get('id');
    $existing_product=product::where('user_id',$user_id)->get();
    $existing_order=order::where('user_id',$user_id)->get();
    // return view('component/account',['existing_order'=>$existing_order,'productAll'=>$productAll]);
    $existingdata=studentregister::where('id',$session)->get();
    // Print_r(($existingdata[0])->firstName);
    // exit;
    $id=($existingdata[0])->id;
    $firstname=($existingdata[0])->firstName;
    $lastname=($existingdata[0])->lastName;
    $gender=($existingdata[0])->gender;
    $phoneNo=($existingdata[0])->phoneNo;
    $email=($existingdata[0])->email;
    return view('component/account',['id'=>$id,'firstname'=>$firstname,'lastname'=> $lastname,'gender'=>$gender, 'phoneNo'=>$phoneNo, 'email'=> $email, 'existing_order'=>$existing_order,'existing_product'=>$existing_product]);
    
}else{
    return view('component/login');
}
}
public function logout(Request $request){
    $request->session()->flush('id');
// redirect()->route('/login');
return redirect('login');
}
}
