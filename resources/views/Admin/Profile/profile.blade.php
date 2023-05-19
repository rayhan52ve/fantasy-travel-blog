@extends('Admin.partial.master')
@section('contant')

<div class="container" style="margin-top:80px">
  <div class="row justify-content-center">
       <div class="col-xl-6 col-md-6 offset-2">
        <div class="card">
            <div class="card-header">
                <h3>User Info</h3>
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
                    <td><img src="{{ asset($admin->image)}}" width="100px" height="100px" class="thumbnail"></td>
                  </tr>
                  <tr>
                    <th scope="col">Name</th>
                    <td><b>{{$admin->name}}<b></td>
                  </tr>
                  <tr>
                    <th scope="col">Email</th>
                    <td>{{$admin->email}}</td>
                  </tr>
                  <tr>
                    <th scope="col">Address</th>
                    <td>{{$admin->address}}</td>
                  </tr>
                  <tr>
                    <th scope="col">Phone</th>
                    <td>{{$admin->phone}}</td>
                  </tr>
              </table> 
              <a class="btn btn-info " href="{{route('profile_edit')}}">Edit</a><br><br>  
              {{-- <a href="{{route('password')}}">Change Password?</a>        --}}
             </div>
        </div>
     </div>
     </div>
  </div>
    
@endsection

