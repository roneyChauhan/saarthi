$(document).ready(function() {

    loadState();

    $(document).on('click', '.edit-state', function(e) {
        e.preventDefault();
        var $this   = $(this);
        var aid     = $this.parent('.md-btn-group').data('id');
        
        if (aid != '') {
            get_form_modal(aid);
        } else {
            return false;
        }
    });

    $(document).on('click', '.delete-state', function(e) {
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
                    url : ADMIN_URL+'state/delete',
                    data:{
                         id:myId
                    },
                    success:function(response){
                        response    = $.parseJSON(response);
                        if (response.status == true) {
                            showMessage('success', response.message);
                            loadState();
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

    $(document).on('submit', "#state_form", function(e) {
        e.preventDefault();
        if ($(this).valid()) {
            var form_data = new FormData($('#state_form')[0]);

            $.ajax({
                type:"POST",
                enctype: 'multipart/form-data',
                url: ADMIN_URL+'state/commit',
                data: form_data,
                processData: false,  // Important!
                contentType: false,
                success: function(response) {   
                    response    = $.parseJSON(response);
                    if (response.status == true) {
                        showMessage('success', response.message);
                        window.location.href = ADMIN_URL + "state";
                        setTimeout(function() {
                            $('#state_modal').modal('hide');
                        }, 500)
                        
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

function loadState() {
    if ($('#states_table').length > 0) {
        $('#states_table').DataTable({
            "destroy"    : true,
            "processing" : true,
            "serverSide" : true,
            'pageLength' : 10,
            "ajax": {
                "url": ADMIN_URL+'state',
                "type": "POST",
                "data": function() {
                    setTimeout(function() {
                        initSwitch();
                    }, 500);
                }
            },
            "order": [[0, 'asc']],
            "columns": [
                { "data": "name" },
                { "data": "change_status" },
                { "data": "action", "bSortable": false }
            ]
        });
    }
}

function initValidation() {
    $("#state_form").validate({
        rules: {
            state : {
                required : true,
                remote   : {
                        url     : ADMIN_URL+'state/validate',
                        type    : "POST",
                        async   : false,
                        data    : {
                                id: function()
                                {
                                    return $('#state_form :input[name="state_id"]').val();
                                }
                            }
                    }
            }
        },
        messages: {
            state : {
                required : "Please enter state name",
                remote   : "State name already exist"  
            }
        }
    });
}
