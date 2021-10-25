@extends('layout/home')
@section('contant')


    <div  style='position :fixed;
    top:20%;
    right:30px;' >
        <div id ='buy'>
        </div>
    </div>
 <div class=' bill'></div>


        <h1 id='empty'></h1>
   
<div class ='container' style='margin-top:4rem'>
    


<?php



    if(isset($cart[0])){

  

    foreach ($cart as $cart_data){


?>

        <li class='list-group-item  bg-dark text-white my-2    remove<?php echo $cart_data->product_id?>' style="border-radius: 8px">
   
       <div class='fw-bold'><h3><?php echo $cart_data->title ;?></h3></div>
         <p><?php echo $cart_data->category ; ?> </p>
         <p>price:  <?php echo $cart_data->price ; ?> rs</p>
    <div>
        <span  class='btn btn-primary  remove' 
        product_id='<?php  echo $cart_data->product_id ;?>'
        item_count='<?php echo $cart_data->item_count; ?>'
            type='submit'> remove key:<?php echo $cart_data->product_id?> </button>
    </div>
        
        <form >
        <div class='d-flex flex-row-reverse bd-highlight   mx-2 my-5 position-absolute top-0 end-0 '>
     
        <span  class='btn btn-primary mx-3  Psub'  
        product_id='<?php echo $cart_data->product_id ; ?>'
        user_id='<?php echo $cart_data->user_id ; ?>'
        >-</span>
     
        <span  class='btn btn-primary mx-3  Padd' 
        product_id=  '<?php echo $cart_data->product_id ; ?>' 
        user_id='<?php echo $cart_data->user_id ; ?>'
        >+</span>
     
      
        </div>
        </form>
      
        <h2  class='count<?php echo $cart_data->product_id?>'> count:<?php echo $cart_data->item_count   ?> </h2>
        <span class=' bg-dark text-white badge bg-primary rounded-pill my-3 position-absolute bottom-0 end-0  mx-5 '>total price:<h4 class ='total_price<?php echo $cart_data->product_id?>'><?php  echo $cart_data->total_price ?> </h4></span>
        <div>
        <h1 id='buy'></h1>
        </div>
   
<?php 
}
}else{
    // echo 'empty cart';
}
?> 
 </div>






@endsection










































