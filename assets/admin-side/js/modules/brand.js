$(document).ready(function() {

    loadBrands();

    $(document).on('change', '#avatar_img', function(e){
        readURL(".image_content_preview",".image_content_lbl", this);
    });

    $(document).on('click', '.open-modal', function(e){
        e.preventDefault();        
        var id = "";
        get_form_modal(id);
    });

    $(document).on('click', '.edit-brand', function(e) {
        e.preventDefault();
        var $this   = $(this);
        var aid     = $this.parent('.md-btn-group').data('id');
        if (aid != '') {
            get_form_modal(aid);
        } else {
            return false;
        }
    });

    $(document).on('click', '.delete-brand', function(e) {
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
                    url : ADMIN_URL+'brand/delete',
                    data:{
                         id:myId
                    },
                    success:function(response){
                        response    = $.parseJSON(response);
                        if (response.status == true) {
                            showMessage('success', response.message);
                            loadBrands();
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

    
    $(document).on('submit', "#brand_form", function(e) {
        e.preventDefault();
        if ($(this).valid()) {
            var form_data = new FormData($('#brand_form')[0]);

            $.ajax({
                type:"POST",
                enctype: 'multipart/form-data',
                url: ADMIN_URL+'brand/commit',
                data: form_data,
                processData: false,  // Important!
                contentType: false,
                success: function(response) {   
                    response    = $.parseJSON(response);
                    if (response.status == true) {
                        showMessage('success', response.message);
                        window.location.href = ADMIN_URL + "brand";
                        setTimeout(function() {
                            $('#brand_modal').modal('hide');
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

function loadBrands() {
    if ($('#brand_table').length > 0) {
        $('#brand_table').DataTable({
            "destroy"    : true,
            "processing" : true,
            "serverSide" : true,
            'pageLength' : 10,
            "ajax": {
                "url": ADMIN_URL+'brand',
                "type": "POST",
                "data": function() {
                    setTimeout(function() {
                        initSwitch();
                    }, 500);
                }
            },
            "order": [[1, 'desc']],
            "columns": [
                { "data": "photo" },
                { "data": "name" },
                { "data": "created_date" },
                { "data": "action", "bSortable": false }
            ]
        });
    }
}

function initValidation() {
    $.validator.addMethod('imageType', function(value, element, param) {
        var brand_id    = $('#brand_form :input[name="brand_id"]').val();
        var allowed_type    = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        var valid           = true;
        if (element.files.length > 0) {
            if ($.inArray( String(element.files[0].type) , allowed_type ) == -1) {
                valid   = false;
            }
        } else if(brand_id == "") {
            valid   = false;
        }
        return valid;
    },"Please upload image");

    $("#brand_form").validate({
        rules: {
            brand_name : {
                required    : true,
                remote      : {
                            url     : ADMIN_URL+'brand/validate',
                            type    : "POST",
                            async   : false,
                            data    : {
                                    id: function()
                                    {
                                        return $('#brand_form :input[name="brand_id"]').val();
                                    }
                                }
                        }
            }
        },
        messages: {
            brand_name : {
                required    : "Please enter brand name",
                remote      : "Brand name already exist"  
            }
        }
    });
}

function get_form_modal(id) {
    $.ajax({
        type: "POST",
        url : ADMIN_URL+'brand/get_brand',
        data:{id : id},
        success:function(response){
            response    = $.parseJSON(response);
            if (response.status == true) {
                $('#brand_modal .modal-body').html(response.modal_form);
                setTimeout(function() {
                    initSwitch();
                    $('#brand_modal').modal('show');
                    initValidation();
                }, 200);
            } else {
                showMessage('danger', response.message);
            }
        }
    });
}