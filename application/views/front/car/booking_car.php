<div class="tj-inner-banner">
    <div class="container">
        <h2>Booking Form</h2>
    </div>
</div>
<!--<div class="tj-breadcrumb">
    <div class="container">
        <ul class="breadcrumb-list">
            <li><a href="<?php echo base_url(); ?>">Home</a></li>
            <li class="active">Booking Form</li>
        </ul>
    </div>
</div>-->
<section class="tj-booking-frm">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <div class="tj-tabs">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="active"><a href="#point" data-toggle="tab">Point to Point</a></li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane active" id="point">
                        <form class="booking-frm" id="booking-frm" method="POST" id="ride-bform">
                            <div class="col-md-12 col-sm-12">
                                <div class="field-holder">
                                    <label for="one_way">
                                        <input type="radio" name="service_type" data-name="One Way" id="one_way" class="trip_type" checked value="0">One Way
                                    </label>
                                    <label for="two_way">
                                        <input type="radio" name="service_type" data-name="Two Way" id="two_way" class="trip_type" value="1">Two Way
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <!--<strong>From Location</strong>-->
                                <div class="field-holder location_form">
                                    <select name="trip_location" id="trip_location" placeholder="From Location">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="field-holder">
                                    <span class="fas fa-calendar-alt"></span>
                                    <input type="text" name="trip_pick_date" autocomplete="off" placeholder="Select your Date" class="pickup_date">
                                </div>
                            </div>
                            <div class="two_way_content hide">
                                <div class="col-md-6 col-sm-6">
                                    <div class="field-holder">
                                        <input type="text" name="trip_days" placeholder="Select trip days" class="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <!--<strong>To Location</strong>-->
                                <div class="field-holder location_form">
                                    <select name="drop_location" id="drop_location" placeholder="To Locations">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 ride-terms">
                                <p class="ride-terms" for="book_terms">I understand and agree with the <a href="<?php echo base_url(). "terms" ?>" target="_blank" >Terms of Service </a> and <a href="<?php echo base_url() . 'cancellation' ?>" target="_blank" > Cancellation </a> </p>
                                <label for="book_terms">
                                    <input name="book_terms" id="book_terms" type="checkbox">
                                </label>
                                <div class="tearms-error"></div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <button type="submit" class="book-btn">Next Step <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-12">
                <div class="booking-summary">
                    <h3>Booking Summary</h3>
                    <ul class="booking-info">
                        <li>
                            <span>Journey Type: </span>
                            <div class="service_type">One Way</div>
                        </li>
                        <li>
                            <span>Cab Name:</span><?php echo isset($booking_details["booking_cab"]->title) ? $booking_details["booking_cab"]->title : "" ?>
                        </li>
                    </ul>
                    <div class="journey-info">
                        <h4 class="service_type">Select Service Type</h4>
                    </div>
                    <ul class="booking-info">
                        <li><span>From: </span><div class="startup_loc info-outer">Enter Startup Location</div></li>
                        <li><span>Pickup Date: </span><div class="pick_date_cls info-outer">Enter Pickup Date</div></li>
                        <li><span>Pickup Time: </span><div class="pick_time_cls info-outer">Enter Pickup Time</div></li>
                    </ul>
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
                    <img src="images/cta-icon1.png" alt=""/>
                    <div class="cta-text">
                        <strong>Best Price Guaranteed</strong>
                        <p>A more recently with desktop softy  like aldus page maker.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="cta-box">
                    <img src="images/cta-icon2.png" alt=""/>
                    <div class="cta-text">
                        <strong>24/7 Customer Care</strong>
                        <p>A more recently with desktop softy  like aldus page maker.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="cta-box">
                    <img src="images/cta-icon3.png" alt=""/>
                    <div class="cta-text">
                        <strong>Easy Bookings</strong>
                        <p>A more recently with desktop softy  like aldus page maker.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>