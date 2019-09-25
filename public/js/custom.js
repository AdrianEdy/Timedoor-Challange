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

    //Prevent submitting from enter key in edit or delete
    $('.form-password').keydown(function (e) {
        if (e.keyCode == 13) {
            e.preventDefault();
            return false;
        }
    });
    
    // EDIT MODAL
    $('.edit-board-btn').click(function(e){
        e.preventDefault();
        var formPass  = $(this).parents('.form-manage'),
            id        = $(this).data('id'),
            password  = formPass.find(':password'),
            editModal = $('#editModal'),
            formEdit  = $('#form-edit');

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
            formEdit.find('.error').remove();
            formEdit.find("#update-btn").removeClass('hidden');
            formEdit.find(".edit-board-btn").removeClass('hidden');
            formEdit.find('.modal-password').parent().removeClass('hidden');
            formEdit.find(".edit-board-btn").attr('data-id', id);
            if (result.passErr) {
              formEdit.find("#update-btn").addClass('hidden');
              formEdit.prepend('<p class="small text-danger mt-5 error text-center">' + result.message + '</p>');
              formEdit.find(".form-control:not(.modal-password)").attr('readonly', true);
              $(".edit-image").addClass('hidden');
              if (result.passErr == 'not set') {
                formEdit.find('.modal-password').parent().addClass('hidden');
                formEdit.find(".edit-board-btn").addClass('hidden');
                formEdit.find("#update-btn").addClass('hidden');
              } 
              password.val(null);
            } else {
              $(".edit-image").removeClass('hidden');
              formEdit.find(".form-control:not(.modal-password)").attr('readonly', false);
              formEdit.find(".edit-board-btn").addClass('hidden');
              formEdit.find('.modal-password').parent().addClass('hidden');
              editModal.find('#form-edit').attr('action', '/update/'+id);
            } 
            $.fn.showData(editModal, result, password.val());
            $('#editModal').modal('show');
          }
        });
    });

    // SET DATA IN BOARD MODAL
    $.fn.showData = function(modal, result, password){
      modal.find('.modal-id').val(result.board.id);
      modal.find('.modal-title').val(result.board.title);
      modal.find('.modal-name').val(result.board.name);
      modal.find('.modal-body').val(result.board.message);
      modal.find('.modal-image').attr('src', '/storage/image/' + 
        (result.board.image ? 'board/' + result.board.image : 'image-not-available.jpg'));
      modal.find('.modal-password').val(password);
    }

    // UPDATE
    $("form#form-edit").submit(function(e) {
        e.preventDefault();    
        var formData = new FormData(this),
            form     = $(this);
        $.ajax({
          url: "/update/" + formData.get('editId'),
          method: 'post',
          data: formData,
          contentType: false,
          cache: false,
          processData: false,
          success: function(result){
            if (result.passErr === null)
              location.reload();
            form.find('.error').remove();
            form.find("#update-btn").removeClass('hidden');
            form.find(".edit-board-btn").removeClass('hidden');
            form.find('.modal-password').parent().removeClass('hidden');
            form.find(".edit-board-btn").attr('data-id', result.board.id);
            
            if (result.passErr) {
              form.find("#update-btn").addClass('hidden');
              form.prepend('<p class="small text-danger mt-5 error text-center">' + result.message + '</p>');
              form.find(".form-control:not(.modal-password)").attr('readonly', true);
              $(".edit-image").addClass('hidden');
              if (result.passErr == 'not set') {
                form.find('.modal-password').parent().addClass('hidden');
                form.find(".edit-board-btn").addClass('hidden');
                form.find("#update-btn").addClass('hidden');
              } 
              form.find(':password').val(null);
            } else {
              $(".edit-image").removeClass('hidden');
              form.find(".form-control:not(.modal-password)").attr('readonly', false);
              form.find(".edit-board-btn").addClass('hidden');
              form.find('.modal-password').parent().addClass('hidden');
              form.attr('action', '/update/'+result.board.id);
            } 
            $.fn.showData(form, result, formData.get('password'));
            $('#editModal').modal('show');
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
          }
        });
    });

    // DELETE MODAL
    $('.delete-board-btn').click(function(e){
        e.preventDefault();
        var formPass  = $(this).parents('.form-manage'),
            id        = $(this).data('id'),
            password  = formPass.find(':password'),
            modal     = $('#deleteModal'),
            form      = $('#form-delete');   

        form.find(".form-control:not(.modal-password)").attr('readonly', true);
        form.find(".confirm-message").empty();
        
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
            form.find("#destroy-btn").removeClass('hidden');
            form.find(".delete-board-btn").removeClass('hidden');
            form.find('.modal-password').parent().removeClass('hidden');
            form.find(".delete-board-btn").attr('data-id', id);
            if (result.passErr) {
              form.find("#destroy-btn").addClass('hidden');
              form.prepend('<p class="small text-danger mt-5 error text-center">' + result.message + '</p>');
              if (result.passErr == 'not set') {
                form.find('.modal-password').parent().addClass('hidden');
                form.find(".delete-board-btn").addClass('hidden');
                form.find("#destroy-btn").addClass('hidden');
              } 
              password.val(null);
            } else {
              form.find(".confirm-message").append('Are you sure want to delete this item?');
              form.find(".delete-board-btn").addClass('hidden');
              form.find('.modal-password').parent().addClass('hidden');
              form.attr('action', '/destroy/'+id);
            } 
            $.fn.showData(modal, result, password.val());
            modal.modal('show');
          }
        });
    });

  });