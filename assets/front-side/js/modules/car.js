$(document).ready(function() {

    if($(".need_to_inqury").length > 0){
        $(".need_to_inqury").on("click", function(e){
            e.preventDefault();
            $("#modalSendInquiry").modal("show");
        });
    }
    if($(".exclusive-link-cls").length > 0){
        $(".exclusive-link-cls").on("click", function(e){
            var $this = $(this);
            $this.parents(".exclusive-cls").find(".exclusive-link-cls").removeClass("active");
            $this.addClass("active");
        });
    }
    if($(".trip_type").length > 0){
        $(".trip_type").on("change", function(e){
            e.preventDefault();
            var $this = $(this);
            var type  = $this.val();
            if(type == 1) {
                $('.two_way_content').removeClass("hide");
            } else if(type == 0) {
                $('.two_way_content').addClass("hide");
            }
        });
    }
    if($(".verify_whatsapp").length > 0){
        $(".verify_whatsapp").on("click", function(e){
            e.preventDefault();
            var $this = $(this);
            if($('#payment_info_frm').valid()) {
                var form_data = new FormData($('#payment_info_frm')[0]);
                $("#payment_info_frm .verify_whatsapp").addClass("disabled");
                $this.attr("disabled", true);
                $.ajax({
                    type        :"POST",
                    enctype     : 'multipart/form-data',
                    url         : base_url+'car/verify_whatsapp',
                    data        : form_data,
                    processData : false,  // Important!
                    contentType : false,
                    success     : function(response) {   
                        response    = $.parseJSON(response);
                        if (response.status == true) {
                            showMessage('success', "Please enter your otp for confirm booking!");
                            $("#payment_info_frm .otp_text_cls").removeClass("hide");
                            $("#payment_info_frm .confirm_booking_btn").attr("disabled", false);
                            $("#payment_info_frm .confirm_booking_btn").removeClass("disabled");
                            $('input[name=otp_text]').focus();
                        } else {
                            showMessage('danger', response.message);
                        }
                        setTimeout(function(){
                            $("#payment_info_frm .verify_whatsapp").removeClass("disabled");
                            $this.attr("disabled", false);
                        },20000);
                    }
                });
            }
        });
    }
//    $(".select_car").on("click", function(e){
//       e.preventDefault();
//       var $this    = $(this);
//       var car_id   = $this.data("car_id");
//       if(car_id != ""){
//           $("#confirm_booking_frm #car_id").val(car_id);
//           $("#confirm_booking_frm").submit();
//       }
//    });
    if($("#booking-frm").length > 0) {
        $('#booking-frm').validate({
            rules: {
                trip_location:      {
                    required    : true
                },
                drop_location:      {
                    required    : true
                },
                trip_pick_date: {
                    required    : true
                },
                trip_pick_time: {
                    required    : true
                },
                trip_days: {
                    required    : true,
                    numeric    : true
                },
                book_terms: {
                    required    : true
                }
            },
            messages: {
                trip_location:     {
                    required    : "Please select location"
                },
                drop_location:     {
                    required    : "Please select location"
                },
                trip_pick_date:   {
                    required    : "Please select date"
                },
                trip_pick_time:   {
                    required    : "Please select time"
                },
                trip_days:   {
                    required    : "Please enter trip days",
                    numeric     : "Please enter valid days"
                },
                book_terms: {
                    required    : "Please accept terms and conditions"
                }
            },
            errorPlacement: function(error, element) {
                if (element.attr("name") == "book_terms" ) {
                    error.insertAfter($(element).parents('.ride-terms').find('.tearms-error'));
                } else {
                    error.insertAfter(element);
                }
            }
        });
    }
    if($("#payment_info_frm").length > 0) {
        $('#payment_info_frm').validate({
            rules: {
                username:      {
                    required    : true
                },
                email: {
                    required    : true,
                    email       : true
                },
                phone: {
                    required    : true,
                    number      : true
                },
                otp_text: {
                    required    : true
                }
            },
            messages: {
                name:     {
                    required    : "Please enter name"
                },
                email:   {
                    required    : "Please enter email",
                    email       : "Please enter valid email"
                },
                phone:   {
                    required    : "Please enter phone no",
                    number     : "Please enter valid phone no"
                },
                otp_text:   {
                    required    : "Please enter otp"
                }
            },
            errorPlacement: function(error, element) {
                error.insertAfter(element);
            }
        });
        $("#payment_info_frm").on("submit", function(){
            if($("#payment_info_frm").valid()) {
                return true;
            } else {
                return false;
            }
        });
    }
    if($("#inquiry_from").length > 0) {
        $('#inquiry_from').validate({
            rules: {
                name:      {
                    required    : true
                },
                email: {
                    required    : true,
                    email       : true
                },
                phone: {
                    number       : true
                },
                message: {
                    required    : true
                }
            },
            messages: {
                name:     {
                    required    : "Please enter name"
                },
                email:   {
                    required    : "Please enter email",
                    email       : "Please enter valid email"
                },
                phone:   {
                    number      : "Please enter valid phone"
                },
                message:   {
                    required    : "Please enter message"
                }
            },
            errorPlacement: function(error, element) {
                error.insertAfter(element);
            }
        });
        $("#inquiry_from").on("submit", function(e){
            e.preventDefault();
            var $this = $(this);
            if($this.valid()) {
                var form_data = new FormData($('#inquiry_from')[0]);
                $.ajax({
                    type        :"POST",
                    enctype     : 'multipart/form-data',
                    url         : base_url+'car/send_inquiry',
                    data        : form_data,
                    processData : false,  // Important!
                    contentType : false,
                    success     : function(response) {   
                        response    = $.parseJSON(response);
                        if (response.status == true) {
                            showMessage('success', response.message);
                            $("#modalSendInquiry").modal("hide");
                        } else {
                            showMessage('danger', response.message);
                        }
                    }
                });
            }
        });
    }

    $("#trip_location").select2({
       placeholder: "From Locations",
       theme: 'bootstrap4',
       ajax    : { 
           url         : base_url + "home/get_location",
           type        : "post",
           dataType    : 'json',
           delay       : 250,
           data        : function (params) {
                           return {
                               searchTerm   : params.term,
                               searchType   : "trip",
                               searchId     : $("#drop_location").val()
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
    $("#drop_location").select2({
       placeholder: "To Locations",
       theme: 'bootstrap4',
       ajax    : { 
           url         : base_url + "home/get_location",
           type        : "post",
           dataType    : 'json',
           delay       : 250,
           data        : function (params) {
                           return {
                               searchTerm   : params.term,
                               searchType   : "drop",
                               searchId     : $("#trip_location").val()
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
});
