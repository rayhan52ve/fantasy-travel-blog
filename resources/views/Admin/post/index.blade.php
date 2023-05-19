@php
    $html_tag_data = [];
    $title = 'Dashboard';
    $description= 'Ecommerce Dashboard'
@endphp
@extends('admin.partial.master',['html_tag_data'=>$html_tag_data, 'title'=>$title, 'description'=>$description])
@section('contant')

<main>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="page-title-container">
                    <div class="row">
                        <div class="col-12 col-md-7">
                        <h1 class="mb-0 pb-0 display-4" id="title">Post List</h1>
                        </div>

                        <div class="col-12 col-md-5 d-flex align-items-start justify-content-end">
                            <button data-bs-toggle="modal" data-bs-target="#createNewPost" type="button" class="createNewPost btn btn-outline-primary btn-icon btn-icon-start w-100 w-md-auto add-datatable">
                                <i data-acorn-icon="plus"></i>
                                <span>Add New</span>
                            </button>
                        </div>
                    </div>
                </div>
                    <div class="data-table-rows slim">

                    <div class="data-table-responsive-wrapper">
                        <table id="posts" class="data-table nowrap w-100">
                            
                        </table>
                    </div>
                   
                    </div>
            <!-- add -->
            <div class="modal modal-right fade" id="createNewPost" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modelHeading">Add Post</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form  id="add_post_form" enctype="multipart/form-data">
                    <div class="mb-3">
                      <label class="form-label">Category</label>
                      <select name="category_id" id="category_id" class="form-control">
                        <option value="">Select Category ID</option>
                      </select>
                      <small class="text-danger" id="nameError"></small>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Title:</label>
                        <input name="title" placeholder="Enter Post Title" type="text" class="form-control" />
                        <small class="text-danger" id="parentidError"></small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Content:</label>
                        <textarea rows="10" name="content" placeholder="Enter Content" type="text-area" class="form-control"></textarea>
                        <small class="text-danger" id="parentidError"></small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Image:</label>
                        <input name="image" type="file" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Video:</label>
                        <input name="video" placeholder="Enter video" type="text" class="form-control" />
                        <small class="text-danger" id="parentidError"></small>
                    </div>
                    <div>
                      <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>
                      <button type="button" class="btn btn-primary" id="postBtnSave">Create</button>
                    </div>
                  </form>
                </div>
                
              </div>
            </div>
          </div>

        <!-- edit -->
        <div class="modal modal-right fade" id="editPost" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modelHeading">Edit Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form  id="update_post_form">
                    <input type="hidden" name="_method" value="PUT">
                    <div class="mb-3">
                      <label class="form-label">Category</label>
                      <select name="category_id" id="update_category_id" value="" class="form-control">
                        <option value="">Select Category ID</option>
                      </select>
                      <small class="text-danger" id="nameError"></small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Title:</label>
                        <input id="edit_title" name="title" type="text" value="" class="form-control" />
                        <small class="text-danger" id="parentidError"></small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Content:</label>
                        <textarea rows="10" id="content" name="content" value="" type="text-area" class="form-control row-"></textarea>
                        <small class="text-danger" id="parentidError"></small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Video:</label>
                        <input id="video" name="video" value="" placeholder="Enter video" type="text" class="form-control" />
                        <small class="text-danger" id="parentidError"></small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Image:</label>
                        <input name="image" type="file" class="form-control image" />
                    </div>
                    <div class="mb-3 imageShow"></div>
                        <div class="mb-3">
                        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="postBtnUpdate">Update</button>
                    </div>
                    </form>
                </div>
                
                </div>
            </div>
            </div>
            </div>
        </div>
    </div>
</main>

@endsection

@section('js')

