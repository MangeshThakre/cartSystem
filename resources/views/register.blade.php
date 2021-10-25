
@extends('layout/home')


@section('contant')
   
<div class='container' style='margin-left:35% ; margin-top:5rem'>

    <form  action='/register'  method="post">
        @csrf
<!---firstName--->

<div class="col-md-4">
        
            <label for="firstName" class="form-label">first name</label>
            <input type="text" class="form-control" id="firstName" placeholder="first name" name='firstName'>
          </div>
<!--lastname---->
  
<div class="col-md-4">
          
            <label for="lastName" class="form-label">last name</label>
            <input type="text" class="form-control" id="lastName" placeholder="last name" name='lastName'>
          </div>

<!---gender--->


<div class="col-md-4">

    <label for="gender" class="form-label">Gender</label>
    <select id="gender" class="form-select" name ='gender'>
      <option>Male</option>
      <option>Female</option>
      <option>Other</option>
    </select>
  </div>


<!---phoneNo--->

          
<div class="col-md-4">
       
            <label for="phoneNo" class="form-label">PhoneNo</label>
            <input type="text" class="form-control" id="phoneNo" name ='phoneNo'>
          </div>


     
<!--email---->

<div class="col-md-4">
        
          <label for="emailID" class="form-label">email</label>
          <input type="email" class="form-control" id="emailID" name="email"> 
        </div>
        
<!---password--->

<div class="col-md-4">

    <label for="password" class="form-label">password</label>
    <input type="password" class="form-control" id="password" name ='password' >
  </div>

       

        
<!--register---->


<div class="col-md-4   my-3">
       
          <button type="submit" class="btn btn-primary   d-inline ">register</button>
      <a href="/login" class="btn btn-primary mx-3 " type="submit">login</a>
        
        </div>

      </form>
</div>


@isset($email)
<p> already  have an with this email-id-- ''{{ $email }}'' </p>
    
@endisset





@endsection