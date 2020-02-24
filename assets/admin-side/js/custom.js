$(window).on("load", function() {
    setTimeout(function() {
        //$(".page-loader").fadeOut()
    }, 500);
});
console.log("Here");
type = ['', 'info', 'success', 'warning', 'danger'];
$(document).ready(function(){
    console.log("Here");
    $(document).on('click', '.delete-button', function(){
       if (! confirm("Are you sure you want to delete?")) {
           return false;
       } 
    });

    $(document).on('switchChange.bootstrapSwitch','.change_status',function(e) {
        e.preventDefault();
        console.log("Here");
        var admin_id = $(this).data('id');
        var page    = $(this).data('page');

        if (admin_id != '' && page != '') {
            $.ajax({
                type:"POST",
                url: ADMIN_URL+page+'/changeStatus',
                data: {
                    id : admin_id
                },
                success: function(response) {   
                    response    = $.parseJSON(response);
                    if (response.status == true) {
                        showMessage('success', response.message);
                    } else {
                        showMessage('danger', response.message);
                    }
                }
            });
        }
        return false;
    });

    $(document).on('focusout', '.custom-name-typeahead',function(e) {
        $(".custom-typeahead-content").html("");
    });

    $(document).on('keyup', '.custom-name-typeahead',function(e) {
        e.preventDefault();
        var $this       = $(this);
        var page        = $this.data('page');
        var name        = $this.val();
        var field_name  = $this.data('field');

        if (page != '' && name.length > 1) {
            $.ajax({
                type    : "POST",
                url     : ADMIN_URL + page + '/get_name',
                data: {
                    name        : name,
                    field_name  : field_name
                },
                success: function(response) {
                    response    = $.parseJSON(response);
                    if (response.status == true) {
                        $this.parents('.form-group').find(".custom-typeahead-content").html(response.html);
                    } else {
                        $this.parents('.form-group').find(".custom-typeahead-content").html("");
                    }
                }
            });
        } else {
            $(".custom-typeahead-content").html("");
        }
        return false;
    });
});

function readURL(img_selector , image_name_selector ,input) {
    if (input.files && input.files[0]) {
        var reader    = new FileReader();
        reader.onload = function(e) {
            $(img_selector).attr('src', e.target.result);
            $(image_name_selector).text(input.files[0].name);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function showMessage(type, message) {
    if (type == 'danger') {
        toastr.error(
            message, "Error!", {
                positionClass: "toast-top-right",
                closeButton: !0
            }
        );
    } else if (type == 'success') {
        toastr.success(
            message, "Success!", {
                positionClass: "toast-top-right",
                closeButton: !0
            }
        );
    } else {
        toastr.info(
            message, "Message!", {
                positionClass: "toast-top-right",
                closeButton: !0
            }
        );   
    }
}
function initTagInput() {
    if($(".tagged_input_cls").length > 0) {
        $(".tagged_input_cls").tagging();
    }
}
function initSwitch() {
    $("input[data-switchery]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });
}

function initSingleDatePicker() {
    if ($('.single_date_picker').length > 0) {
        
        $(".single_date_picker").daterangepicker({
            showDropdowns   :true,
            singleDatePicker:true,
            opens           : 'center',
            months          : 1
        });
    }
}

function initSelect2() {
    if ($('.select2').length > 0) {
        $('.select2').each(function(){
            var placeholder = $(this).data('placeholder');

            if (placeholder != '') {
                $(this).select2({
                    placeholder: placeholder
                });   
            } else {
                $(this).select2();
            }
        });
    }
}