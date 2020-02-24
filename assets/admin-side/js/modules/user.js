$(document).ready(function() {

    loadUser();

    $(document).on('click', '.open-modal', function(e){
        e.preventDefault();
        var id = "";
        get_form_modal(id);
    });

    $(document).on('click', '.view-inquiry', function(e) {
        e.preventDefault();
        var $this   = $(this);
        var aid     = $this.parent('.md-btn-group').data('id');
        
        if (aid != '') {
            get_form_modal(aid);
        } else {
            return false;
        }
    });

    $(document).on('click', '.delete-inquiry', function(e) {
        e.preventDefault();
        var $this = $(this);
        var myId  = $this.parent('.md-btn-group').data('id');

        swal({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then(function (value) {
            if (typeof value.value != 'undefined' && value.value == true) {

                $.ajax({
                    type: "POST",
                    url : ADMIN_URL+'inquiry/delete',
                    data:{
                         id:myId
                    },
                    success:function(response){
                        response    = $.parseJSON(response);
                        if (response.status == true) {
                            showMessage('success', response.message);
                            loadUser();
                        } else {
                            showMessage('danger', response.message);
                        }
                    }
                });
            } else {
                return false;
            }
        });
    });
});

function loadUser() {
    if ($('#user_table').length > 0) {
        $('#user_table').DataTable({
            "destroy"    : true,
            "processing" : true,
            "serverSide" : true,
            'pageLength' : 10,
            "ajax": {
                "url": ADMIN_URL + 'user',
                "type": "POST"
            },
            //"order": [[1, 'desc']],
            "columns": [
                { "data": "first_name" },
                { "data": "email" },
                { "data": "phone" },
            ]
        });
    }
}


function get_form_modal(id) {
    $.ajax({
        type: "POST",
        url : ADMIN_URL+'inquiry/get_inquiry',
        data:{id : id},
        success:function(response){
            response    = $.parseJSON(response);
            if (response.status == true) {
                $('#inquiry_modal .modal-body').html(response.modal_form);
                setTimeout(function() {
                    $('#inquiry_modal').modal('show');
                }, 200);
            } else {
                showMessage('danger', response.message);
            }
        }
    });
}