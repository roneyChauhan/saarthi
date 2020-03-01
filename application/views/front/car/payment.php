<div class="tj-inner-banner">
    <div class="container">
        <h2>Payment</h2>
    </div>
</div>
<!--Inner Banner Section End-->

<!--Breadcrumb Section Start-->
<!--<div class="tj-breadcrumb">
    <div class="container">
        <ul class="breadcrumb-list">
            <li><a href="<?php echo base_url(); ?>">Home</a></li>
            <li><a href="<?php echo base_url(); ?>">Booking Form</a></li>
            <li><a href="<?php echo base_url(); ?>">Confirm Booking</a></li>
            <li class="active">Payment</li>
        </ul>
    </div>
</div>-->
<!--Breadcrumb Section End-->	

<!--Booking Form Section Start-->	
<section class="tj-payment">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-8">
                <div class="tj-tabs">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="active"><a href="#payment" data-toggle="tab">Payment Method</a></li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane active"  id="payment">
                        <form class="payment-frm" action="<?php echo base_url().'car/checkout' ?>" method="POST">
                            <input type="hidden" name="car_id" value="<?php echo isset($booking_details["booking_cab"]->id) ? encreptIt($booking_details["booking_cab"]->id) : "" ; ?>">
                            <div class="col-md-12 col-sm-12">
                                <div class="payment-field">
                                    <label for="paytm">
                                        <input type="radio" checked name="payment_type" id="paytm">Paytm
                                    </label>
                                    <img src="<?php echo front_asset_url() ?>images/paytm.jpg" alt="" />
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <button type="button" class="btn btn-info need_to_inqury">Send Inquiry</button>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <h3>OR</h3>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <p>Contect us on this number : <strong> <a href="tel:+919772074310">+919772074310</a>  </strong></p> 
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <h3>OR</h3>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="payment-field">
                                    <label for="full_paytm">
                                        <input type="radio" checked name="payment_method" value="0" id="full_paytm">Full Payment
                                    </label>
                                </div>
                                <div class="payment-field">
                                    <label for="part_paytm">
                                        <input type="radio" name="payment_method" value="1" id="part_paytm">Partial payment
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <button type="submit" class="book-btn">Book Now <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12 col-xs-12">
                <div class="booking-summary">
                    <h3>Booking Summary</h3>
                    <ul class="booking-info">
                        <li>
                            <span>Journey Type:</span><?php echo isset($booking_details["journey_type"]) ? $booking_details["journey_type"] : "" ?>
                        </li>
                        <li>
                            <span>Cab Name:</span><?php echo isset($booking_details["booking_cab"]->title) ? $booking_details["booking_cab"]->title : "" ?>
                        </li>
                    </ul>
                    <div class="journey-info">
                        <h4 class="service_type"></h4>
                    </div>
                    <ul class="booking-info">
                        <li>
                            <span>From: </span><?php echo isset($booking_details["trip_location_name"]) ? $booking_details["trip_location_name"] : "" ?>
                        </li>
                        <li>
                            <span>To: </span><?php echo isset($booking_details["drop_location_name"]) ? $booking_details["drop_location_name"] : "" ?>
                        </li>
                        <li>
                            <span>Pick Date: </span> <?php echo (isset($booking_details["pick_date"]) && $booking_details["pick_date"] != "") ? date("d F, Y", strtotime($booking_details["pick_date"])) : "" ?> 
                        </li>
                        <li>
                            <span>Pick time: </span> <?php echo (isset($booking_details["pick_time"]) && $booking_details["pick_time"] != "") ? date("h:i A", strtotime($booking_details["pick_time"])) : "" ?> 
                        </li>
                        <?php if(isset($booking_details["trip_days"]) && $booking_details["trip_days"] > 0) { ?>
                            <li>
                                <span>Trip Days: </span> <?php echo $booking_details["trip_days"]; ?> 
                            </li>
                        <?php } ?>
                    </ul>
                    <div class="fare-box">
                        <strong>Total Price</strong>
                        <span>Rs. <?php echo isset($selected_car->total_price) && ($selected_car->total_price > 0) ? $selected_car->total_price : "" ?></span>
                        <span>( inclusive of All Taxes )</span>
                        <a href="javascript:void();" class="details_price" >Amount Details </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<style>
    .payment-inquiry-model {
        position    : absolute;
        top         : 10px;
        right       : 100px;
        bottom      : 0;
        left        : 0;
        z-index     : 10040;
        overflow    : auto;
        overflow-x  : auto;
        overflow-y  : auto;
     }
    .pricing-model {
        position    : absolute;
        top         : 10px;
        right       : 100px;
        bottom      : 0;
        left        : 0;
        z-index     : 10040;
        overflow    : auto;
        overflow-x  : auto;
        overflow-y  : auto;
     }
