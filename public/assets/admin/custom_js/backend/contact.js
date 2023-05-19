
$(function(){

  // ......... contact list ........... 
  var table = $('#contacts').DataTable({
      processing: true,
      serverSide: true,
      "async": true,
      "crossDomain": true,
      ajax: {
          url : route('admin.contacts'),
          headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
        },
      'columns': [
      {'title':'ID','name':'id', 'data':'id'},
      {'title':'Name','name':'name','data':'name'},
      {'title':'Email','name':'email','data':'email'},
      {'title':'Subject','name':'subject','data':'subject'},
      {
          'title': 'Action', data: 'id', width:'20%', render: function (data, type, row, col) {
              let returnData = '';
              
                returnData += '<a title="View" href="javascript:void(0);" data-id="'+data+'" class="btn btn-sm btn-info text-white text-center viewContact"><i class="fa-solid fa-eye"></i></a> ';
                returnData += '<a title="Reply Email" href="javascript:void(0);" data-id="'+data+'" class="btn btn-sm btn-primary text-white text-center viewReply"><i class="fa-solid fa-reply"></i></a> ';
                returnData += '<a title="Delete" href="javascript:void(0);" data-id="'+data+'" class="btn btn-sm btn-danger text-white deleteContact"><i class="fa-solid fa-trash"></i></a>';
              
              return returnData;
          }
      },
          
    ],
    
  });

  // ............. view contact ......... 
  $('body').on('click', '.viewContact', function () {
    var contact_id = $(this).data("id");
    var view_url = route('admin.viewContact','contact_id').replace("contact_id",contact_id);

   
    // console.log(skill_id);
    $.ajax({
        type: "get",
        url: view_url,
        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
        success: function (data) {
            console.log(data);
             
             $("#viewContactInfo").html(`
             <table class="table table-bordered">
            <tbody>
              <tr>
                <th>Name</th>
                <td>`+data.name+`</td>
              </tr>
              <tr>
                <th>Email</th>
                <td>`+data.email+`</td>
              </tr>
              <tr>
                <th>Subject</th>
                <td>`+data.subject+`</td>
              </tr>
              <tr>
                <th>Message</th>
                <td>`+data.message+`</td>
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

             $("#viewContactModal").modal("show");
        }
     });
  });

  // ........... delete contact ............ 
  $('body').on('click', '.deleteContact', function () {
  
      var contact_id = $(this).data("id");
      var contactDestroy = route('admin.deleteContact','contact_id').replace("contact_id",contact_id);
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
                url: contactDestroy,
                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    Swal.fire({
                      toast: true,
                      position: 'top-end',
                      icon: 'success',
                      title: 'Email Deleted Successfully !',
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

});