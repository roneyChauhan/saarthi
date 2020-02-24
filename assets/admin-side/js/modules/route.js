$(document).ready(function() {

    loadRoute();
    initValidation();
    initSwitch();
    if($('.select_location').length > 0) {
        $('[data-mask]').inputmask();
    }
    if($('.select_location').length > 0) {
        $(".select_location").select2({
            placeholder: "Select Location",
            theme: 'bootstrap4',
            ajax    : { 
                url         : ADMIN_URL + "route/get_location",
                type        : "post",
                dataType    : 'json',
                delay       : 250,
                data        : function (params) {
                                return {
                                    searchTerm: params.term // search term
                                };
                },
                processResults: function (response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });
    }
    $(document).on('click', '.open-modal', function(e){
        e.preventDefault();
        var id = "";
        get_form_modal(id);
    });

    $(document).on('click', '.edit-route', function(e) {
        e.preventDefault();
        var $this   = $(this);
        var aid     = $this.parent('.md-btn-group').data('id');
        
        if (aid != '') {
            get_form_modal(aid);
        } else {
            return false;
        }
    });

    $(document).on('click', '.delete-route', function(e) {
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
                    url : ADMIN_URL+'route/delete',
                    data:{
                         id:myId
                    },
                    success:function(response){
                        response    = $.parseJSON(response);
                        if (response.status == true) {
                            showMessage('success', response.message);
                            loadRoute();
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

    $(document).on('submit', "#route_form", function(e) {
        e.preventDefault();
        if ($(this).valid()) {
            var form_data = new FormData($('#route_form')[0]);
            $.ajax({
                type:"POST",
                enctype: 'multipart/form-data',
                url: ADMIN_URL+'route/commit',
                data: form_data,
                processData: false,  // Important!
                contentType: false,
                success: function(response) {   
                    response    = $.parseJSON(response);
                    if (response.status == true) {
                        showMessage('success', response.message);
                        window.location.href = ADMIN_URL + "route";
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

function loadRoute() {
    if ($('#routes_table').length > 0) {
        $('#routes_table').DataTable({
            "destroy"    : true,
            "processing" : true,
            "serverSide" : true,
            'pageLength' : 10,
            "ajax": {
                "url": ADMIN_URL+'route',
                "type": "POST",
                "data": function() {
                    setTimeout(function() {
                        initSwitch();
                    }, 500);
                }
            },
            "order": [[1, 'desc']],
            "columns": [
                { "data": "route" },
                { "data": "kilometer" },
                { "data": "change_status" },
                { "data": "created_date" },
                { "data": "action", "bSortable": false }
            ]
        });
    }
}

function initValidation() {
    $("#route_form").validate({
        rules: {
            from_location : {
                required : true
            },
            to_location : {
                required : true
            },
            kilometer : {
                required : true,
                number:true
            }
        },
        messages: {
            from_location : {
                required : "Please Select Location"  
            },
            to_location : {
                required : "Please Select Location"  
            },
            kilometer : {
                required : "Enter Kilometer",
                number:"Enter Valid Kilometer"
            }
        }
    });
}

function get_form_modal(id) {
    $.ajax({
        type: "POST",
        url : ADMIN_URL+'route/get_route',
        data:{id : id},
        success:function(response){
            response    = $.parseJSON(response);
            if (response.status == true) {
                $('#route_modal .modal-body').html(response.modal_form);
                setTimeout(function() {
                    initSwitch();
                    $('#route_modal').modal('show');
                    initValidation();
                }, 200);
            } else {
                showMessage('danger', response.message);
            }
        }
    });
}