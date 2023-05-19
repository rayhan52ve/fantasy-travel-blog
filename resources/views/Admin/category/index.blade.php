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
                <h1 class="mb-0 pb-0 display-4" id="title">Category List</h1>
                </div>
  
              <!-- Top Buttons Start -->
              <div class="col-md-12 d-flex align-items-start justify-content-end">
                <!-- Add New Button Start -->
                <button data-bs-toggle="modal" data-bs-target="#createNewCategory" type="button" class="createNewCategory btn btn-outline-primary btn-icon btn-icon-start w-100 w-md-auto add-datatable">
                  <i data-acorn-icon="plus"></i>
                  <span>Add New</span>
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
              <table id="category" class="data-table nowrap w-100">
                
              </table>
            </div>
            <!-- Table End -->
          </div>
          <!-- Content End -->
  
          <!-- Add Modal Start -->
          <div class="modal modal-right fade" id="createNewCategory" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modelHeading">Add Category</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form  id="add_category_form">
                    <div class="mb-3">
                      <label class="form-label">Name</label>
                      <input name="name" placeholder="Enter Name" type="text" class="form-control" />
                      <small class="text-danger" id="nameError"></small>
                    </div>
                 
                    <div class="mb-3">
                      <label class="form-label">Parent Category</label>
                      <select name="parent_id" class="parent_id form-control">
                        <option value="">Select Prent Category</option>
                        
                      </select>
                      <small class="text-danger" id="parent_idError"></small>
                  </div>
                      <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>
                      <button type="button" class="btn btn-primary" id="categoryBtnSave">Create</button>
                    </div>
                  </form>
                </div>
                
              </div>
            </div>
          </div>
          <!-- Add Modal End -->
        <!-- edit Modal Start -->
        <div class="modal modal-right fade" id="editCategory" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modelHeading">Edit Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form  id="update_category_form">
                      <input type="hidden" name="_method" value="PUT">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input name="name" placeholder="Enter name" id="name" value="" type="text" class="form-control" />
                            <small class="text-danger" id="nameError"></small>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Parent Category</label>
                          <select name="parent_id" id="parent_id" class="parent_id form-control">
                            <option value="">Select Prent Category</option>
                            
                          </select>
                          <small class="text-danger" id="parent_idError"></small>
                      </div>
                        <div>
                        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="categoryBtnUpdate">Update</button>
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
  var table = $('#category').DataTable({
      processing: true,
      serverSide: true,
      "async": true,
      "crossDomain": true,
      ajax: {
          url : "{{route('categories.index')}}",
          headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
        },
      'columns': [
        {
        'title': '#SL', data: 'id', class: "no-sort", width: '50px', render: function (data, row, type, col) {
            var pageInfo = table.page.info();
            return (col.row + 1) + pageInfo.start;
        }
      },
      {'title':'Name','name':'name','data':'name'},
      // {'title':'Parent Id','name':'parent_id','data':'parent_id'},
      {
          'title': 'Parent', data: 'id',class: 'text-right w72', width: '20px', render: function (data, type, row, col) {
              let returnData = '';
              returnData += row.parent_id == 0 ? "Root" : row.parent.name;
              
              return returnData;
          }
      }, 
      {
          'title': 'Action', data: 'id',class: 'text-right w72', width: '20px', render: function (data, type, row, col) {
              let returnData = '';
              returnData += '<a title="Edit" href="javascript:void(0);" data-id="'+data+'" class="text-primary text-center editCategory"><i class="fs-5 fa-solid fa-pen-to-square"></i></a> &nbsp;';
              returnData += '<a title="Delete" href="javascript:void(0);" data-id="'+data+'" class="text-danger deleteCategory"><i class="fs-5 fa-solid fa-trash"></i></a>';
              
              return returnData;
          }
      },  
    ],
    columnDefs: [{
        searchable: false,
        orderable: false,
        targets: [0, 2,3]
      }],
      responsive: true,
      autoWidth: false,
      serverSide: true,
      processing: true,
  });


  //create
  $('#categoryBtnSave').on('click',function(e) {
      e.preventDefault();

      var formData = new FormData($("#add_category_form")[0]);
      // console.log(formData);
      $.ajax({
        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
        type:'POST',
        url: "{{route('categories.store')}}",
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
          title: 'Category Create Successfully!',
          showConfirmButton: false,
          timer: 1500
        })
          $('#add_category_form').trigger("reset");
          $('#createNewCategory').modal('hide');
          table.draw();
        },
        
      });
  });
  
  
    //edit 
    $('body').on('click', '.editCategory', function () {
      $('#categoryBtnUpdate').text("Update");
      var id_category = $(this).data('id');
      var editcategory = "{{route('categories.edit','id_category')}}".replace("id_category",id_category);
      $.ajax({
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
            type: "get",
            url: editcategory,
            success: function (data) {
              $('#editCategory').modal('show');
              $('#name').val(data.name);
              $('#parent_id').val(data.parent_id);
              editId = data.id;
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
      
  });

  //update
  $('#categoryBtnUpdate').on('click',function(e) {
    e.preventDefault();
    
    var updateCategory = "{{route('categories.update','id_category')}}".replace("id_category",editId);
    var formData = new FormData($("#update_category_form")[0]);
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
        url: updateCategory,
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        success: (data) => {
            Toast.fire({
                icon: 'success',
                title: 'Category Update successfully'
            })
        //  console.log(data);
            $('#update_category_form').trigger("reset");
            $('#editCategory').modal('hide');
            table.draw();
        },
        error: function(data){
            console.log(data);
        }
    });
  });
  //delete
 $('body').on('click', '.deleteCategory', function () {
    
    var category_id = $(this).data("id");
    var categoryDestroy = "{{route('categories.destroy','category_id')}}".replace("category_id",category_id);
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
                url: categoryDestroy,
                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: 'Category Delete Successfully!',
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

 getCategory();
  function getCategory() {
    var subCategory = "{{route('categories.getSubcategory')}}";
    $.ajax({
      headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
      type: "get",
      dataType: 'json',
      processing: true,
      serverSide: true,
      async: true,
      crossDomain: true,
      url: subCategory,
      success: function (data) {
        console
        $.each(data, function (index, val) {
          // console.log(index, val)
          $(".parent_id").append(`<option value="` + val.id + `">` + val.name + `</option>`);

        });

      }
    });
  } 

});
</script>
@endsection