
@extends('User.auth.layouts.app')
@section("user")
<div id="root" class="h-100">
    <!-- Background Start -->
    <div class="fixed-background"></div>
    <!-- Background End -->
    <a href="{{route('login')}}" class="btn btn-primary float-end mt-2 mx-2"><i class="fa-solid fa-right-to-bracket"></i></a>
    <section class="vh-100">
      <div class="container py-5 h-100">
        <div class="row d-flex align-items-center justify-content-center h-100">
          <div class="col-md-8 col-lg-7 col-xl-6">
            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg"
              class="img-fluid" alt="Phone image">
          </div>
          <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
            <h3>User Login</h3>
            <form method="post" action="{{route('userlogin')}}" >
              @csrf
              <!-- Email input -->
              <div class="form-outline mb-4">
                <input type="email" name="email" id="form1Example13" class="form-control form-control-lg" />
                <label class="form-label" for="form1Example13">Email address</label>
              </div>
    
              <!-- Password input -->
              <div class="form-outline mb-4">
                <input type="password" name="password" id="form1Example23" class="form-control form-control-lg" />
                <label class="form-label" for="form1Example23">Password</label>
              </div>
    
              <div class="d-flex justify-content-around align-items-center mb-4">
                <!-- Checkbox -->
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked />
                  <label class="form-check-label" for="form1Example3"> Remember me </label>
                </div>
                <a href="#!">Forgot password?</a>
              </div>
    
              <!-- Submit button -->
              <button type="submit" class="btn btn-primary btn-lg btn-block">Login</button><br><br>
              <div><a href="{{route('register')}}">Register Here</a></div>
              
    
 
    
    
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection


