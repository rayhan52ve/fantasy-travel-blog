
$(function(){
  // ............. image preview .......... 
    $("#image").change(function(){
        let reader = new FileReader();
        reader.onload = (e) =>{
        $("#photo_preview").attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    });
    // ......... Project list ........... 
    var table = $('#projects').DataTable({
        processing: true,
        serverSide: true,
        "async": true,
        "crossDomain": true,
        ajax: {
            url : route('admin.projects'),
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
          },
        'columns': [
        {'title':'ID','name':'id', 'data':'id'},
        {'title':'Title','name':'title','data':'title'},
        {'title':'Project Name','name':'project_name','data':'project_name'},
        {'title':'Image','data': 'image', width:'15%', render: function (data, type, row, col){
          let returnData = '';
        return returnData += "<img src='/"+data+"' width='60' height='60'>";
          }
        },
        {'title':'Status','data': 'status', width:'15%', render: function (data, type, row, col){
          let returnData = '';
        return returnData += (data == 1 ? "<a class='updateProjectStatus' class='btn btn-success btn-sm' id='project-"+row.id+"' project_id='"+row.id+"' href='javascript:void(0)'><button type='button' class='btn btn-success btn-sm'>Active</button></a>" : "<a class='updateProjectStatus' id='project-"+row.id+"' project_id='"+row.id+"' href='javascript:void(0)'><button type='button' class='btn btn-warning btn-sm'>Inactive</button></a>");
          }
        },
        {
            'title': 'Action', data: 'id', width:'20%', render: function (data, type, row, col) {
                let returnData = '';
                
                  returnData += '<a title="View" href="javascript:void(0);" data-id="'+data+'" class="btn btn-sm btn-info text-white text-center viewProject"><i class="fa-solid fa-eye"></i></a> ';
                  returnData += '<a title="Edit" href="javascript:void(0);" data-id="'+data+'" class="btn btn-sm btn-primary text-white text-center editProject"><i class="fa-solid fa-pen-to-square"></i></a> ';
                  returnData += '<a title="Delete" href="javascript:void(0);" data-id="'+data+'" class="btn btn-sm btn-danger text-white deleteProject"><i class="fa-solid fa-trash"></i></a>';
                
                return returnData;
            }
        },
            
      ],
      
    });

  // .......... create Project............... 
    $('.createNewProject').on('click',function () {
      
        $('#addEditProjectBtn').text("create");
        $('#modalTitle').html("Create New Project");
        $('#addEditProjectModal').modal('show');
        $("#titleError").text('');
        $("#project_nameError").text('');
        $("#clintError").text('');
        $("#langageError").text('');
        $("#linkError").text('');
        $('#ProjectForm').trigger("reset");
        $("#imageShow").html(`<img id="photo_preview" src="/uploads/project/no-image.png" width="70" height="70">`);

      
    });
  // ............ edit project ..........
  $('body').on('click', '.editProject', function () {
      $("#titleError").text('');
      $("#project_nameError").text('');
      $("#clintError").text('');
      $("#langageError").text('');
      $("#linkError").text('');
    
      $('#addEditProjectBtn').text("Update");
      var project_id = $(this).data('id');
      var edit_url = route('admin.EditProject','project_id').replace("project_id",project_id);
      $.ajax({
          headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
          type: "get",
            url: edit_url,
            success: function (data) {
              $('#modalTitle').html("Edit Project");
              $('#addEditProjectModal').modal('show');
              $('#project_id').val(data.id);
              $('#Project_title').val(data.title);
              $('#project_name').val(data.project_name);
              $('#clint').val(data.clint);
              $('#langage').val(data.langage);
              $('#link').val(data.link);
              $("#imageShow").html(`<img id='photo_preview' src="/`+data.image+`" width='70' height='70'">`);

            
              // console.log(data.title);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
      
  });
  //  ........... add or update project ...........
  $('#addEditProjectBtn').on('click',function(e) {
      e.preventDefault();

      var formData = new FormData($("#ProjectForm")[0]);
      // console.log(formData);
      $.ajax({
        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
        type:'POST',
        url: route('admin.addEditProject'),
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
          title: 'Project Data Save Successfully !',
          showConfirmButton: false,
          timer: 1500
        })
          $('#ProjectForm').trigger("reset");
          $('#addEditProjectModal').modal('hide');
          table.draw();
        },
        error: function(data){
          // console.log(data);
          $("#titleError").text(data.responseJSON.errors.title);
          $("#project_nameError").text(data.responseJSON.errors.project_name);
          $("#clintError").text(data.responseJSON.errors.clint);
          $("#langageError").text(data.responseJSON.errors.langage);
          $("#linkError").text(data.responseJSON.errors.link);
        }
      });
  });
  // ............ project delete .............
  $('body').on('click', '.deleteProject', function () {
  
      var project_id = $(this).data("id");
      var projectDestroy = route('admin.deleteProject','project_id').replace("project_id",project_id);
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
                type: "get",
                url: projectDestroy,
                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                  
                      Swal.fire({
                          toast: true,
                          position: 'top-end',
                          icon: 'success',
                          title: 'Project Delete Successfully !',
                          showConfirmButton: false,
                          timer: 1500
                      })
                      
                      table.draw();
                      
                  },
                  error: function (data) {
                      console.log('Error:', data);
                  }
              });
          }
      })

  });
  // ............ project view ........... 
  $('body').on('click', '.viewProject', function () {
      var project_id = $(this).data("id");
      var view_url = route('admin.viewProject','project_id').replace("project_id",project_id);

    
      // console.log(skill_id);
      $.ajax({
          type: "get",
          url: view_url,
          headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
          success: function (data) {
              console.log(data);
              
              $("#viewProjectInfo").html(`
              <table class="table table-bordered">
              <tbody>
                <tr>
                  <td colspan="2"><img src="/`+data.image+`" style="display: block;margin-left: auto;margin-right: auto;" width="90" height="80"></td>
                </tr>
                <tr>
                  <th>Title</th>
                  <td>`+data.title+`</td>
                </tr>
                <tr>
                  <th>Project Name</th>
                  <td>`+data.project_name+`</td>
                </tr>
                <tr>
                  <th>Clint Name</th>
                  <td>`+data.clint+`</td>
                </tr>
                <tr>
                  <th>Langage</th>
                  <td>`+data.langage+`</td>
                </tr>
                <tr>
                  <th>Project Link</th>
                  <td>`+data.link+`</td>
                </tr>
                <tr>
                  <th>Status</th>
                  <td>`+(data.status ==1 ? 'Active' : 'Inactive')+`</td>
                </tr>
                <tr>
                  <th>Created At</th>
                  <td>`+moment(data.created_at).format("MMM Do YY")+`</td>
                </tr>
              
              </tbody>
            </table>
              `);

              $("#viewProjectModal").modal("show");
          }
      });
  });
  // ............. project status ... ...
  $('body').on('click', '.updateProjectStatus', function () {
      var status = $(this).text();
      var project_id = $(this).attr("project_id");
      // console.log(project_id);
      $.ajax({
          headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
          type:"post",
          url:"/admin/update-project-status",
          data:{status:status,project_id:project_id},
          success:function(resp){
              if (resp['status']==0) {
                  $("#project-"+project_id).html("<a class='updateProjectStatus' class='btn btn-warning btn-sm' href='javascript:void(0)'><button type='button' class='btn btn-warning btn-sm'>Inactive</button></a>");
              }else if(resp['status']==1){
                  $("#project-"+project_id).html("<a class='updateProjectStatus' class='btn btn-success btn-sm' href='javascript:void(0)'><button type='button' class='btn btn-success btn-sm'>Active</button></a>");
              }
          },error:function(){
              console.log("Error");
          }
      });
  });

});