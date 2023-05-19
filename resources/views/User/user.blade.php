@extends('User.partial.master')
@section('content')

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    <div class="container" style="margin-top:80px">
        <div class="row justify-content-center">
             <div class="col-xl-6 col-md-6 offset-2">
              <div class="card">
                  <div class="card-header">
                    <div class="row">
                      <div class="col-6">
                        <h3>User Info</h3>
                      </div>
                      <div class="col-6">
                        <a href="{{route('Userlogout')}}" class="btn btn-info float-end"><i class="fa-solid fa-right-from-bracket"></i></a>
                      </div>

                  </div>
                  </div>
                  <div class="card-body">
                    @if(session()->has('msg'))
                          <div class="alert alert-{{session('cls')}}">
                            {{session('msg')}}
                          </div>
                    @endif
                    <table class="table table-sm">
                      <tbody>
                        <tr class="pb-6">
                          <td><img src="{{asset(Auth::user()->image)}}" width="100px" height="100px" class="thumbnail"></td>
                        </tr>
                        <tr>
                          <th scope="col">Name</th>
                          <td><b>{{Auth::user()->name}}<b></td>
                        </tr>
                        <tr>
                          <th scope="col">Email</th>
                          <td>{{Auth::user()->email}}</td>
                        </tr>
                        <tr>
                          <th scope="col">Address</th>
                          <td>{{Auth::user()->address}}</td>
                        </tr>
                        <tr>
                          <th scope="col">Phone</th>
                          <td>{{Auth::user()->phone}}</td>
                        </tr>
                    </table> 
                    <a class="btn btn-info " href="{{route('user_edit')}}">Edit</a> <br><br>  
                    <a href="{{route('password')}}">Change Password?</a>       
                   </div>
              </div>
           </div>
           </div>
        </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>

@endsection