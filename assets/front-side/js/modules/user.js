$(document).ready(function() {

    loadBooking();

    if($("#cancel_from").length > 0) {
        $('#cancel_from').validate({
            rules: {
                reason: {
                    required    : true
                }
            },
            messages: {
                reason:   {
                    required    : "Please enter reason"
                }
            },
            errorPlacement: function(error, element) {
                error.insertAfter(element);
            }
        });

        $(document).on("click", '.cancel_booking_btn', function(e){
            e.preventDefault();
            var $this       = $(this);
            var booking_id  = $this.data('booking_id');
            $("#cancel_from #booking_id").val(booking_id);
            $("#modalCancelBooking").modal("show");
        });

        $("#cancel_from").on("submit", function(e){
            e.preventDefault();
            var $this = $(this);
            if($this.valid()) {
                var form_data = new FormData($('#cancel_from')[0]);
                $.ajax({
                    type        :"POST",
                    enctype     : 'multipart/form-data',
                    url         : base_url + 'user/cancel_booking',
                    data        : form_data,
                    processData : false,  // Important!
                    contentType : false,
                    success     : function(response) {   
                        response    = $.parseJSON(response);
                        if (response.status == true) {
                            showMessage('success', response.message);
                            $("#modalCancelBooking").modal("hide");
                            $('#cancel_from')[0].reset();
                            loadBooking();
                        } else {
                            showMessage('danger', response.message);
                        }
                    }
                });
            }
        });
    }
});

function loadBooking() {
    if ($('#booking_table').length > 0) {
        $('#booking_table').DataTable({
            "destroy"    : true,
            "processing" : true,
            "serverSide" : true,
            'pageLength' : 10,
            "ajax": {
                "url": base_url + 'user/load_booking',
                "type": "POST"
            },
            //"order": [[1, 'desc']],
            "columns": [
                { "data": "trip_date" },
                { "data": "trip_type" },
                { "data": "from_location" },
                { "data": "to_location" },
                { "data": "trip_status" },
                { "data": "status" },
                { "data": "total_amount" },
                { "data": "action" },
            ]
        });
    }
}
