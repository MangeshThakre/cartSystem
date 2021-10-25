@extends('layout/home')
@section('contant')

<div class='container ' style='margin-left:35%; margin-top:5rem'>

    <form  action='/account'  method="post">
        @csrf

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

<button class="btn btn-primary  d-inline   my-3 " type="submit">login
</button>
<a href="/register" class="btn btn-primary d-inline  mx-3 " type="submit">register</a>

</form>
</div>


@endsection
