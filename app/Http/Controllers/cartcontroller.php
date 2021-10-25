<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;
use App\models\cart;
use App\models\order;
use App\models\product;

class cartcontroller extends Controller
{
//   display cart data
    public function cart(request $request){
        $user_id=$request->session()->get('id');
        $cart =cart::where('user_id',$user_id)->get();
            
        return view('component/cart',['cart'=>$cart]);
    }
 // add to cart or add data in Database
    public function AddToCart(request $request){
        $user_id=$request->session()->get('id');
        
           ///////////////session /////// if user is loged in//////
        // if(!empty($user_id)){
            // echo  'user_id<br>'. $user_id;

            // $user_id = $_POST['user_id'];
            $product_id=$_POST['product_id'];
            $title=$_POST['user_title'];
            $price=$_POST['user_price'];
            $category=$_POST['user_category'];
            
            //   echo $user_id,$title,$price,$category,$product_id.'<br>';

            
              $cart=new cart;
              $existing_item=cart::where('user_id','=',$user_id)->where('product_id','=',$product_id)->get();
              if(empty($existing_item[0]->user_id)){
                //   echo 'empty';
                 
              $cart->user_id=$user_id;
              $cart->product_id=$product_id;
              $cart->title=$title;
              $cart->price=$price;
              $cart->total_price=$price;
              $cart->category=$category;
              $cart->save();
              ///////////////////////////////////////////////////////////
              $user_id=$request->session()->get('id');
              $cart=cart::where('user_id',$user_id)->get();
              $arr=[];
              foreach($cart as $cart_data){
                  $count=$cart_data->item_count;
                  array_push($arr,$count);    
                  $sum =array_sum($arr);
                //   print_r($sum);
              }
     
              if(!isset($sum)){
                $sum=0;
        return response()->json(['total_item'=>$sum,'item_count'=>$sum,'dataaa'=>0]);

            }else{
        header("Content-Type : application/json ; charset=UTF-8");
        return response()->json(['total_item'=>$sum,'item_count'=>$sum,'dataaa'=>0]);
           
            }
               //////////////////////////////////////////////////////
          
             
              }else{
            
                  $update_count=$existing_item[0]->item_count+1;
                  $total_price=$price * $update_count;
                  /////update total_price and item_count 
               cart::where('user_id','=',$user_id)->where('product_id','=',$product_id)->update(['item_count'=>$update_count,'total_price'=>$total_price]);
                // return view('component/cart');
            ////////////////////////////////////////////////////////////////////   
            $user_id=$request->session()->get('id');
            $cart=cart::where('user_id',$user_id)->get();
            $arr=[];
            foreach($cart as $cart_data){
                $count=$cart_data->item_count;
                array_push($arr,$count);    
                $sum =array_sum($arr);
                // print_r($sum);
            }
            if(!isset($sum)){
                $sum=0;
        return response()->json(['total_item'=>$sum,'item_count'=>$sum,'dataaa'=>0]);
            }else{
        header("Content-Type : application/json ; charset=UTF-8");
        return response()->json(['total_item'=>$sum,'item_count'=>$sum,'dataaa'=>0]);
            }
              }
          //     exit;
            //   echo $existing_item[0]->user_id;
              // ['data'=>$existing_item]

              ///////  if user is not loged-in/// redirdect to login page  
        // }else{

        //   return redirect('/login');
        // };

    }


////  action  sub, add, remove/////////////////////////////////////////////
public function sub(request $request){
    $user_id=$request->session()->get('id');
    $product_id=$_POST['product_id'];
    $existing_data=cart::where('user_id','=',$user_id)->where('product_id','=',$product_id)->get();
    $item_count=$existing_data[0]->item_count;
      $price=$existing_data[0]->price;
    $total_price=$existing_data[0]->total_price;
    if ($item_count >=2){
        cart::where('user_id','=',$user_id)->where('product_id','=',$product_id)->update(['item_count'=>$item_count-1,'total_price'=>$total_price-$price]);
        $updated_item=cart::where('user_id','=',$user_id)->where('product_id','=',$product_id)->get();
        ///////////////////////////////////////////////////////////////////
        $user_id=$request->session()->get('id');
        $cart=cart::where('user_id',$user_id)->get();
        $arr=[];
        foreach($cart as $cart_data){
            $count=$cart_data->item_count;
            array_push($arr,$count);    
            $sum =array_sum($arr);
            // print_r($sum);
        }
        ///////////////////////////////////
     

        return response()->json(['total_item'=>$sum,'dataaa'=>1,'count'=> $updated_item[0]->item_count, 'total_price'=>$updated_item[0]->total_price]);
    }elseif($item_count<=1){
        cart::where('user_id','=',$user_id)->where('product_id','=',$product_id)->delete();
        $updated_item=cart::where('user_id','=',$user_id)->where('product_id','=',$product_id)->get();
         ///////////////////////////////////////////////////////////////////
         $user_id=$request->session()->get('id');
         $cart=cart::where('user_id',$user_id)->get();
         $arr=[];
         foreach($cart as $cart_data){
             $count=$cart_data->item_count;
             array_push($arr,$count);    
             $sum =array_sum($arr);
            //  print_r($sum);

         }
        //  echo $sum;
         if(!isset($sum)){
             $sum=0;
    

     return response()->json(['total_item'=>$sum,'item_count'=>$sum,'dataaa'=>0]);

         }else{
     header("Content-Type : application/json ; charset=UTF-8");

     return response()->json(['total_item'=>$sum,'item_count'=>$sum,'dataaa'=>0]);
        
         }

         ///////////////////////////////////
    }

   
   
}

public function add(request $request){
    $user_id=$request->session()->get('id');
    $product_id=$_POST['product_id'];
    $existing_data=cart::where('user_id','=',$user_id)->where('product_id','=',$product_id)->get();
    $item_count=$existing_data[0]->item_count;
    $price=$existing_data[0]->price;
    $total_price=$existing_data[0]->total_price;
    // echo $total_price .'<br>', $price .'<br>',$item_count ;
    cart::where('user_id','=',$user_id)->where('product_id','=',$product_id)->update(['item_count'=>$item_count+1,'total_price'=>$total_price+$price]);
    $updated_item=cart::where('user_id','=',$user_id)->where('product_id','=',$product_id)->get();
///////////////////////////////////
    $cart=cart::where('user_id',$user_id)->get();
    $arr=[];
    foreach($cart as $cart_data){
        $count=$cart_data->item_count;
        array_push($arr,$count);    
        $sum =array_sum($arr);
        // print_r($sum);
    }
///////////////////////////////////////////
    
       return response()->json(['total_item' =>$sum,'count'=> $updated_item[0]->item_count, 'total_price'=>$updated_item[0]->total_price]);
      
}

public function  remove(request $request){
    $user_id=$request->session()->get('id');
    $product_id=$_POST['product_id'];
    $item=cart::where('user_id','=',$user_id)->where('product_id','=',$product_id)->get();
    // $cartt=cart::where('user_id',$user_id)->get();
    // cart::where('user_id',$user_id)->update(['total_item'=>$cartt[0]->total_item - $item[0]->item_count]);
    cart::where('user_id','=',$user_id)->where('product_id','=',$product_id)->delete();
    $user_id=$request->session()->get('id');
    $cart=cart::where('user_id',$user_id)->get();
    $arr=[];
    foreach($cart as $cart_data){
        $count=$cart_data->item_count;
        array_push($arr,$count);    
        $sum =array_sum($arr);
        // print_r($sum);
    }
    if(!isset($sum)){
        $sum=0;

     return response()->json(['total_item'=>$sum,'item_count'=>$sum,'dataaa'=>0]);

    }else{
     header("Content-Type : application/json ; charset=UTF-8");
     return response()->json(['total_item'=>$sum,'item_count'=>$sum,'dataaa'=>0]);
   
    }

}


/////////////////////////////////////////////////////////////////////////////
public function count(request $request){
    $user_id=$request->session()->get('id');
    $cart=cart::where('user_id',$user_id)->get();
    $arr=[];
    foreach($cart as $cart_data){
        $count=$cart_data->item_count;
        array_push($arr,$count);    
        $sum =array_sum($arr);
    }
    if(!isset($sum)){
        $sum=0;

     return response()->json(['total_item'=>$sum]);

    }else{

     return response()->json(['total_item'=>$sum]);
   
    }


}

public function  buy(request $request){
 $user_id=$request->session()->get('id');
$cart=cart::where('user_id',$user_id)->get();
$arr=[];
    foreach($cart as $cart_data){
        $count=$cart_data->total_price;
        array_push($arr,$count);    
        $sum =array_sum($arr);
    }

return response()->json(['cart_data'=>$cart,'total_price'=>$sum]);
}



public function order(request $request){
    $user_id=$request->session()->get('id');
    $cart=cart::where('user_id',$user_id)->get();
    $arr=[];
    foreach($cart as $cart_data){
        $count=$cart_data->total_price;
           array_push($arr,$count);    
           $total_price=array_sum($arr);
    }
       $order=new order;
       $order->user_id=$user_id;
       $order->Total_price=$total_price;
       $order->save();

       $order=new order;
       $existing_order=order::where('user_id',$user_id)->get();
foreach($existing_order as $order_data){
    $order_id=$order_data->order_id;
}
       foreach($cart as $cart_data){
           $product= new product;
           $product->order_id=$order_id;
           $product->user_id=$cart_data->user_id;
           $product->product_id=$cart_data->product_id;
           $product->title=$cart_data->title;
           $product->category=$cart_data->category;
           $product->price=$cart_data->price;
           $product->item_count=$cart_data->item_count;
           $product->total_price_of_each_count=$cart_data->total_price;
           $product->Total_price=$total_price;
           $product->save();
       }
       cart::where('user_id',$user_id)->delete();

    
    //    $data=['existing_order'=>$existing_order,'productAll'=>$productAll];
    //    return response()->json(['product'=>$productAll]);

        //   return view('component/account',['existing_order'=>$existing_order,'productAll'=>$productAll]);
        }

public function orderget(request $request){
    $user_id=$request->session()->get('id');
    $productAll=product::where('user_id',$user_id)->get();
    $existing_order=order::where('user_id',$user_id)->get();
    return view('component/account',['existing_order'=>$existing_order,'productAll'=>$productAll]);

}



}
    



    // $product_ids=[];
    // $titles=[];
    // $categories=[]; 
    // $price_Per_Item=[];
    // $each_item_total_count=[];	
    // $each_item_total_price=[];
    // $arr=[];
    // foreach($cart as $cart_data){
    //        array_push($product_ids,$cart_data->product_id);
    //        array_push($titles,$cart_data->title);
    //        array_push($categories, $cart_data->category);
    //        array_push($price_Per_Item,$cart_data->price);
    //        array_push($each_item_total_count,$cart_data->item_count);
    //        array_push($each_item_total_price,$cart_data->total_price);

    //        $count=$cart_data->total_price;
    //        array_push($arr,$count);    
    //        $total_price=array_sum($arr);
    // }
    //    $order=new order;
    //    $order->user_id_C=$user_id;
    //    $order->product_ids=json_encode($product_ids);
    //    $order->titles=json_encode($titles);
    //    $order->categories=json_encode($categories);
    //    $order->price_Per_Item=json_encode($price_Per_Item);
    //    $order->each_item_total_count=json_encode($each_item_total_count);
    //    $order->each_item_total_price=json_encode($each_item_total_price);
    //    $order->total_price_C=json_encode($total_price);
                                                                                                                                                                                                       






