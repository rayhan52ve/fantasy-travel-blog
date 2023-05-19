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
                    <h1 class="mb-0 pb-0 display-4" id="title">Menu List</h1>
                </div>
              <!-- Top Buttons Start -->
              <div class="col-12 col-md-5 d-flex align-items-start justify-content-end">
                <!-- Add New Button Start -->
                <button data-bs-toggle="modal" data-bs-target="#createNewMenu" type="button" class="createNewMenu btn btn-outline-primary btn-icon btn-icon-start w-100 w-md-auto add-datatable">
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
              <table id="menuTable" class="data-table nowrap w-100">
                
              </table>
            </div>
            <!-- Table End -->
          </div>
          <!-- Content End -->
  
          <!-- Add Modal Start -->
          <div class="modal modal-right fade" id="createNewMenu" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modelHeading">Add Menu</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form  id="add_menu_form">
                    <div class="mb-3">
                      <label class="form-label">Name:</label>
                      <input name="name" placeholder="Enter menu Name" type="text" class="form-control" />
                      <small class="text-danger" id="nameError"></small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Parent_ID:</label>
                        <input name="parent_id" placeholder="Enter parent id" type="text" class="form-control" />
                        <small class="text-danger" id="parentidError"></small>
                    </div>
                    
                      <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>
                      <button type="button" class="btn btn-primary" id="menuBtnSave">Create</button>
                    </div>
                  </form>
                </div>
                
              </div>
            </div>
          </div>
          <!-- Add Modal End -->
        <!-- edit Modal Start -->
        <div class="modal modal-right fade" id="editMenu" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modelHeading">Edit Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form  id="update_menu_form">
                    <input type="hidden" name="_method" value="PUT">
                        <div class="mb-3">
                            <label class="form-label">Name:</label>
                            <input id="name" name="name" value="" type="text" class="form-control" />
                            <small class="text-danger" id="nameError"></small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Parent ID:</label>
                            <input id="parent_id" name="parent_id" value="" type="text" class="form-control" />
                            <small class="text-danger" id="nameError"></small>
                        </div>
                        
                        
                        <div>
                        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="menuBtnUpdate">Update</button>
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
  var table = $('#menuTable').DataTable({
      processing: true,
      serverSide: true,
      "async": true,
      "crossDomain": true,
      ajax: {
          url : "{{route('menues.index')}}",
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
      {'title':'Parent Id','name':'parent_id','data':'parent_id'},
      {
          'title': 'Action', data: 'id',class: 'text-right w72', width: '20px', render: function (data, type, row, col) {
              let returnData = '';
              returnData += '<a title="Edit" href="javascript:void(0);" data-id="'+data+'" class="text-primary text-center editMenubtn"><i class="fs-5 fa-solid fa-pen-to-square"></i></a> &nbsp;';
              returnData += '<a title="Delete" href="javascript:void(0);" data-id="'+data+'" class="text-danger deleteMenu"><i class="fs-5 fa-solid fa-trash"></i></a>';
              
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


  //create
  $('#menuBtnSave').on('click',function(e) {
      e.preventDefault();

      var formData = new FormData($("#add_menu_form")[0]);
      // console.log(formData);
      $.ajax({
        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
        type:'POST',
        url: "{{route('menues.store')}}",
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
          title: 'Menu Create Successfully!',
          showConfirmButton: false,
          timer: 1500
        })
          $('#add_menu_form').trigger("reset");
          $('#createNewMenu').modal('hide');
          table.draw();
        },
        
      });
  });
  
  
    //edit 
    $('body').on('click', '.editMenubtn', function () {
      var id_menu = $(this).data('id');
      var editmenu = "{{route('menues.edit','id_menu')}}".replace("id_menu",id_menu);
      $.ajax({
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
            type: "get",
            url: editmenu,
            success: function (data) {
              $('#editMenu').modal('show');
              $('#name').val(data.name);
              $('#parent_id').val(data.parent_id);
              editId = data.id;
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
      
  });


  // ........... update ........... 
  $('#menuBtnUpdate').on('click', function (e) {
    e.preventDefault();
    $("#nameError").text('');
    $("#edit_parent_idError").text('');

    var updatemenu = "{{route('menues.update','id_menu')}}".replace("id_menu",editId);
    var formData = new FormData($("#update_menu_form")[0]);
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
      type: 'POST',
      url: updatemenu,
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      success: (data) => {
        console.log(data);

        Toast.fire({
          icon: 'success',
          title: 'Menu Update in successfully'
        })
          //  console.log(data);
            $('#update_menu_form').trigger("reset");
         
            $('#editMenu').modal('hide');
            table.draw();
      },
      error: function (data) {
        console.log(data);

      }
    });
  });
  //delete
 $('body').on('click', '.deleteMenu', function () {
    
    var menus_id = $(this).data("id");
    var menuDestroy = "{{route('menues.destroy','menu_id')}}".replace("menu_id",menus_id);
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
                url: menuDestroy,
                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: 'Menu Delete Successfully!',
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