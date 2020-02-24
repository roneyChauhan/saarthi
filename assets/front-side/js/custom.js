$(document).ready(function () {
    "use strict";

    if($(".details_price").length > 0){
        $(".details_price").on("click", function(e){
            e.preventDefault();
            $("#modalPricingModel").modal("show");
        });
    }	
    /* Preloader Script
    ======================================================*/
	
    $(".tj-loader").delay(800).slideUp(1600);
    $(".loader-outer").delay(800).slideUp(1600);
	
	
	
    /* Sticky Navigation
    ======================================================*/
    if( $('.tj-nav-row').length ){
        var stickyNavTop = $('.tj-nav-row').offset().top;
        var stickyNav = function(){
            var scrollTop = $(window).scrollTop();
            if (scrollTop > 500) { 
                $('.tj-nav-row').addClass('sticky');	
            } else {
                $('.tj-nav-row').removeClass('sticky'); 
            }
        };
        stickyNav();
        $(window).scroll(function() {
            stickyNav();
        });
    }
	
	
    /* Owl Slider For Partners
    ======================================================*/
    if ($('.partners-list').length) {
        $('.partners-list').owlCarousel({
            loop:true,
            dots: false,
            nav:false,
            navText:'',
            items:5,
            autoplay: false,
            smartSpeed:2000,
            responsiveClass:true,
            responsive:{
                0:{
                    items:2,
                },
                768:{
                    items:3,
                },
                992:{
                    items:4,
                },
                1199:{
                    items:5,
                }
            }
        });
    }
	
    /* Owl Slider For Testimonial 1
    ======================================================*/
    if ($('#testimonial-slider').length) {
        $('#testimonial-slider').owlCarousel({
            loop:true,
            dots: false,
            nav:true,
            navText:'',
            items:2,
            margin:30,
            autoplay: true,
            smartSpeed:1000,
            responsiveClass:true,
            responsive:{
                0:{
                    items:1,
                },
                768:{
                    items:2,
                },
                992:{
                    items:2,
                },
                1199:{
                    items:2,
                }
            }
        });
    }
	
	
    /* Owl Slider For Testimonial 2
    ======================================================*/
    if ($('#testimonial-slider2').length) {
        $('#testimonial-slider2').owlCarousel({
            loop:true,
            dots: false,
            nav:false,
            navText:'',
            items:1,
            autoplay:true,
            smartSpeed:1200,
            responsiveClass:true,
            responsive:{
                0:{
                    items:1,
                },
                768:{
                    items:1,
                },
                992:{
                    items:1,
                },
                1199:{
                    items:1,
                }
            }
        });
    }
	
	
    /* Owl Slider For Home 2 Cab Slider
    ======================================================*/
    if ($('#cab-slider').length) {
        $('#cab-slider').owlCarousel({
            loop:true,
            dots: false,
            nav:true,
            navText:'',
            items:1,
            autoplay:true,
            autoplayTimeout :3000,
            smartSpeed:500,
            responsiveClass:true,
            responsive:{
                0:{
                    items:1,
                    nav:false,
                    dots:true,
                },
                768:{
                    items:1,
                },
                992:{
                    items:1,
                },
                1199:{
                    items:1,
                }
            }
        });
    }
    
    /* Blog Slider
    ======================================================*/
    if ($('#blog-slider').length) {
        $('#blog-slider').owlCarousel({
            loop:true,
            dots: false,
            nav:true,
            navText:'',
            autoplay:true,
            items:3,
            smartSpeed:1000,
            responsiveClass:true,
            responsive:{
                0:{
                    items:1,
                },
                768:{
                    items:1,
                },
                992:{
                    items:1,
                },
                1199:{
                    items:1,
                }
            }
        });
    }
	
	
    /* Counter Script
    ======================================================*/
    if ($('.fact-counter').length) {
        $('.fact-counter').counterUp({
            delay: 50,
            time: 3000
        });
    }
	
    if ($('.fact-count').length) {
        $('.fact-count').counterUp({
            delay: 70,
            time: 2000
        });
    }
    if ($('.fact-num').length) {
        $('.fact-num').counterUp({
            delay: 70,
            time: 2000
        });
    }
	
	
    /* Car Price Range Filter
    ======================================================*/
    if($( "#price-range" ).length){
        $( "#price-range" ).slider({
            range: true,
            min: 0,
            max: 500,
            values: [ 75, 300 ],
            slide: function( event, ui ) {
                $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
            }
        });
        $( "#amount" ).val( "$" + $( "#price-range" ).slider( "values", 0 ) +
            " - $" + $( "#price-range" ).slider( "values", 1 ) );
    }
	
	
    /* Owl Slider For Fleet Carousel
    ======================================================*/
    if ($('#cab-carousel').length) {
        $('#cab-carousel').owlCarousel({
            loop:true,
            dots: false,
            nav:true,
            navText:'',
            items:3,
            margin:150,
            center: true,
            autoplay: true,
            autoplayTimeout :3000, 
            smartSpeed:1000,
            responsiveClass:true,
            responsive:{
                0:{
                    items:1,
                },
                768:{
                    items:2,
                },
                992:{
                    items:2,
                },
                1199:{
                    items:3,
                }
            }
        });
    }
	
	
    /* Cab Filter Isotope Script
    ======================================================*/
    if ($('.cab-filter').length) {
        var $container = $('.cab-filter').imagesLoaded(function() {
            $container.isotope({
                filter: '*',
                animationOptions: {
                    duration: 750,
                    easing: 'linear',
                    queue: false,
                }
            });	
            $('.cab-filter-nav a').on("click", function(){
                $('.cab-filter-nav .current').removeClass('current');
                $(this).addClass('current');
		 
                var selector = $(this).attr('data-filter');
                $container.isotope({
                    filter: selector,
                    animationOptions: {
                        duration: 750,
                        easing: 'linear',
                        queue: false,
                    }
                });
                return false;
            }); 
        });
    }
	
    /* Twitter Feed Script
    ======================================================*/
//    if ($('.tj-tweets').length) {
//        $('.tj-tweets').twittie({
//            username: 'sameersattar13',
//            dateFormat: '%b, %d, %Y',
//            template: '{{tweet}}} <div class="date">{{date}}</div>',
//            count: 2,
//            loadingText: 'Loading!'
//        });
//    }
	
	
    /* Gallery Carousel Script
    ======================================================*/
		
    if($(".gallery-thumb").length && $(".gallery").length){
        var right = $(".right-outer");
        var gal_thumb = $(".gallery-thumb");
        var gal = $(".gallery");

        gal_thumb.slick({
            rows: 0,
            slidesToShow: 2,
            draggable: false,
            useTransform: false,
            mobileFirst: true,
            responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 1023,
                settings: {
                    slidesToShow: 1,
                    vertical: true
                }
            }
            ]
        });

        gal.slick({
            rows: 0,
            useTransform: false,
            arrows: true,
            fade: true,
            autoplay: true,
            speed:600,
            cssEase: 'ease-in-out',
            asNavFor: gal_thumb,
		
        });
        $(".gallery-thumb .item").on("click", function() {
            var index = $(this).attr("data-slick-index");
            gal.slick("slickGoTo", index);
        });
    }
    function getCarouselHeight() {
        if($(".gallery-thumb").length && $(".gallery").length){
            if (window.matchMedia("(min-width: 1024px)").matches) {
                var galHeight = $(".gallery").height();
                right.css("height", galHeight);
            } else {
                right.css("height", "auto");
            }
        }else{
            return;
        }
    }

    $(window).on("load",function() {
        getCarouselHeight();
    });
		
	
    /* Contact Form Validation/Ajax Call
    ======================================================*/
    if($('#contact-form').length) {
        
//        $("#contact-form").on('submit', function(e) {
//            e.preventDefault();
//            if ($(this).valid()) {  
//                var form_data = new FormData($('#contact-form')[0]);
//                $.ajax({
//                    type        : "POST",
//                    enctype     : 'multipart/form-data',
//                    data        : form_data,
//                    url         : base_url + 'contact-us',
//                    processData : false,  // Important!
//                    contentType : false,
//                    success : function(response) {   
//                        response    = $.parseJSON(response);
//                        if (response.status == true) {
//                            showMessage('success', response.message);
//                            $('#contact_form').find('input').val('');
//                            $('#contact_form').find('textarea').val('');
//                            $("#frm_submit_btn").text("Email Sent").addClass('success');
//                            $("#frm_submit_btn").removeAttr('disabled');
//                            $("#frm_submit_btn").removeClass('wait');
//                            $('#contact-form')[0].reset();
//                        } else {
//                            showMessage('danger', response.message);
//                            $("#frm_submit_btn").text("Email Failed").addClass('fail');
//                            $("#frm_submit_btn").removeAttr('disabled');
//                            $("#frm_submit_btn").removeClass('wait');
//                        }
//                    }
//                });
//            }
//        });

        $("#contact-form").validate({
            rules: {
                name: "required",
                email: {
                    required: true,
                    email: true
                },
                subject: "required",
                message: "required"
            },
            messages: {
                name: "Please enter your name",
                email: "Please enter a valid email address",
                subject: "It is a required field",
                message: "It is a required field"
            },
            submitHandler: function(form) {
                $.ajax({
                    type        : 'POST', 
                    enctype     : 'multipart/form-data',
                    url         : base_url + 'home/contact_us',
                    processData : false,  // Important!
                    contentType : false,
                    data        : new FormData($('#contact-form')[0]),
                    beforeSend: function() {
                        $("#frm_submit_btn").text("Sending..").addClass('wait');
                        $("#frm_submit_btn").attr('disabled','disabled');
                    },
                    success: function(result){
                        var response    = $.parseJSON(result);
                        if(response.status == true){
                            showMessage('success', response.message);
                            $('#contact_form').find('input').val('');
                            $('#contact_form').find('textarea').val('');
//                            alert("Thank you for contacting. We will get in touch with you soon!");
                            //$("#frm_submit_btn").text("Email Sent").addClass('success');
                            $("#frm_submit_btn").removeAttr('disabled');
                            $("#frm_submit_btn").removeClass('wait');
                            $('#contact-form')[0].reset();
                        }else{
                            showMessage('error', response.message);
//                            alert("Something went wrong. Please check your entries and try again");
                            //$("#frm_submit_btn").text("Email Failed").addClass('fail');
                            $("#frm_submit_btn").removeAttr('disabled');
                            $("#frm_submit_btn").removeClass('wait');
                        }
                    }
                });
                return false;
            }
        });
    }
      
      
      
      
    /* Booking Form Script
    ======================================================*/
	
    var nowDate = new Date();
    var today   = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
	
    if($('.pickup_date').length){
        $('.pickup_date').datetimepicker({
            format: "dd-mm-yyyy HH:ii P",
            autoclose: !0,
            showMeridian: !0,
            todayBtn: !0,
            pickerPosition: "bottom-left"
        });
    }

    if($('.pickup_time').length){
        $('.pickup_time').datetimepicker({
            format: 'h:mm a'
        });
    }
    if($('.booking-frm #dropoff_date').length){
        $('.booking-frm #dropoff_date').datetimepicker({
            format: 'MM/DD/YYYY',
            minDate: today
        });
    }

    if($('.booking-frm #dropoff_time').length){
        $('.booking-frm #dropoff_time').datetimepicker({
            format: 'h:mm a'
        });
    }
    //On Load Condition
    var service_type = $(".booking-frm input[name='service_type']:checked").data("name");
    if( service_type !== null ){
        $('.booking-summary .service_type').text(service_type);
    }

    //On Change Keypress Blur Keyup Condition
    $('.booking-frm #trip_location,.booking-frm input[name="service_type"],.booking-frm #drop_location,.booking-frm #trip_pick_date,.booking-frm #trip_pick_time').on('keyup keypress blur change',function(event){
        //Get Values
        var booking_field_val   = $(this).val();
        var booking_field_id    = $(this).attr('id');
        var service_type        = $(".booking-frm input[name='service_type']:checked").data("name");
        $('.booking-summary .service_type').text(service_type);
        if( booking_field_val.length > 0 ){
            if(booking_field_id=='trip_location'){
                //$('.booking-summary .startup_loc').text(booking_field_val);
            }else if(booking_field_id=='drop_location'){
                //$('.booking-summary .end_loc').text(booking_field_val);
            }else if(booking_field_id=='trip_pick_date'){
                //$('.booking-summary .pick_date_cls').text(booking_field_val);
            }else if(booking_field_id=='trip_pick_time'){
                //$('.booking-summary .pick_time_cls').text(booking_field_val);
            }
        }else{
            if(booking_field_id=='trip_location'){
                $('.booking-summary .startup_loc').text('Enter Startup Location');
            }else if(booking_field_id=='drop_location'){
                $('.booking-summary .end_loc').text('Enter Destination');
            }else if(booking_field_id=='trip_pick_date'){
                $('.booking-summary .pick_date_cls').text('Enter Pickup Date');
            }else if(booking_field_id=='trip_pick_time'){
                $('.booking-summary .pick_time_cls').text('Enter Pickup Time');
            }
        }
    }); 	
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