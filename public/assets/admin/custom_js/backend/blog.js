
$(function(){
  // ........ image preview ......... 
  $("#image").change(function(){
      let reader = new FileReader();
      reader.onload = (e) =>{
      $("#photo_preview").attr('src', e.target.result);
      }
      reader.readAsDataURL(this.files[0]);
  });

  // ......... blog list ........... 
  var table = $('#blogs').DataTable({
      processing: true,
      serverSide: true,
      "async": true,
      "crossDomain": true,
      ajax: {
          url : route('admin.blogs'),
          headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
        },
      'columns': [
      {'title':'ID','name':'id', 'data':'id'},
      {'title':'Post Title','name':'title','data':'title'},
      {'title':'Post Tag,s','name':'tag','data':'tag'},
      {'title':'Image','data': 'image', width:'15%', render: function (data, type, row, col){
        let returnData = '';
       return returnData += "<img src='/"+data+"' width='60' height='60'>";
        }
      },
      {'title':'Status','data': 'status', width:'15%', render: function (data, type, row, col){
        let returnData = '';
       return returnData += (data == 1 ? "<a class='updateBlogStatus' class='btn btn-success btn-sm' id='blog-"+row.id+"' blog_id='"+row.id+"' href='javascript:void(0)'><button type='button' class='btn btn-success btn-sm'>Active</button></a>" : "<a class='updateBlogStatus' id='blog-"+row.id+"' blog_id='"+row.id+"' href='javascript:void(0)'><button type='button' class='btn btn-warning btn-sm'>Inactive</button></a>");
        }
      },
      {
          'title': 'Action', data: 'id', width:'20%', render: function (data, type, row, col) {
              let returnData = '';
              
                returnData += '<a title="View" href="javascript:void(0);" data-id="'+data+'" class="btn btn-sm btn-info text-white text-center viewBlog"><i class="fa-solid fa-eye"></i></a> ';
                returnData += '<a title="Edit" href="javascript:void(0);" data-id="'+data+'" class="btn btn-sm btn-primary text-white text-center editBlog"><i class="fa-solid fa-pen-to-square"></i></a> ';
                returnData += '<a title="Delete" href="javascript:void(0);" data-id="'+data+'" class="btn btn-sm btn-danger text-white deleteBlog"><i class="fa-solid fa-trash"></i></a>';
              
              return returnData;
          }
      },
          
    ],
    
  });

  // .......... create blog............... 
  $('.createNewBlog').on('click',function () {

  $('#addEditBlogBtn').text("create");
  $('#modalTitle').html("Create New Blog");
  $('#addEditBlogModal').modal('show');
  $("#titleError").text('');
  $("#tagError").text('');
  $("#descriptionError").text('');
  $('#BlogForm').trigger("reset");
  $("#imageShow").html(`<img id="photo_preview" src="/uploads/blog/no-image.png" width="70" height="70">`);


  });

  // ............ edit blog ..........
  $('body').on('click', '.editBlog', function () {
      $("#titleError").text('');
      $("#tagError").text('');
      $("#descriptionError").text('');
    
      $('#addEditBlogBtn').text("Update");
      var blog_id = $(this).data('id');
      var edit_url = route('admin.EditBlog','blog_id').replace("blog_id",blog_id);
      $.ajax({
          headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
          type: "get",
            url: edit_url,
            success: function (data) {
              $('#modalTitle').html("Edit Blog");
              $('#addEditBlogModal').modal('show');
              $('#blog_id').val(data.id);
              $('#post_title').val(data.title);
              $('#tag').val(data.tag);
              $('#description').val(data.description);
              $("#imageShow").html(`<img id='photo_preview' src="/`+data.image+`" width='70' height='70'">`);

              // console.log(data.title);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
      
  });

  //  ........... add or update blog ...........
  $('#addEditBlogBtn').on('click',function(e) {
      e.preventDefault();

      var formData = new FormData($("#BlogForm")[0]);
      // console.log(formData);
      $.ajax({
        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
        type:'POST',
        url: route('admin.addEditBlog'),
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
          title: 'Blog Save Successfully !',
          showConfirmButton: false,
          timer: 1500
        })
          $('#BlogForm').trigger("reset");
          $('#addEditBlogModal').modal('hide');
          table.draw();
        },
        error: function(data){
          // console.log(data);
          $("#titleError").text(data.responseJSON.errors.title);
          $("#tagError").text(data.responseJSON.errors.tag);
          $("#descriptionError").text(data.responseJSON.errors.description);
        
        }
      });
  });

  // ........... delete blog ......... 
  $('body').on('click', '.deleteBlog', function () {
  
      var blog_id = $(this).data("id");
      var blogDestroy = route('admin.deleteBlog','blog_id').replace("blog_id",blog_id);
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
                url: blogDestroy,
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

  // ........... view blog ........... 
  $('body').on('click', '.viewBlog', function () {
      var blog_id = $(this).data("id");
      var view_url = route('admin.viewBlog','blog_id').replace("blog_id",blog_id);

    
      // console.log(skill_id);
      $.ajax({
          type: "get",
          url: view_url,
          headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
          success: function (data) {
              console.log(data);
              
              $("#viewBlogInfo").html(`
              <table class="table table-bordered">
              <tbody>
                <tr>
                  <td colspan="2" ><img src="/`+data.image+`" style="display: block;margin-left: auto;margin-right: auto;" width="90" height="80"></td>
                </tr>
                <tr>
                  <th>Post Title</th>
                  <td>`+data.title+`</td>
                </tr>
                <tr>
                  <th>Tag's</th>
                  <td>`+data.tag+`</td>
                </tr>
                <tr>
                  <th>Post By</th>
                  <td>`+data.user.name+`</td>
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

              $("#viewBlogModal").modal("show");
          }
      });
  });

  // ............ blog status .............
  $('body').on('click', '.updateBlogStatus', function () {
      var status = $(this).text();
      var blog_id = $(this).attr("blog_id");
      // console.log(blog_id);
      $.ajax({
          headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
          type:"post",
          url:"/admin/update-blog-status",
          data:{status:status,blog_id:blog_id},
          success:function(resp){
              if (resp['status']==0) {
                  $("#blog-"+blog_id).html("<a class='updateBlogStatus' class='btn btn-warning btn-sm' href='javascript:void(0)'><button type='button' class='btn btn-warning btn-sm'>Inactive</button></a>");
              }else if(resp['status']==1){
                  $("#blog-"+blog_id).html("<a class='updateBlogStatus' class='btn btn-success btn-sm' href='javascript:void(0)'><button type='button' class='btn btn-success btn-sm'>Active</button></a>");
              }
          },error:function(){
              console.log("Error");
          }
      });
  });

});