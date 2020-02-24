<section class="tj-banner-form">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-7">
                <div class="banner-caption">
                    <div class="banner-inner bounceInLeft animated delay-2s">
                        <strong>Unbeatable Price & Well-Maintained Fleet!</strong>
                        <h2>The Top Car Rental Service Provider in PAN India.</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-5">
                <div class="trip-outer">
                    <div class="trip-type-tabs">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#one-way" data-toggle="tab">One Way</a></li>
                            <li><a href="#two-way" data-toggle="tab">Two Way</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active" id="one-way">
                            <form method="POST" name="location_form" id="location_form" class="trip-frm2 booking-frm">
                                <input type="hidden" name="trip_type" value="0">
                                <div class="location_form form-group">
                                    <select name="trip_location" class="form-control" id="trip_location" placeholder="From Locations">
                                    </select>
                                </div>
                                <div class="location_form form-group">
                                    <select name="drop_location" class="form-control" id="drop_location" placeholder="To Locations">
                                    </select>
                                </div>
                                <div class="field-outer">
                                    <input type="text" name="trip_pick_date" class="pickup_date" autocomplete="off" placeholder="Select Date & Time">
                                </div>
                                <div class="field-outer">
                                    <input type="text" name="seating_capacity" placeholder="Seating Capacity">
                                </div>
                                <button type="submit" class="search-btn">Search Cabs <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>	
                            </form>
                        </div>
                        <div class="tab-pane" id="two-way">
                            <form method="POST" name="twoway_form" id="twoway_form" class="trip-frm2 booking-frm">
                                <input type="hidden" name="trip_type" value="1">
                                <div class="location_form form-group">
                                    <select name="trip_location" class="form-control" id="tw_trip_location" placeholder="From Locations">
                                    </select>
                                </div>
                                <div class="location_form form-group">
                                    <select name="drop_location" class="form-control" id="tw_drop_location" placeholder="To Locations">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="trip_pick_date" class="pickup_date" autocomplete="off" placeholder="Select Date & Time">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="trip_days" placeholder="Select Trip Days">
                                </div>
                                <div class="field-outer">
                                    <div class="field-outer">
                                        <input type="text" name="seating_capacity" placeholder="Seating Capacity">
                                    </div>
                                </div>
                                <button type="submit" class="search-btn">Search Cabs <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>	
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="tj-offers">
    <div class="row">
        <div class="col-md-3 col-sm-6">
            <div class="offer-box">
                <img src="<?php echo front_asset_url() ?>images/offer-icon1.png" alt=""/>
                <div class="offer-info">
                    <h4>Best Price Guaranteed</h4>
                    <p>Our prices are lowest in the industry to help you find and rent the best possible car rental in India.</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="offer-box">
                <img src="<?php echo front_asset_url() ?>images/offer-icon2.png" alt=""/>
                <div class="offer-info">
                    <h4>24/7 Customer Care</h4>
                    <p>Enjoy anywhere, anytime customer support to enjoy a stress-free car rental experience with experts.</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="offer-box">
                <img src="<?php echo front_asset_url() ?>images/offer-icon3.png" alt=""/>
                <div class="offer-info">
                    <h4>Home Pickups</h4>
                    <p>We reach your home on time so you are never late to reach your destination.</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="offer-box">
                <img src="<?php echo front_asset_url() ?>images/offer-icon4.png" alt=""/>
                <div class="offer-info">
                    <h4>Easy Bookings</h4>
                    <p>Book car with quick steps and enjoy fast and secure payment facility to match your requirements.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="cab-services">
    <div class="container">
        <div class="row">
            <div class="tj-heading-style">
                <h3>Our Services</h3>
                <p>Saarthi Cab brings to you the most affordable and timely car booking services to make sure you enjoy a great car booking experience!</p>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="cab-service-box">
                    <figure class="service-thumb">
                        <img src="<?php echo front_asset_url() ?>images/cab-service-icon6.png" alt=""/>
                    </figure>
                    <div class="service-desc">
                        <h4>Bus Hire</h4>
                        <p>Our fleet of buses is well maintained and available in different sizes to match your exact needs.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="cab-service-box">
                    <figure class="service-thumb">
                        <img src="<?php echo front_asset_url() ?>images/cab-service-icon6.png" alt=""/>
                    </figure>
                    <div class="service-desc">
                        <h4>Tempo Traveler</h4>
                        <p>We have tempo travelers available for big groups ranging from 10-15 people for comfortable traveling experience.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="cab-service-box">
                    <figure class="service-thumb">
                        <img src="<?php echo front_asset_url() ?>images/cab-service-icon1.png" alt=""/>
                    </figure>
                    <div class="service-desc">
                        <h4>One Way</h4>
                        <p>Affordable solution to those who seek only one-way fair for a particular destinations like hotels, restaurants, city, etc.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="cab-service-box">
                    <figure class="service-thumb">
                        <img src="<?php echo front_asset_url() ?>images/cab-service-icon4.png" alt=""/>
                    </figure>
                    <div class="service-desc">
                        <h4>Two Way</h4>
                        <p>A complete traveling solution to reach your destination and back on time at the lowest price guaranteed.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="cab-service-box">
                    <figure class="service-thumb">
                        <img src="<?php echo front_asset_url() ?>images/cab-service-icon3.png" alt=""/>
                    </figure>
                    <div class="service-desc">
                        <h4>Custom Booking</h4>
                        <p>Customized packages for travelers having special requirements so we can customized to match your needs.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="cab-service-box">
                    <figure class="service-thumb">
                        <img src="<?php echo front_asset_url() ?>images/cab-service-icon2.png" alt=""/>
                    </figure>
                    <div class="service-desc">
                        <h4>Airport</h4>
                        <p>We offer meet and greet service on all airport as per your flight schedule.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="cab-service-box">
                    <figure class="service-thumb">
                        <img src="<?php echo front_asset_url() ?>images/cab-service-icon5.png" alt=""/>
                    </figure>
                    <div class="service-desc">
                        <h4>Hotels</h4>
                        <p>Our luxury and affordable fleet can accommodate your whole group to transfer to top hotels.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="cab-service-box">
                    <figure class="service-thumb">
                        <img src="<?php echo front_asset_url() ?>images/cab-service-icon6.png" alt=""/>
                    </figure>
                    <div class="service-desc">
                        <h4>Home pickup</h4>
                        <p>Saarthi Cab offers best reliable and safest transfers from your home to your preferred destination on time.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php if (isset($car_list) && !empty($car_list)) { ?>
    <section class="fleet-carousel">
        <div class="col-md-12 col-sm-12">
            <div class="tj-heading-style">
                <h3>Our Car Fleet</h3>
            </div>
        </div>
        <div class="carousel-outer">
            <div class="cab-carousel" id="cab-carousel">
                <?php foreach ($car_list as $car) { ?>
                    <div class="fleet-item">
                        <img src="<?php echo base_url() . 'attachment/view/' . encryptIt($car->img_id); ?>" alt=""/>
                        <div class="fleet-inner">
                            <h4><?php echo $car->title; ?></h4>
                            <ul>
                                <li><i class="fas fa-user-circle"></i><?php echo $car->seating_capacity; ?> Passengers</li>
                            </ul>
                            <strong class="price"></strong>
                            <a href="<?php echo base_url() . 'car/confirm_booking/' . encreptIt($car->id) ?>">Book Now <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
<?php } ?>

<section class="tj-welcome">
    <div class="container">
        <div class="row">
            <div class="col-md-7 col-sm-7">
                <div class="about-info">
                    <div class="tj-heading-style">
                        <h3>Who We Are</h3>
                    </div>
                    <p>Saarthi Cab is the top taxi booking service provider, specializing in offering luxury and affordable taxi booking solutions. Each cab is driven by the licensed chauffeurs who are trained and professional to cater to all your special requirements. We bring the best taxi booking services with a fleet consisting of hatchback, sedan, SUV and luxury vehicles.</p>
                    <p><a href="<?php echo base_url().'car/search'; ?>">See all Vehicles<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a></p>
                    <ul class="facts-list">
                        <li>
                            <strong class="fact-count">100</strong>
                            <i class="fa fa-percent"></i>
                            <span>Happy Customer</span>
                        </li>
                        <li>
                            <strong class="fact-count">200</strong>
                            <i class="fas fa-plus"></i>
                            <span>Luxury Cars</span>
                        </li>
                        <li>
                            <strong class="fact-count">12,000</strong>
                            <i class="fas fa-arrow-up"></i>
                            <span>Kilometers Driven</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-5 col-sm-5">
                <div class="welcome-banner">
                    <img src="<?php echo front_asset_url() ?>images/welcome-img.jpg" alt=""/>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="tj-reviews">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="tj-heading-style">
                    <h3>Testimonials</h3>
                </div>
            </div>
            <div class="col-md-12 col-sm-12">
                <div id="testimonial-slider" class="reviews-slider">
                    <div class="review-item">
                        <figure class="img-box">
                            <img src="<?php echo front_asset_url() ?>images/testimonial-img1.png" alt="" />
                        </figure>
                        <div class="review-info">
                            <strong>James Peter</strong>
                            <span class="icon-star-empty icomoon rating"></span>
                            <span class="icon-star-empty icomoon rating"></span>
                            <span class="icon-star-empty icomoon rating"></span>
                            <span class="icon-star-empty icomoon rating"></span>
                            <span class="icon-star-empty icomoon"></span>
                            <div class="review-quote">
                                <p>It’s been great experience with Saarthi Cab. The driver reaches before the time and the car was very well maintained and clean. Thumbs Up!</p>
                            </div>
                        </div>
                    </div>
                    <div class="review-item">
                        <figure class="img-box">
                            <img src="<?php echo front_asset_url() ?>images/testimonial-img2.png" alt="" />
                        </figure>
                        <div class="review-info">
                            <strong>Stefy Grafi</strong>
                            <span class="icon-star-empty icomoon rating"></span>
                            <span class="icon-star-empty icomoon rating"></span>
                            <span class="icon-star-empty icomoon rating"></span>
                            <span class="icon-star-empty icomoon rating"></span>
                            <span class="icon-star-empty icomoon"></span>
                            <div class="review-quote">
                                <p>I have been booking cabs from Saarthi Cab for a long time for commercial purposes. They are always on time and very professional.</p>
                            </div>
                        </div>
                    </div>
                    <div class="review-item">
                        <figure class="img-box">
                            <img src="<?php echo front_asset_url() ?>images/testimonial-img1.png" alt="" />
                        </figure>
                        <div class="review-info">
                            <strong>James Peter</strong>
                            <span class="icon-star-empty icomoon rating"></span>
                            <span class="icon-star-empty icomoon rating"></span>
                            <span class="icon-star-empty icomoon rating"></span>
                            <span class="icon-star-empty icomoon rating"></span>
                            <span class="icon-star-empty icomoon"></span>
                            <div class="review-quote">
                                <p>10/10! It was a wonderful experience with Saarthi Cab. Extremely friendly, helpful & nothing is ever a problem. Highly recommend!</p>
                            </div>
                        </div>
                    </div>
                    <div class="review-item">
                        <figure class="img-box">
                            <img src="<?php echo front_asset_url() ?>images/testimonial-img2.png" alt="" />
                        </figure>
                        <div class="review-info">
                            <strong>Stefy Grafi</strong>
                            <span class="icon-star-empty icomoon rating"></span>
                            <span class="icon-star-empty icomoon rating"></span>
                            <span class="icon-star-empty icomoon rating"></span>
                            <span class="icon-star-empty icomoon rating"></span>
                            <span class="icon-star-empty icomoon"></span>
                            <div class="review-quote">
                                <p>We found Saarthi Cab online and decided to take a chance using them to transport us from Delhi Airport. We were promptly met by our driver and reached the hotel on time.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>	
        </div>
    </div>
</section>