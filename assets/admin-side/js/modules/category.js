$(document).ready(function() {

    loadCategory();
    
    initSwitch();

    $(document).on('click', '.open-modal', function(e){
        e.preventDefault();
        var id = "";
        get_form_modal(id);
    });

    $(document).on('click', '.edit-category', function(e) {
        e.preventDefault();
        var $this   = $(this);
        var aid     = $this.parent('.md-btn-group').data('id');
        
        if (aid != '') {
            get_form_modal(aid);
        } else {
            return false;
        }
    });

    $(document).on('click', '.delete-category', function(e) {
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
                    url : ADMIN_URL+'category/delete',
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

    $(document).on('submit', "#category_form", function(e) {
        e.preventDefault();
        if ($(this).valid()) {
            var form_data = new FormData($('#category_form')[0]);

            $.ajax({
                type:"POST",
                enctype: 'multipart/form-data',
                url: ADMIN_URL+'category/commit',
                data: form_data,
                processData: false,  // Important!
                contentType: false,
                success: function(response) {   
                    response    = $.parseJSON(response);
                    if (response.status == true) {
                        showMessage('success', response.message);
                        window.location.href = ADMIN_URL + "category";
                        setTimeout(function() {
                            $('#category_modal').modal('hide');
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

function loadCategory() {
    if ($('#categorys_table').length > 0) {
        $('#categorys_table').DataTable({
            "destroy"    : true,
            "processing" : true,
            "serverSide" : true,
            'pageLength' : 10,
            "ajax": {
                "url": ADMIN_URL+'category',
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
                { "data": "driver_price" },
                { "data": "created_date" },
                { "data": "change_status" },
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