$(document).ready(function() {

    loadVehicleType();
    
    initSwitch();

    $(document).on('click', '.open-modal', function(e){
        e.preventDefault();
        var id = "";
        get_form_modal(id);
    });

    $(document).on('click', '.delete-vehicle-type', function(e) {
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
                    url : ADMIN_URL+'vehicle_type/delete',
                    data:{
                         id:myId
                    },
                    success:function(response){
                        response    = $.parseJSON(response);
                        if (response.status == true) {
                            showMessage('success', response.message);
                            loadCategory();
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

    $(document).on('submit', "#vehicle_type_form", function(e) {
        e.preventDefault();
        if ($(this).valid()) {
            var form_data = new FormData($('#vehicle_type_form')[0]);

            $.ajax({
                type:"POST",
                enctype: 'multipart/form-data',
                url: ADMIN_URL+'vehicle_type/commit',
                data: form_data,
                processData: false,  // Important!
                contentType: false,
                success: function(response) {   
                    response    = $.parseJSON(response);
                    if (response.status == true) {
                        showMessage('success', response.message);
                        window.location.href = ADMIN_URL + "vehicle_type";
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

function loadVehicleType() {
    if ($('#vehicle_type_table').length > 0) {
        $('#vehicle_type_table').DataTable({
            "destroy"    : true,
            "processing" : true,
            "serverSide" : true,
            'pageLength' : 10,
            "ajax": {
                "url": ADMIN_URL+'vehicle_type',
                "type": "POST",
                "data": function() {
                    setTimeout(function() {
                        initSwitch();
                    }, 500);
                }
            },
            "order": [[1, 'desc']],
            "columns": [
                { "data": "name" },
                { "data": "created_date" },
                { "data": "change_status" },
                { "data": "action", "bSortable": false }
            ]
        });
    }
}

function initValidation() {
    $("#vehicle_type_form").validate({
        rules: {
            name : {
                required : true,
                remote   : {
                        url     : ADMIN_URL+'vehicle_type/validate',
                        type    : "POST",
                        async   : false,
                        data    : {
                                id: function()
                                {
                                    return $('#vehicle_type_form :input[name="vehicle_type_id"]').val();
                                }
                            }
                    }
            }
        },
        messages: {
            name : {
                required : "Please enter vehicle type",
                remote   : "Vehicle type name already exist"  
            }
        }
    });
}
