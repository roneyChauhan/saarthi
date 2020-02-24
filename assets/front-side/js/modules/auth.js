$(document).ready(function() {

    $("#register_form").on('submit', function(e) {
        e.preventDefault();
        if ($(this).valid()) {
            var form_data = new FormData($('#register_form')[0]);
            $.ajax({
                type:"POST",
                enctype: 'multipart/form-data',
                url: base_url+'auth/register',
                data: form_data,
                processData: false,  // Important!
                contentType: false,
                success: function(response) {   
                    response    = $.parseJSON(response);
                    if (response.status == true) {
                        setTimeout(function(){
                            window.location.href = base_url;
                        }, 500);
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

    $.validator.addMethod(
        "validDate",
        function(value, element) {
            // put your own logic here, this is just a (crappy) example
//            return value.match(/^\d\d?\/\d\d?\/\d\d\d\d$/);
            return value.match(/^\d\d\d\d?\-\d\d?\-\d\d$/);
        },
        "Please enter a date in the format yyyy-mm-mm."
    );

    $.validator.addMethod("checkPassword", function(value, element) {
        var regex     = /^\S*(?=\S{6,})(?=\S*[a-z])(?=\S*[\d])\S*$/;
        return regex.test(value);
    }, "Password not match requirment");

    $('#register_form').validate({
        rules: {
            first_name: {
                required    : true
            },
            last_name:  {
                required    : true
            },
            email:      {
                required    : true,
                email       : true,
                remote      : {
                                url     : base_url + 'auth/validate_email',
                                type    : "POST",
                                async   : false
                            }
            },
            mobile_no:      {
                required     : true,
                minlength    : 10,
                maxlength    : 10,
                remote       : {
                                url     : base_url + 'auth/validate_phone',
                                type    : "POST",
                                async   : false
                            }
            },
            password: {
                required        : true,
                checkPassword   : true
            },
            cpassword: {
                required    : true,
                equalTo     : "#password"
            },
            terms: {
                required    : true
            }
        },
        messages: {
             first_name:{
                required    : "Please enter first name"
            },
             last_name: {
                required    : "Please enter last name"
            },
             email:     {
                required    : "Please enter email",
                email       : "Please enter valid email",
                remote      : "Email id already exist"
            },
             mobile_no: {
                required    : "Please enter mobile number",
                minlength   : "Please enter valid mobile number",
                maxlength   : "Please enter valid mobile number",
                remote      : "Phone no already exist"
            },
            password:   {
                required    : "Please enter password",
                checkPassword   : "Please enter secure password"
            },
            cpassword: {
                required    : "Please enter confirm password",
                equalTo     : "Password does not match"
            },
            terms: {
                required    : "Please accept terms"
            }
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element);
            if (element.attr("name") == "terms" ) {
                error.insertAfter($(element).parents('.field-holder').find('.tearms-error'));
            } else {
                error.insertAfter(element);
            }
        }
    });
    
    $('#login_form').validate({
        rules: {
            username:      {
                required    : true
            },
            password: {
                required    : true
            }
        },
        messages: {
            username:     {
                required    : "Please enter username"
            },
            password:   {
                required    : "Please enter password"
            }
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        }
    });

});
