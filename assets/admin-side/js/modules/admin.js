$(document).ready(function() {

    initSelect2();

    loadAdminUsers();
    setTimeout(function(){
        //get_dashboard_data();
    }, 500);

    $(document).on('click', '.delete-user', function(e){
        e.preventDefault();
        var $this = $(this);
        var myId  = $this.data('id');

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
                    url : ADMIN_URL+'admin/delete',
                    data:{
                         id:myId
                    },
                    success:function(response){
                        response    = $.parseJSON(response);
                        if (response.status == true) {
                            showMessage('success', response.message);
                            loadAdminUsers();
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

    if($("#is_active_live").length > 0) {
        $("#is_active_live").on('change', function(e) {
            var $this   = $(this);
            var active  = '0';
            if ($('#is_active_live').is(':checked')){
                active  = '1';
            }
            $.ajax({
                type        : "POST",
                url         : ADMIN_URL+'admin/change_site_mode',
                data        : {active : active},
                success     : function(response) {
                    response    = $.parseJSON(response);
                    if (response.status == true) {
                        showMessage('success', response.message);
                    } else {
                        showMessage('danger', response.message);
                    }
                }
            });
        });
    }

    if($("#sitesettingLocalForm").length > 0) {
        $("#sitesettingLocalForm").validate({
            rules: {
                from_name : {
                    required : true
                },
                from_email : {
                    required : true,
                    email : true
                },
                smtp_host : {
                    required : true
                },
                port : {
                    required : true
                },
                smtp_password : {
                    required : true
                }
            },
            messages: {
                from_name : {
                    required : "Please enter from name for all emails."
                },
                from_email : {
                    required : "Please enter from email-address for all emails.",
                    email : "Please enter valid from email-address for all emails."
                },
                smtp_host : {
                    required : "Please enter Host name."
                },
                port : {
                    required : "Please enter port."
                },
                smtp_password : {
                    required : "Please enter password."
                }
            }
        });

        $("#sitesettingLocalForm").on('submit', function(e) {
            e.preventDefault();
            if ($(this).valid()) {
                var form_data = new FormData($('#sitesettingLocalForm')[0]);

                $.ajax({
                    type        : "POST",
                    enctype     : 'multipart/form-data',
                    url         : ADMIN_URL+'admin/site_settings',
                    data        : form_data,
                    processData : false,  // Important!
                    contentType : false,
                    success     : function(response) {
                        response    = $.parseJSON(response);
                        if (response.status == true) {
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
    }

    if($("#sitesettingLiveForm").length > 0) {
        $("#sitesettingLiveForm").validate({
            rules: {
                from_name : {
                    required : true
                },
                from_email : {
                    required : true,
                    email : true
                },
                smtp_host : {
                    required : true
                },
                port : {
                    required : true
                },
                smtp_password : {
                    required : true
                }
            },
            messages: {
                from_name : {
                    required : "Please enter from name for all emails."
                },
                from_email : {
                    required : "Please enter from email-address for all emails.",
                    email : "Please enter valid from email-address for all emails."
                },
                smtp_host : {
                    required : "Please enter Host name."
                },
                port : {
                    required : "Please enter port."
                },
                smtp_password : {
                    required : "Please enter password."
                }
            }
        });

        $("#sitesettingLiveForm").on('submit', function(e) {
            e.preventDefault();
            if ($(this).valid()) {
                var form_data = new FormData($('#sitesettingLiveForm')[0]);

                $.ajax({
                    type        :"POST",
                    enctype     : 'multipart/form-data',
                    url         : ADMIN_URL+'admin/site_settings',
                    data        : form_data,
                    processData : false,  // Important!
                    contentType : false,
                    success     : function(response) {
                        response    = $.parseJSON(response);
                        if (response.status == true) {
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
    }

    if($("#profileForm").length > 0) {

        $("#profileForm").validate({
            rules: {
                first_name : {
                    required    : true
                },
                last_name : {
                    required    : true
                },
                username : {
                    required    : true,
                    remote      : {
                                url     : ADMIN_URL+'admin/check_username',
                                type    : "POST",
                                async   : false,
                                data    : {
                                        id: function()
                                        {
                                            return $('#profileForm :input[name="user_id"]').val();
                                        }
                                    }
                            }
                },
                password : {
                    passwordType: true
                },
                email : {
                    required    : true,
                    email       : true,
                    remote      : {
                                url     : ADMIN_URL+'admin/check_email',
                                type    : "POST",
                                async   : false,
                                data    : {
                                        id: function()
                                        {
                                            return $('#profileForm :input[name="user_id"]').val();
                                        }
                                    }
                            }
                },
                cpassword : {
                    equalTo : "#password"
                }
            },
            messages: {
                first_name : {
                    required    : "Please enter your first name"
                },
                last_name : {
                    required    : "Please enter your last name"
                },
                username : {
                    required    : "Please enter your username",
                    remote      : "Username already register"
                },
                password : {
                    passwordType    : "Please enter your password"
                },
                email : {
                    required    : "Please enter your email",
                    email       : "Please enter valid email",
                    remote      : "Email already register"
                },
                cpassword : {
                    equalTo : "Does not match with password"
                }
            }
        });

        $.validator.addMethod('passwordType', function(value, element, param) {
            var user_id     = $('#profileForm :input[name="user_id"]').val();
            var valid       = true;
            if (user_id == "" && value == "") {
                valid   = false;
            }
            return valid;
        },"Please enter your password");
        
        $("#profileForm").on('submit', function() {
            if ($(this).valid()) {
                return true;
            } else {
                return false;
            }
        });
    }

    if($("#setupForm").length > 0) {

        $("#setupForm").validate({
            rules: {
                first_name : {
                    required    : true
                },
                last_name : {
                    required    : true
                },
                username : {
                    required    : true,
                    nameRegex   : true,
                    remote      : {
                                url     : ADMIN_URL+'admin/check_username',
                                type    : "POST",
                                async   : false,
                                data    : {
                                        id: function()
                                        {
                                            return $('#setupForm :input[name="user_id"]').val();
                                        }
                                    }
                            }
                },
                password : {
                    passwordType: true
                },
                email : {
                    required    : true,
                    email       : true,
                    remote      : {
                                url     : ADMIN_URL+'admin/check_email',
                                type    : "POST",
                                async   : false,
                                data    : {
                                        id: function()
                                        {
                                            return $('#setupForm :input[name="user_id"]').val();
                                        }
                                    }
                            }
                },
                cpassword : {
                    equalTo : "#password"
                },
                role : {
                    min : 1
                }
            },
            messages: {
                first_name : {
                    required    : "Please enter your first name"
                },
                last_name : {
                    required    : "Please enter your last name"
                },
                username : {
                    required    : "Please enter your username",
                    nameRegex   : "Username must contain only letters & number. No space allowed",
                    remote      : "Username already register"
                },
                password : {
                    passwordType    : "Please enter your password"
                },
                email : {
                    required    : "Please enter your email",
                    email       : "Please enter valid email",
                    remote      : "Email already register"
                },
                cpassword : {
                    equalTo : "Does not match with password"
                },
                role : {
                    min : "Please select role"
                }
            },
            errorPlacement: function (error, element) {
                if (element.attr("name") == "role") {
                    error.insertAfter($(element).parents('.form-group').find('.select2-container'));
                } else {
                    error.insertAfter(element);
                }
            }
        });

        $.validator.addMethod("nameRegex", function(value, element) {
            return this.optional(element) || /^[a-z0-9\\s]+$/i.test(value);
        }, "No space please and don't leave it empty");

        $.validator.addMethod('passwordType', function(value, element, param) {
            var user_id     = $('#setupForm :input[name="user_id"]').val();
            var valid       = true;
            if (user_id == "" && value == "") {
                valid   = false;
            }
            return valid;
        },"Please enter your password");

        $("#setupForm").on('submit', function() {
            if ($(this).valid()) {
                return true;
            } else {
                return false;
            }
        });
    }

    if($("#reset_password").length > 0) {
        $("#reset_password").validate({
            rules: {
                password : {
                    required : true
                },
                cpassword : {
                    equalTo : "#password"
                }
            },
            messages: {
                email : {
                    required : "Please enter password"
                },
                cpassword : {
                    equalTo : "Does not match with password"
                }
            }
        });
    }
    if($("#forgot_password").length > 0) {
        $("#forgot_password").validate({
            rules: {
                email : {
                    required : true,
                    email : true
                }
            },
            messages: {
                email : {
                    required : "Please enter your email",
                    email : "Please enter valid email"
                }
            }
        });
    }
    
    $("#sitesettingLiveForm").validate({
        rules: {
            from_name : {
                required : true
            },
            from_email : {
                required : true,
                email : true
            },
            sandgrid_username : {
                required : true
            },
            sandgrid_password : {
                required : true
            }
        },
        messages: {
            from_name : {
                required : "Please enter from name for all emails."
            },
            from_email : {
                required : "Please enter from email-address for all emails.",
                email : "Please enter valid from email-address for all emails."
            },
            sandgrid_username : {
                required : "Please enter sandgrid username."
            },
            sandgrid_password : {
                required : "Please enter sandgrid password."
            }
        }
    });
});

function loadAdminUsers() {
    if ($('#adminUsers').length > 0) {
        $('#adminUsers').DataTable({
            "destroy"    : true,
            "processing" : true,
            "serverSide" : true,
            'pageLength' : 10,
            "ajax": {
                "url": ADMIN_URL+'admin-users',
                "type": "POST",
                "data": function() {
                    setTimeout(function() {
                        initSwitch();
                    }, 500);
                }
            },
            "order": [[2, 'desc']],
            "columns": [
                { "data": "full_name" },
                { "data": "username" },
                { "data": "email" },
                { "data": "role" },
                { "data": "action", "bSortable": false }
            ]
        });
    }
}

function get_dashboard_data(){
    $.ajax({
        type: "POST",
        url : ADMIN_URL + 'admin/get_dashboard_data',
        success:function(response){
            response    = $.parseJSON(response);
            if (response.status == true) {
                $(".total_books_free_cls").html(response.total_books_free);
                $(".total_books_premium_cls").html(response.total_books_premium);
                $(".total_Authors_cls").html(response.total_Authors);
                $(".total_Publishers_cls").html(response.total_Publishers);
                $(".total_Languages_cls").html(response.total_Languages);
                $(".total_Categories_cls").html(response.total_Categories);
            }
        }
    });
}