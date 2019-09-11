// INPUT TYPE FILE
$(document).on('change', '.btn-file :file', function() {
    var input = $(this),
        numFiles = input.get(0).files ? input.get(0).files.length : 1,
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [numFiles, label]);
  });

  $(document).ready( function() {
    $('.btn-file :file').on('fileselect', function(event, numFiles, label) {
      var input = $(this).parents('.input-group').find(':text'),
          log = numFiles > 1 ? numFiles + ' files selected' : label;

      if( input.length ) {
        input.val(log);
      } else {
        if( log ) alert(log);
      }
    });
    
    // EDIT MODAL
    $('.edit-board-btn').click(function(e){
        e.preventDefault();
        var form = $(this).parents('.form-password'),
            id = $(this).data('id'),
            password = form.find(':password');
        
        $.ajax({
          headers: {
            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
          },
          url: "/edit/" + id,
          method: 'post',
          data: {
            password: password.val()
          },
          success: function(result){
            form.find('.error').remove();
            if (result.password == false) {
              form.append('<p class="small text-danger mt-5 error">' + result.message + '</p>');
            } else {
              $('#editModal').find('#form-edit').attr('action', '/update/'+id);
              $('#editModal').find('.edit-id').val(result.id);
              $('#editModal').find('.edit-title').val(result.title);
              $('#editModal').find('.edit-name').val(result.name);
              $('#editModal').find('.edit-body').val(result.message);
              $('#editModal').find('.edit-image').attr('src', '/storage/' + (result.image || 'image/image-not-available.jpg'));
              $('#editModal').find('#submit-password').val(result.submitPass);
              $('#editModal').find('#update-btn').attr('data-id', id);
              $('#editModal').modal('toggle');
            }
          },
          error: function(err){
            if (err.status == 422) {
              $.each(err.responseJSON.errors, function (i, error) {
                  form.find('.error').remove();
                  form.append('<p class="small text-danger mt-5 error">'+error[0]+'</p>');
              });
            }
          }
        });
    });

    // UPDATE
    $("form#form-edit").submit(function(e) {
        e.preventDefault();    
        var formData = new FormData(this);
        $.ajax({
          url: "/update/" + formData.get('edit-id'),
          method: 'post',
          data: formData,
          contentType: false,
          cache: false,
          processData: false,
          success: function(result){
            location.reload();
          },
          error: function(err){
            if (err.status == 422) {
              $(this).find('.error').remove();
              console.log(err.responseJSON.errors);
              $.each(err.responseJSON.errors, function (i, error) {
                var el = $(document).find('[name="'+i+'"]');
                el.parents('.form-group').append('<p class="small text-danger mt-5 error">'+error[0]+'</p>');
              });
            }
            console.log(err);
          }
        });
    });

    // DELETE MODAL
    $('.delete-board-btn').click(function(e){
        e.preventDefault();
        var form = $(this).parents('.form-password'),
            id = $(this).data('id'),
            password = form.find(':password');

        $.ajax({
          headers: {
            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
          },
          url: "/delete/" + id,
          method: 'post',
          data: {
            password: password.val()
          },
          success: function(result){
            form.find('.error').remove();
            if (result.password == false) {
              form.append('<p class="small text-danger mt-5 error">' + result.message + '</p>');
            } else {
              $('#deleteModal').find('.modal-board-delete-btn').attr('href', '/destroy/'+id);
              //$('#deleteModal').find('.modal-dialog').html(result.content);
              $('#deleteModal').modal('toggle');
            }
          },
          error: function(err){
            if (err.status == 422) {
              $.each(err.responseJSON.errors, function (i, error) {
                  form.find('.error').remove();
                  form.append('<p class="small text-danger mt-5 error">'+error[0]+'</p>');
              });
            }
          }
        });
    });

  });