</style>
<div class="modal payment-inquiry-model fade" id="modalSendInquiry" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Send inquiry us</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form name="inquiry_from" id="inquiry_from" method="post" >
                <div class="modal-body mx-3">
                    <div class="form-group mb-5 mt-3">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control ">
                    </div>
                    <div class="form-group mb-5 mt-3">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" class="form-control ">
                    </div>
                    <div class="form-group mb-5 mt-3">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control ">
                    </div>
                    <div class="form-group mb-5 mt-3" >
                        <label for="message">Message</label>
                        <textarea type="text" id="message" name="message" class="md-textarea form-control" rows="4"></textarea>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button class="btn btn-unique" type="submit" >Send</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal pricing-model fade" id="modalPricingModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Amount Summery </h4>
            </div>
            <div class="modal-body mx-3">
                <div class="fleet-list-box">
                    <div class="fleet-text">
                        <div class="exclusive-cls">
                            <a class="exclusive-link-cls active" data-toggle="pill" href="#inclusion_1">Fare Breakup</a>
                            <a class="exclusive-link-cls nav-link mr-2" data-toggle="pill" href="#exclusion_1">Exclusion</a>
                            <a class="exclusive-link-cls nav-link mr-2" data-toggle="pill" href="#extraCharges_1">Extra Charges</a>
                            <div class="card card-body border border-0 pt-0">
                                <div class="tab-content">
                                    <div id="inclusion_1" class="container tab-pane pl-0 pr-0 pt-2 active">
                                        <?php if (isset($selected_car->route_km) && ($selected_car->route_km > 0) ) { ?>
                                            <ul class="fleet-meta">
                                                <li>Running Distance</li>
                                                <li> <?php echo $selected_car->route_km; ?> KM</li>
                                            </ul>
                                        <?php } ?>
                                        <?php if (isset($selected_car->outstation_price) && ($selected_car->outstation_price > 0) ) { ?>
                                            <ul class="fleet-meta">
                                                <li>Rate/Km	</li>
                                                <li>Rs <?php echo $selected_car->outstation_price; ?></li>
                                            </ul>
                                        <?php } ?>
                                        <?php if (isset($selected_car->route_price) && ($selected_car->route_price > 0) ) { ?>
                                            <ul class="fleet-meta">
                                                <li>Base Fare</li>
                                                <li>Rs <?php echo $selected_car->route_price; ?></li>
                                            </ul>
                                        <?php } ?>
                                        <?php if (isset($selected_car->driver_price) && ($selected_car->driver_price > 0) ) { ?>
                                            <ul class="fleet-meta">
                                                <li>Driver Allowances</li>
                                                <li>Rs <?php echo $selected_car->driver_price; ?></li>
                                            </ul>
                                        <?php } ?>
                                        <?php if (isset($selected_car->total_price) && ($selected_car->total_price > 0) ) { ?>
                                            <ul class="fleet-meta">
                                                <li>Total Fare</li>
                                                <li>Rs <?php echo $selected_car->total_price; ?></li>
                                            </ul>
                                        <?php } ?>
                                    </div>
                                    <div id="exclusion_1" class="container tab-pane fade pl-0 pr-0 pt-2">
                                        <ul class="fleet-meta">
                                            <li>Toll</li>
                                            <li>Parking</li>
                                            <li>State Permit</li>
                                        </ul>
                                    </div>
                                    <div id="extraCharges_1" class="container tab-pane fade pl-0 pr-0 pt-2">
                                        <ul class="fleet-meta">
                                            <li>Extra Km beyond</li>
                                            <li>Rs.8.5/km</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>