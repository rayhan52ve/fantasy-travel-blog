
$(function(){
    // ........ image preview ......... 
  $("#image").change(function(){
        let reader = new FileReader();
        reader.onload = (e) =>{
        $("#photo_preview").attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    });

    //  ........... update profile ...........
    $('#settingUpdateBtn').on('click',function(e) {
        e.preventDefault();
  
        var formData = new FormData($("#siteSettingForm")[0]);
        // console.log(formData);
        $.ajax({
          headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
          type:'POST',
          url: route('admin.siteSettings'),
          data: formData,
          cache:false,
          contentType: false,
          processData: false,
          success: (data) => {
           console.log(data);
            Swal.fire({
              toast: true,
              position: 'top-end',
              icon: 'success',
              title: 'Update Successfully !',
              showConfirmButton: false,
              timer: 1500
            })
           
          },
          error: function(data){
            console.log(data);
          }
        });
    });  

    // ....... edit setting ...... 
    getSiteSetting();
    function getSiteSetting(){
        $.ajax({
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
            type:'get',
            url: route('admin.SiteSetting'),
            cache:false,
            contentType: false,
            processData: false,
            success: (data) => {
             
              $('#facebook').val(data.facebook);
              $('#twitter').val(data.twitter);
              $('#linkdin').val(data.linkdin);
              $('#github').val(data.github);
              $('#years_of_experience').val(data.years_of_experience);
              $('#complete_project').val(data.complete_project);
              $('#happy_customer').val(data.happy_customer);
              $('#number_of_award').val(data.number_of_award);
              $('#description').val(data.description);
              $("#imageShow").html(`<img id='photo_preview' src="/`+data.fave_icon+`" width='70' height='70'">`);
             

            },
            error: function(data){
              console.log(data);
            }
        });
    }


  });