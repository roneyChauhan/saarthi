$(document).ready(function() {

    loadCity();

    $(document).on('click', '.edit-city', function(e) {
        e.preventDefault();
        var $this   = $(this);
        var aid     = $this.parent('.md-btn-group').data('id');
        
        if (aid != '') {
            get_form_modal(aid);
        } else {
            return false;
        }
    });

    $(document).on('click', '.delete-city', function(e) {
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
                    url : ADMIN_URL+'city/delete',
                    data:{
                         id:myId
                    },
                    success:function(response){
                        response    = $.parseJSON(response);
                        if (response.status == true) {
                            showMessage('success', response.message);
                            loadCity();
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

    $(document).on('submit', "#city_form", function(e) {
        e.preventDefault();
        if ($(this).valid()) {
            var form_data = new FormData($('#city_form')[0]);

            $.ajax({
                type:"POST",
                enctype: 'multipart/form-data',
                url: ADMIN_URL+'city/commit',
                data: form_data,
                processData: false,  // Important!
                contentType: false,
                success: function(response) {   
                    response    = $.parseJSON(response);
                    if (response.status == true) {
                        window.location.href = ADMIN_URL + "city";
                        showMessage('success', response.message);
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

function loadCity() {
    if ($('#citys_table').length > 0) {
        $('#citys_table').DataTable({
            "destroy"    : true,
            "processing" : true,
            "serverSide" : true,
            'pageLength' : 10,
            "ajax": {
                "url": ADMIN_URL+'city',
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
                { "data": "state_name" },
                { "data": "status" },
                { "data": "action", "bSortable": false }
            ]
        });
    }
}

function initValidation() {
    $("#city_form").validate({
        rules: {
            city : {
                required : true,
                remote   : {
                        url     : ADMIN_URL+'city/validate',
                        type    : "POST",
                        async   : false,
                        data    : {
                                id: function()
                                {
                                    return $('#city_form :input[name="city_id"]').val();
                                }
                            }
                    }
            }
        },
        messages: {
            city : {
                required : "Please enter city name",
                remote   : "City name already exist"  
            }
        }
    });
}
