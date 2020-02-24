$(document).ready(function () {
    
});

function showMessage(type, message) {
    toastr.options = {
        closeButton: true,
        debug: true,
        progressBar: false,
        positionClass: 'toast-top-right',
        onclick: null
    };

    if (type == 'success') {
        toastr.success(message, 'Success', {timeOut: 5000})
    }
    if (type == 'danger') {
        toastr.error(message, 'Error', {timeOut: 5000})
    }
}