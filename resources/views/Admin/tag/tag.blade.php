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
          <!-- Title and Top Buttons Start -->
          <div class="page-title-container">
            <div class="row">
              <div class="col-12 col-md-7">
                <h1 class="mb-0 pb-0 display-4" id="title">Tag List</h1>
                </div>
              
  
              <!-- Top Buttons Start -->
              <div class="col-md-12 d-flex align-items-start justify-content-end">
                <!-- Add New Button Start -->
                <button data-bs-toggle="modal" data-bs-target="#createNewTag" type="button" class="createNewTag btn btn-outline-primary btn-icon btn-icon-start w-100 w-md-auto add-datatable">
                  <i data-acorn-icon="plus"></i>
                  <span>Add New Tag</span>
                </button>
                <!-- Add New Button End -->
              </div>
              <!-- Top Buttons End -->
            </div>
          </div>
          <!-- Title and Top Buttons End -->
  
          <!-- Content Start -->
          <div class="data-table-rows slim">
            <!-- Controls Start -->
           
            <!-- Controls End -->
  
            <!-- Table Start -->
            <div class="data-table-responsive-wrapper">
              <table id="tag" class="data-table nowrap w-100">
                
              </table>
            </div>
            <!-- Table End -->
          </div>
          <!-- Content End -->
  
          <!-- Add Modal Start -->
          <div class="modal modal-right fade" id="createNewTag" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modelHeading">Add New Tag</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form  id="add_tag_form">
                  <div class="mb-3">
                      <label class="form-label">Post ID:</label>
                      <select name="post_id" id="post_id" class="form-control">
                        <option value="">Select Post ID</option>
                      </select>
                      <small class="text-danger" id="nameError"></small>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Tag Name</label>
                      <input name="name" placeholder="Enter Name" type="text" class="form-control" />
                      <small class="text-danger" id="nameError"></small>
                    </div>
                      <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>
                      <button type="button" class="btn btn-primary" id="tagBtnSave">Create</button>
                    </div>
                  </form>
                </div>
                
              </div>
            </div>
          </div>
          <!-- Add Modal End -->
        <!-- edit Modal Start -->
        <div class="modal modal-right fade" id="editTag" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modelHeading">Edit Tag</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form  id="update_tag_form">
                      <input type="hidden" name="_method" value="PUT">
                      <div class="mb-3">
                      <label class="form-label">Post ID:</label>
                      <select name="post_id" id="update_post_id" class="form-control">
                        <option value="">Select Post ID</option>
                      </select>
                      <small class="text-danger" id="nameError"></small>
                    </div>
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input name="name" placeholder="Enter name" id="name" value="" type="text" class="form-control" />
                            <small class="text-danger" id="nameError"></small>
                        </div>
                        <div>
                        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="tagBtnUpdate">Update</button>
                    </div>
                    </form>
                </div>
                
                </div>
            </div>
            </div>
            <!-- edit Modal End -->
   
        </div>
      </div>
    </div>
  </main>
@endsection
@section('js')
<script>
   $(function(){
    var editId = 0;
    //list
  var table = $('#tag').DataTable({
      processing: true,
      serverSide: true,
      "async": true,
      "crossDomain": true,
      ajax: {
          url : "{{route('tags.index')}}",
          headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
        },
      'columns': [
        {
        'title': '#SL', data: 'id', class: "no-sort", width: '50px', render: function (data, row, type, col) {
            var pageInfo = table.page.info();
            return (col.row + 1) + pageInfo.start;
        }
      },
      {'title':'Post Id','name':'post.title','data':'post.title'},
      {'title':'Name','name':'name','data':'name'},
      {
          'title': 'Action', data: 'id',class: 'text-right w72', width: '20px', render: function (data, type, row, col) {
              let returnData = '';
              returnData += '<a title="Edit" href="javascript:void(0);" data-id="'+data+'" class="text-primary text-center editTagbtn"><i class="fs-5 fa-solid fa-pen-to-square"></i></a> &nbsp;';
              returnData += '<a title="Delete" href="javascript:void(0);" data-id="'+data+'" class="text-danger deleteTag"><i class="fs-5 fa-solid fa-trash"></i></a>';
              
              return returnData;
          }
      },  
    ],
    columnDefs: [{
        searchable: false,
        orderable: false,
        targets: [0, 1,2]
      }],
      responsive: true,
      autoWidth: false,
      serverSide: true,
      processing: true,
  });

  getAllPost();
    function getAllPost(){
      $.ajax({
        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
        type:'get',
        url: "{{route('getAllPost')}}",
        cache:false,
        contentType: false,
        processData: false,
        success: (data) => {
        //  console.log(data);
            $.each(data , function(index, val) { 
              // console.log(index, val)
              $("#post_id").append(`<option value="`+val.id+`">`+val.title+`</option>`);
              $("#update_post_id").append(`<option value="`+val.id+`">`+val.title+`</option>`);
            });
       
        },
        error: function(data){
          console.log(data);
      
        }
      });
    }

  //create
  $('#tagBtnSave').on('click',function(e) {
      e.preventDefault();

      var formData = new FormData($("#add_tag_form")[0]);
      // console.log(formData);
      $.ajax({
        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
        type:'POST',
        url: "{{route('tags.store')}}",
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
          title: 'tag Create Successfully!',
          showConfirmButton: false,
          timer: 1500
        })
          $('#add_tag_form').trigger("reset");
          $('#createNewTag').modal('hide');
          table.draw();
        },
        
      });
  });
  
  
    //edit 
    $('body').on('click', '.editTagbtn', function () {
      $('#tagBtnUpdate').text("Update");
      var id_tag = $(this).data('id');
      var editTag = "{{route('tags.edit','id_tag')}}".replace("id_tag",id_tag);
      $.ajax({
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
            type: "get",
            url: editTag,
            success: function (data) {
              $('#editTag').modal('show');
              $('#update_post_id').val(data.post_id);
              $('#name').val(data.name);
              editId = data.id;
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
      
  });

  //update
  $('#tagBtnUpdate').on('click',function(e) {
    e.preventDefault();
    
    var updateTag = "{{route('tags.update','id_tag')}}".replace("id_tag",editId);
    var formData = new FormData($("#update_tag_form")[0]);
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
        type:'POST',
        url: updateTag,
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        success: (data) => {
            Toast.fire({
                icon: 'success',
                title: 'Tag Updated successfully'
            })
        //  console.log(data);
            $('#update_tag_form').trigger("reset");
            $('#editTag').modal('hide');
            table.draw();
        },
        error: function(data){
            console.log(data);
        }
    });
  });
  //delete
 $('body').on('click', '.deleteTag', function () {
    
    var tag_id = $(this).data("id");
    var tagDestroy = "{{route('tags.destroy','tag_id')}}".replace("tag_id",tag_id);
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
                type: "delete",
                url: tagDestroy,
                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: 'Tag Deleted Successfully!',
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