<script>
    $(function(){
    var editId = 0;

  var table = $('#posts').DataTable({
      processing: true,
      serverSide: true,
      "async": true,
      "crossDomain": true,
      ajax: {
          url : "{{route('posts.index')}}",
          headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
        },
      'columns': [
        {
        'title': '#SL', data: 'id', class: "no-sort", width: '50px', render: function (data, row, type, col) {
            var pageInfo = table.page.info();
            return (col.row + 1) + pageInfo.start;
        }
      },
      {'title':'Category','name':'category.name','data':'category.name'},
      {'title':'Title','name':'title','data':'title'},
      {'title':'Created By','name':'admin.name','data':'admin.name'},
      {'title':'Image','data': 'image', render: function (data, type, row, col){
          let returnData = '';
        return returnData += "<img src='/"+data+"' width='60' height='60'>";
          }
      },
      {
          'title': 'Action', data: 'id',class: 'text-right w72', width: '20px', render: function (data, type, row, col) {
              let returnData = '';
              returnData += '<a title="Edit" href="javascript:void(0);" data-id="'+data+'" class="text-primary text-center editpostbtn"><i class="fs-5 fa-solid fa-pen-to-square"></i></a> &nbsp;';
              returnData += '<a title="Delete" href="javascript:void(0);" data-id="'+data+'" class="text-danger deletepost"><i class="fs-5 fa-solid fa-trash"></i></a>';
              
              return returnData;
          }
      },  
    ],
    columnDefs: [{
        searchable: false,
        orderable: false,
        targets: [0, 3,4,5]
      }],
      responsive: true,
      autoWidth: false,
      serverSide: true,
      processing: true,
  });
  $(".image").change(function(){
        let reader = new FileReader();
        reader.onload = (e) =>{
        $(".photo_preview").attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    });


    getAllCategory();
    function getAllCategory(){
      $.ajax({
        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
        type:'get',
        url: "{{route('getAllCategory')}}",
        cache:false,
        contentType: false,
        processData: false,
        success: (data) => {
        //  console.log(data);
            $.each(data , function(index, val) { 
              // console.log(index, val)
              $("#category_id").append(`<option value="`+val.id+`">`+val.name+`</option>`);
              $("#update_category_id").append(`<option value="`+val.id+`">`+val.name+`</option>`);
            });
       
        },
        error: function(data){
          console.log(data);
      
        }
      });
    }

 
  //create
  $('#postBtnSave').on('click',function(e) {
      e.preventDefault();

      var formData = new FormData($("#add_post_form")[0]);
      // console.log(formData);
      $.ajax({
        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
        type:'POST',
        url: "{{route('posts.store')}}",
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        success: (data) => {
        //  console.log(data);
        Swal.fire({
          toast: true,
          position: 'top-end',
          icon: 'success',
          title: 'Post Create Successfully!',
          showConfirmButton: false,
          timer: 1500
        })
          $('#add_post_form').trigger("reset");
          $('#createNewPost').modal('hide');
          table.draw();
        },
        error: function(data){
          // console.log(data);
        //   $("#titleError").text(data.responseJSON.errors.title);
        //   $("#percentageError").text(data.responseJSON.errors.percentage);
        }
      });
  });

//edit
$('body').on('click', '.editpostbtn', function () {
      $('#postBtnUpdate').text("Update");
      var id_post = $(this).data('id');
      var editPost = "{{route('posts.edit','id_post')}}".replace("id_post",id_post);
      $.ajax({
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
            type: "get",
            url: editPost,
            success: function (data) {
              $('#editPost').modal('show');
              $('#update_category_id').val(data.category_id);
              $('#edit_title').val(data.title);
              $('#content').val(data.content);
              $('#video').val(data.video);
              $(".imageShow").html(`<img class="photo_preview" src="/`+data.image+`" width="70" height="70">`);
              editId = data.id;
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
      
  });

  //update
  $('#postBtnUpdate').on('click',function(e) {
    e.preventDefault();
    
    var updatePost = "{{route('posts.update','id_post')}}".replace("id_post",editId);
    var formData = new FormData($("#update_post_form")[0]);
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })
    // console.log(formData);
    $.ajax({
        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
        type:'post',
        url: updatePost,
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        success: (data) => {
            Toast.fire({
                icon: 'success',
                title: 'Post Update Successfully'
            })
         console.log(data);
            $('#update_post_form').trigger("reset");
            $('#editPost').modal('hide');
            table.draw();
        },
        error: function(data){
            console.log(data);
        }
    });
  });

  //delete
  $('body').on('click', '.deletepost', function () {
    
    var post_id = $(this).data("id");
    var postDestroy = "{{route('posts.destroy','post_id')}}".replace("post_id",post_id);
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
            $.ajax({
                type: "Delete",
                url: postDestroy,
                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: 'Post Delete Successfully!',
                    showConfirmButton: false,
                    timer: 1500
                    })
                
                table.draw()
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }
    })

 });
});
</script>


@endsection