
$(function(){
  //  ........... update profile ...........
  $('#profileUpdateBtn').on('click',function(e) {
      e.preventDefault();

      var formData = new FormData($("#userProfileForm")[0]);
      // console.log(formData);
      $.ajax({
        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
        type:'POST',
        url: route('admin.profile'),
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        success: (data) => {
      //    console.log(data);
          Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: 'Profile Update Successfully !',
            showConfirmButton: false,
            timer: 1500
          })
          $('#editProfileModal').modal('hide');
        },
        error: function(data){
          console.log(data);
        }
      });
  });
  //............. change password .............
  $('#passwordUpdateBtn').on('click',function(e) {
    e.preventDefault();

    var formData = new FormData($("#changePasswordForm")[0]);
    // console.log(formData);
    $.ajax({
      headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
      type:'POST',
      url: route('admin.updatePassword'),
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
          title: 'Password Update Successfully !',
          showConfirmButton: false,
          timer: 1500
        })
        $('#changePasswordForm').trigger("reset");
        $('#changePasswordModal').modal('hide');
      },
      error: function(data){
        console.log(data);
      }
    });
  });


});