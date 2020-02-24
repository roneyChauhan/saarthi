$(document).ready(function() {

    loadCms();

    $('#title').on('keyup', function(e){
        e.preventDefault();
        var url = $(this).val();
        url = url.replace(/\s+/g, '-').toLowerCase();
        url = url.replace("'","");
        url = url.replace('"',"");
        $('#url').val(url);
        $('#urlText').val(base_url+'page/'+url);
    });

    $(document).on('click', '.delete-cms', function(e) {
        e.preventDefault();
        var $this = $(this);
        var myId  = $this.parent('.dropdown-menu').data('id');

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
                    url : ADMIN_URL+'cms/delete',
                    data:{
                         id:myId
                    },
                    success:function(response){
                        response    = $.parseJSON(response);
                        if (response.status == true) {
                            showMessage('success', response.message);
                            loadCms();
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

    $("#cms_form").validate({
        rules: {
            title : {
                required : true,
                remote   : {
                            url     : ADMIN_URL+'cms/validate',
                            type    : "POST",
                            async   : false,
                            data    : {
                                    id: function()
                                    {
                                        return $('#cms_form :input[name="cms_id"]').val();
                                    }
                                }
                        }
            },
            heading : {
                required : true
            }
        },
        messages: {
            title : {
                required : "Please enter title",
                remote   : "Title name already exist"
            },
            heading : {
                required : "Please enter heading"
            }
        }
    });

});

function loadCms() {
    if ($('#cmsTable').length > 0) {
        $('#cmsTable').DataTable({
            "destroy"    : true,
            "processing" : true,
            "serverSide" : true,
            'pageLength' : 10,
            "ajax": {
                "url": ADMIN_URL+'cms',
                "type": "POST",
                "data": function() {
                    setTimeout(function() {
                        initSwitch();
                    }, 500);
                }
            },
            "order": [[4, 'desc']],
            "columns": [
                { "data": "id"},
                { "data": "title" },
                { "data": "url" },
                { "data": "status" },
                { "data": "modify_date" },
                { "data": "action", "bSortable": false }
            ]
        });
    }
}
