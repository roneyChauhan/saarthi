<div class="tj-inner-banner">
    <div class="container">
        <h2>Payment</h2>
    </div>
</div>
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
<section class="tj-payment" id="success-payment">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-8">
                <div class="success-msg">
                    <span class="fas fa-check"></span>
                    <h3>Payment Successfull!</h3>
                    <p>Your payment of ₹<?php echo isset($booking_details->total_amount) ? $booking_details->total_amount : "" ?> to PrimeCabs ID:<?php echo isset($booking_details->reference_id) ? $booking_details->reference_id : "" ?> has been proceeded Successfully!.We’ll send you a confirmation Email shortly.</p>
                    <a href="<?php echo base_url(); ?>"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back to Home</a>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="booking-summary">
                    <h3>Booking Summary</h3>
                    <ul class="booking-info">
                        <?php 
                            $journey_type = "One Way";
                            if($booking_details->service_type == 1) {
                                $journey_type = "Two Way";
                            }
                        ?>
                        <li><span>Booking Reference: </span><?php echo isset($booking_details->reference_id) ? $booking_details->reference_id : "" ?></li>
                        <li><span>Journey Type: </span> <?php echo $journey_type; ?> </li>
                    </ul>
                    <div class="journey-info">
                        <h4>One Way Journey</h4>
                        <i class="far fa-edit"></i>
                    </div>
                    <ul class="booking-info">
                        <li><span>From: </span><?php echo isset($booking_details->pick_city) ? $booking_details->pick_city : "" ?> , <?php echo isset($booking_details->pick_state) ? ucfirst(strtolower($booking_details->pick_state)) : "" ?></li>
                        <li><span>To: </span><?php echo isset($booking_details->drop_city) ? $booking_details->drop_city : "" ?> , <?php echo isset($booking_details->drop_state) ? ucfirst(strtolower($booking_details->drop_state)) : "" ?></li>
                        <li><span>Pickup Date: </span><?php echo (isset($booking_details->pickup_date) && $booking_details->pickup_date != "0000-00-00") ? date("d F, Y", strtotime($booking_details->pickup_date)) : "" ?></li>
                        <li><span>Pickup Time: </span><?php echo (isset($booking_details->pickup_time) && $booking_details->pickup_time != "00:00:00.000000") ? date("H:i A", strtotime($booking_details->pickup_time)) : "" ?></li>
                        <?php if(isset($booking_details->trip_days) && $booking_details->trip_days > 0 ) { ?>
                            <li>
                                <span>Trip Days: </span> <?php echo $booking_details->trip_days; ?> 
                            </li>
                        <?php } ?>
                    </ul>
                    <div class="fare-box">
                        <strong>Total Fare: <span>₹<?php echo isset($booking_details->total_amount) ? $booking_details->total_amount : "" ?></span></strong>
                        <span>( inclusive of All Taxes )</span>
                        <a href="javascript:void();" class="details_price" >Amount Details </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<section class="tj-cal-to-action">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-4">
                <div class="cta-box">
                    <img src="<?php echo front_asset_url(); ?>images/cta-icon1.png" alt=""/>
                    <div class="cta-text">
                        <strong>Best Price Guaranteed</strong>
                        <p>A more recently with desktop softy  like aldus page maker.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="cta-box">
                    <img src="<?php echo front_asset_url(); ?>images/cta-icon2.png" alt=""/>
                    <div class="cta-text">
                        <strong>24/7 Customer Care</strong>
                        <p>A more recently with desktop softy  like aldus page maker.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="cta-box">
                    <img src="<?php echo front_asset_url(); ?>images/cta-icon3.png" alt=""/>
                    <div class="cta-text">
                        <strong>Easy Bookings</strong>
                        <p>A more recently with desktop softy  like aldus page maker.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>