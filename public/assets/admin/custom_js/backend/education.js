
$(function(){
    // ......... education list ........... 
  var table = $('#educations').DataTable({
      processing: true,
      serverSide: true,
      "async": true,
      "crossDomain": true,
      ajax: {
          url : route('admin.educations'),
          headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
        },
      'columns': [
      {'title':'ID','name':'id', 'data':'id'},
      {'title':'Title','name':'title','data':'title'},
      {'title':'Passing Year','name':'passing_year','data':'passing_year'},
      {'title':'Status','data': 'status', width:'15%', render: function (data, type, row, col){
        let returnData = '';
       return returnData += (data == 1 ? "<a class='updateEducationStatus' class='btn btn-success btn-sm' id='education-"+row.id+"' education_id='"+row.id+"' href='javascript:void(0)'><button type='button' class='btn btn-success btn-sm'>Active</button></a>" : "<a class='updateEducationStatus' id='education-"+row.id+"' education_id='"+row.id+"' href='javascript:void(0)'><button type='button' class='btn btn-warning btn-sm'>Inactive</button></a>");
        }
      },
      {
          'title': 'Action', data: 'id', width:'20%', render: function (data, type, row, col) {
              let returnData = '';
              
                returnData += '<a title="View" href="javascript:void(0);" data-id="'+data+'" class="btn btn-sm btn-info text-white text-center viewEducation"><i class="fa-solid fa-eye"></i></a> ';
                returnData += '<a title="Edit" href="javascript:void(0);" data-id="'+data+'" class="btn btn-sm btn-primary text-white text-center editEducation"><i class="fa-solid fa-pen-to-square"></i></a> ';
                returnData += '<a title="Delete" href="javascript:void(0);" data-id="'+data+'" class="btn btn-sm btn-danger text-white deleteEducation"><i class="fa-solid fa-trash"></i></a>';
              
              return returnData;
          }
      },
          
    ],
    
  });

  // .......... create education............... 
  $('.createNewEducation').on('click',function () {
    
      $('#addEditEducationBtn').text("create");
      $('#modalTitle').html("Create New Education");
      $('#addEditEducationModal').modal('show');
      $("#titleError").text('');
      $("#passing_yearError").text('');
      $("#descriptionError").text('');
      $('#EducationForm').trigger("reset");
    
  });

  // ............ edit skill ..........
  $('body').on('click', '.editEducation', function () {
    $("#titleError").text('');
    $("#passing_yearError").text('');
    $("#descriptionError").text('');
    
      $('#addEditEducationBtn').text("Update");
      var education_id = $(this).data('id');
      var edit_url = route('admin.EditEducation','education_id').replace("education_id",education_id);
      $.ajax({
          headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
          type: "get",
            url: edit_url,
            success: function (data) {
              $('#modalTitle').html("Edit Education");
              $('#addEditEducationModal').modal('show');
              $('#education_id').val(data.id);
              $('#Education_title').val(data.title);
              $('#description').val(data.description);
              $('#passing_year').val(data.passing_year);
              // console.log(data.title);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
      
  });

  //  ........... add or update Education ...........
  $('#addEditEducationBtn').on('click',function(e) {
      e.preventDefault();

      var formData = new FormData($("#EducationForm")[0]);
      // console.log(formData);
      $.ajax({
        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
        type:'POST',
        url: route('admin.addEditEducation'),
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
              title: 'Education Save Successfully !',
              showConfirmButton: false,
              timer: 1500
            })
          $('#EducationForm').trigger("reset");
          $('#addEditEducationModal').modal('hide');
          table.draw();
        },
        error: function(data){
          // console.log(data);
          $("#titleError").text(data.responseJSON.errors.title);
          $("#passing_yearError").text(data.responseJSON.errors.passing_year);
          $("#descriptionError").text(data.responseJSON.errors.description);
        }
      });
  });

  // ........... education delete .......
  $('body').on('click', '.deleteEducation', function () {
  
      var education_id = $(this).data("id");
      var educationDestroy = route('admin.deleteEducation','education_id').replace("education_id",education_id);
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
                url: educationDestroy,
                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                  
                      Swal.fire({
                          toast: true,
                          position: 'top-end',
                          icon: 'success',
                          title: 'Skil Delete Successfully !',
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

  // .............. view education ............ 
  $('body').on('click', '.viewEducation', function () {
      var education_id = $(this).data("id");
      var view_url = route('admin.viewEducation','education_id').replace("education_id",education_id);

    
      // console.log(skill_id);
      $.ajax({
          type: "get",
          url: view_url,
          headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
          success: function (data) {
              console.log(data);
              
              $("#viewEducationInfo").html(`
              <table class="table table-bordered">
              <tbody>
                <tr>
                  <th>Title</th>
                  <td>`+data.title+`</td>
                </tr>
                <tr>
                  <th>Passing Year</th>
                  <td>`+data.passing_year+`</td>
                </tr>
                <tr>
                  <th>Description</th>
                  <td>`+data.description+`</td>
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

              $("#viewEducationModal").modal("show");
          }
      });
  });

  // ............ education status ..........
  $('body').on('click', '.updateEducationStatus', function () {
      var status = $(this).text();
      var education_id = $(this).attr("education_id");
// console.log(education_id);
      $.ajax({
          headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
          type:"post",
          url:"/admin/update-education-status",
          data:{status:status,education_id:education_id},
          success:function(resp){
              if (resp['status']==0) {
                  $("#education-"+education_id).html("<a class='updateEducationStatus' class='btn btn-warning btn-sm' href='javascript:void(0)'><button type='button' class='btn btn-warning btn-sm'>Inactive</button></a>");
              }else if(resp['status']==1){
                  $("#education-"+education_id).html("<a class='updateEducationStatus' class='btn btn-success btn-sm' href='javascript:void(0)'><button type='button' class='btn btn-success btn-sm'>Active</button></a>");
              }
          },error:function(){
              console.log("Error");
          }
      });
  });

});