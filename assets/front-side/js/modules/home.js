$(document).ready(function() {
    $("#trip_location").select2({
       placeholder: "From Location",
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
       placeholder: "To Location",
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

    $("#tw_trip_location").select2({
       placeholder  : "From Location",
       theme        : 'bootstrap4',
       ajax         : {
           url         : base_url + "home/get_location",
           type        : "post",
           dataType    : 'json',
           delay       : 250,
           data        : function (params) {
                           return {
                               searchTerm   : params.term,
                               searchType   : "trip",
                               searchId     : $("#tw_drop_location").val()
                               
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

    $("#tw_drop_location").select2({
       placeholder: "To Location",
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
                               searchId     : $("#tw_trip_location").val()
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
//   $("#location_form").on('submit', function(e) {
//       e.preventDefault();
//       console.log("here");
//   });

//    $("#location_form").on('submit', function(e) {
//        e.preventDefault();
//        if ($(this).valid()) {
//            var form_data = new FormData($('#location_form')[0]);
//            $.ajax({
//                type        :"POST",
//                enctype     : 'multipart/form-data',
//                url         : base_url+'auth/register',
//                data        : form_data,
//                processData : false,  // Important!
//                contentType : false,
//                success     : function(response) {   
//                    response    = $.parseJSON(response);
//                    if (response.status == true) {
//                        showMessage('success', response.message);
//                        setTimeout(function(){
//                            window.location.href = base_url;
//                        }, 500);
//                    } else {
//                        showMessage('danger', response.message);
//                    }
//                }
//            });
//        } else {
//            return false;
//        }
//    });

//    $.validator.addMethod(
//        "validDate",
//        function(value, element) {
//            // put your own logic here, this is just a (crappy) example
////            return value.match(/^\d\d?\/\d\d?\/\d\d\d\d$/);
//            return value.match(/^\d\d\d\d?\-\d\d?\-\d\d$/);
//        },
//        "Please enter a date in the format yyyy-mm-mm."
//    );
//
//    $.validator.addMethod("checkPassword", function(value, element) {
//        var regex     = /^\S*(?=\S{6,})(?=\S*[a-z])(?=\S*[\d])\S*$/;
//        return regex.test(value);
//    }, "Password not match requirment");
//
    $('#location_form').validate({
        rules: {
            trip_location : {
                required    : true
            },
            drop_location : {
                required    : true
            },
            trip_pick_date: {
                required    : true
            },
            trip_pick_time: {
                required    : true
            },
            seating_capacity: {
                required    : true,
                number      : true
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
            seating_capacity:   {
                required    : "Please enter seating capacity",
                number      : "Please enter valid number"
            }
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        }
    });
    $('#twoway_form').validate({
        rules: {
            trip_location : {
                required    : true
            },
            drop_location : {
                required    : true
            },
            trip_pick_date: {
                required    : true
            },
            trip_pick_time: {
                required    : true
            },
            seating_capacity: {
                required    : true
            },
            trip_days: {
                required    : true,
                number      : true
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
            seating_capacity:   {
                required    : "Please select seating capacity"
            },
            trip_days:   {
                required    : "Please trip days",
                numeric     : "Please valid days"
            }
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        }
    });
});
