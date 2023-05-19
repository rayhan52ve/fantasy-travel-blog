
$(function(){
  // ......... skill list ........... 
  var table = $('#skills').DataTable({
      processing: true,
      serverSide: true,
      "async": true,
      "crossDomain": true,
      ajax: {
          url : route('admin.skills'),
          headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
        },
      'columns': [
      {'title':'ID','name':'id', 'data':'id'},
      {'title':'Title','name':'title','data':'title'},
      {'title':'Percentage','name':'percentage','data':'percentage'},
      {'title':'Status','data': 'status', width:'15%', render: function (data, type, row, col){
        let returnData = '';
        return returnData += (data == 1 ? "<a class='updateSkillStatus' class='btn btn-success btn-sm' id='skill-"+row.id+"' skill_id='"+row.id+"' href='javascript:void(0)'><button type='button' class='btn btn-success btn-sm'>Active</button></a>" : "<a class='updateSkillStatus' id='skill-"+row.id+"' skill_id='"+row.id+"' href='javascript:void(0)'><button type='button' class='btn btn-warning btn-sm'>Inactive</button></a>");
        }
      },
      {
          'title': 'Action', data: 'id', width:'20%', render: function (data, type, row, col) {
              let returnData = '';
              
                returnData += '<a title="View" href="javascript:void(0);" data-id="'+data+'" class="btn btn-sm btn-info text-white text-center viewSkill"><i class="fa-solid fa-eye"></i></a> ';
                returnData += '<a title="Edit" href="javascript:void(0);" data-id="'+data+'" class="btn btn-sm btn-primary text-white text-center editSkill"><i class="fa-solid fa-pen-to-square"></i></a> ';
                returnData += '<a title="Delete" href="javascript:void(0);" data-id="'+data+'" class="btn btn-sm btn-danger text-white deleteSkill"><i class="fa-solid fa-trash"></i></a>';
              
              return returnData;
          }
      },
          
    ],
    
  });

  // .......... create skill............... 
  $('.createNewSkill').on('click',function () {
    
      $('#addEditSkillBtn').text("create");
      $('#modalTitle').html("Create New Skill");
      $('#addEditSkillModal').modal('show');
      $("#titleError").text('');
      $("#percentageError").text('');
      $('#skillForm').trigger("reset");
      
  });

  // ............ edit skill ..........
  $('body').on('click', '.editSkill', function () {
    $("#titleError").text('');
    $("#percentageError").text('');
    
      $('#addEditSkillBtn').text("Update");
      var id_skill = $(this).data('id');
      var edit_url = route('admin.EditSkill','id_skill').replace("id_skill",id_skill);
      $.ajax({
          headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
          type: "get",
            url: edit_url,
            success: function (data) {
              $('#modalTitle').html("Edit Skill");
              $('#addEditSkillModal').modal('show');
              $('#skill_id').val(data.id);
              $('#skill_title').val(data.title);
              $('#percentage').val(data.percentage);
              // console.log(data.title);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
      
  });
  
  //  ........... add or update skill ...........
  $('#addEditSkillBtn').on('click',function(e) {
      e.preventDefault();

      var formData = new FormData($("#skillForm")[0]);
      // console.log(formData);
      $.ajax({
        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
        type:'POST',
        url: route('admin.addEditSkill'),
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
          title: 'Skill Save Successfully !',
          showConfirmButton: false,
          timer: 1500
        })
          $('#skillForm').trigger("reset");
          $('#addEditSkillModal').modal('hide');
          table.draw();
        },
        error: function(data){
          // console.log(data);
          $("#titleError").text(data.responseJSON.errors.title);
          $("#percentageError").text(data.responseJSON.errors.percentage);
        }
      });
  });

  // ................. delete skill ......... 
  $('body').on('click', '.deleteSkill', function () {
    
      var skill_id = $(this).data("id");
      var cityDestroy = route('admin.deleteSkill','skill_id').replace("skill_id",skill_id);
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
                  url: cityDestroy,
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
                  
                    table.draw()
                    },
                    error: function (data) {
                        console.log('Error:', data);
                  }
              });
          }
      })
  
  });

  // ........... view skill ...........
  $('body').on('click', '.viewSkill', function () {
      var skill_id = $(this).data("id");
      var view_url = route('admin.viewSkill','skill_id').replace("skill_id",skill_id);

      
      // console.log(skill_id);
      $.ajax({
          type: "get",
          url: view_url,
          headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
          success: function (data) {
              console.log(data);
                
                $("#viewSkillInfo").html(`
                <table class="table table-bordered">
              <tbody>
                <tr>
                  <th>Title</th>
                  <td>`+data.title+`</td>
                </tr>
                <tr>
                  <th>Percentage(%)</th>
                  <td>`+data.percentage+`%</td>
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

                $("#viewSkillModal").modal("show");
          }
        });
  });

  // ............ skill status ..........
  $('body').on('click', '.updateSkillStatus', function () {
    var status = $(this).text();
    // var skill_id = $(this).skill("id");
    var skill_id = $(this).attr("skill_id");
// console.log(skill_id);
    $.ajax({
      headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
      type:"post",
      url:"/admin/update-skill-status",
      data:{status:status,skill_id:skill_id},
      success:function(resp){
        if (resp['status']==0) {
          $("#skill-"+skill_id).html("<a class='updateSkillStatus' class='btn btn-warning btn-sm' href='javascript:void(0)'><button type='button' class='btn btn-warning btn-sm'>Inactive</button></a>");
        }else if(resp['status']==1){
          $("#skill-"+skill_id).html("<a class='updateSkillStatus' class='btn btn-success btn-sm' href='javascript:void(0)'><button type='button' class='btn btn-success btn-sm'>Active</button></a>");
        }
      },error:function(){
        console.log("Error");
      }
    });
  });

});