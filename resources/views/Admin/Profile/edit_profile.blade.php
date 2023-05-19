<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
   
<div class="container" style="margin-top:80px">
  <div class="row justify-content-center">
       <div class="col-md-6 offset-2">
        <div class="card">
            <div class="card-header">
                <h3>Edit User Info</h3>
            </div>
            <div class="card-body"> 
                <form action="{{route('profile_update')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="">Name</label>
                        <input value="{{$admin->name}}" type="text" class="form-control" Name="name" >
                      </div>

                      <div class="form-group col-md-6">
                        <label for="">Email</label>
                        <input readonly value="{{$admin->email}}" type="email" class="form-control" Name="email">
                      </div>

                      <div class="form-group col-md-6">
                        <label for="">Address</label>
                        <input value="{{$admin->address}}" type="text" class="form-control"  Name="address">
                      </div>
                      
                      <div class="form-group col-md-6">
                        <label for="">Phone</label>
                        <input value="{{$admin->phone}}" type="text" class="form-control"  Name="phone">
                      </div>

                      <div class="form-group col-md-6">
                        <label for="">Image</label>
                        <input type="file" class="form-control" name="image">
                      </div>
                      
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                  </form>
            </div>
        </div>
     </div>
     </div>
  </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>

    
