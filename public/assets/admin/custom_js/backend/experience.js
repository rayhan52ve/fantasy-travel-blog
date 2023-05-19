
$(function(){

  // ......... experience list ........... 
  var table = $('#experiences').DataTable({
      processing: true,
      serverSide: true,
      "async": true,
      "crossDomain": true,
      ajax: {
          url : route('admin.experiences'),
          headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
        },
      'columns': [
      {'title':'ID','name':'id', 'data':'id'},
      {'title':'Title','name':'title','data':'title'},
      {'title':'Passing Year','name':'passing_year','data':'passing_year'},
      {'title':'Status','data': 'status', width:'15%', render: function (data, type, row, col){
        let returnData = '';
       return returnData += (data == 1 ? "<a class='updateExperienceStatus' class='btn btn-success btn-sm' id='experience-"+row.id+"' experience_id='"+row.id+"' href='javascript:void(0)'><button type='button' class='btn btn-success btn-sm'>Active</button></a>" : "<a class='updateExperienceStatus' id='experience-"+row.id+"' experience_id='"+row.id+"' href='javascript:void(0)'><button type='button' class='btn btn-warning btn-sm'>Inactive</button></a>");
        }
      },
      {
          'title': 'Action', data: 'id', width:'20%', render: function (data, type, row, col) {
              let returnData = '';
              
                returnData += '<a title="View" href="javascript:void(0);" data-id="'+data+'" class="btn btn-sm btn-info text-white text-center viewExperience"><i class="fa-solid fa-eye"></i></a> ';
                returnData += '<a title="Edit" href="javascript:void(0);" data-id="'+data+'" class="btn btn-sm btn-primary text-white text-center editExperience"><i class="fa-solid fa-pen-to-square"></i></a> ';
                returnData += '<a title="Delete" href="javascript:void(0);" data-id="'+data+'" class="btn btn-sm btn-danger text-white deleteExperience"><i class="fa-solid fa-trash"></i></a>';
              
              return returnData;
          }
      },
          
    ],
    
  });

  // .......... create experience............... 
  $('.createNewExperience').on('click',function () {
    
      $('#addEditExperienceBtn').text("create");
      $('#modalTitle').html("Create New Experience");
      $('#addEditExperienceModal').modal('show');
      $("#titleError").text('');
      $("#passing_yearError").text('');
      $("#descriptionError").text('');
      $('#ExperienceForm').trigger("reset");
    
  });

  // ............ edit experience ..........
  $('body').on('click', '.editExperience', function () {
    $("#titleError").text('');
    $("#passing_yearError").text('');
    $("#descriptionError").text('');
    
      $('#addEditExperienceBtn').text("Update");
      var experience_id = $(this).data('id');
      var edit_url = route('admin.EditExperience','experience_id').replace("experience_id",experience_id);
      $.ajax({
          headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
          type: "get",
            url: edit_url,
            success: function (data) {
              $('#modalTitle').html("Edit Experience");
              $('#addEditExperienceModal').modal('show');
              $('#experience_id').val(data.id);
              $('#Experience_title').val(data.title);
              $('#description').val(data.description);
              $('#passing_year').val(data.passing_year);
              // console.log(data.title);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
      
  });

  //  ........... add or update Experience ...........
  $('#addEditExperienceBtn').on('click',function(e) {
      e.preventDefault();

      var formData = new FormData($("#ExperienceForm")[0]);
      // console.log(formData);
      $.ajax({
        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
        type:'POST',
        url: route('admin.addEditExperience'),
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
            title: 'Experience Save Successfully !',
            showConfirmButton: false,
            timer: 1500
          })
          $('#ExperienceForm').trigger("reset");
          $('#addEditExperienceModal').modal('hide');
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
  // ................ experience delete............ 
  $('body').on('click', '.deleteExperience', function () {
  
      var experience_id = $(this).data("id");
      var experienceDestroy = route('admin.deleteExperience','experience_id').replace("experience_id",experience_id);
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
                url: experienceDestroy,
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
  // ...............experience view ...........
  $('body').on('click', '.viewExperience', function () {
      var experience_id = $(this).data("id");
      var view_url = route('admin.viewExperience','experience_id').replace("experience_id",experience_id);

    
      // console.log(skill_id);
      $.ajax({
          type: "get",
          url: view_url,
          headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
          success: function (data) {
              console.log(data);
              
              $("#viewExperienceInfo").html(`
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

              $("#viewExperienceModal").modal("show");
          }
      });
  });
  // ...............experience status ..............
  $('body').on('click', '.updateExperienceStatus', function () {
      var status = $(this).text();
      var experience_id = $(this).attr("experience_id");
// console.log(experience_id);
      $.ajax({
          headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
          type:"post",
          url:"/admin/update-experience-status",
          data:{status:status,experience_id:experience_id},
          success:function(resp){
              if (resp['status']==0) {
                  $("#experience-"+experience_id).html("<a class='updateExperienceStatus' class='btn btn-warning btn-sm' href='javascript:void(0)'><button type='button' class='btn btn-warning btn-sm'>Inactive</button></a>");
              }else if(resp['status']==1){
                  $("#experience-"+experience_id).html("<a class='updateExperienceStatus' class='btn btn-success btn-sm' href='javascript:void(0)'><button type='button' class='btn btn-success btn-sm'>Active</button></a>");
              }
          },error:function(){
              console.log("Error");
          }
      });
  });

});