@extends('layout/home')
@section('contant')


<div class="collapse navbar-collapse  d-flex justify-content-end   fixed-top" id="navbarNavDarkDropdown" 
style="position: absolute;
top:10px;
right:0;
z-index:99999;
">
  <ul class="navbar-nav mx-5">
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle "   href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false" 
      style="
      position :fixed;
      top:8px;
      right:20px;
z-index:99999;
color:white;
">
        <b>Catrgory</b>
      </a>
      <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
        <li><a class="dropdown-item" href='/?category=/'>all</a></li>
          <li><a class="dropdown-item" href="/?category=/category/men's clothing">men's clothing</a></li>
          <li><a class="dropdown-item" href="/?category=/category/electronics">electronics</a></li>
          <li><a class="dropdown-item" href="/?category=/category/women's clothing">women's clothing</a></li>
          <li><a class="dropdown-item" href="/?category=/category/jewelery">jewelery</a></li>
        </ul>
    </li>
  </ul>
</div>


<?php


if(!empty($_GET['category'])){
$category=$_GET['category'];
  $api_url = 'https://fakestoreapi.com/products'.$category;
// Read JSON file
$json_data = file_get_contents($api_url);

// Decode JSON data into PHP array
$response_data = json_decode($json_data);

$user_data = $response_data;
?>

<div class='container  my-5 ' style='margin-top: 5rem !important;'>
  <div class='container  my-5 '>
  <div class="row">
  <?php
    foreach ($user_data as $user)   {
?>
 <div class="col-md-4">
  
  <div class='card mx-2  my-2' style="width: 18rem; "  >
  <img src="<?php echo $user->image; ?>" class='card-img-top' alt='...'>
  <div class='card-body'>
  <h5 class='card-title'> @php echo $user->title; @endphp </h5> 

  <p class='card-text'><?php echo $user->description; ?></p>

  <p>Price: <?php echo $user->price;?></p>

  <button  class='btn btn-primary user-id'
    data-id="<?php echo $user->id ?>"
    data-title=" @php echo $user->title; @endphp "
     data-category=" @php echo $user->category; @endphp"
     data-price=" @php echo $user->price; @endphp"
     user-id="<?php echo $user_id; ?>"
      >add to cart Pid:<?php echo $user->id; ?></button>

  </div>
  </div>
  </div>
  <?php  } 
  ?>
  </div>
  </div>
  {{-- <div id='dom' data-ID='dom_value'>hello</div> --}}
  </div>
  

<?php
}else{
  $category='/';
  // print_r($category);
  $api_url = 'https://fakestoreapi.com/products'.$category;
// Read JSON file
$json_data = file_get_contents($api_url);

// Decode JSON data into PHP array
$response_data = json_decode($json_data);

$user_data = $response_data;

?>


<div class='container  my-5 ' style='margin-top: 5rem !important;'>
  <div class='container  my-5 '>
  <div class="row">
  <?php
    foreach ($user_data as $user)   {
?>
      
    <div class="col-md-4">
  
    <div class='card mx-2  my-2' style="width: 18rem; "  >
    <img src="<?php echo $user->image; ?>" class='card-img-top'>
    <div class='card-body'>
    <h5 class='card-title'> @php echo $user->title; @endphp </h5> 

    <p class='card-text'><?php echo $user->description; ?></p>

    <p>Price: <?php echo $user->price;?></p>

    <button   class='btn btn-primary user-id'
     data-id="<?php echo $user->id ?>" 
     data-title=" @php echo $user->title; @endphp "
     data-category=" @php echo $user->category; @endphp"
     data-price=" @php echo $user->price; @endphp"
     user-id="<?php echo $user_id; ?>"

     >add to cart Pid:<?php echo $user->id; ?></button>

    </div>
    </div>
    </div>
    <?php  } 
    ?>
    </div>
    </div>
    </div>


  

<?php
}
?>

<?php echo 'hello';
$v='afdsjdf;ja;d;jfl;';


?>
@endsection
