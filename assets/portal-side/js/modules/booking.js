$(document).ready(function() {

    loadBooking();

});

function loadBooking() {
    if ($('#booking_table').length > 0) {
        $('#booking_table').DataTable({
            "destroy"    : true,
            "processing" : true,
            "serverSide" : true,
            'pageLength' : 10,
            "ajax": {
                "url": portal_url+'booking',
                "type": "POST"
            },
            "order": [[1, 'desc']],
            "columns": [
                { "data": "trip_date" },
                { "data": "trip_type" },
                { "data": "from_location" },
                { "data": "to_location" },
                { "data": "status" },
                { "data": "total_amount" },
                { "data": "action", "bSortable": false }
            ]
        });
    }
}

function initValidation() {
    $("#category_form").validate({
        rules: {
            name : {
                required : true,
                remote   : {
                        url     : ADMIN_URL+'category/validate',
                        type    : "POST",
                        async   : false,
                        data    : {
                                id: function()
                                {
                                    return $('#category_form :input[name="category_id"]').val();
                                }
                            }
                    }
            }
        },
        messages: {
            name_english : {
                required : "Please enter category name",
                remote   : "Category name already exist"  
            }
        }
    });
}

function get_form_modal(id) {
    $.ajax({
        type: "POST",
        url : ADMIN_URL+'category/get_category',
        data:{id : id},
        success:function(response){
            response    = $.parseJSON(response);
            if (response.status == true) {
                $('#category_modal .modal-body').html(response.modal_form);
                setTimeout(function() {
                    initSwitch();
                    $('#category_modal').modal('show');
                    initValidation();
                }, 200);
            } else {
                showMessage('danger', response.message);
            }
        }
    });
}