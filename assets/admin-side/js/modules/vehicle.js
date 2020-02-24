$(document).ready(function() {

    loadVehicles();

    initValidation();

    initSelect2();

    initSwitch();
    $(document).on('change', '#vehicle_photo', function(e){
        var allValid    = true;
        var form_data   = new FormData($('#vehicle_details')[0]);
        if (allValid) {
            $.ajax({
                type        :"POST",
                enctype     : 'multipart/form-data',
                url         : ADMIN_URL + 'vehicle/upload_vehicle_photo',
                data        : form_data,
                processData : false,  // Important!
                contentType : false,
                success     : function(response) {   
                    response    = $.parseJSON(response);
                    if (response.status == true) {
                        if(typeof(response.html) != "undefined" && response.html !== null) {
                            $(".uploaded_vehicle_photo").append(response.html);
                        }
                    }
                }
            });
        } else {
            alert("Height and Width must be 290px X 205px");
        }
    });

    if($(".vehicle_type_cls").length > 0){
       $(".vehicle_type_cls").on("click", function(){
           var $this        = $(this);
           var vehicle_type    = $this.val();
           if (vehicle_type == '1') {
               $(".original_vehicles_content").removeClass("hide");
           } else if(vehicle_type == "0"){
               $(".original_vehicles_content").addClass("hide");
           }
       });
    }

    $(document).on('click', '.delete-vehicle', function(e) {
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
                    url : ADMIN_URL+'vehicle/delete',
                    data:{
                         id:myId
                    },
                    success:function(response){
                        response    = $.parseJSON(response);
                        if (response.status == true) {
                            showMessage('success', response.message);
                            loadVehicles();
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

    $(document).on('click', '.remove_ajax_vehicle_photo', function(e){
        e.preventDefault();
        var $this       = $(this);
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
                var type        = $this.data("type"); 
                var image_name  = $this.data("name");
                if (image_name != "") {
                    $.ajax({
                        type: "POST",
                        url : ADMIN_URL+'vehicle/remove_vehicle_photo',
                        data:{ image_name : image_name,  type : type},
                        success:function(response){
                            response    = $.parseJSON(response);
                            if (response.status == true) {
                                showMessage('success', response.message);
                                $this.parent(".vehicle_photo_list").remove();
                            } else {
                                showMessage('danger', response.message);
                            }
                        }
                    });
                }
            } else {
                return false;
            }
        });
    });

    $(document).on('click', '.remove_file', function(e) {
        e.preventDefault();
        var $this = $(this);
        var vehicle  = $this.data('name');

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
                    url : ADMIN_URL+'vehicle/remove_vehicle_file',
                    data:{
                         vehicle:vehicle
                    },
                    success:function(response){
                        response    = $.parseJSON(response);
                        if (response.status == true) {
                            showMessage('success', response.message);
                            get_bulk_vehicles();
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
});

function loadVehicles() {
    if ($('#adminUsers').length > 0) {
        $('#adminUsers').DataTable({
            "destroy"    : true,
            "processing" : true,
            "serverSide" : true,
            'pageLength' : 10,
            "ajax": {
                "url": ADMIN_URL+'vehicle',
                "type": "POST",
                "data": function() {
                    setTimeout(function() {
                        //initSwitch();
                    }, 500);
                }
            },
            "order": [[0, 'desc']],
            "columnDefs": [
                {
                    'targets': 2,
                    'createdCell':  function (td, cellData, rowData, row, col) {
                       $(td).attr('nowrap', ''); 
                    }
                }
            ],
            "columns": [
                { "data": "name" },
                { "data": "created_date" },
                { "data": "action", "bSortable": false }
            ]
        });
    }
}


function initValidation() {
    $("#vehicle_details").validate({
        ignore  : [],
        rules   : {
            title : {
                required : true,
                remote   : {
                    url     : ADMIN_URL+'vehicle/validate',
                    type    : "POST",
                    async   : false,
                    data    : {
                        id: function() {
                            return $('#vehicle_details :input[name="vehicle_id"]').val();
                        }
                    }
                }
            },
            category : {
                required    : true
            },
            vehicle_type : {
                required    : true
            },
            overview : {
                required    : true
            },
            min_day : {
                required    : true,
                number      : true
            },
            outstation_km : {
                required    : true,
                number      : true
            },
            outstation_price : {
                required    : true,
                number      : true
            },
            seating_capacity : {
                required    : true,
                number      : true
            }
        },
        messages: {
            title : {
                required : "Please enter vehicle name",
                remote   : "vehicle name already exist"  
            },
            category : {
                required   : "Please select category"
            },
            vehicle_type : {
                required   : "Please select vehicle type"
            },
            overview : {
                required : "Please enter overview"
            },
            min_hours : {
                required : "Please enter min hours",
                number   : "Please enter valid min hours"
            },
            local_km : {
                required : "Please enter local km",
                number   : "Please enter valid min hours"
            },
            hours_price : {
                required    : "Please enter hours price",
                number      : "Please enter valid min hours"
            },
            min_day : {
                required    : "Please enter min day",
                number      : "Please enter valid min day"
            },
            outstation_km : {
                required    : "Please enter outstation km",
                number      : "Please enter valid outstation km"
            },
            outstation_price : {
                required    : "Please enter outstation price",
                number      : "Please enter valid outstation price"
            },
            seating_capacity : {
                required    : "Please enter number of seating capacity",
                number      : "Please enter valid pages"
            }
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element);
            var panel_id = $('.error:not(label)').filter(":first").parents('.tab-pane').attr('id');
            $('#vehicle_details .nav-tabs a[href="#'+panel_id+'"]').trigger('click');
        },
        invalidHandler: function(form, validator) {
            var errors = validator.numberOfInvalids();
            if (errors > 0) {  
                var panel_id = $('.error:not(label)').filter(":first").parents('.tab-pane').attr('id');
                $('#vehicle_details .nav-tabs a[href="#'+panel_id+'"]').trigger('click');
            }
        }
    });

}

