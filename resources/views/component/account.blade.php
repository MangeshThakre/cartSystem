
@extends('layout/home')


@section('contant')






<div style='margin-top:5rem'>  
  <table class='table table-dark table-striped  my-3' >
<thead>
    <tr>
      <th scope='col'>id</th>
      <th scope='col'>FirstName</th>
      <th scope='col'>LastName</th>
      <th scope='col'>Gender</th>
      <th scope='col'>Email-Id</th>
      <th scope='col'>Phone-No.</th>
    </tr>
  </thead>
   <tbody>
     <tr>
       <th scope='row'>{{ $id }}</th>
       <td>{{$firstname}}</td>
       <td>{{$lastname}}</td>
       <td>{{ $gender }}</td>
       <td>{{ $email }}</td>
       <td>{{ $phoneNo}}</td>
     </tr>
  
  </tbody>
</table>  
 </div>  


 
<div class='d-flex justify-content-end'><a href='/logout' class='btn btn-dark' type='submit'>log Out</a></div>


<?php

if(isset($existing_order)){
?>
  <div class='container  my-5 ' style='margin-top: 5rem !important;'>
  <div class='container  my-5 '>
  <div class="row">
    <?php
foreach($existing_order as $order_data) {
 
  ?>
  <div class="card mx-5 my-3  bg-dark text-white" style="width: 18rem;">
  <div class="card-body " >
    <hr>
    <h5 class="card-title">Order no {{ $order_data->order_id }}</h5>
    <hr>

<?php
        foreach($existing_product as $product_data ){
    
        if( $product_data->order_id==$order_data->order_id){
        // echo'<br>';
        //   print_r($product_data->title);
          ?>
          <p> <b> Title </b> :{{ $product_data->title }}</p>
            <p> <b> cCtegory :</b>{{ $product_data->category }}</p>
          <p> <b> Item count </b>{{ $product_data->item_count }}</p>
          <p> <b> Price/item </b>{{ $product_data->price}}</p>
          <p> <b> Total price of each item </b>{{ $product_data->total_price_of_each_count }}</p>
<hr>

          <?php
       
        }
  
}
?>
<p> Total Price {{ $order_data->Total_price }}</p>
<!-- <span  class="btn btn-primary orderid" order_id='{{ $order_data->order_id }}'>delete</span> -->

</div>
</div>
<?php
} 
?>
</div>  
</div> 
</div>
<?php
} 
?>
  

  <!-- <div class='card mx-5 my-4    ' style="width: 18rem;">
    <div class="card-body  ">
      <h5 class="card-title">order No. </h5>
  <?php
       
          ?> ->




@endsection